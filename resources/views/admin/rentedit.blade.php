@extends('admin.layouts.main')
@section('container')
    <style>
        .autocomplete-items {
            position: absolute;

            border-bottom: none;
            border-top: none;
            z-index: 99;
            /*position the autocomplete items to be the same width as the container:*/
            top: 100%;
            left: 0;
            right: 0;
        }

        .autocomplete-items div {
            padding: 10px;
            cursor: pointer;
            background-color: #fff;
            border-bottom: 1px solid #d4d4d4;
            border-radius: 5px;
        }

        .autocomplete-items div:hover {
            /*when hovering an item:*/
            background-color: #e9e9e9;
        }

        .autocomplete-active {
            /*when navigating through the items using the arrow keys:*/
            background-color: DodgerBlue !important;
            color: #ffffff;
        }
    </style>
    <div class="h-full ">
        <div class="p-4 sm:ml-64 h-full">
            <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 h-screen">
                @if (session()->has('success'))
                    <div id="alert-3"
                        class="flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                        role="alert">
                        <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                        </svg>
                        <span class="sr-only">Info</span>
                        <div class="ms-3 text-sm font-medium">
                            Berhasil Menambahkan Peminjaman
                        </div>
                        <button type="button"
                            class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700"
                            data-dismiss-target="#alert-3" aria-label="Close">
                            <span class="sr-only">Close</span>
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                        </button>
                    </div>
                @endif
                @if (session()->has('error'))
                    <div id="alert-3"
                        class="flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                        role="alert">
                        <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                        </svg>
                        <span class="sr-only">Info</span>
                        <div class="ms-3 text-sm font-medium">
                            Buku yang di pilih tidak tersedia!
                        </div>
                        <button type="button"
                            class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700"
                            data-dismiss-target="#alert-3" aria-label="Close">
                            <span class="sr-only">Close</span>
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                        </button>
                    </div>
                @endif
                @if (session()->has('pengembalian'))
                    <div id="alert-3"
                        class="flex items-center p-4 mb-4 text-yellow-800 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-400"
                        role="alert">
                        <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                        </svg>
                        <span class="sr-only">Info</span>
                        <div class="ms-3 text-sm font-medium">
                            Buku berhasil dikembalikan
                        </div>
                        <button type="button"
                            class="ms-auto -mx-1.5 -my-1.5 bg-yellow-50 text-yellow-500 rounded-lg focus:ring-2 focus:ring-yellow-400 p-1.5 hover:bg-yellow-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-yellow-400 dark:hover:bg-gray-700"
                            data-dismiss-target="#alert-3" aria-label="Close">
                            <span class="sr-only">Close</span>
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                        </button>
                    </div>
                @endif
                <div class="m-auto mt-3 mb-3"><a href="/dashboard/rents" class="bg-blue-400 p-4 rounded-md">Kembali</a></div>
                <form class=" flex flex-col justify-start" action="{{ route('peminjamanedit', ['f_id' => $detailPeminjaman->f_id]) }}" method="POST">
                    @csrf
                    <div class=" mb-3">
                        Pilih Anggota
                        <select name="f_idanggota" id="anggota"
                            class="border border-transparent bg-gray-200 px-4 py-2 text-base rounded-lg w-full" required>
                            <option value="" selected></option>
                            @foreach ($anggota as $agt)
                                <option value="{{ $agt->f_id }}">{{ $agt->f_nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class=" mb-3">
                        Pilih Admin
                        <select name="f_idadmin" id="admin"
                            class="border border-transparent bg-gray-200 px-4 py-2 text-base rounded-lg w-full" required>
                            <option value="" selected></option>
                            @foreach ($admin as $agt)
                                <option value="{{ $agt->f_id }}">{{ $agt->f_nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class=" mb-3">
                        Pilih Buku
                        <select name="f_judul" id="buku"
                            class="border border-transparent bg-gray-200 px-4 py-2 text-base rounded-lg w-full" required>
                            <option value="" selected></option>
                            @foreach ($buku as $bk)
                                <option value="{{ $bk->buku->f_id }}">{{ $bk->buku->f_judul }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex flex-col mb-3 w-full">
                        <label for="">Tanggal Peminjaman</label>
                        <input type="date" class=" rounded-md border-0 w-fit" name="f_tanggalpeminjaman" value="{{ $detailPeminjaman->tPeminjaman->f_tanggalpeminjaman }}">
                    </div>
                    <div class="flex flex-col mb-3 w-full">
                        <label for="">Tanggal Kembali</label>
                        <input type="date" class=" rounded-md border-0 w-fit" name="f_tanggalkembali" value="{{ $detailPeminjaman->f_tanggalkembali }}">
                    </div>

                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 w-60">Input Peminjaman</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#anggota').select2({
                placeholder: 'Pilih Anggota',
                allowClear: true
            });
            $('#admin').select2({
                placeholder: 'Pilih Admin',
                allowClear: true
            });
            $('#buku').select2({
                placeholder: 'Pilih Buku',
                allowClear: true
            });
        });
    </script>
@endsection


@section('script')
@endsection
