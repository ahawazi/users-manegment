<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Seeders\RolePermissionSeeder as SeedersRolePermissionSeeder;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use RolePermissionSeeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([]);
    }
}
