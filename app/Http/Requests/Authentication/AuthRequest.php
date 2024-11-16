<?php

namespace App\Http\Requests\Authentication;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
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
            'email' => ['required', 'string', 'max:255', 'email'],
            'password' => ['required', 'string']
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Email harus di isi !',
            'email.string' => 'Email harus berupa string !',
            'email.max' => 'Email maksimal 255 karakter !',
            'email.email' => 'Email wajib valid ! contoh : example@local.com ',
            'password.required' => 'Password wajib di isi !',
            'password.string' => 'Password harus berupa string ! !'
        ];
    }
}
