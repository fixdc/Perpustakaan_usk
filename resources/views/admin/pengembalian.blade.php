@extends('admin.layouts.main')
@section('container')
    <div class="p-4 sm:ml-64 h-full ">

        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 h-screen">

            <div class="flex gap-4 mb-4">
                <div class="p-5 flex items-center justify-center rounded bg-blue-400 dark:bg-gray-800 hover:bg-blue-800">
                    <a href="/dashboard/pengembalian/report" >
                        <p class=" text-sm md:text-lg font-Mont text-white dark:text-gray-500">
                            Unduh Laporan 
                        </p>
                    </a>
                </div>
                <div class="p-5 flex items-center justify-center rounded bg-red-400 dark:bg-gray-800 hover:bg-red-800">
                    <form action="{{ route('deletedata') }}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" onclick="return confirm('Apakah anda ingin menghapus semua data peminjaman')" class=" text-sm md:text-lg font-Mont text-white dark:text-gray-500">
                            Hapus Semua Data
                        </button>
                    </form>
                </div>
            </div>
            <div>
                @if (session()->has('success'))
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
                        Berhasil Menghapus data
                    </div>
                    <button type="button"
                        class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700"
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
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg ">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                No
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Peminjam
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Judul Buku
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Petugas
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Tanggal Peminjaman
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Tanggal Kembali
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pengembalian as $pengembalian)
                            <tr class="bg-white dark:bg-gray-800">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $loop->iteration }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $pengembalian->tPeminjaman->anggota->f_nama }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $pengembalian->detailbuku->buku->f_judul }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $pengembalian->tPeminjaman->admin->f_nama }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $pengembalian->tPeminjaman->f_tanggalpeminjaman }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $pengembalian->f_tanggalkembali }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#anggota').select2({
                placeholder: 'Pilih Anggota',
                allowClear: true
            });
            $('#buku').select2({
                placeholder: 'Pilih Buku',
                allowClear: true
            });
        });
    </script>
@endsection
