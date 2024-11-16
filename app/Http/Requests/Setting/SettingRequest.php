<?php

namespace App\Http\Requests\Setting;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
            'cabdisProvinsi' => ['required', 'string', 'max:300'],
            'cabdisKabupaten' => ['required', 'string', 'max:300'],
            'npsn' => ['required', 'string', 'max:255'],
            'namaSekolah' => ['required', 'string', 'max:255'],
            'alamat' => ['required', 'string'],
            'email' => ['required', 'string', 'max:255'],
            'telepon' => ['required', 'string', 'max:15'],
            'website' => ['required', 'string', 'max:255'],
        ];
    }
}
