<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class T_detailpeminjaman extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 't_detailpeminjaman';
    protected $primaryKey = 'f_id';



    public function tPeminjaman() {
        return $this->belongsTo(T_peminjaman::class, 'f_idpeminjaman');
    }

    public function detailbuku() {
        return $this->belongsTo(T_detailbuku::class, 'f_iddetailbuku');
    }





    // public function tPeminjaman() {
    //     return $this->belongsTo(T_peminjaman::class, 'f_idpeminjaman');
    // }
    // public function tPeminjaman()
    // {
    //     return $this->belongsTo(T_detailbuku::class, 'f_iddetailbuku', 'f_id');
    // }
    // public function peminjaman()
    // {
    //     return $this->belongsTo(T_detailbuku::class, 'f_iddetailbuku', 'f_id');
    // }
    // public function detail()
    // {
    //     return $this->belongsTo(T_peminjaman::class, 'f_idpeminjaman', 'f_id');
    // }
}
