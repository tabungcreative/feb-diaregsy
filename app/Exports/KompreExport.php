<?php

namespace App\Exports;

use App\Models\Kompre;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;


class KompreExport implements FromView
{

    public function view(): View
    {
        return view('admin.kompre.export', [
            'kompre' => Kompre::all()
        ]);
    }
}
