<?php

namespace Database\Seeders;

use App\Models\UserStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserStatus::query()->updateOrCreate([
            'name'=> 'active',
        ]);
        UserStatus::query()->updateOrCreate([
            'name'=> 'in-active',
        ]);
    }
}
