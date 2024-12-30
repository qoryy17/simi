<?php

namespace App\Models\Item;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListDistributionItemModel extends Model
{
    use HasFactory;
    protected $table = 'simi_list_distribusi_barang';
    protected $primaryKey = 'id';

    protected $fillable = [
        'kode_distribusi',
        'barang_id',
        'kode_barang',
        'catatan',
    ];

    public $timestamps = true;
}
