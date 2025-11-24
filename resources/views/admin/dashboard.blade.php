@extends('layouts.app')

@section('content')
<div style="max-width: 1000px; margin: 0 auto;">
    <h2 class="mb-4">Admin Dashboard</h2>

    <div class="grid" style="grid-template-columns: 1fr 1fr; gap: 2rem; margin-bottom: 2rem;">
        <!-- Add Item -->
        <div class="card">
            <h3>Add New Item</h3>
            <form action="{{ route('admin.items.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Price</label>
                    <input type="number" step="0.01" name="price" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" class="form-control" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label>Image</label>
                    <input type="file" name="image" class="form-control">
                </div>
                <div class="form-group">
                    <label>Stock</label>
                    <input type="number" name="stock" class="form-control" min="0" value="0" required>
                </div>
                <button type="submit" class="btn btn-primary mt-4">Add Item</button>
            </form>
        </div>

        <!-- Add Announcement -->
        <div class="card">
            <h3>Add Announcement</h3>
            <form action="{{ route('admin.announcements.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Message</label>
                    <textarea name="message" class="form-control" rows="3" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary mt-4">Post Announcement</button>
            </form>
        </div>
        
        <!-- Add Inbox Message -->
        <div class="card">
            <h3>Send Inbox Message</h3>
            <form action="{{ route('admin.inbox.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Message</label>
                    <textarea name="message" class="form-control" rows="3" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary mt-4">Send to All</button>
            </form>
        </div>
    </div>

    <!-- Inbox Messages List -->
    <div class="card mb-4">
        <h3>Manage Inbox Messages</h3>
        <table style="width: 100%; border-collapse: collapse; margin-top: 1rem;">
            <thead>
                <tr style="border-bottom: 1px solid rgba(255,255,255,0.1); text-align: left;">
                    <th style="padding: 0.5rem;">Message</th>
                    <th style="padding: 0.5rem;">Date</th>
                    <th style="padding: 0.5rem;">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($inboxMessages as $msg)
                    <tr style="border-bottom: 1px solid rgba(255,255,255,0.05);">
                        <td style="padding: 0.5rem;">{{ $msg->message }}</td>
                        <td style="padding: 0.5rem;">{{ $msg->created_at->format('M d, Y') }}</td>
                        <td style="padding: 0.5rem;">
                            <form action="{{ route('admin.inbox.delete', $msg) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" style="padding: 0.25rem 0.5rem; font-size: 0.8rem;">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Items List -->
    <div class="card mb-4">
        <h3>Manage Items</h3>
        <table style="width: 100%; border-collapse: collapse; margin-top: 1rem;">
            <thead>
                <tr style="border-bottom: 1px solid rgba(255,255,255,0.1); text-align: left;">
                    <th style="padding: 0.5rem;">Name</th>
                    <th style="padding: 0.5rem;">Price</th>
                    <th style="padding: 0.5rem;">Stock</th>
                    <th style="padding: 0.5rem;">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                    <tr style="border-bottom: 1px solid rgba(255,255,255,0.05);" id="item-row-{{ $item->id }}">
                        <td style="padding: 0.5rem;">{{ $item->name }}</td>
                        <td style="padding: 0.5rem;">${{ number_format($item->price, 2) }}</td>
                        <td style="padding: 0.5rem;">{{ $item->stock }}</td>
                        <td style="padding: 0.5rem;">
                            <button onclick="toggleEdit({{ $item->id }})" class="btn btn-primary" style="padding: 0.25rem 0.5rem; font-size: 0.8rem; margin-right: 0.5rem;">Edit</button>
                            <form action="{{ route('admin.items.delete', $item) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" style="padding: 0.25rem 0.5rem; font-size: 0.8rem;">Delete</button>
                            </form>
                        </td>
                    </tr>
                    <!-- Edit Form Row (Hidden by default) -->
                    <tr id="edit-form-{{ $item->id }}" style="display: none; background: var(--surface);">
                        <td colspan="4" style="padding: 1rem;">
                            <form action="{{ route('admin.items.update', $item) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                                    <div>
                                        <label style="font-size: 0.9rem;">Name</label>
                                        <input type="text" name="name" value="{{ $item->name }}" class="form-control" required>
                                    </div>
                                    <div>
                                        <label style="font-size: 0.9rem;">Price</label>
                                        <input type="number" step="0.01" name="price" value="{{ $item->price }}" class="form-control" required>
                                    </div>
                                    <div>
                                        <label style="font-size: 0.9rem;">Stock</label>
                                        <input type="number" name="stock" value="{{ $item->stock }}" class="form-control" min="0" required>
                                    </div>
                                    <div>
                                        <label style="font-size: 0.9rem;">Image</label>
                                        <input type="file" name="image" class="form-control">
                                    </div>
                                    <div style="grid-column: 1 / -1;">
                                        <label style="font-size: 0.9rem;">Description</label>
                                        <textarea name="description" class="form-control" rows="2">{{ $item->description }}</textarea>
                                    </div>
                                </div>
                                <div style="margin-top: 1rem;">
                                    <button type="submit" class="btn btn-primary" style="padding: 0.5rem 1rem;">Save Changes</button>
                                    <button type="button" onclick="toggleEdit({{ $item->id }})" class="btn btn-secondary" style="padding: 0.5rem 1rem;">Cancel</button>
                                </div>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
    function toggleEdit(itemId) {
        const editForm = document.getElementById('edit-form-' + itemId);
        if (editForm.style.display === 'none') {
            editForm.style.display = 'table-row';
        } else {
            editForm.style.display = 'none';
        }
    }
    </script>

    <!-- Users List -->
    <div class="card">
        <h3>Manage Users</h3>
        <table style="width: 100%; border-collapse: collapse; margin-top: 1rem;">
            <thead>
                <tr style="border-bottom: 1px solid rgba(255,255,255,0.1); text-align: left;">
                    <th style="padding: 0.5rem;">Name</th>
                    <th style="padding: 0.5rem;">Username</th>
                    <th style="padding: 0.5rem;">Email</th>
                    <th style="padding: 0.5rem;">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr style="border-bottom: 1px solid rgba(255,255,255,0.05);">
                        <td style="padding: 0.5rem;">{{ $user->name }}</td>
                        <td style="padding: 0.5rem;">{{ $user->username }}</td>
                        <td style="padding: 0.5rem;">{{ $user->email }}</td>
                        <td style="padding: 0.5rem;">
                            <form action="{{ route('admin.users.delete', $user) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" style="padding: 0.25rem 0.5rem; font-size: 0.8rem;">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
