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
            'no_whatsapp' => 'required',
            'ukuran_toga' => 'required',
        ];
    }
}
