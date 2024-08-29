<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DummyUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userData = [[
            'name'=> 'Mas Dimas',
            'email'=>'dimas@gmail.com',
            'role'=>'user',
            'password'=>bcrypt('123')
        ],[
            'name'=> 'Mas Admin',
            'email'=>'admin@gmail.com',
            'role'=>'admin',
            'password'=>bcrypt('123')
        ],[
            'name'=> 'Mas Owner',
            'email'=>'owner@gmail.com',
            'role'=>'owner',
            'password'=>bcrypt('123')
        ]
        ];

        foreach ($userData as $key => $val) {
            User::create($val);
        }
    }
}
