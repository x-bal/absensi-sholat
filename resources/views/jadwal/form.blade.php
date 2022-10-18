@extends('layouts.master', ['title' => $title])

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">{{ $title }}</div>

            <div class="card-body">
                <form action="{{ $action }}" method="post" enctype="multipart/form-data">
                    @method($method)
                    @csrf
                    <div class="form-group mb-3">
                        <label for="nama_jadwal"><sup class="text-danger">*</sup> Nama Jadwal</label>
                        <input type="text" name="nama_jadwal" id="nama_jadwal" class="form-control" value="{{ $jadwal->nama_jadwal ?? old('nama_jadwal') }}">

                        @error('nama_jadwal')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="mulai"><sup class="text-danger">*</sup> Mulai</label>
                        <input type="time" name="mulai" id="mulai" class="form-control" value="{{ $jadwal->mulai ?? old('mulai') }}">

                        @error('mulai')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="selesai"><sup class="text-danger">*</sup> Selesai</label>
                        <input type="time" name="selesai" id="selesai" class="form-control" value="{{ $jadwal->selesai ?? old('selesai') }}">

                        @error('selesai')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="telat"><sup class="text-danger">*</sup> Telat</label>
                        <input type="time" name="telat" id="telat" class="form-control" value="{{ $jadwal->telat ?? old('telat') }}">

                        @error('telat')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <button type="submit" class="btn btn-primary"><i class="fe fe-save"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop