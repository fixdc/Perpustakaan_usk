@extends('admin.layouts.main')
@section('container')
@php
        $user = null;
        if (Auth::guard('web')->user()) {
            $user = Auth::guard('web')->user();
        } elseif (Auth::guard('admin')->user()) {
            $user = Auth::guard('admin')->user();
        }
    @endphp
<section class="bg-gradient-to-br from-blue-100 to-blue-500 dark:bg-gray-900 h-screen ml-64 align-middle justify-center py-44 rounded-l-full m-auto">
    <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
        <div class="mx-auto max-w-screen-sm text-center">
            <h1 class="mb-4 text-7xl tracking-tight lg:text-9xl text-white">Hello!</h1>
            <p class="mb-4 text-3xl tracking-tight md:text-4xl text-white">{{ $user->f_nama }}</p>
            <p class="mb-4 text-lg font-light text-white">Semoga harimu menyenangkan dan sehat selalu</p>
        </div>
           
    </div>
</section>
@endsection