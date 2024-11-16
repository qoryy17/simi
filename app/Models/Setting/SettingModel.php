<?php

namespace App\Models\Setting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingModel extends Model
{
    use HasFactory;

    protected $table = 'simi_institusi';
    protected $primaryKey = 'id';

    protected $fillable = [
        'cabdis_provinsi',
        'cabdis_kabupaten',
        'npsn',
        'nama_sekolah',
        'alamat',
        'email',
        'telepon',
        'website',
        'logo'
    ];

    public $timestamps = true;
}
