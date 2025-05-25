@extends('layouts.app')

@push('styles')
<style>
:root {
    --gold: #f2c615;
    --charcoal: #e9e9e9;
    --light: #e9e9e9;
    --border: #d4d4d4;
}

body {
    background: var(--charcoal);
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
}

.wrapper {
    width: 100%;
    max-width: 1000px;
    margin: 40px auto;
    background: var(--gold);
    padding: 32px 28px;
    border-radius: 8px;
    display: grid;
    grid-template-columns: 1fr 220px;
    gap: 24px;
    box-shadow: 0 0 12px rgba(0,0,0,0.3);
}

header {
    grid-column: 1 / 3;
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 22px;
}
header h1 {
    font-size: 26px;
    color: #000;
    font-weight: 800;
}

/* CART LIST */
.cart-box {
    background: var(--light);
    border-radius: 12px;
    padding: 24px;
    max-height: 500px;
    overflow-y: auto;
    scrollbar-width: thin;
}
.cart-box h3 {
    margin-bottom: 14px;
    font-size: 17px;
    font-weight: 700;
}

.item {
    display: grid;
    grid-template-columns: 60px 1fr 100px;
    align-items: center;
    gap: 16px;
    padding: 18px 0;
    border-bottom: 1px solid var(--border);
}
.item:last-child {
    border-bottom: none;
}

.thumb {
    width: 60px;
    height: 45px;
    background: #ccc;
    border-radius: 6px;
}

.name {
    font-size: 14px;
    font-weight: 600;
}

.qty-wrap {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-top: 6px;
}
.qty-btn {
    width: 24px;
    height: 24px;
    border-radius: 50%;
    background: #555;
    color: #fff;
    border: none;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
    cursor: pointer;
}
.qty-btn:hover {
    background: #222;
}

.price-tag {
    font-size: 13px;
    padding: 6px 12px;
    background: #e5e5e5;
    border-radius: 20px;
    font-weight: 600;
    text-align: right;
}

/* SIDE BUTTONS */
.button-panel {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.side-btn {
    width: 100%;
    padding: 12px 0;
    font-weight: 700;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    text-align: center;
    transition: background 0.2s;
}

.btn-black {
    background: #000;
    color: #fff;
}
.btn-black:hover {
    background: #333;
}

.btn-white {
    background: #fff;
    color: #000;
}
.btn-white:hover {
    background: #eee;
}

.total {
    text-align: right;
    font-weight: 700;
    margin-top: 14px;
    font-size: 15px;
}
</style>
@endpush

@section('content')
<div class="wrapper">

    {{-- HEADER --}}
    <header>
        <h1>NyaperGO <i class="fa fa-user"></i></h1>
        <a href="{{ route('menu') }}" class="btn-black side-btn" style="width:auto; padding:6px 16px;">← Menu</a>
    </header>

    {{-- KERANJANG --}}
    <div class="cart-box">
        <h3>Keranjang Pesanan</h3>

        @forelse($cart as $row)
        @php($p = $row['product'])
        <div class="item">
            <div class="thumb"></div>

            <div>
                <div class="name">{{ $p->name }}</div>
                <div class="qty-wrap">
                    <form action="{{ route('cart.qty',[$p->id,'minus']) }}" method="POST">@csrf
                        <button class="qty-btn">−</button>
                    </form>
                    <span>{{ $row['qty'] }}</span>
                    <form action="{{ route('cart.qty',[$p->id,'plus']) }}" method="POST">@csrf
                        <button class="qty-btn">+</button>
                    </form>
                </div>
            </div>

            <div class="price-tag">
                Rp {{ number_format($p->price*$row['qty'],0,',','.') }}
            </div>
        </div>
        @empty
            <p>Keranjang masih kosong.</p>
        @endforelse

        @if(count($cart))
            @php($total = collect($cart)->sum(fn($r)=>$r['product']->price*$r['qty']))
            <div class="total">Total: Rp {{ number_format($total,0,',','.') }}</div>
        @endif
    </div>

    {{-- PANEL TOMBOL --}}
    <div class="button-panel">
        @if(count($cart))
            {{-- BUAT PESANAN --}}
            <form action="{{ route('cart.confirm') }}" method="POST">@csrf
                <button class="side-btn btn-black">Buat Pesanan</button>
            </form>

            {{-- EDIT --}}
            <a href="{{ route('menu') }}" class="side-btn btn-white">Edit Pesanan</a>

            {{-- CANCEL --}}
            <form action="{{ route('cart.clear') }}" method="POST">@csrf
                <button class="side-btn btn-white">Cancel Pesanan</button>
            </form>
        @endif
    </div>

</div>
@endsection
