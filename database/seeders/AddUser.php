<?php

namespace Database\Seeders;

use App\Models\Requester;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AddUser extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            'ein' => '0003',
            'name' => 'Usman',
            'email' => 'usman@gmail.com',
            'password' => Hash::make('admin123'),
            'role' => 'requester',
            'image' => 'default.jpg'
        ]);

        Requester::insert([
            'user_ein' => '0003',
            'name' => 'Usman',
        ]);
    }
}
