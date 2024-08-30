<?php

namespace App\Http\Controllers;

use App\Models\T_admin;
use App\Models\T_anggota;
use App\Models\T_peminjaman;
use App\Models\T_detailpeminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function view()
    {
        $admin = T_admin::all();

        return view('admin/pustakawan', [
            'admin' => $admin
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin/createpustakawan');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'f_nama' => 'required|max:255',
            'f_username' => 'required|unique:t_admin,f_username',
            'f_level' => 'required',
            'f_status' => 'required',
            'f_password' => 'required'
        ]);

        // Menggunakan bcrypt() untuk mengenkripsi password sebelum menyimpannya
        $validatedData['f_password'] = bcrypt($validatedData['f_password']);

        T_admin::create($validatedData);

        return redirect('dashboard/pustakawan')->with('success', 'Berhasil menambahkan user');
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit($f_username)
    {
        $admin = T_admin::where('f_username', $f_username)->first();
        return view('admin/pustakawanedit', ['admin' => $admin]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $f_username)
    {
        $admin = T_admin::where('f_username', $f_username)->first();

        $request->validate([
            'f_nama' => 'required',
            'f_username' => 'required|unique:t_admin,f_username',
            'f_level' => 'required',
            'f_status' => 'required',
        ]);

        $admin->f_nama = $request->f_nama;
        $admin->f_username = $request->f_username;
        $admin->f_level = $request->f_level;
        $admin->f_status = $request->f_status;

        $admin->save();

        return redirect('dashboard/pustakawan')->with('edit', 'Berhasil mengedit Kategori');
    }

    


    // public function destroy($f_username)
    // {
    //     $admin = T_admin::where('f_username', $f_username)->first();
        
    //     $admin->delete();

    //     return redirect('dashboard/pustakawan')->with('delete', 'User deleted successfully.');
    // }


    public function destroy($f_id){
        $admin = T_admin::where('f_id', $f_id)->first();
    
        $peminjaman = T_peminjaman::where('f_idadmin', $admin->f_id)->first();
        if ($peminjaman) {
            return redirect('dashboard/pustakawan')->with('error','Admin sedang meminjam');
        }
    
        $admin->delete();
        return redirect('dashboard/pustakawan')->with('delete', 'Admin Berhasil Dihapus');
    }

    public function editpasswordviewadmin($f_username)
    {

        $admin = T_admin::where('f_username', $f_username)->first();

        return view('admin.edituserpasswordadmin', [
            'admin' => $admin,
        ]);
    }
    public function editpasswordadmin(Request $request, $f_username)
    {
        $user = T_admin::where('f_username', $f_username)->first();

        $validated = $request->validate([
            'f_password' => 'required'
        ]);

        $validated['f_password'] = Hash::make($validated['f_password']);

        $user->update($validated);

        return redirect('/dashboard/pustakawan');
    }
}
