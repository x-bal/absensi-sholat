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
                        <label for="rfid"><sup class="text-danger">*</sup> Rfid</label>
                        <input type="text" disabled name="rfid" id="rfid" class="form-control" value="{{ $siswa->rfid ?? old('rfid') }}">

                        @error('rfid')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="angkatan">Angkatan</label>
                        <select name="angkatan" id="angkatan" class="form-control">
                            <option disabled selected>-- Pilih Angkatan --</option>
                            @foreach($angkatan as $angk)
                            <option {{ $siswa->angkatan_id == $angk->id ? 'selected' : '' }} value="{{ $angk->id }}">{{ $angk->nama_angkatan }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="jurusan">Jurusan</label>
                        <select name="jurusan" id="jurusan" class="form-control">
                            <option disabled selected>-- Pilih jurusan --</option>
                            @foreach($jurusan as $jur)
                            <option {{ $siswa->jurusan_id == $jur->id ? 'selected' : '' }} value="{{ $jur->id }}">{{ $jur->nama_jurusan }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="nama_siswa"><sup class="text-danger">*</sup> Nama Siswa</label>
                        <input type="text" name="nama_siswa" id="nama_siswa" class="form-control" value="{{ $siswa->nama_siswa ?? old('nama_siswa') }}">

                        @error('nama_siswa')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="nipd"><sup class="text-danger">*</sup> Nipd</label>
                        <input type="text" name="nipd" id="nipd" class="form-control" value="{{ $siswa->nipd ?? old('nipd') }}">

                        @error('nipd')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="nisn"><sup class="text-danger">*</sup> Nisn</label>
                        <input type="text" name="nisn" id="nisn" class="form-control" value="{{ $siswa->nisn ?? old('nisn') }}">

                        @error('nisn')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="foto"><sup class="text-danger">*</sup> Foto</label>
                        <input type="file" name="foto" id="foto" class="form-control">

                        @error('foto')
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