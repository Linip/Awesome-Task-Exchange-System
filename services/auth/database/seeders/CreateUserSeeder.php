<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CreateUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'id' => 1,
            'public_id' => '9b876e56-7828-40c2-8f01-65fe04b95a75',
            'name' => 'Admin',
            'email' => 'admin@ates.test',
            'password' => Hash::make('1234'),
        ]);

        DB::table('users')->insert([
            'id' => 2,
            'public_id' => '9b876e56-bed3-4eab-9af4-1f2a9f591a97',
            'name' => 'Manager',
            'email' => 'manger@ates.test',
            'password' => Hash::make('1234'),
        ]);

        DB::table('users')->insert([
            'id' => 3,
            'public_id' => '9b876e57-043b-454a-9c03-31e33b989a68',
            'name' => 'Worker',
            'email' => 'worker@ates.test',
            'password' => Hash::make('1234'),
        ]);
    }
}
