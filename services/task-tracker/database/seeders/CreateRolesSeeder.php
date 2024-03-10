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
        $adminRole->addPermission('tasks.create');
        $adminRole->addPermission('tasks.shuffle');

        $adminRole->newOwner('Role', 'manager', 'Manager role');
        $adminRole->addPermission('tasks.create');
        $adminRole->addPermission('tasks.shuffle');


        $adminRole->newOwner('Role', 'worker', 'Worker role');
        $adminRole->addPermission('tasks.create');
        $adminRole->addPermission('tasks.view.its');
    }
}
