@extends('layouts.app')

@section('content')
<div style="max-width: 100%; margin: 0 auto; padding: 2rem 1rem;">
    <h1 style="margin-bottom: 2rem; font-size: 2rem;">Shop</h1>
    
    <div class="grid" style="
        display: grid;
        grid-template-columns: repeat(6, 1fr);
        gap: 1rem;
        grid-auto-rows: 1fr;
        width: 100%;
    ">
        @foreach($items as $item)
            <div class="card" style="
                display: flex;
                flex-direction: column;
                padding: 0.75rem;
                height: 100%;
                transition: transform 0.2s ease, box-shadow 0.2s ease;
            " onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 10px 30px rgba(0,0,0,0.3)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                @if($item->image_path)
                    <div style="width: 100%; aspect-ratio: 1/1; margin-bottom: 1rem; border-radius: 0.5rem; overflow: hidden;">
                        <img src="{{ asset('storage/' . $item->image_path) }}" alt="{{ $item->name }}" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                @else
                    <div style="width: 100%; aspect-ratio: 1/1; background: linear-gradient(135deg, #334155 0%, #1e293b 100%); border-radius: 0.5rem; margin-bottom: 1rem; display: flex; align-items: center; justify-content: center; color: #94a3b8; font-size: 2.5rem;">
                        📷
                    </div>
                @endif
                
                <h3 style="margin: 0 0 0.25rem 0; font-size: 0.95rem; line-height: 1.2; min-height: 1.8rem;">{{ $item->name }}</h3>
                
                <p style="color: var(--gray); margin: 0 0 0.5rem 0; flex-grow: 1; line-height: 1.4; font-size: 0.8rem; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">{{ $item->description }}</p>
                
                <div style="margin: 0.5rem 0; padding: 0.4rem 0.5rem; background: rgba(59, 130, 246, 0.1); border-radius: 0.25rem; font-size: 0.75rem;">
                    @if($item->stock > 0)
                        <strong>Stock:</strong> 
                        <span style="color: var(--primary); font-weight: bold;">
                            {{ $item->stock }} in stock
                        </span>
                    @else
                        <span style="color: #ef4444; font-weight: bold;">
                            Out of Stock
                        </span>
                    @endif
                </div>
                
                <div style="border-top: 1px solid rgba(255,255,255,0.1); margin-top: 0.5rem; padding-top: 0.5rem;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
                        <span style="font-size: 1.1rem; font-weight: bold; color: var(--primary);">${{ number_format($item->price, 2) }}</span>
                    </div>
                    
                    @if($item->stock > 0)
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.4rem;">
                            <form action="{{ route('cart.add', $item) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary" style="width: 100%; padding: 0.4rem 0.3rem; font-size: 0.75rem;">Cart</button>
                            </form>
                            <form action="{{ route('shop.buynow', $item) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success" style="width: 100%; padding: 0.4rem 0.3rem; font-size: 0.75rem;">Buy</button>
                            </form>
                        </div>
                    @else
                        <button type="button" class="btn" disabled style="width: 100%; opacity: 0.5; cursor: not-allowed; padding: 0.4rem; font-size: 0.75rem;">Out of Stock</button>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</div>

@if($items->isEmpty())
    <div style="text-align: center; padding: 3rem 1rem;">
        <p style="color: var(--gray); margin-bottom: 1.5rem;">No items available right now.</p>
        <a href="{{ route('shop.index') }}" class="btn btn-primary">Refresh</a>
    </div>
@endif

<style>
    @media (max-width: 1200px) {
        .grid {
            grid-template-columns: repeat(4, 1fr) !important;
        }
    }

    @media (max-width: 768px) {
        .grid {
            grid-template-columns: repeat(3, 1fr) !important;
            gap: 0.75rem !important;
        }
    }

    @media (max-width: 480px) {
        .grid {
            grid-template-columns: repeat(2, 1fr) !important;
            gap: 0.5rem !important;
        }
        
        h1 {
            font-size: 1.5rem !important;
        }
    }
</style>
@endsection
