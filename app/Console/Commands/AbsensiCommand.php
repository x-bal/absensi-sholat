<?php

namespace App\Console\Commands;

use App\Models\Absensi;
use App\Models\Jadwal;
use App\Models\Siswa;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AbsensiCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'absensi:command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */

    public $jdw;

    public function handle()
    {
        $tanggal = Carbon::now('Asia/Jakarta')->format('Y-m-d');
        $now = Carbon::now('Asia/Jakarta')->format('H:i');
        $waktu = Carbon::now('Asia/Jakarta');
        $jadwals = Jadwal::where('status', 1)->get();
        $siswa = Siswa::where('status', 1)->get();
        $jdw = [];

        foreach ($jadwals as $jadwal) {
            if ($waktu->between($jadwal->mulai, Carbon::parse($jadwal->telat)->addMinute(7)->format('H:i'), true)) {
                $jdw = $jadwal;
            }
        }

        if ($jdw != null) {
            $time = Carbon::parse($jdw['telat'])->addMinute(5)->format('H:i');

            if ($now == $time) {
                foreach ($siswa as $sw) {
                    $absensi = Absensi::whereDate('tanggal', $tanggal)->where('jadwal_id', $jdw['id'])->where('siswa_id', $sw->id)->first();

                    if (!$absensi) {
                        try {
                            DB::beginTransaction();
                            Absensi::create([
                                'device_id' => 1,
                                'siswa_id' => $sw->id,
                                'jadwal_id' => $jdw['id'],
                                'tanggal' => $tanggal,
                                'keterangan' => 'Tidak Hadir'
                            ]);
                            DB::commit();
                        } catch (\Throwable $th) {
                            DB::rollBack();
                            Log::write($th->getMessage());
                        }
                    }
                }
            }
        }
    }
}
