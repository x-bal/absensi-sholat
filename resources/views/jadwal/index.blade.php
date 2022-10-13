@extends('layouts.master', ['title' => $title ])

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">{{ $title }}</div>

            <div class="card-body">
                <a href="{{ route('jadwal.create') }}" class="btn btn-primary mb-3 align-middle"><i class="fe fe-plus-circle"></i> Tambah Jadwal</a>

                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-dark">No</th>
                                <th class="text-dark">Nama Jadwal</th>
                                <th class="text-dark">Mulai</th>
                                <th class="text-dark">Selesai</th>
                                <th class="text-dark">Status</th>
                                <th class="text-dark">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($jadwal as $jdw)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $jdw->nama_jadwal }}</td>
                                <td>{{ $jdw->mulai }}</td>
                                <td>{{ $jdw->selesai }}</td>
                                <td>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input status" value="{{ $jdw->status }}" id="status-{{ $jdw->id }}" data-id="{{ $jdw->id }}" {{ $jdw->status == 1 ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="status-{{ $jdw->id }}">{{ $jdw->status == 1 ? 'Active' : 'Nonactive' }}</label>
                                    </div>
                                </td>
                                <td>
                                    <a href="{{ route('jadwal.edit', $jdw->id) }}" class="btn btn-success text-light"><i class="fe fe-edit align-middle"></i></a>
                                    <form id="form-delete" action="{{ route('jadwal.destroy', $jdw->id) }}" method="post" class="d-inline">
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

@push('script')
<script>
    $(document).ready(function() {
        $(".table").on('click', '.status', function() {
            let id = $(this).attr('data-id');
            let status = $(this).val();

            $.ajax({
                url: "/jadwal/" + id,
                method: 'GET',
                type: 'GET',
                data: {
                    id: id,
                    status: status
                },
                success: function(response) {
                    window.location.reload()
                }
            })
        })
    })
</script>
@endpush