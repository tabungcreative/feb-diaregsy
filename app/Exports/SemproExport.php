<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use App\Models\Sempro;

class SemproExport implements FromView
{
    public function view(): View
    {
        return view('admin.sempro.export', [
            'sempro' => Sempro::all()
        ]);
    }
}
