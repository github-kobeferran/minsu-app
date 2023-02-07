<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'super admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'employer',
            'email' => 'employer@admin.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'alumni',
            'email' => 'alumni@admin.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
        ]);
    }
}
