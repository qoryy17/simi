<?php

namespace App\Models\Verification;

use App\Models\Item\ItemModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VerificationModel extends Model
{
    use HasFactory;

    protected $table = 'simi_verifikasi';
    protected $primaryKey = 'id';

    protected $fillable = [
        'kode_verifikasi',
        'status',
        'keterangan',
        'verifikator_id'
    ];

    public $timestamps = true;

    public function item(): BelongsTo
    {
        return $this->belongsTo(ItemModel::class);
    }
}
