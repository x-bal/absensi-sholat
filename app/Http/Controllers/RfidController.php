<?php

namespace App\Http\Controllers;

use App\Http\Requests\Rfid\CreateRfidRequest;
use App\Http\Requests\Rfid\UpdateRfidRequest;
use App\Models\Angkatan;
use App\Models\Jurusan;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RfidController extends Controller
{

    public function index()
    {
        $rfid = Siswa::where('status', 0)->get();
        $title = 'Data Rfid';

        return view('rfid.index', compact('title', 'rfid'));
    }

    public function store(CreateRfidRequest $createRfidRequest)
    {
        try {
            DB::beginTransaction();

            Siswa::create($createRfidRequest->all());

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Rfid berhasil ditambahkan'
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'status' => 'failed',
                'message' => $th->getMessage()
            ]);
        }
    }

    public function edit(Siswa $rfid)
    {
        $title = 'Edit Rfid';
        $action = route('rfid.update', $rfid->id);
        $method = 'PUT';
        $angkatan = Angkatan::get();
        $jurusan = Jurusan::get();

        return view('rfid.form', compact('rfid', 'title', 'action', 'method', 'angkatan', 'jurusan'));
    }

    public function update(UpdateRfidRequest $updateRfidRequest, Siswa $rfid)
    {
        try {
            DB::beginTransaction();

            $attr = $updateRfidRequest->except('angkatan', 'jurusan');

            $foto = $updateRfidRequest->file('foto');
            $fotoUrl = $foto->storeAs('siswa', Str::slug($updateRfidRequest->nama_siswa) . '-' . Str::random(5) . '.' . $foto->extension());

            $attr['angkatan_id'] = $updateRfidRequest->angkatan;
            $attr['jurusan_id'] = $updateRfidRequest->jurusan;
            $attr['foto'] = $fotoUrl;
            $attr['status'] = 1;

            $rfid->update($attr);

            DB::commit();

            return redirect()->route('rfid.index')->with('success', 'Rfid berhasil ditambahkan ke siswa');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }

    public function destroy(Siswa $rfid)
    {
        try {
            DB::beginTransaction();

            $rfid->delete();

            DB::commit();

            return redirect()->route('rfid.index')->with('success', 'Rfid berhasil dihapus');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }
}
