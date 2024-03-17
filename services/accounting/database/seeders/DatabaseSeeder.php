<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->callOnce(CreateUserSeeder::class);
        $this->callOnce(CreateRulesSeeder::class);
        $this->callOnce(CreateRolesSeeder::class);
        $this->callOnce(CreateRolesToUserSeeder::class);
        $this->callOnce(TaskSeeder::class);
    }
}
