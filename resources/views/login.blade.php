
<html lang="en">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1" name="viewport"/>
  <title>
   NyaperGO Login
  </title>
  <script src="https://cdn.tailwindcss.com">
  </script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <style>
   @import url('https://fonts.googleapis.com/css2?family=Roboto&display=swap');
    body {
      font-family: 'Roboto', sans-serif;
    }
  </style>
 </head>
 <body class="bg-[#e5af0a] min-h-screen flex items-center justify-center p-4">
  <div class="bg-white rounded-3xl max-w-2xl w-full flex flex-col sm:flex-row p-8 sm:p-12 gap-8 sm:gap-0">

   <!-- Left side -->
   <div class=" flex-col justify-center w-full sm:w-1/2">
    <h2 class="text-center font-semibold text-lg text-black mb-1">
     Login
    </h2>
    <div class="border-b border-[#e5af0a] w-100 mb-2">
    </div>
    <p class="text-center text-xs font-semibold text-black mb-6">
     Selamat datang di
     <br/>
     NyaperGO
    </p>
    <form method="post" action="{{ route('login') }}" class="flex flex-col gap-6">
    @csrf
     <label class="flex flex-col text-[#e5af0a] font-semibold text-base">
      Email
      <input name="email" class="mt-1 border border-[#f9e7b0] bg-[#fef9e9] rounded-sm h-9 px-2 text-black placeholder-[#f9e7b0] focus:outline-none" placeholder="aku@gmail.com" type="email" required/>
     </label>
     <label class="flex flex-col text-[#e5af0a] font-semibold text-base">
      Password
      <input name="password" class="mt-1 border border-[#f9e7b0] bg-[#fef9e9] rounded-sm h-9 px-2 text-black placeholder-[#f9e7b0] focus:outline-none" placeholder="123456" type="password" required/>
     </label>
    <p><a href="{{ route('registrasi') }}" class="text-[#2E52AC] hover:underline">Belum punya akun?</a></p>
    <button action="{{ route('login') }}" type="submit" class="bg-[#e5af0a] text-white font-semibold rounded-full py-2 mt-1 hover:bg-yellow-500 transition-colors">
        Login
    </button>
</form>
 </div>

   <!-- Right side -->
   <div class="flex flex-col items-center justify-center w-full sm:w-1/2 text-center">
    <p class="italic font-semibold text-xl text-black mb-6">
     Nyaper
     <em>
      GO
     </em>
    </p>
    <img alt="gambar bowl isi kentang" class="w-55 h-43 object-contain" height="200" 
    src="{{ asset('asset/gambar.jpg') }}" width="300"/>
   </div>
  </div>
 </body>
  <script>
  </script>
</html>