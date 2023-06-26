<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UjianAkhirRegisterRequest extends FormRequest
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
            'email' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'nik' => 'required',
            'judul_skripsi' => 'required',
            'pembimbing1' => 'required',
            'pembimbing2' => 'required',
            'no_whatsapp' => 'required',
            'berkas_skripsi' => 'required|mimes:pdf|file|max:2000',
            'ijazah_terakhir' => 'required|mimes:pdf|file|max:500',
            'transkrip_nilai' => 'required|mimes:pdf|file|max:500',
            'ktp' => 'required|mimes:pdf|file|max:500',
            'slip_pembayaransemesterterakhir' => 'required|mimes:pdf|file|max:500',
            'slip_pembayaranSkripsi' => 'required|mimes:pdf|file|max:500',
            'sertifikat' => 'required|mimes:pdf|file|max:500',
        ];
    }
}
