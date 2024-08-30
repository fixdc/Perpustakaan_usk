<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Carbon\Carbon;
use App\Models\T_admin;
use App\Models\T_anggota;
use App\Models\T_buku;
use App\Models\T_detailbuku;
use App\Models\T_kategori;
use App\Models\T_peminjaman;
use App\Models\T_detailpeminjaman;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
{
    T_anggota::create([
        "f_nama" => 'Fikri Aidhil Setiansyah',
        "f_username" => 'Fikri',
        "f_password" => Hash::make('user'),
        "f_tempatlahir" => 'Jakarta',
        "f_tanggallahir" => Carbon::createFromFormat('Y-m-d','2006-03-13')
    ]);
    T_anggota::create([
        "f_nama" => 'Fathul Bari',
        "f_username" => 'fbari',
        "f_password" => Hash::make('user'),
        "f_tempatlahir" => 'Jakarta',
        "f_tanggallahir" => Carbon::createFromFormat('Y-m-d','2006-03-13')
    ]);
    T_anggota::create([
        "f_nama" => 'M Revikhasa F P',
        "f_username" => 'revi',
        "f_password" => Hash::make('user'),
        "f_tempatlahir" => 'Jakarta',
        "f_tanggallahir" => Carbon::createFromFormat('Y-m-d','2006-03-13')
    ]);

    T_admin::create([
        "f_nama" => 'Admin 1',
        "f_username" => 'Admin',
        "f_password" => Hash::make('admin'),
        "f_level" => 'Admin',
        "f_status" => 'Aktif',
    ]);
    T_anggota::create([
        "f_nama" => 'Achmad Surya Saputra',
        "f_username" => 'surya',
        "f_password" => Hash::make('user'),
        "f_tempatlahir" => 'Jakarta',
        "f_tanggallahir" => Carbon::createFromFormat('Y-m-d','2006-03-13')
    ]);

    T_admin::create([
        "f_nama" => 'Pustakawan',
        "f_username" => 'Pustakawan',
        "f_password" => Hash::make('pustakawan'),
        "f_level" => 'Pustakawan',
        "f_status" => 'Aktif',
    ]);
    
    T_kategori::create([
        'f_kategori' => 'Pelajaran'
    ]);
    T_kategori::create([
        'f_kategori' => 'Novel'
    ]);
    T_kategori::create([
        'f_kategori' => 'Fiksi'
    ]);
    T_kategori::create([
        'f_kategori' => 'Non Fiksi'
    ]);
    T_kategori::create([
        'f_kategori' => 'Cerpen'
    ]);
    
    T_buku::create([
        'f_idkategori' => 1,
        'f_judul' => 'Buku Matematika',
        'f_pengarang' => 'Ibu Syifa',
        'f_penerbit' => 'Gramedia',
        'f_deskripsi' => 'Buku pelajaran matematika',
    ]);
    T_buku::create([
        'f_idkategori' => 2,
        'f_judul' => 'Hello World',
        'f_pengarang' => 'Programmer',
        'f_penerbit' => 'Gramedia',
        'f_deskripsi' => 'Buku Coding',
    ]);

    T_detailbuku::create([
        'f_idbuku' => 1,
        'f_stok' => 3,
        'f_status' => 'Tersedia'
    ]);
    T_detailbuku::create([
        'f_idbuku' => 2,
        'f_stok' => 5,
        'f_status' => 'Tersedia'
    ]);

    T_peminjaman::create([
        'f_idadmin' => 1,
        'f_idanggota' => 1,
        'f_tanggalpeminjaman' => Carbon::createFromFormat('Y-m-d', '2024-24-3'),
    ]);
    T_peminjaman::create([
        'f_idadmin' => 1,
        'f_idanggota' => 1,
        'f_tanggalpeminjaman' => Carbon::createFromFormat('Y-m-d', '2024-24-3'),
    ]);
    T_detailpeminjaman::create([
        'f_idpeminjaman' => 1,
        'f_iddetailbuku' => 1,
        'f_tanggalkembali' => Carbon::createFromFormat('Y-m-d', '2024-24-4'),
    ]);
    T_detailpeminjaman::create([
        'f_idpeminjaman' => 1,
        'f_iddetailbuku' => 1,
        'f_tanggalkembali' => Carbon::createFromFormat('Y-m-d', '2024-24-4'),
    ]);
}
}
