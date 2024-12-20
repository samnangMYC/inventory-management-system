<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inventory Management System</title>
    @vite('resources/css/app.css')
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <style>
        main {
            font-family: sans-serif;
        }
        .background-image {
            background-image: url('assets/images/background.jpg');
           
        }
    </style>
</head>
<body>
    <main class="bg-black">
        <header class="flex justify-between items-center h-32 bg-primary text-gray-200 text-3xl px-12 xl:px-20">
    
         <h1 class="uppercase">Tomnenh</h1>
           <ul class="flex gap-12 ">
               <li class="hover:text-light hover:cursor-pointer">Home</li>
            </ul>
        
        </header>
        <div class="background-image bg-cover bg-center h-screen filter ">
            <div class="flex items-center justify-center h-full">
                <div class=" text-primary bg-white p-14 text-5xl lg:text-6xl xl:8xl font-bold text-center ">
                    
                    <p class="mb-6 xl:mb-20">Welcome to the Inventory Management System</p>

                    <a href="{{route('login')}}" class="text-blue-600 bg-[#E3F0AF] p-3 rounded-md">>> Dashboard <<</a>
                </div>
            </div>
        </div>
    </main>
</body>
</html>