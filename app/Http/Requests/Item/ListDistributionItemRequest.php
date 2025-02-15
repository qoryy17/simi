<?php

namespace App\Http\Requests\Item;

use Illuminate\Foundation\Http\FormRequest;

class ListDistributionItemRequest extends FormRequest
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
            "barang" => ["required", "string", "max:255"],
        ];
    }
    public function messages(): array
    {
        return [
            "barang.required" => "Kode Distribusi Harus Diisi !",
            "barang.string" => "Kode Distribusi Harus Berupa String !",
            "barang.max" => "Kode Distribusi Maximal 255 Karakter !",
        ];
    }
}
