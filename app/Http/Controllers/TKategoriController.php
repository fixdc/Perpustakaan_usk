<?php

namespace App\Http\Controllers;

use App\Models\T_buku;
use App\Models\T_detailbuku;
use App\Models\T_detailpeminjaman;
use App\Models\T_peminjaman;
use App\Http\Requests\StoreT_bukuRequest;
use App\Http\Requests\UpdateT_bukuRequest;
use App\Models\T_kategori;
use Illuminate\Http\Request;

class TkategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $kategori = T_kategori::all();
    
    return view('admin/categorydata', [
        'kategori' => $kategori,
    ]);
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategori = T_kategori::all();

        return view('admin/createcategory', [
            'kategori' => $kategori
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'f_kategori' => 'required|unique:t_kategori,f_kategori',
        ]);
        T_kategori::create($validatedData);

        return redirect('dashboard/category')->with('Success', 'Berhasil Menambahkan buku');
    }

  
    
    public function edit($f_id)
    {
        $kategori =T_kategori::where('f_id', $f_id)->first();
        return view('admin/editcategory', ['kategori'=> $kategori]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $f_id)
    {
        $kategori = T_kategori::where('f_id', $f_id)->first();

        $request->validate([
            'f_kategori' => 'required|unique:t_kategori,f_kategori',            
        ]);

        $kategori->f_kategori = $request->f_kategori;

        $kategori->save();

        return redirect('dashboard/category')->with('edit', 'berhasil mengedit buku');
    }

    
    public function destroy($f_id)
{
    $kategori = T_kategori::findOrFail($f_id);

    if (T_Buku::where('f_idkategori', $kategori->f_id)->exists()) {
        return redirect('dashboard/category')->with('error', 'Kategori ini memiliki buku terkait. Anda tidak dapat menghapusnya.');
    }

    $kategori->delete();

    return redirect('dashboard/category')->with('delete', 'Category and related records deleted successfully.');
}
}
