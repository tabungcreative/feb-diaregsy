<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class YudisiumRegisterRequest extends FormRequest
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
            'nim' => 'required',
            'nama' => 'required',
            'prodi' => 'required',
            'judul_skripsi' => 'required',
            'tanggal_mulai' => 'required',
            'tanggal_ujian' => 'required',
            'jenis_kelamin' => 'required',
            'pembimbing1' => 'required',
            'pembimbing2' => 'required',
            'no_whatsapp' => 'required|numeric',
            'ukuran_toga' => 'required',
            'bukti_pembayaran' => 'required|mimes:pdf|file|max:500',
            'bebas_spp' => 'required|mimes:pdf|file|max:500',
            'transkrip_nilai' => 'required|mimes:pdf|file|max:500',
            'bebas_perpus' => 'required|mimes:pdf|file|max:500',
            'artikel' => 'required|mimes:pdf|file|max:500',
            'file_skripsi' => 'required|mimes:pdf|file|max:500',
            'bebas_plagiasi' => 'required|mimes:pdf|file|max:500',
            'bukti_penjilidan' => 'required|mimes:pdf|file|max:500',
            'bukti_pengumpulan' => 'required|mimes:pdf|file|max:500',
        ];
    }
}
