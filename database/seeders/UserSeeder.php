<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
            'name'              => 'Admin',
            'phone'              => '01742424567',
            'email'             => 'admin@gmail.com',
            'is_admin'           => 1,
            'email_verified_at' => now(),
            'password'          => Hash::make('123456'),
            'remember_token'    => Str::random(10),
            'role_id'           => 1,
            'date_of_birth'     => '1996-09-07',
        ]);

        User::create([
            'name'              => 'Ebrahim',
            'phone'              => '01542424567',
            'email'             => 'ebrahim@gmail.com',
            'email_verified_at' => now(),
            'password'          => Hash::make('123456'),
            'remember_token'    => Str::random(10),
            'role_id'           => 3,
            'date_of_birth'     => '2022-09-07',
        ]);
    }
}
