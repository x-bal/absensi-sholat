<?php

namespace App\Http\Requests\Rfid;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRfidRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'nama_siswa' => 'required|string',
            'angkatan' => 'required|numeric',
            'jurusan' => 'required|numeric',
            'nipd' => 'required|numeric',
            'nisn' => 'required|numeric',
            'foto' => 'required|mimes:jpg,jpeg,png',
        ];
    }
}
