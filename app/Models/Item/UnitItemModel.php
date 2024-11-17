<?php

namespace App\Models\Item;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnitItemModel extends Model
{
    use HasFactory;

    protected $table = 'simi_satuan_barang';
    protected $primaryKey = 'id';

    protected $fillable = [
        'satuan',
        'keterangan'
    ];

    public $timestamps = true;
}
