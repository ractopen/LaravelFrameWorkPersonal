<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    public function index()
    {
        $items = Item::all();
        return view('shop.index', compact('items'));
    }

    public function addToCart(Request $request, Item $item)
    {
        // Check stock availability
        if ($item->stock < 1) {
            return back()->withErrors(['error' => 'This item is out of stock.']);
        }

        $cart = Cart::firstOrCreate(
            ['user_id' => Auth::id(), 'status' => 'active']
        );

        $cartItem = CartItem::where('cart_id', $cart->id)
                            ->where('item_id', $item->id)
                            ->first();

        if ($cartItem) {
            // Check if incrementing would exceed stock
            if ($cartItem->quantity + 1 > $item->stock) {
                return back()->withErrors(['error' => 'Not enough stock available.']);
            }
            $cartItem->increment('quantity');
        } else {
            CartItem::create([
                'cart_id' => $cart->id,
                'item_id' => $item->id,
                'quantity' => 1,
            ]);
        }

        return back()->with('success', 'Item added to cart.');
    }

    public function viewCart()
    {
        $cart = Cart::where('user_id', Auth::id())
                    ->where('status', 'active')
                    ->with('items')
                    ->first();
        
        return view('shop.cart', compact('cart'));
    }

    public function checkout(Request $request)
    {
        $cart = Cart::where('user_id', Auth::id())
                    ->where('status', 'active')
                    ->with('items')
                    ->first();

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('shop.cart');
        }

        // Filter items if selection is made
        $selectedIds = $request->input('selected_items', []);
        $quantities = $request->input('quantities', []);
        
        if (empty($selectedIds)) {
            return back()->withErrors(['error' => 'Please select at least one item to checkout.']);
        }

        $selectedItems = $cart->items->whereIn('id', $selectedIds)->map(function($item) use ($quantities) {
            // Use the submitted quantity if available
            if (isset($quantities[$item->id])) {
                $item->pivot->quantity = max(1, (int)$quantities[$item->id]);
            }
            
            // Check stock availability
            if ($item->pivot->quantity > $item->stock) {
                return null; // Mark for removal
            }
            
            return $item;
        })->filter(); // Remove null items

        // Check if any items were removed due to stock
        if ($selectedItems->count() < count($selectedIds)) {
            return back()->withErrors(['error' => 'Some items exceed available stock. Please adjust quantities.']);
        }
        
        // Generate QR Code URL
        $orderData = [
            'user' => Auth::user()->username,
            'items' => $selectedItems->map(function($item) {
                return $item->name . ' x' . $item->pivot->quantity;
            })->values(),
            'total' => $selectedItems->sum(function($item) {
                return $item->price * $item->pivot->quantity;
            })
        ];
        
        $orderDate = date('F j, Y');
        $orderNumber = 'ORD-' . strtoupper(substr(md5($orderData['user'] . time()), 0, 8));

        // Generate a 4-digit verification code and store it in session keyed by order number.
        $verificationCode = rand(1000, 9999);
        session(['order_verification_' . $orderNumber => $verificationCode]);
        
        // Build item list with IDs only (short format for vCard)
        $itemIds = $selectedItems->map(function($item) {
            return 'ID:' . $item->id . ' x' . $item->pivot->quantity;
        })->join(', ');
        
        // Create vCard as a proper contact that users can save
        $vcard = "BEGIN:VCARD\n";
        $vcard .= "VERSION:3.0\n";
        $vcard .= "FN:Buy My Classmate Receipt\n";
        $vcard .= "ORG:Buy My Classmate Inc\n";
        $vcard .= "TITLE:Order Receipt\n";
        $vcard .= "EMAIL:orders@buymyclassmate.inc\n";
        $vcard .= "NOTE:Order: " . $orderNumber . "\nCustomer: " . $orderData['user'] . "\nItems: " . $itemIds . "\nDate: " . $orderDate . "\nCode: " . $verificationCode . "\n";
        $vcard .= "END:VCARD";
        
        // QR code encodes the full vCard so users can scan and save as contact
        $qrData = $vcard;
        $total = $orderData['total'];

        return view('shop.checkout', compact('selectedItems', 'qrData', 'total', 'selectedIds', 'orderNumber', 'verificationCode'));
    }

    public function completeOrder(Request $request)
    {
        $selectedIds = $request->input('selected_items', []);
        $orderNumber = $request->input('order_number');
        $providedCode = $request->input('verification_code');

        // Require verification code to match the one embedded in the vCard (stored in session).
        if (!$orderNumber || !$providedCode) {
            return back()->withErrors(['error' => 'Verification code is required to complete the order.']);
        }

        $expected = session('order_verification_' . $orderNumber);
        if (!$expected || (string)$expected !== (string)$providedCode) {
            return back()->with('error', 'Verification not succeeded. Please enter the correct 4-digit code from the QR.');
        }
        
        if (empty($selectedIds)) {
            return redirect()->route('shop.cart');
        }

        $cart = Cart::where('user_id', Auth::id())
                    ->where('status', 'active')
                    ->first();

        // If single item checkout (not from cart)
        if (!$cart) {
            foreach ($selectedIds as $itemId) {
                $item = Item::find($itemId);
                if ($item) {
                    // Deduct stock by submitted quantity
                    $quantity = 1;
                    if ($request->has('quantities')) {
                        $quantities = $request->input('quantities');
                        if (isset($quantities[$itemId])) {
                            $quantity = max(1, (int)$quantities[$itemId]);
                        }
                    } elseif ($request->has('verification_code')) {
                        // For single item checkout, quantity is in hidden input
                        $quantity = (int)$request->input('verification_code') ? (int)$request->input('quantity', 1) : 1;
                    } else {
                        $quantity = (int)$request->input('quantity', 1);
                    }
                    $item->stock = max(0, $item->stock - $quantity);
                    $item->save();
                }
            }
        } else {
            // Deduct stock and remove items from cart
            foreach ($selectedIds as $itemId) {
                $cartItem = CartItem::where('cart_id', $cart->id)
                                    ->where('item_id', $itemId)
                                    ->first();
                if ($cartItem) {
                    $item = Item::find($itemId);
                    if ($item) {
                        // Deduct stock
                        $item->stock = max(0, $item->stock - $cartItem->quantity);
                        $item->save();
                    }
                    // Remove from cart
                    $cartItem->delete();
                }
            }
        }

        // Clear the stored verification code for this order
        session()->forget('order_verification_' . $orderNumber);

        return redirect()->route('shop.index')->with('success', 'Order completed! Thank you for your purchase.');
    }

    public function deleteFromCart(Item $item)
    {
        $cart = Cart::where('user_id', Auth::id())
                    ->where('status', 'active')
                    ->first();

        if ($cart) {
            CartItem::where('cart_id', $cart->id)
                    ->where('item_id', $item->id)
                    ->delete();
        }

        return back()->with('success', 'Item removed from cart.');
    }

    public function buyNow(Request $request, Item $item)
    {
        // Check stock availability
        if ($item->stock < 1) {
            return back()->withErrors(['error' => 'This item is out of stock.']);
        }

        $quantity = max(1, min((int)$request->input('quantity', 1), $item->stock));

        $cart = Cart::firstOrCreate(
            ['user_id' => Auth::id(), 'status' => 'active']
        );

        $cartItem = CartItem::where('cart_id', $cart->id)
                            ->where('item_id', $item->id)
                            ->first();

        if ($cartItem) {
            // Check if incrementing would exceed stock
            if ($cartItem->quantity + $quantity > $item->stock) {
                return back()->withErrors(['error' => 'Not enough stock available.']);
            }
            $cartItem->quantity += $quantity;
            $cartItem->save();
        } else {
            CartItem::create([
                'cart_id' => $cart->id,
                'item_id' => $item->id,
                'quantity' => $quantity,
            ]);
        }

        // Redirect directly to checkout with this item selected
        return redirect()->route('shop.checkout')->with('success', 'Item added to cart. Proceeding to checkout...');
    }

    public function singleCheckout(Request $request, Item $item)
    {
        if ($request->method() !== 'POST') {
            // Redirect to store if not POST (e.g., refresh or direct visit)
            return redirect()->route('shop.index');
        }
        $quantity = max(1, min((int)$request->input('quantity', 1), $item->stock));
        if ($item->stock < 1) {
            return back()->withErrors(['error' => 'This item is out of stock.']);
        }
        if ($quantity > $item->stock) {
            return back()->withErrors(['error' => 'Not enough stock available.']);
        }
        // Prepare single item for checkout view
        $selectedItems = collect([$item]);
        $item->pivot = (object)[ 'quantity' => $quantity ];
        $total = $item->price * $quantity;
        $orderNumber = 'ORD-' . strtoupper(substr(md5(Auth::user()->username . time()), 0, 8));
        $verificationCode = rand(1000, 9999);
        session(['order_verification_' . $orderNumber => $verificationCode]);
        $qrData = 'Order: ' . $orderNumber . ', Item: ' . $item->name . ', Qty: ' . $quantity . ', Code: ' . $verificationCode;
        $selectedIds = [$item->id];
        return view('shop.checkout', compact('selectedItems', 'qrData', 'total', 'orderNumber', 'verificationCode', 'selectedIds'));
    }
}
