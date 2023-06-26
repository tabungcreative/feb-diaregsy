<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UjianAkhirUpdateRequest extends FormRequest
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
            'email' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'nik' => 'required',
            'judul_skripsi' => 'required',
            'pembimbing1' => 'required',
            'pembimbing2' => 'required',
            'no_whatsapp' => 'required',
            'berkas_skripsi' => 'mimes:pdf|file|max:2000',
            'ijazah_terakhir' => 'mimes:pdf|file|max:500',
            'transkrip_nilai' => 'mimes:pdf|file|max:500',
            'ktp' => 'mimes:pdf|file|max:500',
            'slip_pembayaransemesterterakhir' => 'mimes:pdf|file|max:500',
            'slip_pembayaranSkripsi' => 'mimes:pdf|file|max:500',
            'sertifikat' => 'mimes:pdf|file|max:500',
        ];
    }
}
