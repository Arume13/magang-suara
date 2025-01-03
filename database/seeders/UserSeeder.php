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
        // $admin = User::query()->updateOrCreate([
        //     'email' => 'admin@mail.com',],
        //     [
        //     'name' => 'admin',
        //     'password' => bcrypt('pass12345'),
        //     'user_status_id' => 1
        // ]);
        // $admin->assignRole('admin');

        $user =  User::query()->updateOrCreate([
                'email' => 'user@mail.com',],
                [
                'name' => 'user',
                'password' => bcrypt('pass12345'),
                'user_status_id' => 1
            ]);
        $user->givePermissionTo('show-user');
    }
}
