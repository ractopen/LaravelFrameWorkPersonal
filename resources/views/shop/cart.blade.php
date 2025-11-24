@extends('layouts.app')

@section('content')
<div style="max-width: 800px; margin: 0 auto;">
    <h2 class="mb-4">Your Cart</h2>
    
    @if($cart && $cart->items->count() > 0)
        <div class="card">
            <form action="{{ route('shop.checkout') }}" method="POST" id="cart-form">
                @csrf
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="border-bottom: 1px solid rgba(255,255,255,0.1); text-align: left;">
                            <th style="padding: 1rem; width: 50px;">Select</th>
                            <th style="padding: 1rem; width: 100px;">Image</th>
                            <th style="padding: 1rem;">Item</th>
                            <th style="padding: 1rem;">Price</th>
                            <th style="padding: 1rem;">Quantity</th>
                            <th style="padding: 1rem;">Total</th>
                            <th style="padding: 1rem;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cart->items as $item)
                            <tr style="border-bottom: 1px solid rgba(255,255,255,0.05);">
                                <td style="padding: 1rem;">
                                    <input type="checkbox" name="selected_items[]" value="{{ $item->id }}" style="transform: scale(1.5); cursor: pointer;">
                                </td>
                                <td style="padding: 1rem;">
                                    @if($item->image_path)
                                        <img src="{{ asset('storage/' . $item->image_path) }}" alt="{{ $item->name }}" style="width: 60px; height: 60px; object-fit: cover; border-radius: 4px;">
                                    @else
                                        <div style="width: 60px; height: 60px; background: var(--border); border-radius: 4px; display: flex; align-items: center; justify-content: center;">
                                            📷
                                        </div>
                                    @endif
                                </td>
                                <td style="padding: 1rem;">{{ $item->name }}</td>
                                <td style="padding: 1rem;">${{ number_format($item->price, 2) }}</td>
                                <td style="padding: 1rem;">
                                    <input type="number" name="quantities[{{ $item->id }}]" value="{{ $item->pivot->quantity }}" min="1" max="99" style="width: 60px; padding: 0.25rem; border: 1px solid var(--border); background: var(--bg); color: var(--text); border-radius: 4px; text-align: center;">
                                </td>
                                <td style="padding: 1rem;">${{ number_format($item->price * $item->pivot->quantity, 2) }}</td>
                                <td style="padding: 1rem;">
                                    <form action="{{ route('cart.delete', $item->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-danger" style="padding: 0.25rem 0.5rem; font-size: 0.85rem;">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                
                <div class="flex justify-between items-center mt-4" style="padding: 1rem;">
                    <h3>Total (All): ${{ number_format($cart->items->sum(fn($i) => $i->price * $i->pivot->quantity), 2) }}</h3>
                    <button type="submit" class="btn btn-primary">Checkout Selected</button>
                </div>
            </form>
        </div>
    @else
        <div class="card text-center">
            <p>Your cart is empty.</p>
            <a href="{{ route('shop.index') }}" class="btn btn-primary mt-4">Browse Shop</a>
        </div>
    @endif
</div>
@endsection
