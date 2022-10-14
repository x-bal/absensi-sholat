<?php

namespace App\Http\Controllers;

use App\Http\Requests\Jadwal\CreateJadwalRequest;
use App\Http\Requests\Jadwal\UpdateJadwalRequest;
use App\Models\Jadwal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JadwalController extends Controller
{
    public function __construct()
    {
        $this->middleware('isAdmin');
    }

    public function index()
    {
        $jadwal = Jadwal::get();
        $title = 'Data Jadwal';

        return view('jadwal.index', compact('title', 'jadwal'));
    }

    public function create()
    {
        $jadwal = new Jadwal();
        $title = 'Tambah Jadwal';
        $action = route('jadwal.store');
        $method = 'POST';

        return view('jadwal.form', compact('jadwal', 'title', 'action', 'method'));
    }

    public function store(CreateJadwalRequest $createJadwalRequest)
    {
        try {
            DB::beginTransaction();

            Jadwal::create($createJadwalRequest->all());

            DB::commit();

            return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil ditambahkan');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }

    public function show(Jadwal $jadwal)
    {
        if (request('status') == 1) {
            $jadwal->update(['status' => 0]);
            $msg = 'nonaktifkan';
        } else {
            $jadwal->update(['status' => 1]);
            $msg = 'aktifkan';
        }

        return response()->json([
            'status' => 'success',
            'message' => back()->with('success', 'Jadwal berhasil di ' . $msg)
        ]);
    }

    public function edit(Jadwal $jadwal)
    {
        $title = 'Edit Jadwal';
        $action = route('jadwal.update', $jadwal->id);
        $method = 'PUT';

        return view('jadwal.form', compact('jadwal', 'title', 'action', 'method'));
    }

    public function update(UpdateJadwalRequest $updateJadwalRequest, Jadwal $jadwal)
    {
        try {
            DB::beginTransaction();

            $jadwal->update($updateJadwalRequest->all());

            DB::commit();

            return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil diubah');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }

    public function destroy(Jadwal $jadwal)
    {
        try {
            DB::beginTransaction();

            $jadwal->delete();

            DB::commit();

            return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil dihapus');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }
}
