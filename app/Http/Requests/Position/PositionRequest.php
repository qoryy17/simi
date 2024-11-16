<?php

namespace App\Http\Requests\Position;

use Illuminate\Foundation\Http\FormRequest;

class PositionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'jabatan' => ['required', 'max:255', 'string'],
            'kodeJabatan' => ['required', 'max:255', 'string'],
            'keterangan' => ['required', 'string']
        ];
    }

    public function messages(): array
    {
        return [
            'jabatan.required' => ' Jabatan harus di isi !',
            'jabatan.max' => ' Jabatan maksimal 255 karakter !',
            'jabatan.string' => ' Jabatan harus berupa string !',
            'jabatan.required' => ' Kode jabatan harus di isi !',
            'kodeJabatan.max' => ' Kode jabatan maksimal 255 karakter !',
            'kodeJabatan.string' => ' Kode jabatan harus berupa string !',
            'keterangan.required' => ' Kode jabatan harus di isi !',
            'keterangan.string' => ' Jabatan harus berupa string !',
        ];
    }
}
