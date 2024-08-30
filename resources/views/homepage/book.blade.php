<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <link rel="icon" href="img/logo.png" type="image/x-icon">
    <title>Perpustakaan</title>
</head>

<body class=" bg-gradient-to-tr from-blue-100 to-blue-400 w-full h-screen">

    @php
        $user = null;
        if (Auth::guard('web')->user()) {
            $user = Auth::guard('web')->user();
        } elseif (Auth::guard('admin')->user()) {
            $user = Auth::guard('admin')->user();
        }
    @endphp

    <nav class="backdrop-blur-xl fixed w-full z-50 top-0 start-0 transition duration-300 ease-in-out font-cool">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="#" class="flex items-center space-x-3 rtl:space-x-reverse">
                <h1>PERPUSTAKAAN </h1>
            </a>


            <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
                @if ($user)
                    <form action="{{ route('logout') }}" method="post"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        @csrf
                        <button type="submit">Keluar</button>
                    </form>
                @else
                    <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                        type="button">Login <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 4 4 4-4" />
                        </svg>
                    </button>

                    <!-- Dropdown menu -->
                    <div id="dropdown"
                        class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                            aria-labelledby="dropdownDefaultButton">
                            <li>
                                <a href="/login"
                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Login
                                    For Users</a>
                            </li>
                            <li>
                                <a href="/loginadmin"
                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Login
                                    For Admins or Pustakawan</a>
                            </li>
                        </ul>
                    </div>
                @endif
                <button data-collapse-toggle="navbar-sticky" type="button"
                    class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                    aria-controls="navbar-sticky" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 17 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 1h15M1 7h15M1 13h15" />
                    </svg>
                </button>
            </div>
            <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
                <ul
                    class="flex flex-col p-4 md:p-0 mt-4 font-medium md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0">
                    @if (Auth::guard('admin')->user())
                        <li class="text-blue-600">
                            <a href="/homepage" class="block py-2 px-3 transition duration-300 ease-in-out">Home</a>
                        </li>
                        <li class="text-blue-600">
                            <a href="/dashboard/admin"
                                class="block py-2 px-3 transition duration-300 ease-in-out">Dashboard</a>
                        </li>
                        <li class="text-blue-600">
                            <a href="/book" class="block py-2 px-3 transition duration-300 ease-in-out">Buku</a>
                        </li>
                    @else
                        <li class="text-blue-600">
                            <a href="/homepage" class="block py-2 px-3 transition duration-300 ease-in-out">Home</a>
                        </li>
                        <li class="text-blue-600">
                            <a href="/riwayat" class="block py-2 px-3 transition duration-300 ease-in-out">Riwayat</a>
                        </li>
                        <li class="text-blue-600">
                            <a href="/book" class="block py-2 px-3 transition duration-300 ease-in-out">Buku</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    @if (Auth::guard('web')->user())
        <div class="mt-20 flex flex-row justify-between mx-36">
            <h1 class="font-cool text-3xl bg-white p-3 rounded-md">DAFTAR BUKU</h1>
        </div>
        <div class="mx-36 pt-7 flex justify-between gap-4">
            <div class="flex flex-wrap gap-2">
                @foreach ($books as $book)
                    <div class="bg-blue-100 max-w-72 min-w-72 max-h-36 min-h-36 p-4 rounded-md shadow-md">
                        <h1 class="font-cool text-2xl">{{ $book->detailbuku->buku->f_judul }}</h1>
                        <p class="font-mont text-sm">{{ $book->detailbuku->buku->f_deskripsi }}</p>
                    </div>
                @endforeach
            </div>
        @else
            <div class="mx-36 justify-center mt-20 flex flex-col gap-4">
                <h1 class="font-cool p-4 bg-white rounded-md text-3xl text-center">DAFTAR BUKU</h1>
                <div class="flex flex-wrap gap-3 justify-center">
                    @foreach ($books as $book)
                        <div class="bg-blue-100 max-w-96 min-w-96 max-h-36 min-h-36 p-4 rounded-md shadow-md">
                            <h1 class="font-cool text-2xl">{{ $book->detailbuku->buku->f_judul }}</h1>
                            <p class="font-mont text-sm">{{ $book->detailbuku->buku->f_deskripsi }}</p>
                        </div>
                    @endforeach
                </div>
                <div class="mt-4">
                    {{ $books->links() }}
                </div>
           </div>
    @endif

    </div>


    {{-- endnavbar --}}



    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <script>
        window.addEventListener("scroll", function() {
            var navbar = document.querySelector("nav");
            var listItems = navbar.querySelectorAll("li");

            // Loop melalui setiap elemen li dan ubah warna teksnya menjadi putih saat di-scroll
            listItems.forEach(function(item) {
                item.classList.toggle("text-white", window.scrollY > 0);
            });
        });
    </script>
</body>

</html>
{{-- navbar --}}
