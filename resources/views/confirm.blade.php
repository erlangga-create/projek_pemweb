<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Konfirmasi</title>
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background-color: #e8e8e8;
      padding: 40px;
    }

    .container {
      background-color: #f2c615;
      max-width: 800px;
      width: 100%;
      margin: auto;
      padding: 40px;
      border-radius: 15px;
      box-shadow: 0 0 25px rgba(0,0,0,0.3);
    }

    .header {
      display: flex;
      align-items: center;
      font-weight: bold;
      font-size: 28px;
      color: white;
      margin-bottom: 10px;
    }

    .header-icon {
      width: 24px;
      height: 24px;
      border: 2px solid black;
      margin-left: 12px;
    }

    .content {
      background-color: #e8e8e8;
      border-radius: 20px;
      padding: 40px;
      margin-top: 25px;
    }

    h2 {
      text-align: center;
      margin-bottom: 35px;
      font-size: 26px;
      color: #222;
    }

    .row {
      background-color: white;
      padding: 18px 25px;
      border-radius: 12px;
      margin-bottom: 18px;
      display: flex;
      justify-content: space-between;
      font-weight: bold;
      font-size: 18px;
    }

    .form-group {
      background-color: white;
      padding: 18px 25px;
      border-radius: 12px;
      margin-bottom: 18px;
      font-weight: bold;
      font-size: 18px;
      color: #444;
    }

    .form-group input,
    .form-group select {
      width: 100%;
      margin-top: 8px;
      padding: 10px;
      border-radius: 8px;
      border: 1px solid #ccc;
      font-size: 16px;
    }

    .btn-pesan {
      background-color: #ffc107;
      color: black;
      font-weight: bold;
      border: none;
      padding: 18px;
      width: 100%;
      border-radius: 30px;
      cursor: pointer;
      transition: background 0.3s;
      font-size: 18px;
    }

    .btn-pesan:hover {
      background-color: #e0a800;
    }

        .btn-orange {
        background-color:rgb(255, 254, 252);
        color: orange;
        padding: 10px 15px;
        text-decoration: none;
        border-radius: 50px;
        font-weight: bold;
        transition: background-color 0.3s ease;
    }
  </style>
</head>
<body>

  <div class="container">
    <div class="header">
      NyaperGO <div class="header-icon"></div>
    </div>
    <a href="{{ route('cart.index') }}" class="btn-orange">Keranjang</a>
    <form class="content" method="POST" action="{{ route('order.save') }}">
      <h2>Konfirmasi Pesanan</h2>

      @csrf

      @if(count($cart) > 0)
        @php $total = 0; @endphp
        @foreach($cart as $item)
          @php
            $subtotal = $item['product']->price * $item['qty'];
            $total += $subtotal;
          @endphp
          <div class="row">
            <span>{{ $item['product']->name }}</span>
            <span>{{ $item['qty'] }}x Rp {{ number_format($item['product']->price, 0, ',', '.') }}</span>
          </div>
        @endforeach

        <div class="row" style="background: #f1f1f1;">
          <span>Total</span>
          <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
        </div>
      @else
        <div class="row">
          <span>Keranjang kosong</span>
        </div>
      @endif

      <div class="form row">
        <label>Alamat Pengiriman:</label>
        <div style="padding-top: 8px;">
          {{ $defaultAlamat->alamat ?? 'Alamat belum diset.' }}
        </div>
      </div>

      <div class="form-group">
        METODE PEMBAYARAN
        <select name="metode_pembayaran" required>
          <option value="">-- Pilih Metode Pembayaran --</option>
          <option value="Tunai">Tunai</option>
          <option value="QRIS">QRIS</option>
          <option value="Transfer Bank">Transfer Bank</option>
        </select>
      </div>

      <button type="submit" class="btn-pesan">PESAN SEKARANG</button>
    </form>
  </div>

</body>
</html>
