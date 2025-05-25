  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <title>NyaperGO User Profile</title>

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
      <span>{{ $user->name }}</span> <!-- Data dari database -->
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

      <section class="flex-1 p-16">
      <div class="flex items-center space-x-8 mb-16">
        <img
          alt="User profile picture"
          class="rounded-full"
          height="100"
          width="100"
          src="https://storage.googleapis.com/a1aa/image/e8406ae9-5800-44c1-fa7b-b004d5d26ccf.jpg"
        />
        <h3 class="font-extrabold text-lg">{{ $user->name }}</h3> <!-- Data dari database -->
      </div>
        <!-- Form Start -->
<form method="POST" action="/profile/update">
  @csrf

    <div>
          <label class="block font-extrabold mb-2" for="name">Username</label>
          <input
          id="username"
            name="username"
            type="text"
            value="{{ old('name', $user->username) }}"
            class="w-full h-12 bg-[#D9D9D9] border-none rounded-none focus:ring-0 px-4"
          />
        </div>

        <div>
          <label class="block font-extrabold mb-2" for="birthdate">Birth Date</label>
          <input
            name="tanggal_lahir"
            type="date"
            value="{{ old('birth_date', $user->tanggal_lahir) }}"
            class="w-full h-12 bg-[#D9D9D9] border-none rounded-none focus:ring-0 px-4"
          />
        </div>

        <div>
          <label class="block font-extrabold mb-2" for="phone">Phone Number</label>
          <input
            name="nomor_telepon"
            type="text"
            value="{{ old('phone_number', $user->nomor_telepon) }}"
            class="w-full h-12 bg-[#D9D9D9] border-none rounded-none focus:ring-0 px-4"
          />
        </div>

        <div>
          <label class="block font-extrabold mb-2" for="email">Email Address</label>
          <input
            id="email"
            name="email"
            type="email"
            value="{{ old('email', $user->email) }}"
            class="w-full h-12 bg-[#D9D9D9] border-none rounded-none focus:ring-0 px-4"
            readonly
          />
        </div>
    <div class="sm:col-span-2 mt-16 flex justify-center">
      <button
        type="submit"
        class="bg-[#FBC14E] text-black font-semibold text-lg rounded-full px-12 py-3 hover:bg-transparent hover:text-[#e2751b] border border-[#e2751b]">
        Save Changes
      </button>
  </form>
  <form method="post" action="{{ route('delete') }}">
    @csrf
    @method('DELETE')
        </div>
        <div class="sm:col-span-2 mt-16 flex justify-center">
      <button
        type="submit"
        class="bg-[#FBC14E] text-black font-semibold text-lg rounded-full px-12 py-3 hover:bg-transparent hover:text-[#e2751b] border border-[#e2751b]">
        Hapus Akun
      </button>
    </div>
  </form>
        <!-- Form End -->
      </section>
    </main>
  </body>
  </html>