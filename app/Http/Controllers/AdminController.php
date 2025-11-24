<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\User;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\InboxMessage;

class AdminController extends Controller
{
    public function dashboard()
    {
        $items = Item::all();
        $users = User::where('is_admin', false)->get();
        $announcements = Announcement::all();
        $inboxMessages = InboxMessage::all();
        return view('admin.dashboard', compact('items', 'users', 'announcements', 'inboxMessages'));
    }

    public function storeItem(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'stock' => 'required|integer|min:0',
        ]);

        $path = null;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('items', 'public');
        }

        Item::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'image_path' => $path,
            'stock' => $request->stock,
        ]);

        return back()->with('success', 'Item added successfully.');
    }

    public function updateItem(Request $request, Item $item)
    {
        $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'stock' => 'required|integer|min:0',
        ]);

        $path = $item->image_path;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('items', 'public');
        }

        $item->update([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'image_path' => $path,
            'stock' => $request->stock,
        ]);

        return back()->with('success', 'Item updated successfully.');
    }

    public function deleteItem(Item $item)
    {
        $item->delete();
        return back()->with('success', 'Item deleted.');
    }

    public function deleteUser(User $user)
    {
        $user->delete();
        return back()->with('success', 'User deleted.');
    }

    public function storeAnnouncement(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
        ]);

        Announcement::create([
            'message' => $request->message,
            'is_active' => true,
        ]);

        return back()->with('success', 'Announcement added.');
    }

    public function deleteAnnouncement(Announcement $announcement)
    {
        $announcement->delete();
        return back()->with('success', 'Announcement deleted.');
    }

    public function storeInboxMessage(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
        ]);

        InboxMessage::create([
            'message' => $request->message,
        ]);

        return back()->with('success', 'Inbox Message sent.');
    }

    public function deleteInboxMessage(InboxMessage $inboxMessage)
    {
        $inboxMessage->delete();
        return back()->with('success', 'Inbox Message deleted.');
    }
}
