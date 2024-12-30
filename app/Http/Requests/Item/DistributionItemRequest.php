<?php

namespace App\Http\Requests\Item;

use Illuminate\Foundation\Http\FormRequest;

class DistributionItemRequest extends FormRequest
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
            "kodeDistribusi" => ["required", "string", "max:255"],
            "nomorBast" => ["required", "string"],
            "ruangan" => ["required", "string"],
        ];
    }
    public function messages(): array
    {
        return [
            "kodeDistribusi.required" => "Kode Distribusi Harus Diisi !",
            "kodeDistribusi.string" => "Kode Distribusi Harus Berupa String !",
            "kodeDistribusi.max" => "Kode Distribusi Maximal 255 Karakter !",
            "ruangan.required" => "Ruangan Harus Diisi !",
            "ruangan.string" => "Ruangan Harus Berupa String !",
        ];
    }
}
