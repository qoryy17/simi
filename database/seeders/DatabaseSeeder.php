<?php

namespace Database\Seeders;

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
    }
}
