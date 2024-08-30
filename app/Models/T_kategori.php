<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class T_kategori extends Model
{
    use HasFactory;
    protected $guarded = ['f_id'];

    protected $table = 't_kategori';

    public $timestamps = false; 

    protected $primaryKey = 'f_id';
    

}
