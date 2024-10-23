<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        $adminRole = Role::create(['name' => 'admin']);
        $productManagerRole = Role::create(['name' => 'product_manager']);
        $productLeaderRole = Role::create(['name' => 'product_leader']);

        $adminRole->givePermissionTo(['product.create', 'product.edit', 'product.update', 'product.view']);
        $productManagerRole->givePermissionTo(['product.view']);
        $productLeaderRole->givePermissionTo(['product.view']);

        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'password' => '123456789',
        ]);
        $admin->assignRole($adminRole);

        $productManager = User::create([
            'name' => 'Product Manager',
            'email' => 'manager@gmail.com',
            'password' => '123456789',
        ]);
        $productManager->assignRole($productManagerRole);

        $productLeader = User::create([
            'name' => 'Product Leader',
            'email' => 'leader@gmail.com',
            'password' => '123456789',
        ]);
        $productLeader->assignRole($productLeaderRole);
    }
}
