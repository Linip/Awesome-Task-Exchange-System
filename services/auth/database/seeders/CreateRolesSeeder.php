<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Wnikk\LaravelAccessRules\AccessRules;

class CreateRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = new AccessRules();

        $adminRole->newOwner('Role', 'admin', 'Admin role');
        $adminRole->newOwner('Role', 'manager', 'Manager role');
        $adminRole->newOwner('Role', 'worker', 'Worker role');
    }
}
