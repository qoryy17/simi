<?php

namespace App\Http\Requests\Room;

use Illuminate\Foundation\Http\FormRequest;

class RoomRequest extends FormRequest
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
            'ruangan' => ['required', 'string', 'max:255'],
            'kodeRuangan' => ['required', 'string', 'max:255'],
            'keterangan' => ['required', 'string']
        ];
    }

    public function messages(): array
    {
        return [
            'ruangan.required' => 'Ruangan harus di isi !',
            'ruangan.string' => 'Ruangan harus berupa string !',
            'ruangan.max' => 'Ruangan maksimal 255 karakter !',
            'kodeRuangan.required' => 'Kode ruangan harus di isi !',
            'kodeRuangan.string' => 'Kode ruangan harus berupa string !',
            'kodeRuangan.max' => 'Kode ruangan maksimal 255 karakter !',
            'keterangan.required' => 'Keterangan harus di isi !',
            'keterangan.string' => 'Keterangan harus berupa string !',
        ];
    }
}
