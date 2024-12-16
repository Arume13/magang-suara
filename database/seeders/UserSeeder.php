<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            User ::query()->withTrashed()->firstOrCreate([
            'email' => $i.'@example.com',
            ],[
                'name' => $i,
                'user_status_id' => 1,
                'password' => Hash::make('password'),
            ]);
        }
    }
}
