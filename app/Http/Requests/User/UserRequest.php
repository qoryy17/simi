<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'pegawai' => ['required', 'string'],
            'role' => ['required', 'string'],
            'blokir' => ['required', 'string']
        ];
    }

    public function messages(): array
    {
        return [
            'pegawai.required' => 'Pegawai harus di isi !',
            'pegawai.string' => 'Pegawai harus berupa string',
            'role.required' => 'Role harus di isi !',
            'role.string' => 'Role harus berupa string !',
            'blokir.required' => 'Blokir harus di isi !',
            'blokir.string' => 'Blokir harus beruapa string !'
        ];
    }
}
