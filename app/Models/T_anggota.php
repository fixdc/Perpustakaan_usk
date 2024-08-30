<?php

namespace App\Models;

use Illuminate\Database\DBAL\TimestampType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Foundation\Auth\T_anggota as Authenticatable;

class T_anggota extends Authenticatable
{
    use HasFactory;

    protected $primaryKey = 'f_id';
    
    protected $table = 't_anggota';

    protected $guarded = ['f_id'];

    public $timestamps = false; 


    public function getAuthPassword(){
        return $this->f_password;
    }

    public function tPeminjaman() {
        return $this->hasOne(T_peminjaman::class, 'f_idanggota');
    }
}
