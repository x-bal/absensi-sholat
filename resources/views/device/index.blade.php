@extends('layouts.master', ['title' => $title ])

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">{{ $title }}</div>

            <div class="card-body">
                <a href="{{ route('device.create') }}" class="btn btn-primary mb-3 align-middle"><i class="fe fe-plus-circle"></i> Tambah Device</a>

                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-dark">No</th>
                                <th class="text-dark">Id Device</th>
                                <th class="text-dark">Nama Device</th>
                                <th class="text-dark">Mode</th>
                                <th class="text-dark">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($devices as $device)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $device->iddev }}</td>
                                <td>{{ $device->nama_device }}</td>
                                <td>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input mode" value="{{ $device->mode }}" id="mode-{{ $device->id }}" data-id="{{ $device->id }}" {{ $device->mode == 'SCAN' ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="mode-{{ $device->id }}">{{ $device->mode }}</label>
                                    </div>
                                </td>
                                <td>
                                    <a href="{{ route('device.edit', $device->id) }}" class="btn btn-success text-light"><i class="fe fe-edit align-middle"></i></a>
                                    <form id="form-delete" action="{{ route('device.destroy', $device->id) }}" method="post" class="d-inline">
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
        $(".table").on('click', '.mode', function() {
            let id = $(this).attr('data-id');
            let mode = $(this).val();

            $.ajax({
                url: "/device/" + id,
                method: 'GET',
                type: 'GET',
                data: {
                    id: id,
                    mode: mode
                },
                success: function(response) {
                    window.location.reload()
                }
            })
        })
    })
</script>
@endpush