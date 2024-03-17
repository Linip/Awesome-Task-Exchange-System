<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CreateOAuthClients extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('oauth_clients')->insert([
            'id' => '9b878d76-e970-40a8-aca7-1ff74a88df66',
            'user_id' => null,
            'name' => 'Laravel Personal Access Client',
            'secret' => 'eoQLEGbkySsSN95xnpeAAs54SYnuyQ2hWq0GZe8R',
            'provider' => null,
            'redirect' => 'http://localhost',
            'personal_access_client' => 1,
            'password_client' => 0,
            'revoked' => 0,
            'created_at' => '2024-03-10 10:02:42',
            'updated_at' => '2024-03-10 10:02:42',
        ]);
        DB::table('oauth_clients')->insert([
            'id' => '9b878d76-ecca-45e3-ba4c-24d87ae52bdd',
            'user_id' => null,
            'name' => 'Laravel Password Grant Client',
            'secret' => 'SPEqklWJCxOTNIJitvWaLpdQVLV3PAIt4OYtaaWn',
            'provider' => 'users',
            'redirect' => 'http://localhost',
            'personal_access_client' => 0,
            'password_client' => 1,
            'revoked' => 0,
            'created_at' => '2024-03-10 10:02:42',
            'updated_at' => '2024-03-10 10:02:42',
        ]);
        DB::table('oauth_clients')->insert([
            'id' => '9b878ee0-ce59-4602-95df-cf52620b3210',
            'user_id' => null,
            'name' => 'Task tracker',
            'secret' => null,
            'provider' => null,
            'redirect' => 'http://tasks.ates.test:8080/auth/callback',
            'personal_access_client' => 0,
            'password_client' => 0,
            'revoked' => 0,
            'created_at' => '2024-03-10 10:06:39',
            'updated_at' => '2024-03-10 10:06:39',
        ]);
    }
}
