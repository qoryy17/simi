<?php

namespace App\Models\Item;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConditionItemModel extends Model
{
    use HasFactory;
    
    protected $table = 'simi_kondisi_barang';
    protected $primaryKey = 'id';

    protected $fillable = [
        'kondisi',
        'keterangan'
    ];

    public $timestamps = true;
}
