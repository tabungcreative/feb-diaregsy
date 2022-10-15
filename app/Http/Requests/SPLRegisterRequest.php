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
        return false;
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
            'foto_ktp' => 'required',
            'no_pembayaran' => 'required',
            'no_whatsapp' => 'required',
            'jenis_pendaftaran' => 'required',
        ];
    }
}
