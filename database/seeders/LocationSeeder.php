<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('locations')->insert([
            ['name' => 'Purwokerto Selatan', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Purwokerto Utara', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Purwokerto Timur', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Purwokerto Barat', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Purwokerto Kecamatan Sumbang', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Purwokerto Kecamatan Wangon', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Purwokerto Kecamatan Banyumas', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Purwokerto Kecamatan Cilongok', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Purwokerto Kecamatan Ajibarang', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Purwokerto Kecamatan Kembaran', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Purwokerto Kecamatan Rawalo', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Purwokerto Kecamatan Karanglewas', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Purwokerto Kecamatan Sokaraja', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Purwokerto Kecamatan Kedungbanteng', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Purwokerto Kecamatan Lumbir', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Purwokerto Kecamatan Patikraja', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Purwokerto Kecamatan Pekuncen', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
