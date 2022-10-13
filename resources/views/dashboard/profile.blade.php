@extends('layouts.master', ['title' => 'Profile'])

@section('content')
<div class="my-4">
    <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Profile</a>
        </li>
    </ul>
    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row mt-5 align-items-center">
            <div class="col-md-3 text-center mb-5">
                <div class="avatar avatar-xl">
                    <img src="{{ asset('/storage/' . auth()->user()->foto) }}" alt="..." class="avatar-img rounded-circle">
                </div>
            </div>
            <div class="col">
                <div class="row align-items-center">
                    <div class="col-md-7">
                        <h4 class="mb-1">{{ auth()->user()->name }}</h4>
                        <p class="mb-3"><span class="badge badge-dark">{{ auth()->user()->level }}</span></p>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-md-7">
                        <p class="text-muted">
                            Masjid Al Mukhlisin <br>

                            IDN Boarding School Bogor <br>
                            Jl. KH.Abdul Hamid Kp.Sirnasari RT 06 RW 02, Desa Gunung Sari, Kecamatan Pamijahan, Kabupaten Bogor, Jawa Barat <br><br>
                            © 2022
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <hr class="my-4">
        <div class="form row">
            <div class="form-group col-md-6">
                <label for="username"><sup class="text-danger">*</sup> Username</label>
                <input type="text" class="form-control" id="username" name="username" value="{{ auth()->user()->username }}">

                @error('username')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group col-md-6">
                <label for="password">New Password</label>
                <input type="password" class="form-control" name="password" id="password">

                @error('password')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group col-md-6">
                <label for="nama"><sup class="text-danger">*</sup> Nama</label>
                <input type="text" id="nama" class="form-control" name="name" value="{{ auth()->user()->name }}">

                @error('name')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group col-md-6">
                <label for="confirm">Confirm Password</label>
                <input type="password" class="form-control" id="confirm" name="confirm">

                @error('confirm')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group col-md-6">
                <label for="foto">Foto</label>
                <input type="file" class="form-control-file" id="foto" name="foto">

                @error('foto')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
        <button type="submit" class="btn btn-primary"><i class="fe fe-save"></i> Save Profile</button>
    </form>
</div>
@stop