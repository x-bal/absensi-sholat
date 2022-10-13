@extends('layouts.master', ['title' => $title ])

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">{{ $title }}</div>

            <div class="card-body">
                <!-- <a href="{{ route('siswa.create') }}" class="btn btn-primary mb-3 align-middle"><i class="fe fe-plus-circle"></i> Tambah siswa</a> -->

                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-dark">No</th>
                                <th class="text-dark">Foto</th>
                                <th class="text-dark">Rfid</th>
                                <th class="text-dark">Nipd / Nisn</th>
                                <th class="text-dark">Angkatan / Jurusan</th>
                                <th class="text-dark">Nama siswa</th>
                                <th class="text-dark">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($siswa as $sw)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="text-center">
                                    <img src="{{ asset('storage/'. $sw->foto) }}" alt="" class="avatar-img rounded-circle" width="50">
                                </td>
                                <td>{{ $sw->rfid }}</td>
                                <td>
                                    {{ $sw->nipd }} / {{ $sw->nisn }}
                                </td>
                                <td>
                                    {{ $sw->angkatan->nama_angkatan }} <br> {{ $sw->jurusan->nama_jurusan }}
                                </td>
                                <td>{{ $sw->nama_siswa }}</td>
                                <td>
                                    <a href="{{ route('siswa.edit', $sw->id) }}" class="btn btn-success text-light"><i class="fe fe-edit align-middle"></i></a>
                                    <form id="form-delete" action="{{ route('siswa.destroy', $sw->id) }}" method="post" class="d-inline">
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