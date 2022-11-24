<?php

namespace App\Exports;

use App\Models\UjianAkhir;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;


class UjianAkhirExport implements FromView
{
    public function view(): View
    {
        return view('admin.ujianAkhir.export', [
            'ujianAkhir' => UjianAkhir::all()
        ]);
    }
}
