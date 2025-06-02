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
    border-radius: 6px;
    overflow: hidden;
    position: relative;
    background: #f5f5f5;
}

.thumb img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
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
    transition: background 0.2s;
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
    border: 1px solid #ddd;
}
.btn-white:hover {
    background: #eee;
}

.total {
    text-align: right;
    font-weight: 700;
    margin-top: 14px;
    font-size: 15px;
    padding-right: 8px;
}

.empty-cart {
    text-align: center;
    padding: 20px;
    color: #666;
}
</style>
@endpush

@section('content')
<div class="wrapper">

    {{-- HEADER --}}
    <header>
        <h1>NyaperGO <i class="fa fa-user"></i></h1>
        <a href="{{ route('menu') }}" class="btn-black side-btn" style="width:auto; padding:6px 16px;">← Kembali ke Menu</a>
    </header>

    {{-- KERANJANG --}}
    <div class="cart-box">
        <h3>Keranjang Pesanan</h3>

        @php
            // Map nama produk ke nama file gambar
            $imageMap = [
                'Soto Ayam' => 'sotoayam.jpg',
                'Ayam Goreng' => 'ayamgoreng.jpg',
                'Es Teh Manis' => 'esteh.jpg',
                'Jus Jeruk' => 'jusjeruk.jpg',
                'Kopi Hitam' => 'kopihitam.jpg',
                'Keripik Kentang' => 'keripikkentang.jpg',
                'Pisang Goreng' => 'pisanggoreng.jpg',
                'Nasi Goreng' => 'nasigoreng.jpg'
            ];
        @endphp

        @forelse($cart as $row)
            @php
                $p = $row['product'];
                $filename = $imageMap[$p->name] ?? 'default.jpg';
            @endphp

            <div class="item">
                <div class="thumb">
                    @if(file_exists(public_path('images/' . $filename)))
                        <img src="{{ asset('images/' . $filename) }}" alt="{{ $p->name }}">
                    @else
                        <div style="display:flex; align-items:center; justify-content:center; height:100%; color:#999; font-size:10px;">
                            No Image
                        </div>
                    @endif
                </div>

                <div>
                    <div class="name">{{ $p->name }}</div>
                    <div class="qty-wrap">
                        <form action="{{ route('cart.qty', [$p->id, 'minus']) }}" method="POST">
                            @csrf
                            <button type="submit" class="qty-btn" title="Kurangi jumlah">−</button>
                        </form>
                        <span>{{ $row['qty'] }}</span>
                        <form action="{{ route('cart.qty', [$p->id, 'plus']) }}" method="POST">
                            @csrf
                            <button type="submit" class="qty-btn" title="Tambah jumlah">+</button>
                        </form>
                    </div>
                </div>

                <div class="price-tag">
                    Rp {{ number_format($p->price * $row['qty'], 0, ',', '.') }}
                </div>
            </div>
        @empty
            <div class="empty-cart">
                <p>Keranjang belanja Anda masih kosong</p>
                <a href="{{ route('menu') }}" class="btn-black side-btn" style="margin-top:15px; width:auto; display:inline-block; padding:8px 20px;">
                    Lihat Menu
                </a>
            </div>
        @endforelse

        @if(count($cart))
            @php
                $total = collect($cart)->sum(fn($r) => $r['product']->price * $r['qty']);
            @endphp
            <div class="total">Total: Rp {{ number_format($total, 0, ',', '.') }}</div>
        @endif
    </div>

    {{-- PANEL TOMBOL --}}
    @if(count($cart))
    <div class="button-panel">
        {{-- BUAT PESANAN --}}
        <form action="{{ route('cart.confirm') }}" method="POST">
            @csrf
            <button type="submit" class="side-btn btn-black">Buat Pesanan</button>
        </form>

        {{-- EDIT PESANAN --}}
        <a href="{{ route('menu') }}" class="side-btn btn-white">Tambah Item Lain</a>

        {{-- KOSONGKAN KERANJANG --}}
        <form action="{{ route('cart.clear') }}" method="POST">
            @csrf
            <button type="submit" class="side-btn btn-white" onclick="return confirm('Yakin ingin mengosongkan keranjang?')">Kosongkan Keranjang</button>
        </form>
    </div>
    @endif

</div>
@endsection
