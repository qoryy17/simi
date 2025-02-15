<?php

namespace App\Models\Item;

use App\Models\Room\RoomModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DistributionItemModel extends Model
{
    use HasFactory;
    protected $table = 'simi_distribusi_barang';
    protected $primaryKey = 'id';

    protected $fillable = [
        'kode_distribusi',
        'nomor_bast',
        'ruangan_id',
        'keterangan',
        'status',
        'verifikasi_id',
        'penerima',
        'diinput_oleh',
    ];



    public $timestamps = true;

    public function listDistributionItems(): HasMany
    {
        return $this->hasMany(ListDistributionItemModel::class, 'distribusi_barang_id', 'id');
    }

    public function rooms(): HasMany
    {
        return $this->hasMany(RoomModel::class, 'id', 'ruangan_id');
    }
}
