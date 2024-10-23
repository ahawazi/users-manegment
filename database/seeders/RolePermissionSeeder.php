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
        // Create roles
        $adminRole = Role::create(['name' => 'admin']);
        $productManagerRole = Role::create(['name' => 'product_manager']);
        $productLeaderRole = Role::create(['name' => 'product_leader']);

        // Define permissions
        Permission::create(['name' => 'product.create']);
        Permission::create(['name' => 'product.edit']);
        Permission::create(['name' => 'product.update']);
        Permission::create(['name' => 'product.view']);

        // Assign permissions to roles
        $adminRole->givePermissionTo(['product.create', 'product.edit', 'product.update', 'product.view']);
        $productManagerRole->givePermissionTo(['product.view']);
        $productLeaderRole->givePermissionTo(['product.view']);

        // Create admin user
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'password' => '123456789', // Default password
        ]);
        $admin->assignRole($adminRole);

        // Create product manager user
        $productManager = User::create([
            'name' => 'Product Manager',
            'email' => 'manager@gmail.com',
            'password' => '123456789', // Default password
        ]);
        $productManager->assignRole($productManagerRole);

        // Create product leader user
        $productLeader = User::create([
            'name' => 'Product Leader',
            'email' => 'leader@gmail.com',
            'password' => '123456789', // Default password
        ]);
        $productLeader->assignRole($productLeaderRole);
    }
}

