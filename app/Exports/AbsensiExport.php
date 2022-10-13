<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class AbsensiExport implements FromView
{
    public function __construct($absensi = [], $title = '')
    {
        $this->absensi = $absensi;
        $this->title = $title;
    }

    public function view(): View
    {
        return view('absensi.export', [
            'title' => $this->title,
            'absensi' => $this->absensi
        ]);
    }
}
