@extends('layouts.main')
@section('container')
    {{-- navbar --}}

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
                        type="button">Masuk <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 4 4 4-4" />
                        </svg>
                    </button>

                    <!-- Dropdown menu -->
                    <div id="dropdown"
                        class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                            <li>
                                <a href="/login"
                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Anggota</a>
                            </li>
                            <li>
                                <a href="/loginadmin"
                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Admin
                                    / Pustakawan</a>
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
                        @if (Auth::guard('web')->user())
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
                    @endif
                </ul>
            </div>
        </div>
    </nav>




    {{-- endnavbar --}}






    {{-- hero --}}



    <section
        class="relative overflow-hidden bg-gradient-to-b from-blue-50 via-transparent to-transparent pb-12 pt-20 sm:pb-16 sm:pt-32 lg:pb-24 xl:pb-32 xl:pt-40">
        <div class="relative z-20 mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-2xl text-center">
                <img src="img/LOGOSMKN65YANGKETENGAH.png" alt="" class="w-32 align-middle m-auto">
                <h1 class="text-4xl md:text-5xl font-black tracking-tight text-gray-900 font-mont">
                    PERPUSTAKAAN
                    <span class="text-blue-600">SEKOLAH MENENGAH KEJURUAN 65
                    </span>
                </h1>
                <h2 class="mt-6 text-lg leading-8 text-white font-cool">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maxime, consectetur. Eaque nostrum quo
                    expedita, debitis nam odit veritatis laborum incidunt!
                </h2>
                @if ($user)
                    <h1 class="font-cool text-2xl text-blue-400 bg-white p-10 rounded-md">
                        Welcome <span>{{ $user->f_nama }}</span>
                        @if (Auth::guard('admin')->user())
                            As
                        @endif
                        <span>{{ $user->f_level }}</span>
                    </h1>
                @endif
                <div class="mt-10 flex items-center justify-center gap-x-6">
                    {{-- <a class="isomorphic-link isomorphic-link--internal inline-flex items-center justify-center gap-2 rounded-xl bg-blue-600 px-4 py-3 text-sm font-semibold text-white shadow-sm transition-all duration-150 hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600"
                    href="/login">Shop Now
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </a> --}}
                </div>
            </div>
        </div>
    </section>


    {{-- endhero --}}







    {{-- aboutus --}}

    <div class="py-16">
        <div class="px-5 md:px-40">
            <div
                class=" p-6 md:p-3 bg-gray-50 rounded-xl justify-center items-center flex md:flex-row gap-5 flex-col shadow-lg">
                <div class="md:7/12 lg:w-1/2 text-center">
                    <h2 class="text-5xl font-black font-mont">
                        ABOUT US
                    </h2>
                    <p class="my-8 font-cool">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Unde ad impedit dignissimos perferendis
                        minus nostrum repellendus illum iste vel vitae, sit nam, esse officiis molestias, ratione nobis! Sed
                        enim illo vel numquam, maxime architecto placeat sapiente tempore ut ratione esse adipisci a
                        accusantium molestias ipsum eaque, et cumque, facilis recusandae?
                    </p>

                </div>
            </div>
        </div>
    </div>


    {{-- endaboutus --}}


    <div class="py-16 mx-24">
        <div class="xl:container m-auto px-6 text-gray-600 md:px-12 xl:px-16">
            <div
                class="shadow-xl lg:bg-gray-50 dark:lg:bg-darker lg:p-16 rounded-xl space-y-6 md:flex flex-row-reverse md:gap-6 justify-center md:space-y-0 lg:items-center">
                <div class="md:5/12 lg:w-1/2">
                    <img src="img/pie.svg" alt="image" loading="lazy" width="" height="" />
                </div>
                <div class="md:7/12 lg:w-1/2">
                    <h2 class="text-3xl font-bold text-gray-900 md:text-4xl dark:text-white font-cool">
                        Perpustakaan SMKN 65 Jakarta Mempunyai Fitur...
                    </h2>
                    <p class="my-8 text-gray-600 dark:text-gray-300 font-cool">
                        Nobis minus voluptatibus pariatur dignissimos libero quaerat iure expedita at?
                        Asperiores nemo possimus nesciunt dicta veniam aspernatur quam mollitia.
                    </p>
                    <div class="divide-y space-y-4 divide-gray-100 dark:divide-gray-800">
                        <div class="mt-8 flex gap-4 md:items-center">
                            <div class="w-12 h-12 flex gap-4 rounded-full bg-indigo-100 dark:bg-indigo-900/20">
                                <i class="fa-solid fa-clipboard-check m-auto text-xl text-green-400"></i>
                            </div>
                            <div class="w-5/6">
                                <h4 class="font-semibold text-lg text-gray-700 dark:text-indigo-300 font-cool">Full
                                    Create,Read,Update,dan Delete (CRUD)</h3>
                                    <p class="text-gray-500 dark:text-gray-400 font-coolit">Asperiores nemo possimus
                                        nesciunt quam mollitia.</p>
                            </div>
                        </div>
                        <div class="pt-4 flex gap-4 md:items-center">
                            <div class="w-12 h-12 flex gap-4 rounded-full bg-teal-100 dark:bg-teal-900/20">
                                <i class="fa-solid fa-file-invoice m-auto text-xl text-orange-400"></i></i>
                            </div>
                            <div class="w-5/6">
                                <h4 class="font-semibold text-lg text-gray-700 dark:text-teal-300 font-cool">Laporan yang
                                    Terintegrasi</h3>
                                    <p class="text-gray-500 dark:text-gray-400 font-coolit">Asperiores nemo possimus
                                        nesciunt quam mollitia.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="xl:container m-auto px-6 py-20 md:px-12 lg:px-20 font-cool">
        <div class="m-auto text-center lg:w-8/12 xl:w-7/12">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white md:text-4xl">
                Dengan Menggunakan :
            </h2>
        </div>
        <div class="m-auto mt-12 items-center justify-center space-y-6 lg:flex lg:space-y-0 lg:space-x-6 xl:w-10/12">
            <div class="group relative z-10 mx-auto sm:w-7/12 lg:w-4/12">
                <div aria-hidden="true"
                    class="absolute top-0 h-full w-full rounded-3xl border border-gray-100 dark:border-gray-700 bg-white dark:bg-gray-800 shadow-2xl shadow-gray-600/10 dark:shadow-none transition duration-500 group-hover:scale-105 lg:group-hover:scale-110">
                </div>
                <div class="relative space-y-8 p-8">
                    <div class="flex items-center justify-between">
                        <h5 class="text-xl font-semibold text-gray-700 dark:text-white">One Report</h5>
                    </div>
                    <img src="img/tanzanite.webp" width="512" height="512" class="m-auto w-16"
                        alt="tanzanite illustration" />
                    <p class="text-center text-gray-600 dark:text-gray-300">
                        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Iusto dolorum
                    </p>
                    <a href="/login"
                        class="relative flex h-11 w-full items-center justify-center px-6 before:absolute before:inset-0 before:rounded-full before:bg-sky-50 before:border before:border-sky-500 dark:before:border-gray-600 dark:before:bg-gray-700 before:transition before:duration-300 hover:before:scale-105 active:duration-75 active:before:scale-95">

                        <span class="relative text-base font-semibold text-sky-600 dark:text-white">Login Sekarang</span>

                    </a>
                </div>
            </div>

            <div class="group relative m-auto md:w-10/12 lg:w-8/12">
                <div aria-hidden="true"
                    class="absolute top-0 h-full w-full rounded-3xl border border-gray-100 dark:border-gray-700 bg-white dark:bg-gray-800 shadow-2xl shadow-gray-600/10 dark:shadow-none transition duration-500 group-hover:scale-105 lg:group-hover:scale-110">
                </div>
                <div class="relative sm:flex">
                    <div class="space-y-8 p-8 pb-20 sm:w-7/12 sm:pb-8">
                        <div class="flex items-center justify-between">
                            <h5 class="text-xl font-semibold text-gray-700 dark:text-white">Three Roles</h5>
                        </div>
                        <img src="img/premium.webp" width="512" height="512" class="m-auto w-16"
                            alt="premium illustration" />
                        <p class="text-center text-gray-600 dark:text-gray-300">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam, sequi?
                        </p>
                        <div class="absolute inset-x-0 bottom-6 w-full px-6 sm:static sm:px-0">
                            <button
                                class="relative flex h-11 w-full items-center justify-center px-6 before:absolute before:inset-0 before:rounded-full before:bg-primary before:transition before:duration-300 hover:before:scale-105 active:duration-75 active:before:scale-95">
                                <span class="relative text-base font-semibold text-white dark:text-dark">Start plan</span>
                            </button>
                        </div>
                    </div>

                    <div class="-mt-16 pb-20 sm:mt-0 sm:w-5/12 sm:pb-0">
                        <div
                            class="relative h-full before:absolute before:left-0 before:top-1 before:my-auto before:h-0.5 before:w-full before:rounded-full before:bg-gray-200 dark:before:bg-gray-700 sm:pt-0 sm:before:inset-y-0 sm:before:h-[85%] sm:before:w-0.5">
                            <div class="relative -mt-1 h-full overflow-x-auto pt-7 pb-6 sm:-ml-1 sm:pl-1">
                                <ul class="flex flex-col w-full gap-6 md:grid-cols-2">
                                    <li>
                                        <input type="radio" id="admin" name="hosting" value="admin"
                                            class="hidden peer" required />
                                        <label for="admin"
                                            class="inline-flex items-center justify-between w-fit ml-5 p-3 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                                            <div class="block">
                                                <div class="w-fit text-lg font-semibold">Admin</div>
                                                <div class="w-fit">Lorem ipsum dolor sit amet.</div>
                                            </div>
                                        </label>
                                    </li>
                                    <li>
                                        <input type="radio" id="pustakawan" name="hosting" value="pustakawan"
                                            class="hidden peer" required />
                                        <label for="pustakawan"
                                            class="inline-flex items-center justify-between w-fit ml-5 p-3 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                                            <div class="block">
                                                <div class="w-fit text-lg font-semibold">Pustakawan</div>
                                                <div class="w-fit">Lorem ipsum dolor sit amet.</div>
                                            </div>
                                        </label>
                                    </li>
                                    <li>
                                        <input type="radio" id="anggota" name="hosting" value="anggota"
                                            class="hidden peer" required />
                                        <label for="anggota"
                                            class="inline-flex items-center justify-between w-fit ml-5 p-3 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                                            <div class="block">
                                                <div class="w-fit text-lg font-semibold">Anggota</div>
                                                <div class="w-fit">Lorem ipsum dolor sit amet.
                                                </div>
                                            </div>
                                        </label>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>





    <footer class="mx-40 bg-white dark:bg-gray-900 py-16 rounded-lg shadow-lg">
        <div class="md:px-12 lg:px-28">
            <div class="container m-auto space-y-6 text-gray-600 dark:text-gray-300">
                <div class="text-center">
                    <span class="text-sm tracking-wide font-cool">Copyright © Perpustakaan <span id="year"></span> |
                        Author: <a href="https://fixdc.github.io/"
                            class="text-orange-500 bg-blue-300 p-2 rounded-md">fixdc.github.io</a></span>
                </div>
            </div>
        </div>
    </footer>







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
@endsection
