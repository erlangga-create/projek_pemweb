@extends('layouts.app')

@section('title', 'Menu')

@push('styles')
<style>
:root {
    --gold: #f2c615;
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
    color: var(--charcoal);
}

.cart-btn {
    background: var(--charcoal);
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
    gap: 8px;
    padding: 14px 0;
    border-bottom: 1px solid #ccc;
}

.item:last-child {
    border-bottom: 0;
}

.thumb {
    width: 60px;
    height: 45px;
    background: #ccc;
    border-radius: 6px;
    flex-shrink: 0;
    overflow: hidden;
}

.item-info {
    flex: 1;
    padding-left: 8px;
}

form {
    margin-left: 4px;
}

.add-btn {
    background: none;
    border: none;
    font-size: 28px;
    font-weight: 700;
    cursor: pointer;
    color: var(--charcoal);
    padding: 0;
    line-height: 1;
    display: flex;
    align-items: center;
    justify-content: center;
}

.btn-orange {
    background-color: var(--charcoal);
    color: white;
    padding: 10px 15px;
    text-decoration: none;
    border-radius: 5px;
    margin-left: 10px;
    font-weight: bold;
    transition: background-color 0.3s ease;
}
</style>
@endpush

@section('content')

<div class="wrapper">
    <header>
        <h1>NyaperGO <i class="fa fa-user"></i></h1>
        <a href="{{ route('home') }}" class="btn-orange">Home</a>
        <a href="{{ route('cart.index') }}" class="cart-btn">
            Lihat Keranjang ({{ count(session('cart', [])) }})
        </a>
    </header>

    <div class="box">
        <div style="font-weight:700; margin-bottom:10px;">Menu Makanan</div>

        {{-- FORM CARI MAKANAN --}}
        <form method="GET" action="{{ route('menu') }}" style="margin-bottom: 14px; display: flex; gap: 8px;">
            <input 
                type="text" 
                name="cari" 
                placeholder="Cari makanan..." 
                value="{{ request('cari') }}" 
                style="flex: 1; padding: 6px 10px; border: 1px solid #ccc; border-radius: 4px; font-size: 13px;"
            >
            <input type="hidden" name="cat" value="{{ request('cat', 'all') }}">
            <button type="submit" class="tab-btn active" style="padding: 6px 14px;">Cari</button>
        </form>

        {{-- TAB KATEGORI --}}
        <div class="tabs">
            @php
                $active = request('cat', 'all');
                $categories = ['all' => 'SEMUA', 'minuman' => 'MINUMAN', 'makanan' => 'MAKANAN', 'snack' => 'SNACK'];
            @endphp
            @foreach ($categories as $key => $label)
                <button 
                    type="button" 
                    class="tab-btn {{ $active === $key ? 'active' : '' }}" 
                    onclick="window.location='?cat={{ $key }}{{ request('cari') ? '&cari=' . urlencode(request('cari')) : '' }}'">
                    {{ $label }}
                </button>
            @endforeach
        </div>

        {{-- LIST PRODUK --}}
        <div class="list" id="productList">
            @forelse ($products as $p)
                <div class="item" data-name="{{ strtolower($p->name) }}">
                    <div class="thumb">
                        @php
                            $imageMap = [
                                'Ayam Goreng' => 'ayamgoreng.jpg',
                                'Es Teh Manis' => 'esteh.jpg',
                                'Jus Jeruk' => 'jusjeruk.jpg',
                                'Keripik Kentang' => 'keripikkentang.jpg',
                                'Kopi Hitam' => 'kopihitam.jpg',
                                'Nasi Goreng' => 'nasigoreng.jpg',
                                'Pisang Goreng' => 'pisanggoreng.jpg',
                                'Soto Ayam' => 'sotoayam.jpg',
                            ];
                            $filename = $imageMap[$p->name] ?? 'default.jpg';
                        @endphp
                        <img src="{{ asset('images/' . $filename) }}" alt="{{ $p->name }}" style="width:100%; height:100%; object-fit:cover; border-radius:6px;">
                    </div>
                    <div class="item-info">
                        <div style="font-weight:600;">{{ $p->name }}</div>
                        <div style="font-size:12px;">Rp {{ number_format($p->price, 0, ',', '.') }}</div>
                        <small>{{ $p->description ?? 'Deskripsi Makanan' }}</small>
                    </div>
                    <form action="{{ route('cart.add', $p->id) }}" method="POST" style="margin:0;">
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


