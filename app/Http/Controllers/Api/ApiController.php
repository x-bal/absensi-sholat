<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\Device;
use App\Models\History;
use App\Models\Jadwal;
use App\Models\Siswa;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    public function getmode()
    {
        if (request('iddev')) {
            $device = Device::where('iddev', request('iddev'))->first();

            if ($device) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Mode device berhasil didapatkan',
                    'mode' => $device->mode
                ]);
            } else {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Device tidak ditemukan',
                ]);
            }
        } else {
            return response()->json([
                'status' => 'failed',
                'message' => 'Salah Parameter',
            ]);
        }
    }

    public function addcard()
    {
        if (request('iddev') && request('uid')) {
            $device = Device::where('iddev', request('iddev'))->first();

            if ($device) {
                $uid = Siswa::where('uid', request('uid'))->first();

                if ($uid) {
                    return response()->json([
                        'status' => 'failed',
                        'message' => 'Uid sudah terdaftar'
                    ]);
                } else {
                    try {
                        DB::beginTransaction();

                        Siswa::create([
                            'uid' => request('uid')
                        ]);

                        History::create([
                            'device_id' => $device->id,
                            'keterangan' => 'Add new card'
                        ]);

                        DB::commit();

                        return response()->json([
                            'status' => 'success',
                            'message' => 'Card berhasil ditambahkan'
                        ]);
                    } catch (\Throwable $th) {
                        return response()->json([
                            'status' => 'failed',
                            'message' => $th->getMessage()
                        ]);
                    }
                }
            } else {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Device tidak ditemukan'
                ]);
            }
        } else {
            return response()->json([
                'status' => 'failed',
                'message' => 'Salah parameter'
            ]);
        }
    }

    public function absensi()
    {
        if (request('iddev') && request('uid')) {
            $device = Device::where('iddev', request('iddev'))->first();

            if ($device) {
                $siswa = Siswa::where('uid', request('uid'))->first();

                if ($siswa) {
                    if ($siswa->status == 1) {
                        $waktu = Carbon::now('Asia/Jakarta');
                        $now = Carbon::now('Asia/Jakarta')->format('H:i');
                        $jadwals = Jadwal::where('status', 1)->get();
                        $jdw = [];

                        foreach ($jadwals as $jadwal) {
                            if ($waktu->between($jadwal->mulai, $jadwal->selesai, true)) {
                                $jdw = $jadwal;
                            }
                        }

                        if ($jdw == null) {
                            return response()->json([
                                'status' => 'failed',
                                'message' => 'Tidak ada jadwal saat ini',
                                'nama_siswa' => $siswa->nama_siswa,
                                'nisn' => $siswa->nisn,
                                'jurusan' => $siswa->jurusan->nama_jurusan,
                                'waktu' => Carbon::now('Asia/Jakarta')->format('d/m/Y H:i:s')
                            ]);
                        }

                        $absensi = Absensi::where('siswa_id', $siswa->id)->where('jadwal_id', $jdw['id'])->where('tanggal', Carbon::now('Asia/Jakarta')->format('Y-m-d'))->first();


                        if (!$absensi && $now >= $jdw['mulai'] && $now <= $jdw['selesai']) {
                            try {
                                DB::beginTransaction();

                                Absensi::create([
                                    'device_id' => $device->id,
                                    'jadwal_id' => $jdw['id'],
                                    'siswa_id' => $siswa->id,
                                    'tanggal' => $waktu,
                                    'keterangan' => 'Hadir'
                                ]);

                                History::create([
                                    'device_id' => $device->id,
                                    'keterangan' => 'Hadir waktu ' . $jdw['nama_jadwal']
                                ]);

                                DB::commit();

                                return response()->json([
                                    'status' => 'success',
                                    'message' => 'Berhasil absensi waktu ' . $jdw['nama_jadwal'],
                                    'nama_siswa' => $siswa->nama_siswa,
                                    'nisn' => $siswa->nisn,
                                    'jurusan' => $siswa->jurusan->nama_jurusan,
                                    'waktu' => Carbon::now('Asia/Jakarta')->format('d/m/Y H:i:s')
                                ]);
                            } catch (\Throwable $th) {
                                DB::rollBack();
                                return response()->json([
                                    'status' => 'failed',
                                    'message' => $th->getMessage(),
                                    'nama_siswa' => $siswa->nama_siswa,
                                    'nisn' => $siswa->nisn,
                                    'jurusan' => $siswa->jurusan->nama_jurusan,
                                    'waktu' => Carbon::now('Asia/Jakarta')->format('d/m/Y H:i:s')
                                ]);
                            }
                        } else {
                            return response()->json([
                                'status' => 'failed',
                                'message' => 'Anda sudah absensi di jadwal tersebut',
                                'nama_siswa' => $siswa->nama_siswa,
                                'nisn' => $siswa->nisn,
                                'jurusan' => $siswa->jurusan->nama_jurusan,
                                'waktu' => Carbon::now('Asia/Jakarta')->format('d/m/Y H:i:s')
                            ]);
                        }
                    } else {
                        return response()->json([
                            'status' => 'failed',
                            'message' => 'Data siswa belum di verifikasi',
                            'nama_siswa' => $siswa->nama_siswa,
                            'nisn' => $siswa->nisn,
                            'jurusan' => $siswa->jurusan->nama_jurusan,
                            'waktu' => Carbon::now('Asia/Jakarta')->format('d/m/Y H:i:s')
                        ]);
                    }
                } else {
                    return response()->json([
                        'status' => 'failed',
                        'message' => 'Data siswa tidak ditemukan'
                    ]);
                }
            } else {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Device tidak ditemukan'
                ]);
            }
        } else {
            return response()->json([
                'status' => 'failed',
                'message' => 'Salah parameter'
            ]);
        }
    }
}
