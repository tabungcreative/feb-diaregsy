<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class YudisiumUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'judul_skripsi' => 'required',
            'tanggal_mulai' => 'required',
            'tanggal_ujian' => 'required',
            'jenis_kelamin' => 'required',
            'pembimbing1' => 'required',
            'pembimbing2' => 'required',
            'no_whatsapp' => 'required|numeric',
            'ukuran_toga' => 'required',
            'bukti_pembayaran' => 'mimes:pdf|file|max:500',
            'bebas_spp' => 'mimes:pdf|file|max:500',
            'transkrip_nilai' => 'mimes:pdf|file|max:500',
            'bebas_perpus' => 'mimes:pdf|file|max:500',
            'artikel' => 'mimes:pdf|file|max:500',
            'file_skripsi' => 'mimes:pdf|file|max:500',
            'bebas_plagiasi' => 'mimes:pdf|file|max:500',
            'bukti_penjilidan' => 'mimes:pdf|file|max:500',
            'bukti_pengumpulan' => 'mimes:pdf|file|max:500',
        ];
    }
}
