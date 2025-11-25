@extends('layouts.app')

@section('content')
<div style="max-width: 700px; margin: 0 auto; padding: 1rem;">
    <div class="card">
        <h2 style="margin-bottom: 1.5rem; text-align: center;">Scan to Pay</h2>
        
        <div style="text-align: center; margin-bottom: 2rem;">
            <p style="color: var(--gray); margin-bottom: 1rem;">Scan the QR code to save receipt</p>
            <div id="qrcode" style="background: white; padding: 1.5rem; display: inline-block; border: 2px solid var(--border); border-radius: 0.5rem; margin-bottom: 1rem;"></div>
            <p style="font-size: 0.9rem; color: var(--gray);">Order: <strong style="color: var(--text);">{{ $orderNumber }}</strong></p>
        </div>
        <div style="margin-bottom: 1.5rem;">
            <h3 style="margin-bottom: 1rem;">Order Items</h3>
            <div style="display: grid; gap: 1rem;">
                @foreach($selectedItems as $item)
                    <div style="display: flex; gap: 1rem; padding: 1rem; background: rgba(255,255,255,0.05); border-radius: 0.5rem; align-items: center;">
                        @if($item->image_path)
                            <img src="{{ asset('storage/' . $item->image_path) }}" alt="{{ $item->name }}" style="width: 100px; height: 100px; object-fit: cover; border-radius: 0.5rem; flex-shrink: 0;">
                        @else
                            <div style="width: 100px; height: 100px; background: linear-gradient(135deg, #334155 0%, #1e293b 100%); border-radius: 0.5rem; display: flex; align-items: center; justify-content: center; color: #94a3b8; font-size: 2rem; flex-shrink: 0;">
                                📷
                            </div>
                        @endif
                        <div style="flex-grow: 1;">
                            <h4 style="margin: 0 0 0.5rem 0;">{{ $item->name }}</h4>
                            <p style="margin: 0 0 0.5rem 0; color: var(--gray);">Qty: <strong>{{ $item->pivot->quantity }}</strong></p>
                            <p style="margin: 0; color: var(--primary); font-weight: bold; font-size: 1.1rem;">${{ number_format($item->price * $item->pivot->quantity, 2) }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div style="border-top: 1px solid rgba(255,255,255,0.1); padding-top: 1.5rem; margin-bottom: 1.5rem;">
            <div style="display: flex; justify-content: space-between; align-items: center; font-size: 1.25rem; font-weight: bold;">
                <span>Total Amount:</span>
                <span style="color: var(--primary);">${{ number_format($total, 2) }}</span>
            </div>
        </div>

        <form action="{{ route('shop.checkout.complete') }}" method="POST">
            @csrf
            @foreach($selectedIds as $id)
                <input type="hidden" name="selected_items[]" value="{{ $id }}">
            @endforeach
            <input type="hidden" name="order_number" value="{{ $orderNumber }}">

            <div style="margin-bottom: 1.5rem; padding: 1rem; background: rgba(255,255,255,0.05); border-radius: 0.5rem;">
                <label for="verification_code" style="display: block; margin-bottom: 0.75rem; font-weight: 500;">Enter 4-Digit Code from QR</label>
                <input id="verification_code" name="verification_code" type="text" maxlength="4" pattern="\d{4}" placeholder="0000" required style="width: 100%; padding: 0.75rem; text-align: center; font-size: 1.5rem; letter-spacing: 0.5rem; border: 2px solid var(--border); background: var(--bg); color: var(--text); border-radius: 0.25rem;" />
            </div>

            <div style="display: flex; gap: 1rem;">
                <a href="{{ route('shop.cart') }}" class="btn btn-secondary" style="flex: 1; text-align: center; padding: 0.75rem;">Back to Cart</a>
                <button type="submit" class="btn btn-success" style="flex: 1; padding: 0.75rem;">Complete Order</button>
            </div>
        </form>
    </div>
</div>

@if(session('error') && old('verification_code'))
    <script>alert("{{ session('error') }}");</script>
@endif

<script src="{{ asset('js/qrcode.min.js') }}"></script>
<script>
    new QRCode(document.getElementById("qrcode"), {
        text: {!! json_encode($qrData) !!},
        width: 250,
        height: 250
    });
</script>
@endsection
