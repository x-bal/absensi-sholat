@extends('layouts.master', ['title' => $title ])

@push('style')

@endpush

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">{{ $title }}</div>

            <div class="card-body">
                {{-- <div class="alert alert-info">
                    *Untuk lakukan export absensi mohon lakukan filter terlebih dahulu.
                </div> --}}

                <form action="" class="row">
                    <div class="form-group col-md-3">
                        <label for="date-input1">Bulan</label>
                        <input type="month" name="bulan" class="form-control" value="{{ request('bulan') ?? Carbon\Carbon::now('Asia/Jakarta')->format('Y-m') }}">
                    </div>

                    <div class="form-group col-md-3 mt-4">
                        <button type="submit" class="btn btn-primary"><i class="fe fe-filter"></i> Filter</button>
                        {{--
                        @if(request('tanggal'))
                        <a href="{{ route('absensi.export') }}?tanggal={{ request('tanggal') }}&angkatan={{ request('angkatan') }}&jurusan={{ request('jurusan') }}" class="btn btn-success text-light"><i class="fe fe-file-text"></i> Export</a>
                        @endif
                        --}}
                    </div>
                </form>

                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-dark">No</th>
                                <th class="text-dark">Nipd / Nisn</th>
                                <th class="text-dark">Angkatan / Jurusan</th>
                                <th class="text-dark">Nama siswa</th>
                                <th class="text-dark">Hadir</th>
                                <th class="text-dark">Telat</th>
                                <th class="text-dark">Tidak Hadir</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($siswa as $sw)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    {{ $sw->nipd }} / {{ $sw->nisn }}
                                </td>
                                <td>
                                    {{ $sw->angkatan->nama_angkatan }} <br> {{ $sw->jurusan->nama_jurusan }}
                                </td>
                                <td>{{ $sw->nama_siswa }}</td>
                                <td class="text-center">
                                    <span class="badge badge-success text-white p-2">{{ $sw->absensi()->whereMonth('tanggal', $bulan)->whereYear('tanggal', $year)->where('keterangan', 'Hadir')->count() }}</span>
                                </td>
                                <td class="text-center">
                                    <span class="badge badge-warning text-white p-2">{{ $sw->absensi()->whereMonth('tanggal', $bulan)->whereYear('tanggal', $year)->where('keterangan', 'Telat')->count() }}</span>
                                </td>
                                <td class="text-center">
                                    <span class="badge badge-danger text-white p-2">{{ $sw->absensi()->whereMonth('tanggal', $bulan)->whereYear('tanggal', $year)->where('keterangan', 'Tidak Hadir')->count() }}</span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@stop