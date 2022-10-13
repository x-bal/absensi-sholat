<?php

namespace App\Http\Controllers;

use App\Http\Requests\Siswa\UpdateSiswaRequest;
use App\Models\Angkatan;
use App\Models\Jurusan;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SiswaController extends Controller
{
    public function index()
    {
        $siswa = Siswa::where('status', 1)->get();
        $title = 'Data Siswa';

        return view('siswa.index', compact('siswa', 'title'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Siswa $siswa)
    {
        //
    }

    public function edit(Siswa $siswa)
    {
        $title = 'Edit Siswa';
        $action = route('siswa.update', $siswa->id);
        $method = 'PUT';
        $angkatan = Angkatan::get();
        $jurusan = Jurusan::get();

        return view('siswa.form', compact('siswa', 'title', 'action', 'method', 'angkatan', 'jurusan'));
    }

    public function update(UpdateSiswaRequest $updateSiswaRequest, Siswa $siswa)
    {
        try {
            DB::beginTransaction();

            $attr = $updateSiswaRequest->except('angkatan', 'jurusan');

            if ($updateSiswaRequest->file('foto')) {
                Storage::delete($siswa->foto);
                $foto = $updateSiswaRequest->file('foto');
                $fotoUrl = $foto->storeAs('siswa', Str::slug($updateSiswaRequest->nama_siswa) . '-' . Str::random(5) . '.' . $foto->extension());
            } else {
                $fotoUrl = $siswa->foto;
            }

            $attr['angkatan_id'] = $updateSiswaRequest->angkatan;
            $attr['jurusan_id'] = $updateSiswaRequest->jurusan;
            $attr['foto'] = $fotoUrl;

            $siswa->update($attr);

            DB::commit();

            return redirect()->route('siswa.index')->with('success', 'Siswa berhasil diubah');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }

    public function destroy(Siswa $siswa)
    {
        try {
            DB::beginTransaction();

            Storage::delete($siswa->foto);
            $siswa->delete();

            DB::commit();

            return redirect()->route('siswa.index')->with('success', 'Siswa berhasil diubah');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }
}
