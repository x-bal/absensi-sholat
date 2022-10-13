<div class="table-responsive">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th class="text-dark text-center">No</th>
                <th class="text-dark text-center">Tanggal</th>
                <th class="text-dark text-center">Nama Device</th>
                <th class="text-dark text-center">Nama Siswa</th>
                <th class="text-dark text-center">Angkatan / Jurusan</th>
                @foreach(App\Models\Jadwal::where('status', 1)->get() as $jadwal)
                <th>{{ $jadwal->nama_jadwal }}</th>
                @endforeach
            </tr>
        </thead>

        <tbody>
            @foreach($absensi as $absen)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ Carbon\Carbon::parse($absen->created_at)->format('d/m/Y H:i:s') }}</td>
                <td>{{ $absen->device->nama_device }}</td>
                <td>{{ $absen->siswa->nama_siswa }}</td>
                <td>{{ $absen->siswa->angkatan->nama_angkatan }} - {{ $absen->siswa->jurusan->nama_jurusan }}</td>
                @foreach(App\Models\Jadwal::where('status',1)->get() as $jdw)
                <td>{{ App\Models\Absensi::where('siswa_id', $absen->siswa_id)->where('jadwal_id', $jdw->id)->where('tanggal', $absen->tanggal)->first()->keterangan ?? '-' }}</td>
                @endforeach
            </tr>
            @endforeach
        </tbody>
    </table>
</div>