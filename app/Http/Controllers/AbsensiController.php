<?php

namespace App\Http\Controllers;

use App\Exports\AbsensiExport;
use App\Models\Absensi;
use App\Models\Angkatan;
use App\Models\Jurusan;
use App\Models\Siswa;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class AbsensiController extends Controller
{
    public function index(Request $request)
    {
        $angkatan = Angkatan::get();
        $jurusan = Jurusan::get();

        $date = Carbon::now('Asia/Jakarta')->format('Y-m-d');
        $absensi = Absensi::where('tanggal', $date)->latest()->get();
        $title = 'Data Absensi Siswa - ' . Carbon::now('Asia/Jakarta')->format('d/m/Y');

        if ($request->tanggal && $request->angkatan == 'all' || $request->jurusan == 'all') {
            $mulai = Carbon::parse(explode('-', $request->tanggal)[0])->format('Y-m-d');
            $sampai = Carbon::parse(explode('-', $request->tanggal)[1])->addDay(1)->format('Y-m-d');

            $absensi = Absensi::whereBetween('tanggal', [$mulai, $sampai])->latest()->get();

            $title = 'Data Absensi Siswa - ' . $request->tanggal;
        }

        if ($request->tanggal && $request->angkatan != '' && $request->angkatan != 'all' || $request->jurusan != '' && $request->jurusan != 'all') {
            $mulai = Carbon::parse(explode('-', $request->tanggal)[0])->format('Y-m-d');
            $sampai = Carbon::parse(explode('-', $request->tanggal)[1])->addDay(1)->format('Y-m-d');
            $angkatanid = $request->angkatan;
            $jurusanid = $request->jurusan;

            $absensi = Absensi::whereBetween('tanggal', [$mulai, $sampai])->whereHas('siswa', function ($q) use ($angkatanid, $jurusanid) {
                $q->where('angkatan_id', $angkatanid)->orWhere('jurusan_id', $jurusanid);
            })->latest()->get();

            $title = 'Data Absensi Siswa - ' . $request->tanggal;
        }

        return view('absensi.index', compact('absensi', 'title', 'angkatan', 'jurusan'));
    }

    public function export(Request $request)
    {
        if ($request->tanggal && $request->angkatan == 'all' || $request->jurusan == 'all') {
            $mulai = Carbon::parse(explode('-', $request->tanggal)[0])->format('Y-m-d');
            $sampai = Carbon::parse(explode('-', $request->tanggal)[1])->addDay(1)->format('Y-m-d');

            $absensi = Absensi::whereBetween('tanggal', [$mulai, $sampai])->groupBy('tanggal')->groupBy('siswa_id')->latest()->get();

            $title = 'Data Absensi Siswa - ' . $mulai . '-' . $sampai;
        }

        if ($request->tanggal && $request->angkatan != '' && $request->angkatan != 'all' || $request->jurusan != '' && $request->jurusan != 'all') {
            $mulai = Carbon::parse(explode('-', $request->tanggal)[0])->format('Y-m-d');
            $sampai = Carbon::parse(explode('-', $request->tanggal)[1])->addDay(1)->format('Y-m-d');
            $angkatanid = $request->angkatan;
            $jurusanid = $request->jurusan;

            $absensi = Absensi::whereBetween('tanggal', [$mulai, $sampai])->whereHas('siswa', function ($q) use ($angkatanid, $jurusanid) {
                $q->where('angkatan_id', $angkatanid)->orWhere('jurusan_id', $jurusanid);
            })->groupBy('tanggal')->groupBy('siswa_id')->latest()->get();

            $title = 'Data Absensi Siswa - ' . $mulai . '-' . $sampai;
        }

        return \Excel::download(new AbsensiExport($absensi, $title), $title . '.xlsx');
    }

    public function rekap(Request $request)
    {
        $angkatan = Angkatan::get();
        $jurusan = Jurusan::get();

        $date = Carbon::now('Asia/Jakarta');
        $absensi = Absensi::whereMonth('tanggal', $date->format('m'))->whereYear('tanggal', $date->format('Y'))->latest()->get();
        $siswa = Siswa::where('status', 1)->get();

        $title = 'Rekap Absensi Siswa - ' . Carbon::now('Asia/Jakarta')->format('F Y');

        $bulan = $date->format('m');
        $year = $date->format('Y');

        if ($request->bulan) {
            $year = explode('-', $request->bulan)[0];
            $bulan = explode('-', $request->bulan)[1];

            $title = 'Rekap Absensi Siswa - ' . Carbon::create()->month($bulan)->format('F') . ' ' . Carbon::create()->year($year)->format('Y');
        }

        return view('absensi.rekap', compact('bulan', 'year', 'title', 'angkatan', 'jurusan', 'siswa'));
    }
}
