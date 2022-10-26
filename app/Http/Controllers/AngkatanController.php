<?php

namespace App\Http\Controllers;

use App\Http\Requests\Angkatan\CreateAngkatanRequest;
use App\Http\Requests\Angkatan\UpdateAngkatanRequest;
use App\Models\Angkatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AngkatanController extends Controller
{
    public function __construct()
    {
        $this->middleware('isAdmin');
    }

    public function index()
    {
        $angkatan = Angkatan::get();
        $title = 'Data Angkatan';

        return view('angkatan.index', compact('title', 'angkatan'));
    }

    public function create()
    {
        $angkatan = new Angkatan();
        $title = 'Tambah Angkatan';
        $action = route('angkatan.store');
        $method = 'POST';

        return view('angkatan.form', compact('angkatan', 'title', 'action', 'method'));
    }

    public function store(CreateAngkatanRequest $createAngkatanRequest)
    {
        try {
            DB::beginTransaction();

            Angkatan::create($createAngkatanRequest->all());

            DB::commit();

            return redirect()->route('angkatan.index')->with('success', 'Angkatan berhasil ditambahkan');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }

    public function show(Angkatan $angkatan)
    {
        return view('angkatan.show', compact('angkatan'));
    }

    public function edit(Angkatan $angkatan)
    {
        $title = 'Edit Angkatan';
        $action = route('angkatan.update', $angkatan->id);
        $method = 'PUT';

        return view('angkatan.form', compact('angkatan', 'title', 'action', 'method'));
    }

    public function update(UpdateAngkatanRequest $updateAngkatanRequest, Angkatan $Angkatan)
    {
        try {
            DB::beginTransaction();

            $Angkatan->update($updateAngkatanRequest->all());

            DB::commit();

            return redirect()->route('angkatan.index')->with('success', 'Angkatan berhasil diubah');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }

    public function destroy(Angkatan $angkatan)
    {
        try {
            DB::beginTransaction();

            if ($angkatan->siswa()->count() > 0) {
                return back()->with('error', 'Data angkatan memiliki siswa');
            } else {
                $angkatan->delete();
            }

            DB::commit();

            return redirect()->route('angkatan.index')->with('success', 'Angkatan berhasil dihapus');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }
}
