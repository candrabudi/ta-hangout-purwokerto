<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'full_name' => 'Nur Laeli Agustina',
                'username' => 'admin',
                'password' => Hash::make('adminpassword'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
