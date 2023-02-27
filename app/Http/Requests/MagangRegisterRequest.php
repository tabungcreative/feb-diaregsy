<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MagangRegisterRequest extends FormRequest
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
            'nim' => 'required',
            'nama' => 'required',
            'prodi' => 'required',
            'alamat' => 'required',
            // 'no_pembayaran' => 'required',
            'no_whatsapp' => 'required|numeric',
            'instansi_magang' => 'required',
            'pimpinan_instansi' => 'required',
            'lembar_persetujuan' => 'required|mimes:pdf|file|max:500',
            'bukti_pembayaran' => 'required|mimes:pdf|file|max:500',
        ];
    }
}
