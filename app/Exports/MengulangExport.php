<?php

namespace App\Exports;

use App\Models\Mengulang;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class MengulangExport implements FromView
{
   public function view(): View
    {
        return view('admin.mengulang.export', [
            'mengulang' => Mengulang::all()
        ]);
    }
}
