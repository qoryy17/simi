<?php

namespace App\Http\Requests\Verification;

use Illuminate\Foundation\Http\FormRequest;

class VerificationRequest extends FormRequest
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
            'status' => ['required', 'string'],
            'keterangan' => ['required', 'string']
        ];
    }

    public function messages(): array
    {
        return [
            'status.required' => 'Status verifikasi harus di pilih !',
            'status.string' => 'Status verifikasi harus berupa string !',
            'keterangan.required' => 'Keterangan verifikasi harus di isi !',
            'keterangan.string' => 'Keterangan verifikasi harus berupa string !',
        ];
    }
}
