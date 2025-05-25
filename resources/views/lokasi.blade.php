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
    <div
      id="modalTambahAlamat"
      class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 hidden"
    >
      <div class="bg-white p-8 rounded-md shadow-md w-[500px]">
        <h2 class="text-xl font-bold mb-4">Edit Alamat</h2>

        <textarea
          id="alamatInput"
          placeholder="Alamat"
          class="w-full border border-black p-4 mb-6 text-gray-700 resize-none"
          rows="4"
        ></textarea>

        <div class="flex justify-end">
          <button
            type="button"
            onclick="submitAlamat()"
            class="bg-[#e6b300] text-white font-bold rounded-full px-6 py-2 hover:bg-yellow-600 transition"
          >
            Konfirmasi
          </button>
        </div>
        </div>
      </div>
    </div>
  
      <header
      class="bg-[#E6B400] flex justify-between items-center px-8 py-4 border-b-2 border-black"
    >
      <h1 class="font-extrabold text-2xl">NyaperGO</h1>
      <nav class="flex items-center space-x-6 text-black text-lg font-extrabold">
        <i class="far fa-bell cursor-pointer"></i>
        <i class="far fa-user-circle cursor-pointer"></i>
        <span>Username</span>
      </nav>
    </header>

    <main class="flex min-h-[calc(100vh-64px)]">
      <aside
        class="bg-[#E6B400] w-64 border-r-2 border-black flex flex-col justify-between py-10 px-6"
      >
        <div>
          <h2 class="font-extrabold text-xl mb-10">User Profile</h2>
          <ul class="space-y-8 text-black font-extrabold text-lg">
            <li class="flex items-center space-x-4 cursor-pointer">
              <i class="far fa-user-circle text-2xl"></i>
              <span><a href="{{ route('dashboard') }}">User Info</a></span>
            </li>
            <li class="flex items-center space-x-4 cursor-pointer">
              <i class="far fa-heart text-2xl"></i>
              <span>Favorites</span>
            </li>
            <li class="flex items-center space-x-4 cursor-pointer">
              <i class="fas fa-cog text-2xl"></i>
              <span>Settings</span>
            </li>
            <li class="flex items-center space-x-4 cursor-pointer">
              <i class="far fa-bell text-2xl"></i>
              <span>Notifications</span>
            </li>
            <li class="flex items-center space-x-4 cursor-pointer">
              <i class="fas fa-map-marker-alt text-2xl"></i>
              <span>Lokasi</span>
            </li>
            <li class="flex items-center space-x-4 cursor-pointer">
              <i class="fas fa-home text-2xl"></i>
              <span><a href="home">home</a></span>
            </li>
          </ul>
        </div>
        <div class="flex items-center space-x-4 cursor-pointer font-semibold text-lg">
          <i class="fas fa-sign-out-alt text-2xl"></i>
          <span>Log Out</span>
        </div>
      </aside>

   <section class="flex-1 p-10">
        <div class="flex-1 p-4">
          <div class="flex justify-between items-center mb-4">
            <h3 class="font-extrabold text-lg text-black">Alamat Saya</h3>
          <hr class="border-black mb-8" />
      
      <!-- Profile Form -->
    <form method="POST" action="/lokasi" class="max-w-lg space-y-6">
    @csrf

<textarea
  name="alamat"
  type="text"
  placeholder="Alamat"
  class="w-full border border-black p-4 mb-6 text-gray-700 resize-none"
  rows="4"
></textarea>

<div class="flex justify-auto">
  <button
    type="button"
    onclick="submitAlamat()"
    class="bg-[#e6b300] text-white font-bold rounded-full px-6 py-2 hover:bg-yellow-600 transition">
    Konfirmasi
  </button>
</div>
</form>

      <!-- Delete Form -->
      </form>
    </section>
  </main>
  </body>
</html>
