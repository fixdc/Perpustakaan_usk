<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class T_peminjaman extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 't_peminjaman';

    protected $primaryKey = 'f_id';


    public function detailpeminjaman() {
        return $this->hasOne(T_detailpeminjaman::class, 'f_idpeminjaman');
    }

    public function admin() {
        return $this->belongsTo(T_admin::class, 'f_idadmin');
    }

    public function anggota() {
        return $this->belongsTo(T_anggota::class, 'f_idanggota');
    }








    // public function detail()
    // {
    //     return $this->hasOne(T_detailpeminjaman::class, 'f_idpeminjaman');
    // }
    // public function admin()
    // {
    //     return $this->belongsTo(T_admin::class, 'f_idadmin', 'f_id');
    // }
    // public function anggota()
    // {
    //     return $this->belongsTo(T_anggota::class, 'f_idanggota');
    // }
}
