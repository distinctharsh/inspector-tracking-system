<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $adminRole = Role::create(['name' => 'Admin']);
        $managerRole = Role::create(['name' => 'Manager']);
        $userRole = Role::create(['name' => 'User']);

        // Create Permissions
        Permission::create(['name' => 'view inspectors']);
        Permission::create(['name' => 'edit inspectors']);
        Permission::create(['name' => 'delete inspectors']);


        $adminRole->givePermissionTo(['view inspectors', 'edit inspectors', 'delete inspectors']);
        $managerRole->givePermissionTo(['view inspectors', 'edit inspectors']);
        $userRole->givePermissionTo(['view inspectors']);



        $adminUser = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
        ]);
        $adminUser->assignRole($adminRole);

        $managerUser = User::factory()->create([
            'name' => 'Manager User',
            'email' => 'manager@example.com',
        ]);
        $managerUser->assignRole($managerRole);

        $regularUser = User::factory()->create([
            'name' => 'Regular User',
            'email' => 'user@example.com',
        ]);
        $regularUser->assignRole($userRole);


    }
}
