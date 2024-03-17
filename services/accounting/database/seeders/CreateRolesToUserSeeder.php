<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreateRolesToUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /** @var User $admin */
        $admin = User::query()->find(1);
        $admin->inheritPermissionFrom('Role', 'admin');

        /** @var User $manager */
        $manager = User::query()->find(2);
        $manager->inheritPermissionFrom('Role', 'manager');

        /** @var User $worker */
        $worker = User::query()->find(3);
        $worker->inheritPermissionFrom('Role', 'worker');
    }
}
