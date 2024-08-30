<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class T_detailbuku extends Model
{
    use HasFactory;
    
    public $timestamps = false;

    protected $table = 't_detailbuku';


    protected $primaryKey = 'f_id'; // Perbaikan di sini
    
    public function buku()
    {
        return $this->belongsTo(T_buku::class, 'f_idbuku', 'f_id');
    }

    public function detailpeminjaman() {
        return $this->belongsTo(T_detailpeminjaman::class, 'f_iddetailbuku');
    }
}
