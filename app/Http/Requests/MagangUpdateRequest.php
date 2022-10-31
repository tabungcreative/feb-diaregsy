<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MagangUpdateRequest extends FormRequest
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
            'alamat' => 'required',
            'email' => 'required',
            'instansi_magang' => 'required',
            'pimpinan_instansi' => 'required',
            'no_whatsapp' => 'required',
            'lembar_persetujuan' => 'mimes:pdf|file|max:3000',
        ];
    }
}
