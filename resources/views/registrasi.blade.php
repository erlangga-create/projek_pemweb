<html lang="en">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1" name="viewport"/>
  <title>
   NyaperGO Registration
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
    
   <!-- Left side form -->
   <div class="flex flex-col justify-center w-full sm:w-1/2">
    <h2 class="text-center font-semibold text-lg text-black mb-1">
     Registrasi
    </h2>
    <div class="border-b border-[#e5af0a] w-100 mb-2">
    </div>
    <p class="text-center text-xs font-semibold text-black mb-6">
     Selamat datang di
     <br/>
     NyaperGO
    </p>
    <form method="POST" action="{{ route('registrasi') }}" class="flex flex-col gap-6">
    @csrf
    <label class="flex flex-col text-[#e5af0a] font-semibold text-base">
      Username
      <input name="username" class="mt-1 border border-[#f9e7b0] bg-[#fef9e9] rounded-sm h-9 px-2 text-black placeholder-[#f9e7b0] focus:outline-none" placeholder="" type="username" required/>
     </label>
     <label class="flex flex-col text-[#e5af0a] font-semibold text-base">
      Email
      <input name="email" class="mt-1 border border-[#f9e7b0] bg-[#fef9e9] rounded-sm h-9 px-2 text-black placeholder-[#f9e7b0] focus:outline-none" placeholder="" type="email" required/>
     </label>
     <label class="flex flex-col text-[#e5af0a] font-semibold text-base">
      Password
      <input name="password" class="mt-1 border border-[#f9e7b0] bg-[#fef9e9] rounded-sm h-9 px-2 text-black placeholder-[#f9e7b0] focus:outline-none" placeholder="" type="password" required/>
     </label>
    <button type="submit" class="bg-[#e5af0a] text-white font-semibold rounded-full py-2 mt-1 hover:bg-yellow-500 transition-colors">
      Buat Akun
    </button>
    </form>
    <div class="flex justify-center mt-4">
     <img alt="Google logo icon in color" class="w-6 h-6" height="24" src="https://storage.googleapis.com/a1aa/image/0d02798c-ad50-40ef-6481-1fd45ffd9aef.jpg" width="24"/>
    </div>
   </div>

   <!-- Right side image and text -->
   <div class="flex flex-col items-center justify-center w-full sm:w-1/2 text-center">
    <p class="italic font-semibold text-xl text-black mb-4">
     Nyaper
     <em>
      GO
     </em>
    </p>
    <img alt="gambar bowl isi kentang" class="w-55 h-43 object-contain" height="200" src="{{ asset('asset/gambar ani 1.jpg') }}" width="300"/>
   </div>
  </div>
 </body>
</html>