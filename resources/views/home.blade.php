<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1" name="viewport"/>
  <title>NyaperGO</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet"/>
  <style>
    body {
      font-family: "Inter", sans-serif;
    }
  </style>
</head>
<body class="bg-white">
  <header class="relative overflow-hidden">
    <div class="flex justify-between items-center max-w-8xl mx-auto px-3 py-3 relative z-10">
      <div class="text-2xl font-extrabold text-black">NyaperGO</div>
      <nav class="ml-auto relative">
        <div class="absolute -left-14 -right-[100vw] -top-3 -bottom-3 bg-[#f2c615] rounded-l-[80px] -z-10"></div>
        <ul class="flex items-center space-x-10 px-14 py-6">
          <li><a class="font-extrabold text-black text-lg leading-6 hover:underline" href="#">Home</a></li>
          <li><a class="font-extrabold text-black text-lg leading-6 hover:underline" href="{{ route('menu') }}">Menu</a></li>
          <li><a class="font-extrabold text-black text-lg leading-6 hover:underline" href="#">Delivery</a></li>
          <li><a class="font-extrabold text-black text-lg leading-6 hover:underline" href="#">Contact Us</a></li>
          <li>
            @auth
              <div class="flex items-center space-x-2 cursor-pointer group" id="profile-button">
                <a href="/dashboard"class="far fa-user-circle text-2xl group-hover:text-accent"></a>
                 
                <span class="group-hover:text-accent">{{ Auth::user()->name }}</span>
              </div>
            @else
              <a href='{{ route('login') }}'class="bg-white font-extrabold text-black text-lg leading-6 rounded-full px-6 py-2" >Sign In</a>
            @endauth
          </li>
        </ul>
      </nav>
    </div>
  </header>

  <main class="max-w-7xl mx-auto px-6">
    <section class="flex flex-col md:flex-row items-center justify-between mt-20 md:mt-32">
      <div class="md:w-1/2">
        <h1 class="text-[#e5af0a] font-extrabold text-4xl md:text-5xl leading-tight mb-4">
          Your Favorite<br/>Bites, Served Fast<br/>&amp; Tasty
        </h1>
        <p class="text-black text-base md:text-lg max-w-md mb-8">
          From the grill to your doorstep — sizzling, crispy, and full of flavor. Just sit back, we've got dinner covered.
        </p>
      @auth
        <a href="{{ route('menu') }}" 
        class="bg-[#f2c615] text-white px-4 py-2 rounded-full hover:bg-yellow-500 transition-colors">
        Order Now</a>
          <span class="group-hover:text-accent">{{ Auth::user()->name }}</span>
        </div>
      @else
        <a href="{{ route('login') }}"
         class="bg-[#f2c615] text-white px-4 py-2 rounded-full hover:bg-yellow-500 transition-colors">
        Order Now</a>
      @endauth
      </div>
      <div class="md:w-1/2 mt-12 md:mt-0 relative">
        <div class="absolute -bottom-16 -right-16 w-[600px] h-[320px] bg-[#f2c615] rounded-[120px] z-0"></div>
        <img alt="Cheeseburger with lettuce, tomato, pickles, cheese, glass of orange juice, wooden bowls with sauces and fried snacks on wooden board" 
        class="relative z-10 max-w-full h-auto" 
        height="320" src="{{ asset('asset/halaman2.png') }}" width="600"/>
      </div>
    </section>
  </main>
  <!-- Tambahkan Font Awesome untuk ikon -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <script>
    document.addEventListener('DOMContentLoaded', () => {
      @if(Auth::check())
        <a href="/profile">Profile</a>
    @else
        <a href="{{ route('login') }}">Sign In</a>
    @endif
      // Toggle dropdown profile
      const profileButton = document.getElementById('profile-button');
      if (profileButton) {
        profileButton.addEventListener('click', toggleDropdown);
      }
      
      // Close dropdown when clicking outside
      document.addEventListener('click', (e) => {
        const dropdown = document.getElementById('profile-dropdown');
        const profileBtn = document.getElementById('profile-button');
        
        if (dropdown && !dropdown.contains(e.target) && !(profileBtn && profileBtn.contains(e.target))) {
          dropdown.classList.add('hidden');
        }
      });

      // Order button click handler
      const orderBtn = document.getElementById('order-btn');
      if (orderBtn) {
        orderBtn.addEventListener('click', (e) => {
          @guest
            e.preventDefault();
            window.location.href = "{{ route('login') }}";
          @endguest
        });
      }
    });

    function toggleDropdown() {
      const dropdown = document.getElementById('profile-dropdown');
      dropdown.classList.toggle('hidden');
    }
  </script>
</body>
</html>