@extends('layouts.master', ['title' => $title ])

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">{{ $title }}</div>

            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-dark">No</th>
                                <th class="text-dark">Tanggal</th>
                                <th class="text-dark">Nama Device</th>
                                <th class="text-dark">Keterangan</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($histories as $angk)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ Carbon\Carbon::parse($angk->tanggal)->format('d/m/Y H:i:s') }}</td>
                                <td>{{ $angk->device->nama_device }}</td>
                                <td>{{ $angk->keterangan }}</td>
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