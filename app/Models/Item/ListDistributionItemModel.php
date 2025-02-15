<?php

namespace App\Models\Item;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ListDistributionItemModel extends Model
{
    use HasFactory;
    protected $table = 'simi_list_distribusi_barang';
    protected $primaryKey = 'id';

    protected $fillable = [
        'distribusi_barang_id',
        'barang_id',
        'kode_barang',
        'catatan',
    ];

    public $timestamps = true;

    public function distributionItem(): BelongsTo
    {
        return $this->belongsTo(DistributionItemModel::class, 'distribusi_barang_id');
    }
    public function items(): BelongsTo
    {
        return $this->belongsTo(ItemModel::class, 'kode_barang', 'kode_barang');
    }
}
