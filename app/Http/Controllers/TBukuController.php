<?php

namespace App\Http\Controllers;

use App\Models\T_buku;
use App\Http\Requests\StoreT_bukuRequest;
use App\Http\Requests\UpdateT_bukuRequest;
use App\Models\T_detailbuku;
use App\Models\T_detailpeminjaman;
use App\Models\T_peminjaman;
use App\Models\T_kategori;
use Database\Factories\TPeminjamanFactory;
use Illuminate\Http\Request;

class TBukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $buku = T_buku::with('kategori', 'detailbuku')->get();

        return view('admin/bookdata', [
            'buku' => $buku
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategori = T_kategori::all();

        return view('admin/createbook', [
            'kategori' => $kategori
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     $validatedData = $request->validate([
    //         'f_judul' => 'required|unique:t_buku,f_judul',
    //         'f_pengarang' => 'required',
    //         'f_penerbit' => 'required',
    //         'f_deskripsi' => 'required',
    //         'f_idkategori' => 'required',
    //         'f_stok' => 'required',
    //         'f_status' => 'required'
    //     ]);


    //     $buku = T_buku::create($validatedData);


    //     $status = new T_detailbuku();
    //     $status->f_idbuku = $buku->f_id;
    //     $status->f_status = $validatedData['f_status'];
    //     $status->f_stok = $validatedData['f_stok'];
    //     $status->save();

    //     return redirect('dashboard/book')->with('Success', 'Berhasil Menambahkan buku');
    // }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'f_judul' => 'required|unique:t_buku,f_judul',
            'f_pengarang' => 'required',
            'f_penerbit' => 'required',
            'f_deskripsi' => 'required',
            'f_idkategori' => 'required',
            'f_stok' => 'required|integer|min:0',
            'f_status' => 'required'
        ]);

        // If stok is 0, set f_status to 'Tidak Tersedia'
        if ($validatedData['f_stok'] == 0) {
            $validatedData['f_status'] = 'Tidak Tersedia';
        }

        // Create T_buku entry
        $buku = T_buku::create($validatedData);

        // Create T_detailbuku entry
        $status = new T_detailbuku();
        $status->f_idbuku = $buku->f_id;
        $status->f_status = $validatedData['f_status'];
        $status->f_stok = $validatedData['f_stok'];
        $status->save();

        return redirect('dashboard/book')->with('Success', 'Berhasil Menambahkan buku');
    }

    /**
     * Display the specified resource.
     */


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($f_id)
    {
        $buku = T_buku::where('f_id', $f_id)->with('kategori')->first();
        $kategori = T_kategori::all();
        return view('admin/editbook', ['buku' => $buku, 'kategori' => $kategori]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $f_id)
    {
        $buku = T_buku::findOrFail($f_id);

        $request->validate([
            'f_judul' => 'required|unique:t_buku,f_judul,' . $f_id . ',f_id',
            'f_idkategori' => 'required',
            'f_pengarang' => 'required',
            'f_penerbit' => 'required',
            'f_deskripsi' => 'required',
            'f_status' => 'required|in:Tersedia,Tidak Tersedia',
            'f_stok' => 'required|integer|min:0',
        ]);

        $buku->update([
            'f_judul' => $request->f_judul,
            'f_idkategori' => $request->f_idkategori,
            'f_pengarang' => $request->f_pengarang,
            'f_penerbit' => $request->f_penerbit,
            'f_deskripsi' => $request->f_deskripsi,
        ]);

        $detailBuku = T_detailbuku::where('f_idbuku', $f_id)->first();

        if (!$detailBuku) {
            $detailBuku = new T_detailbuku();
            $detailBuku->f_idbuku = $f_id;
        }

        $detailBuku->f_status = $request->f_status;
        $detailBuku->f_stok = $request->f_stok;
        $detailBuku->save();

        return redirect('dashboard/book')->with('edit', 'Berhasil mengedit buku');
    }



    public function destroy($f_id)
    {

        $buku = T_buku::where('f_id', $f_id)->first();
        $detailBuku = T_detailBuku::where('f_idbuku', $buku->f_id)->first();

        $peminjaman = T_detailpeminjaman::where('f_iddetailbuku', $detailBuku->f_id)->first();
        if ($peminjaman) {
            return redirect('dashboard/book')->with('error', 'Buku sedang dipinjam');
        }

        $buku->delete();
        return redirect('dashboard/book')->with('delete', 'Buku Berhasil Dihapus');
    }
}
