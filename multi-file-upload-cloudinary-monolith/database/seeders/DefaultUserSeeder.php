<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DefaultUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'id'=> 1,
                'name'=> 'Admin',
                'email'=> 'admin@gmail.com',
                'password'=> Hash::make('password'),
                'role'=> 'admin'
            ],
            [
                'id'=> 2,
                'name'=> 'Alex',
                'email'=> 'alex@gmail.com',
                'password'=> Hash::make('password'),
                'role'=> 'user'
            ]
        ];

        User::insert($users);
    }
}
