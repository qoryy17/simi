<?php

namespace App\Models\Item;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DistributionModel extends Model
{
    use HasFactory;

    protected $table = 'simi_distribusi_barang';
    protected $primaryKey = 'id';

    protected $fillable = [
        'kode_distribusi',
        'nomor_bast',
        'ruangan_id',
        'list_distribusi_id',
        'keterangan',
        'status',
        'verifikasi_id',
        'penerima',
        'diinput_oleh',
    ];

    public $timestamps = true;
}
