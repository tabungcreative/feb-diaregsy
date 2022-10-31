<?php

namespace App\Exports;

use App\Models\BimbinganSkripsi;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class BimbinganSkripsiExport implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        return view('admin.bimbinganSkripsi.export', [
            'bimbinganSkripsi' => BimbinganSkripsi::all()
        ]);
    }
}
