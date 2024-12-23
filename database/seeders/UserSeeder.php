<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
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
        User::truncate();
        User::create([
            'name' => 'Admin',
            'level' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin'),
            'remember_token' => Str::random(60),
        ]);
        User::create([
            'name' => 'Karyawan',
            'level' => 'karyawan',
            'email' => 'karyawan@gmail.com',
            'password' => bcrypt('karyawan'),
            'remember_token' => Str::random(60),
        ]);
    }
}
