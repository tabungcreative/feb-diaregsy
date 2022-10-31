<?php

namespace App\Exports;

use App\Models\Magang;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class MagangExport implements FromView
{
    public function view(): View
    {
        return view('admin.magang.export', [
            'magang' => Magang::all()
        ]);
    }
}
