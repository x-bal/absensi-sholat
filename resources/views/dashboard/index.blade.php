@extends('layouts.master', ['title' => 'Dashboard'])

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="alert alert-info">
            Selamat datang {{ auth()->user()->name }}, Have a nice day :)
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6 col-xl-3 mb-4">
        <div class="card shadow border-0">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-3 text-center">
                        <span class="circle circle-sm bg-primary">
                            <i class="fe fe-16 fe-users text-white mb-0"></i>
                        </span>
                    </div>
                    <div class="col pr-0">
                        <p class="small text-muted mb-0">Users</p>
                        <span class="h3 mb-0">{{ App\Models\User::count() ?? 0 }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3 mb-4">
        <div class="card shadow border-0">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-3 text-center">
                        <span class="circle circle-sm bg-primary">
                            <i class="fe fe-16 fe-chevrons-up text-white mb-0"></i>
                        </span>
                    </div>
                    <div class="col pr-0">
                        <p class="small text-muted mb-0">Jurusan</p>
                        <span class="h3 mb-0">{{ App\Models\Jurusan::count() ?? 0 }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3 mb-4">
        <div class="card shadow border-0">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-3 text-center">
                        <span class="circle circle-sm bg-primary">
                            <i class="fe fe-16 fe-list text-white mb-0"></i>
                        </span>
                    </div>
                    <div class="col pr-0">
                        <p class="small text-muted mb-0">Jadwal</p>
                        <span class="h3 mb-0">{{ App\Models\Jadwal::where('status',1)->count() ?? 0 }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3 mb-4">
        <div class="card shadow border-0">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-3 text-center">
                        <span class="circle circle-sm bg-primary">
                            <i class="fe fe-16 fe-user-check text-white mb-0"></i>
                        </span>
                    </div>
                    <div class="col pr-0">
                        <p class="small text-muted mb-0">Siswa</p>
                        <span class="h3 mb-0">{{ App\Models\Siswa::where('status',1)->count() ?? 0 }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop