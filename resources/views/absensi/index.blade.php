@extends('layouts.master', ['title' => $title ])

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">{{ $title }}</div>

            <div class="card-body">
                <div class="alert alert-info">
                    *Untuk lakukan export absensi mohon lakukan filter terlebih dahulu.
                </div>

                <form action="" class="row">
                    <div class="form-group col-md-3">
                        <label for="date-input1">Tangal</label>
                        <input type="text" name="tanggal" class="form-control datetimes" value="{{ request('tanggal') ?? '' }}">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="angkatan">Angkatan</label>
                        <select name="angkatan" id="angkatan" class="form-control">
                            <option value="all">All</option>
                            @foreach($angkatan as $angk)
                            <option {{ request('angkatan') == $angk->id ? 'selected' : '' }} value="{{ $angk->id }}">{{ $angk->nama_angkatan }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="jurusan">Jurusan</label>
                        <select name="jurusan" id="jurusan" class="form-control">
                            <option value="all">All</option>
                            @foreach($jurusan as $jur)
                            <option {{ request('jurusan') == $jur->id ? 'selected' : '' }} value="{{ $jur->id }}">{{ $jur->nama_jurusan }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-3 mt-4">
                        <button type="submit" class="btn btn-primary"><i class="fe fe-filter"></i> Filter</button>
                        @if(request('tanggal'))
                        <a href="{{ route('absensi.export') }}?tanggal={{ request('tanggal') }}&angkatan={{ request('angkatan') }}&jurusan={{ request('jurusan') }}" class="btn btn-success text-light"><i class="fe fe-file-text"></i> Export</a>
                        @endif
                    </div>
                </form>

                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-dark">No</th>
                                <th class="text-dark">Tanggal</th>
                                <th class="text-dark">Nama Device</th>
                                <th class="text-dark">Jadwal</th>
                                <th class="text-dark">Nama Siswa</th>
                                <th class="text-dark">Angkatan / Jurusan</th>
                                <th class="text-dark">Keterangan</th>
                                <th class="text-dark">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($absensi as $absen)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ Carbon\Carbon::parse($absen->created_at)->format('d/m/Y H:i:s') }}</td>
                                <td>{{ $absen->device->nama_device }}</td>
                                <td>{{ $absen->jadwal->nama_jadwal }}</td>
                                <td>{{ $absen->siswa->nama_siswa }}</td>
                                <td>
                                    {{ $absen->siswa->angkatan->nama_angkatan }} <br>
                                    {{ $absen->siswa->jurusan->nama_jurusan }}
                                </td>
                                <td>{{ $absen->keterangan }}</td>
                                <td>
                                    <a href="{{ route('absensi.edit', $absen->id) }}" class="btn btn-success text-light"><i class="fe fe-edit align-middle"></i></a>
                                    <form id="form-delete" action="{{ route('absensi.destroy', $absen->id) }}" method="post" class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button type="button" class="btn btn-danger btn-delete"><i class="fe fe-trash align-middle"></i></button>
                                    </form>
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