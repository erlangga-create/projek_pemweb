<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Pesanan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <style>
      @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap');
      body {
          font-family: 'Poppins', sans-serif;
      }
    </style>
</head>
  <body class="bg-[#FFF5E4]">
  <header class="bg-[#f2c615] flex justify-between items-center px-8 py-4 border-b-2 border-black">
    <h1 class="font-extrabold text-2xl">NyaperGO</h1>
    <nav class="flex items-center space-x-6 text-black text-lg font-extrabold">
      <i class="far fa-bell cursor-pointer"></i>
      <i class="far fa-user-circle cursor-pointer"></i>
    </nav>
  </header>

    <main class="flex min-h-[calc(100vh-64px)]">
     <aside class="bg-[#f2c615] w-64 border-r-2 border-black flex flex-col justify-between py-10 px-6">
        <div>
          <h2 class="font-semibold text-xl mb-10">User Profile</h2>
          <ul class="space-y-8 text-black font-semibold text-lg">
            <li class="flex items-center space-x-4"><i class="far fa-user-circle text-2xl"></i><a href="dashboard">User Info</a></li>
            <li class="flex items-center space-x-4"><i class="far fa-heart text-2xl"></i><a href="#">Favorites</a></li>
            <li class="flex items-center space-x-4"><i class="fas fa-cog text-2xl"></i><span>Settings</span></li>
            <li class="flex items-center space-x-4"><i class="far fa-bell text-2xl"></i><a href="orders">History Pesanan</a></li>
            <li class="flex items-center space-x-4"><i class="fas fa-map-marker-alt text-2xl"></i><a href="lokasi">Lokasi</a></li>
            <li class="flex items-center space-x-4"><i class="fas fa-home text-2xl"></i><a href="/">Home</a></li>
          </ul>
        </div>
        <div class="flex items-center space-x-4 cursor-pointer font-semibold text-lg">
          <i class="fas fa-sign-out-alt text-2xl"></i>
         <a href="{{ route('logout') }}" >Log Out</a>
        </div>
      </aside>



        <!-- Content -->
        <section class="flex-1 p-10">
            <h2 class="text-3xl font-bold mb-6">Daftar Pesanan Anda</h2>

            @if(session('success'))
                <div class="bg-green-100 text-green-800 p-4 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @if($orders->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
                        <thead class="bg-[#f2c615] text-black">
                            <tr>

                                <th class="text-left px-6 py-3">Metode</th>
                                <th class="text-left px-6 py-3">Total</th>
                                <th class="text-left px-6 py-3">Tanggal</th>
                                <th class="text-left px-6 py-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                                <tr class="border-b hover:bg-gray-100">
                                    <td class="px-6 py-4">{{ $order->metode_pembayaran }}</td>
                                    <td class="px-6 py-4">Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4">{{ $order->created_at->format('d-m-Y H:i') }}</td>
                                    <td class="px-6 py-4">
                                        <form action="{{ route('orders.destroy', $order->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pesanan ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-gray-700">Belum ada pesanan.</p>
            @endif
        </section>
    </main>
</div>

</body>
</html>