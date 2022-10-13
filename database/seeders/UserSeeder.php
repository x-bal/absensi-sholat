<?php

namespace Database\Seeders;

use App\Models\Angkatan;
use App\Models\Device;
use App\Models\Jadwal;
use App\Models\Jurusan;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'username' => 'developer',
            'name' => 'Developer',
            'password' => bcrypt('secret'),
            'level' => 'Admin'
        ]);

        User::create([
            'username' => 'staff',
            'name' => 'Staff',
            'password' => bcrypt('secret'),
            'level' => 'Staff'
        ]);

        Jadwal::create([
            'nama_jadwal' => 'Shubuh',
            'mulai' => '04:00',
            'selesai' => '05:00',
        ]);

        Jadwal::create([
            'nama_jadwal' => 'Dzuhur',
            'mulai' => '11:00',
            'selesai' => '12:00',
        ]);

        Jadwal::create([
            'nama_jadwal' => 'Ashar',
            'mulai' => '15:00',
            'selesai' => '16:00',
        ]);


        Jadwal::create([
            'nama_jadwal' => 'Magrib',
            'mulai' => '18:00',
            'selesai' => '18:30',
        ]);


        Jadwal::create([
            'nama_jadwal' => 'Isya',
            'mulai' => '19:00',
            'selesai' => '20:00',
        ]);

        $angkatan = Angkatan::create([
            'nama_angkatan' => 'Abu Bakar'
        ]);

        $jurusan =  Jurusan::create([
            'nama_jurusan' => 'Rekayasa Perangkat Lunak'
        ]);

        Device::create([
            'iddev' => 1,
            'nama_device' => 'Device Mesjid'
        ]);

        Siswa::create([
            'angkatan_id' => $angkatan->id,
            'jurusan_id' => $jurusan->id,
            'uid' => '12345678',
            'nama_siswa' => 'Siswa Seeder',
            'nipd' => '11223344',
            'nisn' => '10122001',
        ]);
    }
}
