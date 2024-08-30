<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\T_anggota;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TAnggotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        T_anggota::create([
            "f_id" => '1',
            "f_nama" => 'anonymous',
            "f_username" => 'anonymous',
            "f_password" => Hash::make('anonymous'),
            "f_tempatlahir" => 'Jakarta',
            "f_tanggallahir" => Carbon::createFromFormat('Y-m-d','2006-03-13'),
        ]);

        T_anggota::create([
            "f_id" => '1',
            "f_nama" => 'anonymous',
            "f_username" => 'anonymous',
            "f_password" => Hash::make('anonymous'),
            "f_tempatlahir" => 'Jakarta',
            "f_tanggallahir" => Carbon::createFromFormat('Y-m-d','2006-03-13'),
        ]);
    }
}
