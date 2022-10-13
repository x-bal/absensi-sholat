<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function device()
    {
        return $this->belongsTo(Device::class);
    }

    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class);
    }
}
