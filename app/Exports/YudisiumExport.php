<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use App\Models\Yudisium;


class YudisiumExport implements FromView
{
   
    public function view(): View
    {
        return view('admin.yudisium.export', [
            'yudisium' => Yudisium::all()
        ]);
    }
}
