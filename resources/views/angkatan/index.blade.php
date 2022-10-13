@extends('layouts.master', ['title' => $title ])

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">{{ $title }}</div>

            <div class="card-body">
                <a href="{{ route('angkatan.create') }}" class="btn btn-primary mb-3 align-middle"><i class="fe fe-plus-circle"></i> Tambah Angkatan</a>

                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-dark">No</th>
                                <th class="text-dark">Nama Angkatan</th>
                                <th class="text-dark">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($angkatan as $angk)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $angk->nama_angkatan }}</td>
                                <td>
                                    <a href="{{ route('angkatan.edit', $angk->id) }}" class="btn btn-success text-light"><i class="fe fe-edit align-middle"></i></a>
                                    <form id="form-delete" action="{{ route('angkatan.destroy', $angk->id) }}" method="post" class="d-inline">
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