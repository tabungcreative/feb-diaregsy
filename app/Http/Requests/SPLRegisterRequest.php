<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SPLRegisterRequest extends FormRequest
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
            'no_whatsapp' => 'required|numeric',
            'jenis_pendaftaran' => 'required',
            'bukti_pembayaran' => 'required|mimes:pdf|file|max:500',
        ];
    }
}
