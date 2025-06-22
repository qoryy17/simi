<?php

namespace Database\Seeders;

use App\Models\Item\ConditionItemModel;
use App\Models\Item\UnitItemModel;
use App\Models\Officer\OfficerModel;
use App\Models\Position\PositionModel;
use App\Models\Room\RoomModel;
use App\Models\Setting\SettingModel;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            'name' => 'SIMI',
            'email' => 'superadmin@simi.local',
            'email_verified_at' => now(),
            'password' => Hash::make('123'),
            'remember_token' => Str::random(10),
            'role' => 'Superadmin',
            'blokir' => 'T'
        ]);

        SettingModel::create([
            'cabdis_provinsi' => 'Sumatera Utara',
            'cabdis_kabupaten' => 'Lubuk Pakam',
            'npsn' => '000000',
            'nama_sekolah' => 'SMK NEGERI 1 BERINGIN',
            'alamat' => 'Jl Pendidikan No 3 Emplasemen Kuala Namu',
            'email' => 'info@smkn1beringin.sch.id',
            'telepon' => '000-0000',
            'website' => 'smkn1beringin.sch.id',
        ]);

        RoomModel::create([
            'ruangan' => 'Perpustakaan',
            'kode_ruangan' => 'R001',
            'keterangan' => 'Ruang Perpustakaan Sekolah',
        ]);
        RoomModel::create([
            'ruangan' => 'Laboratorium Komputer',
            'kode_ruangan' => 'R002',
            'keterangan' => 'Ruang Laboratorium Komputer',
        ]);
        RoomModel::create([
            'ruangan' => 'Ruang Kelas 10',
            'kode_ruangan' => 'R003',
            'keterangan' => 'Ruang Kelas untuk Siswa Kelas 10',
        ]);

        ConditionItemModel::create([
            'kondisi' => 'Baik',
            'keterangan' => 'Barang dalam kondisi baik dan layak digunakan',
        ]);
        ConditionItemModel::create([
            'kondisi' => 'Rusak',
            'keterangan' => 'Barang dalam kondisi rusak dan tidak layak digunakan',
        ]);

        ConditionItemModel::create([
            'kondisi' => 'Perlu Perbaikan',
            'keterangan' => 'Barang dalam kondisi perlu perbaikan sebelum digunakan',
        ]);

        UnitItemModel::create([
            'satuan' => 'Unit',
            'keterangan' => 'Satuan untuk menghitung jumlah barang',
        ]);
        UnitItemModel::create([
            'satuan' => 'Pcs',
            'keterangan' => 'Satuan untuk menghitung jumlah barang per item',
        ]);
        UnitItemModel::create([
            'satuan' => 'Set',
            'keterangan' => 'Satuan untuk menghitung jumlah barang dalam satu set',
        ]);
        UnitItemModel::create([
            'satuan' => 'Lembar',
            'keterangan' => 'Satuan untuk menghitung jumlah barang per lembar',
        ]);
        UnitItemModel::create([
            'satuan' => 'Botol',
            'keterangan' => 'Satuan untuk menghitung jumlah barang dalam botol',
        ]);
        UnitItemModel::create([
            'satuan' => 'Kg',
            'keterangan' => 'Satuan untuk menghitung berat barang dalam kilogram',
        ]);
        UnitItemModel::create([
            'satuan' => 'Liter',
            'keterangan' => 'Satuan untuk menghitung volume barang dalam liter',
        ]);
        UnitItemModel::create([
            'satuan' => 'Box',
            'keterangan' => 'Satuan untuk menghitung panjang barang dalam box',
        ]);

        PositionModel::create([
            'jabatan' => 'Kepala Sekolah',
            'kode_jabatan' => 'J001',
            'keterangan' => 'Jabatan Kepala Sekolah',
        ]);
        PositionModel::create([
            'jabatan' => 'Wakil Kepala Sekolah',
            'kode_jabatan' => 'J002',
            'keterangan' => 'Jabatan Wakil Kepala Sekolah',
        ]);
        PositionModel::create([
            'jabatan' => 'Guru Produktif',
            'kode_jabatan' => 'J003',
            'keterangan' => 'Jabatan Guru Produktif',
        ]);

        PositionModel::create([
            'jabatan' => 'Guru Normatif',
            'kode_jabatan' => 'J004',
            'keterangan' => 'Jabatan Guru Normatif',
        ]);

        OfficerModel::create([
            'nip' => '1234567890',
            'nama' => 'Budi Santoso',
            'jabatan_id' => 1, // Kepala Sekolah
            'status' => 'Aktif',
        ]);

        OfficerModel::create([
            'nip' => '0987654321',
            'nama' => 'Siti Aminah',
            'jabatan_id' => 2, // Wakil Kepala Sekolah
            'status' => 'Aktif',
        ]);

        OfficerModel::create([
            'nip' => '1122334455',
            'nama' => 'Andi Wijaya',
            'jabatan_id' => 3, // Guru Produktif
            'status' => 'Aktif',
        ]);

        OfficerModel::create([
            'nip' => '5566778899',
            'nama' => 'Rina Sari',
            'jabatan_id' => 4, // Guru Normatif
            'status' => 'Aktif',
        ]);

        User::create([
            'name' => 'Rina Sari',
            'email' => 'rinasari@simi.local',
            'email_verified_at' => now(),
            'password' => Hash::make('rinasari'),
            'remember_token' => Str::random(10),
            'pegawai_id' => 4, // Rina Sari
            'role' => 'Verifikator',
            'blokir' => 'T'
        ]);
        User::create([
            'name' => 'Andi Wijaya',
            'email' => 'andiwijaya@simi.local',
            'email_verified_at' => now(),
            'password' => Hash::make('andiwijaya'),
            'remember_token' => Str::random(10),
            'pegawai_id' => 3, // Andi Wijaya
            'role' => 'Operator',
            'blokir' => 'T'
        ]);
    }
}
