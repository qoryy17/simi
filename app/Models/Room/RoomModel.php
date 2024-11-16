<?php

namespace App\Models\Room;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
