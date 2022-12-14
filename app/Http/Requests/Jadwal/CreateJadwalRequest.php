<?php

namespace App\Http\Requests\Jadwal;

use Illuminate\Foundation\Http\FormRequest;

class CreateJadwalRequest extends FormRequest
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
            'nama_jadwal' => 'required|string|unique:jadwals',
            'mulai' => 'required|string',
            'selesai' => 'required|string',
            'telat' => 'required|string',
        ];
    }
}
