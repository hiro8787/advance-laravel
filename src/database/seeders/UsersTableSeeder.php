<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [];
        for ($i = 0; $i < 5; $i++) {
            $users[] = [
                'name' => Str::random(10),
                'email' => Str::random(10).'@example.com',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'verification_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
                'role' => 'user',
            ];
        }
        $users[] = [
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'verification_token' => null,
            'created_at' => now(),
            'updated_at' => now(),
            'role' => 'admin',
        ];
        $users[] = [
            'name' => 'Representative User',
            'email' => 'representative@example.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'verification_token' => null,
            'created_at' => now(),
            'updated_at' => now(),
            'role' => 'representative',
        ];

        DB::table('users')->insert($users);
    }
}
