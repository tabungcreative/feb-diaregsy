<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use App\Models\Sempro;
use App\Models\TahunAjaran;

class SemproExport implements FromView
{
    public function view(): View
    {
        $tahunAjaran = TahunAjaran::where('is_active', 1)->first();
        return view('admin.sempro.export', [
            'sempro' => Sempro::where('tahun_ajaran_id', $tahunAjaran->id)->get()
        ]);
    }
}
