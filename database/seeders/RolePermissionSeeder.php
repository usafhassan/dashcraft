<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create permissions
        $permissions = [
            // Customer permissions
            'view customers',
            'create customers',
            'edit customers',
            'delete customers',
            'export customers',
            'import customers',
            
            // User permissions
            'view users',
            'create users',
            'edit users',
            'delete users',
            
            // Tag permissions
            'view tags',
            'create tags',
            'edit tags',
            'delete tags',
            
            // Persona permissions
            'view personas',
            'create personas',
            'edit personas',
            'delete personas',
            
            // Dashboard permissions
            'view dashboard',
            'view analytics',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Create roles
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $managerRole = Role::firstOrCreate(['name' => 'manager']);
        $viewerRole = Role::firstOrCreate(['name' => 'viewer']);

        // Assign permissions to roles
        $adminRole->givePermissionTo(Permission::all());
        
        $managerRole->givePermissionTo([
            'view customers',
            'create customers',
            'edit customers',
            'export customers',
            'view users',
            'view tags',
            'create tags',
            'edit tags',
            'view personas',
            'create personas',
            'edit personas',
            'view dashboard',
            'view analytics',
        ]);
        
        $viewerRole->givePermissionTo([
            'view customers',
            'view users',
            'view tags',
            'view personas',
            'view dashboard',
        ]);
    }
}
