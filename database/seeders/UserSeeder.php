<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Santhanakumar Pitchai',
                'email' => 'sk@sk.com',
                'password' => 'sk@12345',
                'usertype' => 'admin',
            ],
            [
                'name' => 'Prasanth Jayakumar',
                'email' => 'jp@jp.com',
                'password' => 'jp@12345',
                'usertype' => 'user',
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
