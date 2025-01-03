<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       Permission::create(['name'=>'add-user']);
       Permission::create(['name'=>'edit-user']);
       Permission::create(['name'=>'delete-user']);
       Permission::create(['name'=>'show-user']);

       Permission::create(['name'=>'add-avatar']);
       Permission::create(['name'=>'edit-avatar']);
       Permission::create(['name'=>'show-avatar']);

       Role::create(['name'=>'admin']);
       Role::create(['name'=>'user']);

       $roleAdmin = Role::findByName('admin');
       $roleAdmin->givePermissionTo('add-user');
       $roleAdmin->givePermissionTo('edit-user');
       $roleAdmin->givePermissionTo('delete-user');
       $roleAdmin->givePermissionTo('show-user');
       

       $roleUser = Role::findByName('user');
       $roleUser->givePermissionTo('add-avatar');
       $roleUser->givePermissionTo('edit-avatar');
       $roleUser->givePermissionTo('show-avatar');
    //    $roleUser->givePermissionTo('add-avatar');
    }
}
