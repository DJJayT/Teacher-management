<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [];

        $users[] = [
            'id' => 1,
            'name' => 'Jason',
            'email' => 'kontakt@djja.yt',
            'password' => Hash::make('password'),
            'abbreviation' => 1,
        ];

        $users[] = [
            'id' => 2,
            'name' => 'Eric',
            'email' => 'info@ericevanengelhardt.ovh',
            'password' => Hash::make('password'),
            'abbreviation' => 1,
        ];

        $users[] = [
            'id' => 3,
            'name' => 'Christine',
            'email' => 'dragonica.minecraft@web.de',
            'password' => Hash::make('password'),
            'abbreviation' => 1,
        ];

        User::insert($users);
    }
}
