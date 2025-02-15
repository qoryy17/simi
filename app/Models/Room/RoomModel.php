<?php

namespace App\Models\Room;

use App\Models\Item\DistributionItemModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RoomModel extends Model
{
    use HasFactory;

    protected $table = 'simi_ruangan';
    protected $primaryKey = 'id';

    protected $fillable = [
        'ruangan',
        'kode_ruangan',
        'keterangan'
    ];

    public $timestamps = true;

    public function distribution(): BelongsTo
    {
        return $this->belongsTo(DistributionItemModel::class, 'ruangan_id', 'id');
    }
}
