<?php

namespace App\Models\Position;

use App\Models\Officer\OfficerModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PositionModel extends Model
{
    use HasFactory;

    protected $table = 'simi_jabatan';
    protected $primaryKey = 'id';

    protected $fillable = [
        'jabatan',
        'kode_jabatan',
        'keterangan',
    ];

    public $timestamps = true;

    public function officers(): BelongsTo
    {
        return $this->belongsTo(OfficerModel::class);
    }
}
