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
                <div class="flex gap-4 mb-4">
                    <div class="p-5 flex items-center justify-center rounded bg-blue-400 dark:bg-gray-800 hover:bg-blue-800">
                        <a href="/dashboard/data-user">
                            <p class="text-sm md:text-lg font-Mont font-bold text-white dark:text-gray-500">
                                CANCEL
                            </p>
                        </a>
                    </div>
                </div>
                <form class="mx-auto max-w-5xl flex flex-col justify-start" action="/dashboard/rents/add" method="POST">
                    @csrf

                    <div class="relative inline-block mb-3" style="width: 300px;">
                        <select name="anggota" id="anggota" class="border border-transparent bg-gray-200 px-4 py-2 text-base rounded-lg w-full" required>
                            <option value="" selected></option>
                            @foreach ($anggota as $agt)
                                <option value="{{ $agt->f_id }}">{{ $agt->f_nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="relative inline-block mb-3" style="width: 300px;">
                        {{-- <label for="">Judul Buku</label>
                        <input id="buku" type="text" class="border border-transparent bg-gray-200 px-4 py-2 text-base rounded-lg w-full" name=""> --}}
                        <select name="buku" id="buku" class="border border-transparent bg-gray-200 px-4 py-2 text-base rounded-lg w-full" required>
                            <option value="" selected></option>
                            @foreach ($buku as $bk)
                                <option value="{{ $bk->f_id }}">{{ $bk->f_judul }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex flex-col mb-3">
                        <label for="">Tanggal Peminjaman</label>
                        <input type="date" class=" rounded-md border-0 w-fit" name="f_tanggalpeminjaman">
                    </div>

                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Add
                        User</button>
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
                $('#buku').select2({
                    placeholder: 'Pilih Buku',
                    allowClear: true
                });
            });
    </script>
@endsection


@section('script')
    
@endsection