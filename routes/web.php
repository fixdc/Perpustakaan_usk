<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TBukuController;
use App\Http\Controllers\TKategoriController;
use App\Http\Controllers\TpeminjamanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {

    return view('homepage/homepage');
})->name('landing');
Route::get('/homepage', function () {
    return view('homepage/homepage');
});

Route::get('/book', [TpeminjamanController::class, 'book']);
Route::get('/riwayat', [TpeminjamanController::class, 'riwayat']);

Route::get('/login', [LoginController::class, 'showLoginform'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/loginadmin', [LoginController::class, 'showLoginformadmin'])->middleware('guest')->name('loginadmin');
Route::post('/loginadmin', [LoginController::class, 'loginadmin']);


Route::middleware('logSuccess')->group(function () {

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');



    Route::get('/dashboard/admin', [DashboardController::class, 'index']);




    // ADMIN ONLY
    Route::middleware('OnlyAdmin')->group(function () {
        Route::get('/dashboard/members', [MemberController::class, 'view']);
        Route::get('/dashboard/members/create', [MemberController::class, 'createview']);
        Route::post('/dashboard/members/create', [MemberController::class, 'store']);
        Route::delete('/delete/{f_id}', [MemberController::class, 'delete'])->name('delete');
        Route::get('/edit/{f_username}', [MemberController::class, 'editview'])->name('editview');
        Route::post('/edit/{f_username}', [MemberController::class, 'edit'])->name('edit');
        Route::get('/editpassword/{f_username}', [MemberController::class, 'editpasswordview'])->name('editviewpassword');
        Route::post('/editpassword/{f_username}', [MemberController::class, 'editpassword'])->name('editpassword');


        Route::get('/dashboard/pustakawan', [AdminController::class, 'view']);
        Route::get('/dashboard/pustakawan/create', [AdminController::class, 'create']);
        Route::post('/dashboard/pustakawan/create', [AdminController::class, 'store']);
        Route::delete('/delete/pustakawan/{f_id}', [AdminController::class, 'destroy'])->name('deleteadmin');
        Route::get('/edit/pustakawan/{f_username}', [AdminController::class, 'edit'])->name('editviewadmin');
        Route::post('/edit/pustakawan/{f_username}', [AdminController::class, 'update'])->name('editadmin');
        Route::get('/edit/passwordpustakawan/{f_username}', [AdminController::class, 'editpasswordviewadmin'])->name('editviewpasswordadmin');
        Route::post('/edit/passwordpustakawan/{f_username}', [AdminController::class, 'editpasswordadmin'])->name('editpasswordadmin');


        Route::get('/dashboard/book', [TbukuController::class, 'index']);
        Route::get('/dashboard/book/add', [TbukuController::class, 'create']);
        Route::post('/dashboard/book/add', [TbukuController::class, 'store']);
        Route::delete('/deletebook/{f_id}', [TbukuController::class, 'destroy'])->name('deletebook');
        Route::get('/dashboard/book/edit/{f_id}', [TbukuController::class, 'edit'])->name('editbook');
        Route::post('/dashboard/book/edit/{f_id}', [TbukuController::class, 'update'])->name('editbooks');


        Route::get('/dashboard/category', [TKategoriController::class, 'index']);
        Route::get('/dashboard/category/add', [TKategoriController::class, 'create']);
        Route::post('/dashboard/category/add', [TKategoriController::class, 'store']);
        Route::delete('/deletecategory/{f_id}', [TKategoriController::class, 'destroy'])->name('deletecategory');
        Route::get('/dashboard/category/edit/{f_id}', [TKategoriController::class, 'edit'])->name('editcategory');
        Route::post('/dashboard/category/edit/{f_id}', [TKategoriController::class, 'update']);
    });







    // ADMIN PUSTAKAWAN ONLY
    Route::middleware('AdminPustakawan')->group(function(){

        Route::get('/dashboard/rents', [TpeminjamanController::class, 'index']);
        Route::get('/dashboard/rents/add', [TpeminjamanController::class, 'create']);
        Route::post('/dashboard/rents/add', [TpeminjamanController::class, 'store'])->name('peminjaman.start');
        Route::get('/dashboard/rents/{f_id}', [TpeminjamanController::class, 'edit'])->name('peminjamaneditview');
        Route::post('/dashboard/rents/{f_id}', [TpeminjamanController::class, 'update'])->name('peminjamanedit');
        Route::put('/dashboard/rents/{id}', [TpeminjamanController::class, 'pengembalian'])->name('peminjaman.kembali');
        Route::delete('/dashboard/rents/delete{id}', [TpeminjamanController::class, 'hapuspengembalian'])->name('peminjaman.hapus');
        
        Route::get('/dashboard/return', [TpeminjamanController::class, 'indexreturn']);
        
        
        Route::get('/dashboard/pengembalian', [TpeminjamanController::class, 'getPengembalian']);
        Route::delete('/dashboard/pengembalian/delete', [TpeminjamanController::class, 'delete'])->name('deletedata');
        Route::get('/dashboard/pengembalian/report', [TpeminjamanController::class, 'report']);
    });
});
