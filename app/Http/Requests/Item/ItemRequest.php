<?php

namespace App\Http\Requests\Item;

use Illuminate\Foundation\Http\FormRequest;

class ItemRequest extends FormRequest
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
            'kodeBarang' => ['required', 'max:255', 'string'],
            'namaBarang' => ['required', 'string'],
            'jenis' => ['required', 'max:255', 'string'],
            'merek' => ['required', 'max:255', 'string'],
            'tipe' => ['required', 'max:255', 'string'],
            'nomorSeri' => ['required', 'max:255', 'string'],
            'ukuran' => ['required', 'max:255', 'string'],
            'bahan' => ['required', 'max:255', 'string'],
            'jumlah' => ['required', 'integer', 'string'],
            'satuan' => ['required', 'string'],
            'harga' => ['required', 'integer'],
            'sumberDana' => ['required', 'max:255', 'string'],
            'kondisi' => ['required', 'string'],
            'tahun' => ['required', 'string'],
            'nomorKontrak' => ['required',  'max:255', 'string'],
            'tanggalKontrak' => ['required', 'string', 'date'],
            'edoc' => ['file', 'mimes:pdf', 'max:5120'],
            'image' => ['file', 'mimes:png,jpg,jpeg', 'max:5120'],
        ];
    }

    public function messages(): array
    {
        return [
            'kodeBarang.required' => 'Kode barang harus di isi !',
            'kodeBarang.string' => 'Kode barang harus berupa string !',
            'kodeBarang.max' => 'Kode barang maksimal 255 karakter !',
            'namaBarang.required' => 'Nama barang harus di isi !',
            'namaBarang.string' => 'Nama barang harus berupa string !',
            'jenis.required' => 'Jenis barang harus di isi !',
            'jenis.string' => 'Jenis barang harus berupa string !',
            'jenis.max' => 'Jenis barang maksimal 255 karakter !',
            'merek.required' => 'Merek barang harus di isi !',
            'merek.string' => 'Merek barang harus berupa string !',
            'merek.max' => 'Merek barang maksimal 255 karakter !',
            'tipe.required' => 'Tipe barang harus di isi !',
            'tipe.string' => 'Tipe barang harus berupa string !',
            'tipe.max' => 'Tipe barang maksimal 255 karakter !',
            'nomorSeri.required' => 'Nomor seri harus di isi !',
            'nomorSeri.string' => 'Nomor seri harus berupa string !',
            'nomorSeri.max' => 'Nomor seri maksimal 255 karakter',
            'ukuran.required' => 'Ukuran barang harus di isi !',
            'ukuran.string' => 'Ukuran barang harus berupa string !',
            'ukuran.max' => 'Ukuran barang maksimal 255 karakter !',
            'bahan.required' => 'Bahan barang harus di isi !',
            'bahan.string' => 'Bahan barang harus berupa string !',
            'bahan.max' => 'Bahan barang maksimal 255 karakter !',
            'jumlah.required' => 'Jumlah barang harus di isi !',
            'jumlah.integer' => 'Jumlah barang harus berupa angka !',
            'jumlah.string' => 'Jumlah barang harus berupa string !',
            'satuan.required' => 'Satuan barang harus di pilih !',
            'satuan.string' => 'Satuan barang harus berupa string !',
            'harga.required' => 'Harga barang harus di isi !',
            'harga.integer' => 'Harga barang harus berupa angka !',
            'sumberDana.required' => 'Sumber dana harus di isi !',
            'sumberDana.string' => 'Sumber dana harus berupa string !',
            'sumberDana.max' => 'Sumber dana maksimal 255 karakter !',
            'kondisi.required' => 'Kondisi barang harus di pilih !',
            'kondisi.string' => 'Kondisi barang harus berupa string !',
            'tahun.required' => 'Tahun pengadaan harus di pilih !',
            'tahun.string' => 'Tahun pengadaan harus berupa string !',
            'nomorKontrak.required' => 'Nomor kontrak harus di isi !',
            'nomorKontrak.string' => 'Nomor kontrak harus berupa string !',
            'nomorKontrak.max' => 'Nomor kontrak maksimal 255 karakter !',
            'tanggalKontrak.required' => 'Tanggal kontrak harus di pilih !',
            'tanggalKontrak.string' => 'Tanggal kontrak harus berupa string !',
            'tanggalKontrak.date' => 'Tanggal kontrak harus valid !',
            'edoc.file' => 'Edoc harus berupa file !',
            'edoc.mimes' => 'Edoc hanya boleh bertipe pdf !',
            'edoc.max' => 'Edoc maksimal 5MB !',
            'images.file' => 'Gambar harus berupa file !',
            'images.mimes' => 'Gambar hanya boleh bertipe png/jpg/jpeg !',
            'images.max' => 'Gambar maksimal 5MB !',
        ];
    }
}
