<?php

namespace App\Exports;

use App\Models\SPL;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class SPLExport implements FromView
{

    public function view(): View
    {
        return view('admin.spl.export', [
            'spl' => SPL::all()
        ]);
    }
}
