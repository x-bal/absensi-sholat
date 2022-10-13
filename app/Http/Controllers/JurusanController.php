<?php

namespace App\Http\Controllers;

use App\Http\Requests\Jurusan\CreateJurusanRequest;
use App\Http\Requests\Jurusan\UpdateJurusanRequest;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JurusanController extends Controller
{

    public function index()
    {
        $jurusan = Jurusan::get();
        $title = 'Data Jurusan';

        return view('jurusan.index', compact('title', 'jurusan'));
    }

    public function create()
    {
        $jurusan = new Jurusan();
        $title = 'Tambah Jurusan';
        $action = route('jurusan.store');
        $method = 'POST';

        return view('jurusan.form', compact('jurusan', 'title', 'action', 'method'));
    }

    public function store(CreateJurusanRequest $createJurusanRequest)
    {
        try {
            DB::beginTransaction();

            Jurusan::create($createJurusanRequest->all());

            DB::commit();

            return redirect()->route('jurusan.index')->with('success', 'Jurusan berhasil ditambahkan');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }

    public function show(Jurusan $jurusan)
    {
        return view('jurusan.show', compact('jurusan'));
    }

    public function edit(Jurusan $jurusan)
    {
        $title = 'Edit Jurusan';
        $action = route('jurusan.update', $jurusan->id);
        $method = 'PUT';

        return view('jurusan.form', compact('jurusan', 'title', 'action', 'method'));
    }

    public function update(UpdateJurusanRequest $updateJurusanRequest, Jurusan $jurusan)
    {
        try {
            DB::beginTransaction();

            $jurusan->update($updateJurusanRequest->all());

            DB::commit();

            return redirect()->route('jurusan.index')->with('success', 'Jurusan berhasil diubah');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }

    public function destroy(Jurusan $jurusan)
    {
        try {
            DB::beginTransaction();

            if ($jurusan->siswa()->count() > 0) {
                return back()->with('error', 'Data jurusan memiliki siswa');
            } else {
                $jurusan->delete();
            }

            DB::commit();

            return redirect()->route('jurusan.index')->with('success', 'Jurusan berhasil dihapus');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }
}
