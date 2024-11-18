<?php

namespace App\Http\Requests\Item;

use Illuminate\Foundation\Http\FormRequest;

class ConditionItemRequest extends FormRequest
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
            'kondisi' => ['required', 'string', 'max:255'],
            'keterangan' => ['required', 'string']
        ];
    }
    
    public function messages(): array  
    {
        return [ 
            'kondisi.required' => 'Kondisi harus di isi !',
            'kondisi.string' => 'Kondisi harus berupa string !',
            'kondisi.max' => 'Kondisi maksimal 255 karakter !',
            'keterangan.required' => 'Keterangan harus di isi !',
            'keterangan.string' => 'Keterangan harus berupa string !'
        ];
    }
}
