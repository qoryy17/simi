<?php

namespace App\Models\Borrow;

use App\Models\Officer\OfficerModel;
use App\Models\Room\RoomModel;
use Illuminate\Database\Eloquent\Model;

class BorrowingItemModel extends Model
{
    protected $table = 'simi_peminjaman_barang';
    protected $primaryKey = 'id';
    protected $fillable = [
        'kode_peminjaman',
        'durasi',
        'tanggal_peminjaman',
        'tanggal_pengembalian',
        'ruangan_id',
        'pegawai_id',
        'status',
        'keterangan',
        'file_qrcode',
        'diinput_oleh'
    ];

    public function room()
    {
        return $this->belongsTo(RoomModel::class, 'ruangan_id');
    }

    public function officer()
    {
        return $this->belongsTo(OfficerModel::class, 'pegawai_id');
    }
}
