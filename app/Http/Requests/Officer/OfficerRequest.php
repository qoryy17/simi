<?php

namespace App\Http\Requests\Officer;

use Illuminate\Foundation\Http\FormRequest;

class OfficerRequest extends FormRequest
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
            'nip' => ['required', 'string'],
            'namaLengkap' => ['required', 'string', 'max:255'],
            'jabatan' => ['required', 'string'],
            'status' => ['required', 'string']
        ];
    }

    public function messages(): array
    {
        return [
            'nip.required' => 'NIP harus di isi !',
            'nip.string' => 'NIP harus berupa string !',
            'namaLengkap.required' => 'Nama lengkap harus di isi !',
            'namaLengkap.string' => 'Nama lengkap harus berupa string !',
            'jabatan.required' => 'Jabatan harus di isi !',
            'jabatan.string' => 'Jabatan harus berupa string !',
            'status.required' => 'Status harus di isi !',
            'status.string' => 'Status harus berupa string !'
        ];
    }
}
