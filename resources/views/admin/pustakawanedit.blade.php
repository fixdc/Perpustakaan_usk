@extends('admin.layouts.main')
@section('container')
<div class="h-full ">
    <div class="p-4 sm:ml-64 h-full">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 h-screen">
            <div class="flex gap-4 mb-4">
                <div class="p-5 flex items-center justify-center rounded bg-blue-400 dark:bg-gray-800 hover:bg-blue-800">
                    <a href="/dashboard/pustakawan">
                        <p class=" text-sm md:text-lg font-Mont font-bold text-white dark:text-gray-500">
                            CANCEL
                        </p>
                    </a>
                </div>
            </div>
            <form class="mx-auto max-w-5xl flex flex-col justify-start text-white" action="{{ route('editadmin', [$admin->f_username]) }}" method="POST" >
                @csrf
                <div class="mb-5 font-Mont font-bold">
                    <label  class="block font-bold mb-2 text-sm text-black">Nama</label>
                    <input type="text" id="name" name="f_nama" value="{{ $admin->f_nama }}"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                        required>
                </div>
                <div class="mb-5 font-Mont font-bold">
                    <label class="block mb-2 text-sm font-bold text-black">Username</label>
                    <input type="text" name="f_username" value="{{ $admin->f_username }}"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                        required>
                </div>
                <div class="mb-3 font-Mont font-bold">
                    <label for="email" class="font-bold block mb-2 text-sm text-black">Level</label>
                            <select id="countries" name="f_level"
                            class="font-bold bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            >
                            <option selected value="{{ $admin->f_level }}">{{ $admin->f_level }}</option>
                            <option value="Admin">Admin</option>
                            <option value="Pustakawan">Pustakawan</option>
                        </select>
                </div>
                <div class="mb-3 font-Mont font-bold">
                    <label for="email" class="font-bold block mb-2 text-sm text-black">Status</label>
                            <select id="countries" name="f_status"
                            class="font-bold bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            name="id_kelas">
                            <option selected value="{{ $admin->f_status }}">{{ $admin->f_status }}</option>
                            <option value="Tidak Aktif">Tidak Aktif</option>
                            <option value="Aktif">Aktif</option>
                        </select>
                </div>
                <div class="mb-5 text-white bg-red-400 p-3 rounded-md w-fit">
                    <a href="{{ route('editviewpasswordadmin', ['f_username' => $admin->f_username]) }}">Edit Password Here</a>
                </div>
                <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Edit User</button>
            </form>

        </div>
    </div>
</div>
@endsection