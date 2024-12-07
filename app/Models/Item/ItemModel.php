<?php

namespace App\Models\Item;

use App\Models\Verification\VerificationModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ItemModel extends Model
{
    use HasFactory;

    protected $table = 'simi_barang';
    protected $primaryKey = 'id';

    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'jenis',
        'merek',
        'tipe',
        'nomor_seri',
        'ukuran',
        'bahan',
        'jumlah',
        'satuan_barang_id',
        'harga',
        'sumber_dana',
        'kondisi_barang_id',
        'tahun_pengadaan',
        'nomor_kontrak',
        'tanggal_kontrak',
        'file_edoc',
        'status',
        'keterangan',
        'diinput_oleh',
        'verifikasi_id',
        'file_image',
    ];

    public $timestamps = true;

    public function unitItem(): BelongsTo
    {
        return $this->belongsTo(UnitItemModel::class);
    }

    public function conditionItem(): BelongsTo
    {
        return $this->belongsTo(ConditionItemModel::class);
    }

    public function verification(): BelongsTo
    {
        return $this->belongsTo(VerificationModel::class);
    }
}
