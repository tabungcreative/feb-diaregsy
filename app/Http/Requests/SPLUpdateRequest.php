<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SPLUpdateRequest extends FormRequest
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
            'no_whatsapp' => 'required',
            'jenis_pendaftaran' => 'required',
            // 'foto_ktp' => 'required|max:3000',
            'bukti_pembayaran' => 'required|max:3000',
        ];
    }
}
