@extends('layouts.app')

@section('title','Menu')

@push('styles')
<style>
:root {
    --gold: #f5a900;
    --charcoal: #000;
    --light: #e9e9e9;
}

body {
    background: var(--light);
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
}

.wrapper {
    width: 100vw;
    max-width: 100%;
    min-height: 100vh;
    padding: 28px 24px;
    background: var(--gold);
    box-sizing: border-box;
}

header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 18px;
}

header h1 {
    font-size: 24px;
    color: #000;
}

.cart-btn {
    background: #000;
    color: #fff;
    border: none;
    padding: 6px 16px;
    font-weight: 600;
    cursor: pointer;
    text-decoration: none;
}

.box {
    background: var(--light);
    border-radius: 10px;
    padding: 18px 22px;
}

.tabs {
    display: flex;
    gap: 10px;
    margin: 14px 0;
}

.tab-btn {
    border: 1px solid var(--gold);
    background: #fff;
    padding: 4px 18px;
    font-size: 11px;
    font-weight: 600;
    cursor: pointer;
    border-radius: 2px;
}

.tab-btn.active {
    background: var(--gold);
}

.list .item {
    display: flex;
    align-items: center;
    gap: 4px;
    padding: 14px 0;
    border-bottom: 1px solid #ccc;
}

.item:last-child {
    border-bottom: 0;
}

.thumb {
    width: 50px;
    height: 40px;
    background: #ccc;
    border-radius: 6px;
    flex-shrink: 0;
}

.item-info {
    flex: 1;
    padding-left: 6px;
}

form {
    margin-left: 2px;
}

.add-btn {
    background: none;
    border: none;
    font-size: 28px;
    font-weight: 700;
    cursor: pointer;
    color: #000;
    padding: 0;
    line-height: 1;
    display: flex;
    align-items: center;
    justify-content: center;
}
</style>
@endpush

@section('content')

<div class="wrapper">
    <header>
        <h1>NyaperGO <i class="fa fa-user"></i></h1>
        <a href="/home" >home</a>
        <a href="#" class="cart-btn">
            Lihat Keranjang ({{ count(session('cart', [])) }})
        </a>
    </header>

    <div class="box">
        <div style="font-weight:700; margin-bottom:10px;">Menu Makanan</div>

        {{-- FORM CARI MAKANAN --}}
        <form method="GET" action="#" style="margin-bottom: 14px; display: flex; gap: 8px;">
            <input type="text" name="cari" placeholder="Cari makanan..." value="{{ request('cari') }}"
                style="flex: 1; padding: 6px 10px; border: 1px solid #ccc; border-radius: 4px; font-size: 13px;">
            <input type="hidden" name="cat" value="{{ request('cat', 'all') }}">
            <button type="submit" class="tab-btn active" style="padding: 6px 14px;">Cari</button>
        </form>

        {{-- TAB KATEGORI --}}
        <div class="tabs">
            @php($active = request('cat', 'all'))
            @foreach(['all' => 'SEMUA', 'minuman' => 'MINUMAN', 'makanan' => 'MAKANAN', 'snack' => 'SNACK'] as $key => $label)
                <button class="tab-btn {{ $active == $key ? 'active' : '' }}" onclick="window.location='?cat={{ $key }}'">
                    {{ $label }}
                </button>
            @endforeach
        </div>

        {{-- LIST PRODUK --}}
        <div class="list" id="productList">
            @forelse($products as $p)
                <div class="item" data-name="{{ strtolower($p->name) }}">
                    <div class="thumb"></div>
                    <div class="item-info">
                        <div style="font-weight:600;">{{ $p->name }}</div>
                        <div style="font-size:12px;">Rp {{ number_format($p->price, 0, ',', '.') }}</div>
                        <small>{{ $p->description ?? 'Deskripsi Makanan' }}</small>
                    </div>
                    <form action="#" method="POST">
                        @csrf
                        <button class="add-btn" title="Tambah ke Keranjang">+</button>
                    </form>
                </div>
            @empty
                <p>Belum ada menu tersedia.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
