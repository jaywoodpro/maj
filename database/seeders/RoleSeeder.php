<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdmin = Role::create(['name' => 'super_admin']);
        $admin = Role::create(['name' => 'admin']);
        $vendor = Role::create(['name' => 'vendor']);
        $proUser = Role::create(['name' => 'pro_user']);
        $user = Role::create(['name' => 'user']);
        $superAdminUser = \App\Models\User::factory()->create([
            'name' => 'محمد جواد',
            'last_name' => 'قانع دستجردی',
            'email' => 'info@modernandishan.ir',
            'password' => bcrypt('1qazxsw2'), // مطمئن شوید پسورد قوی است
        ]);
        $superAdminUser->assignRole($superAdmin);
    }
}
