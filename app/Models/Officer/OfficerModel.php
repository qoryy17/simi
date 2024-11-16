<?php

namespace App\Models\Officer;

use App\Models\Position\PositionModel;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class OfficerModel extends Model
{
    use HasFactory;

    protected $table = 'simi_pegawai';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nip',
        'nama',
        'jabatan_id',
        'status'
    ];

    public $timestamps = true;

    public function positions(): HasOne
    {
        return $this->hasOne(PositionModel::class);
    }

    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
