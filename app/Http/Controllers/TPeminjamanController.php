<?php

namespace App\Http\Controllers;

use App\Models\T_peminjaman;
use App\Models\T_detailpeminjaman;
use App\Models\T_anggota;
use App\Models\T_buku;
use App\Http\Requests\StoreT_peminjamanRequest;
use App\Http\Requests\UpdateT_peminjamanRequest;
use App\Models\T_admin;
use App\Models\T_detailbuku;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class TPeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $detailPeminjaman = T_detailpeminjaman::with('tPeminjaman', 'detailbuku')->where('f_tanggalkembali', null)->get();
        $anggota = T_anggota::all();
        $buku = T_buku::all();

        return view('admin/rent', [
            'detailPeminjaman' => $detailPeminjaman,
            'anggota' => $anggota,
            'buku' => $buku
        ]);
    }

    public function indexreturn()
    {
        $detailPeminjaman = T_detailpeminjaman::with('tPeminjaman', 'detailbuku')->where('f_tanggalkembali', null)->get();
        $anggota = T_anggota::all();
        $buku = T_buku::all();

        return view('admin/return', [
            'detailPeminjaman' => $detailPeminjaman,
            'anggota' => $anggota,
            'buku' => $buku
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // Ambil semua data anggota
        $anggota = T_anggota::all();
        $buku = T_buku::all();
        // dd($anggota, $buku);

        // Mengembalikan daftar anggota ke view 'admin.createrent'
        return view('admin.createrent', [
            'anggota' => $anggota,
            'buku' => $buku,
        ]);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $buku = T_detailbuku::find($request->buku);

        if ($buku->f_status == "Tidak Tersedia") {
            return redirect()->back()->with('error', 'Buku tidak tersedia!');
        }

        $buku->f_stok -= 1;

        if ($buku->f_stok == 0) {
            $buku->f_status = 'Tidak Tersedia';
        }

        $buku->save();

        $peminjaman = new T_peminjaman();
        $peminjaman->f_idadmin = Auth::guard('admin')->user()->f_id;
        $peminjaman->f_idanggota = $request->anggota;
        $peminjaman->f_tanggalpeminjaman = $request->f_tanggalpeminjaman;
        $peminjaman->save();

        $detailPeminjaman = new T_detailpeminjaman();
        $detailPeminjaman->f_idpeminjaman = $peminjaman->f_id;
        $detailPeminjaman->f_iddetailbuku = $request->buku;
        $detailPeminjaman->f_tanggalkembali = null;
        $detailPeminjaman->save();

        return redirect()->back()->with('success', 'Peminjaman Telah Aktif');
    }


    public function pengembalian($id)
    {
        $detailPeminjaman = T_detailpeminjaman::findOrFail($id);

        if ($detailPeminjaman) {
            $detailPeminjaman->f_tanggalkembali = Carbon::now()->toDateString();
            $detailPeminjaman->save();

            $detailBuku = $detailPeminjaman->detailbuku;

            $detailBuku->f_stok += 1;

            if ($detailBuku->f_stok > 0) {
                $detailBuku->f_status = 'Tersedia';
            }

            $detailBuku->save();

            return redirect()->back()->with('success', 'PEMINJAMAN TELAH SELESAI!');
        } else {
            return redirect()->back()->with('error', 'PEMINJAMAN TIDAK VALID!');
        }
    }





    // PENGEMBALIAN
    public function getPengembalian()
    {
        // ->where('f_tanggalkembali', '!=', null)
        $pengembalian = T_detailpeminjaman::with('tPeminjaman', 'detailbuku')->get();
        return view('admin.pengembalian', compact('pengembalian'));
    }
    public function report()
    {
        $pengembalian = T_detailpeminjaman::with('tPeminjaman', 'detailbuku')->get();

        $pdf = Pdf::loadview('admin.pdf', ['pengembalian' => $pengembalian]);
        return $pdf->download('laporan-peminjaman.pdf');
    }

    public function delete()
    {
        T_detailpeminjaman::whereNotNull('f_tanggalkembali')->delete();

        return redirect()->back()->with('success', 'semua data sudah di hapus');
    }
    public function hapuspengembalian($id)
    {
        T_peminjaman::where('f_id', $id)->delete();

        return redirect()->back()->with('delete', 'semua data sudah di hapus');
    }








    public function book()
    {
        if (Auth::guard('web')->check()) {
            $userid = auth()->guard('web')->user()->f_id;

            $pengembalian = T_detailpeminjaman::whereHas('tPeminjaman', function ($query) use ($userid) {
                $query->where('f_idanggota', $userid);
            })
                ->paginate(5);
        } elseif (Auth::guard('admin')->check()) {
            $userid = auth()->guard('admin')->user()->f_id;

            $pengembalian = T_detailpeminjaman::whereHas('tPeminjaman', function ($query) use ($userid) {
                $query->where('f_idadmin', $userid);
            })
                ->get();
        }

        $books = T_buku::paginate(5);

        return view('homepage.book', compact('pengembalian', 'books'));
    }
    public function riwayat()
    {
        if (Auth::guard('web')->check()) {
            $userid = auth()->guard('web')->user()->f_id;

            $pengembalian = T_detailpeminjaman::whereHas('tPeminjaman', function ($query) use ($userid) {
                $query->where('f_idanggota', $userid);
            })
                ->paginate(5);

            return view('homepage.riwayat', compact('pengembalian'));
        }
    }


    public function edit($f_id)
    {
        $detailPeminjaman = T_detailPeminjaman::where('f_id', $f_id)->first();
        $anggota = T_anggota::all();
        $buku = T_detailbuku::where('f_status', 'Tersedia')->get();
        $admin = T_admin::all();
        return view('admin/rentedit', [
            'detailPeminjaman' => $detailPeminjaman,
            'anggota' => $anggota,
            'buku' => $buku,
            'admin' => $admin,
        ]);
    }

    public function update(Request $request, $f_id)
    {
        $peminjaman = T_detailPeminjaman::where('f_id', $f_id)->first();

        $validated = $request->validate([
            'f_idanggota' => 'required|exists:t_anggota,f_id'
        ]);

        $validatedDetail = $request->validate([
            'f_iddetailbuku' => 'required'
        ]);

        $peminjaman->update($validatedDetail);

        $peminjaman->peminjaman->update($validated);

        return redirect('dashboard/rents')->with('berhasil', 'Berhasil edit peminjaman');
    }
}
