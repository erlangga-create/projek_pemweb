<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>NyaperGO Lokasi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
      rel="stylesheet"
    />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
      @import url('https://fonts.googleapis.com/css2?family=Inter:wght@700&display=swap');
      body {
        font-family: 'Inter', sans-serif;
      }
    </style>
  </head>
  <body class="bg-white">

    <!-- Modal Tambah/Edit Alamat -->
    <div
      id="modalTambahAlamat"
      class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 hidden"
    >
      <div class="bg-white p-8 rounded-md shadow-md w-[500px]">
        <h2 class="text-xl font-bold mb-4" id="modalTitle">Edit Alamat</h2>

        <form id="alamatForm" method="POST" action="{{ route('lokasi.store') }}">
          @csrf
          <input type="hidden" id="alamatId" name="id">
          <textarea
            name="alamat"
            id="alamatInput"
            placeholder="Alamat"
            class="w-full border border-black p-4 mb-6 text-gray-700 resize-none"
            rows="4"
          ></textarea>

          <div class="flex justify-end space-x-2">
            <button
              type="button"
              onclick="closeModal()"
              class="bg-gray-300 text-black px-4 py-2 rounded-full">
              Batal
            </button>
            <button
              type="submit"
              class="bg-[#e6b300] text-white font-bold rounded-full px-6 py-2 hover:bg-yellow-600 transition"
            >
              Konfirmasi
            </button>
          </div>
        </form>
      </div>
    </div>

    <!-- Header -->
    <header class="bg-[#f2c615] flex justify-between items-center px-8 py-4 border-b-2 border-black">
      <h1 class="font-extrabold text-2xl">NyaperGO</h1>
      <nav class="flex items-center space-x-6 text-black text-lg font-extrabold">
        <i class="far fa-bell cursor-pointer"></i>
        <i class="far fa-user-circle cursor-pointer"></i>
        <span>Username</span>
      </nav>
    </header>

    <!-- Main Layout -->
    <main class="flex min-h-[calc(100vh-64px)]">
      <!-- Sidebar -->
      <aside class="bg-[#f2c615] w-64 border-r-2 border-black flex flex-col justify-between py-10 px-6">
        <div>
          <h2 class="font-extrabold text-xl mb-10">User Profile</h2>
          <ul class="space-y-8 text-black font-extrabold text-lg">
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
        @if(session('warning'))
  <div style="color: red; margin-bottom: 10px;">
    {{ session('warning') }}
  </div>
@endif

        <div class="flex justify-between items-center mb-6">
          <h3 class="font-extrabold text-lg text-black">Alamat Saya</h3>
          <button
            class="bg-[#e6b300] text-white font-bold rounded-full px-6 py-2 hover:bg-yellow-600 transition"
            onclick="document.getElementById('modalTambahAlamat').classList.remove('hidden')">
            Tambah Alamat
          </button>
        </div>
        <!-- Daftar Alamat -->
      @foreach($lokasi as $lok)
<div class="bg-white border border-black p-4 mb-4 rounded-md shadow-md">
  
  <p class="text-black">{{ $lok->alamat }}</p>
  
  @if($lok->is_default)
    <span class="text-green-600 font-bold">[Default]</span>
  @endif

  <div class="flex justify-end mt-2 space-x-2">
    <form action="{{ route('lokasi.destroy', $lok->id) }}" method="POST">
      @csrf
      @method('DELETE')
      <button type="submit" class="bg-red-500 text-white px-4 py-1 rounded-full">Hapus</button>
    </form>

    <button
      type="button"
      onclick="editAlamat('{{ $lok->id }}', '{{ $lok->alamat }}')"
      class="bg-yellow-500 text-white px-4 py-1 rounded-full">
      Edit
    </button>

    @if(!$lok->is_default)
      <form action="{{ route('lokasi.setDefault', $lok->id) }}" method="POST">
        @csrf
        <button type="submit" class="bg-blue-500 text-white px-4 py-1 rounded-full">
          Gunakan Alamat
        </button>
      </form>
    @endif
  </div>
</div>
@endforeach
      </section>
    </main>
    

    <!-- JavaScript for Modal -->
    <script>
      function closeModal() {
        document.getElementById('modalTambahAlamat').classList.add('hidden');
        document.getElementById('alamatForm').action = "{{ route('lokasi.store') }}";
        document.getElementById('alamatForm').reset();

        const methodInput = document.querySelector('input[name="_method"]');
        if (methodInput) methodInput.remove();
      }

      function editAlamat(id, alamat) {
        const modal = document.getElementById('modalTambahAlamat');
        const input = document.getElementById('alamatInput');
        const form = document.getElementById('alamatForm');

        input.value = alamat;
        form.action = '/lokasi/' + id;

        // Tambahkan _method=PUT jika belum ada
        if (!form.querySelector('input[name="_method"]')) {
          const method = document.createElement('input');
          method.type = 'hidden';
          method.name = '_method';
          method.value = 'PUT';
          form.appendChild(method);
        }

        modal.classList.remove('hidden');
      }
    </script>
  </body>
</html>
