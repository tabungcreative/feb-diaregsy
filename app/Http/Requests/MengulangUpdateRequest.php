<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MengulangUpdateRequest extends FormRequest
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
            'no_whatsapp' => 'required',
            'khs' => 'mimes:pdf|file|max:500',
            'bukti_pembayaran' => 'mimes:pdf|file|max:500',
        ];
    }
}
