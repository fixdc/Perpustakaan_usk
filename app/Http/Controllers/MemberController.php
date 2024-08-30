<?php

namespace App\Http\Controllers;

use App\Models\T_anggota;
use App\Models\T_peminjaman;
use App\Models\T_detailpeminjaman;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MemberController extends Controller
{
    public function view()
    {

        $anggota = T_anggota::all();

        return view('admin/user', [
            'anggota' => $anggota
        ]);
    }

    public function createview()
    {
        return view('admin/createuser');
    }

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'f_nama' => 'required|max:255',
            'f_username' => 'required|unique:t_anggota,f_username',
            'f_tempatlahir' => 'required',
            'f_tanggallahir' => 'required',
            'f_password' => 'required'
        ]);


        $validatedData['f_password'] = bcrypt($validatedData['f_password']);

        T_anggota::create($validatedData);

        return redirect('dashboard/members')->with('success', 'Berhasil menambahkan user');
    }

    public function delete($f_id){
        $anggota = T_anggota::where('f_id', $f_id)->first();
    
        $peminjaman = T_peminjaman::where('f_idanggota', $anggota->f_id)->first();
        if ($peminjaman) {
            return redirect('dashboard/members')->with('error','anggota sedang meminjam');
        }
    
        $anggota->delete();
        return redirect('dashboard/members')->with('delete', 'anggota Berhasil Dihapus');
    }

    public function editview(Request $request, $f_username)
    {

        $anggota = T_anggota::where('f_username', $f_username)->first();
        return view('admin/useredit', ['anggota' => $anggota]);
    }

    public function edit(Request $request, $f_username)
    {

        $anggota = T_anggota::where('f_username', $f_username)->first();

        $request->validate([
            'f_nama' => 'required',
            'f_username' => 'required|unique:t_anggota,f_username',
            'f_tempatlahir' => 'required',
            'f_tanggallahir' => 'required',
        ]);

        $anggota->f_nama = $request->f_nama;
        $anggota->f_username = $request->f_username;
        $anggota->f_tempatlahir = $request->f_tempatlahir;
        $anggota->f_tanggallahir = $request->f_tanggallahir;

        $anggota->save();

        return redirect('dashboard/members')->with('edit', 'Berhasil mengedit Kategori');
    }
    public function editpasswordview($f_username)
    {

        $anggota = T_anggota::where('f_username', $f_username)->first();

        return view('admin.edituserpassword', [
            'anggota' => $anggota,
        ]);
    }
    public function editpassword(Request $request, $f_username)
    {
        $user = T_anggota::where('f_username', $f_username)->first();

        $validated = $request->validate([
            'f_password' => 'required'
        ]);

        $validated['f_password'] = Hash::make($validated['f_password']);

        $user->update($validated);

        return redirect('/dashboard/members');
    }
}
