<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@todolist.local'],
            [
                'name' => 'Admin',
                'password' => env('APP_LOGIN_PASSWORD', 'password'),
            ],
        );
    }
}
