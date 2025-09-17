<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create demo users with different roles
        $users = [
            [
                'name' => 'Admin User',
                'email' => 'admin@dashcraft.com',
                'password' => Hash::make('password'),
                'is_active' => true,
            ],
            [
                'name' => 'Manager User',
                'email' => 'manager@dashcraft.com',
                'password' => Hash::make('password'),
                'is_active' => true,
            ],
            [
                'name' => 'Viewer User',
                'email' => 'viewer@dashcraft.com',
                'password' => Hash::make('password'),
                'is_active' => true,
            ],
            [
                'name' => 'John Smith',
                'email' => 'john@dashcraft.com',
                'password' => Hash::make('password'),
                'is_active' => true,
            ],
            [
                'name' => 'Sarah Johnson',
                'email' => 'sarah@dashcraft.com',
                'password' => Hash::make('password'),
                'is_active' => false,
            ],
        ];

        foreach ($users as $userData) {
            $user = User::firstOrCreate(
                ['email' => $userData['email']],
                $userData
            );
            
            // Assign roles based on email (only if user doesn't have roles)
            if (!$user->hasAnyRole(['admin', 'manager', 'viewer'])) {
                if ($userData['email'] === 'admin@dashcraft.com') {
                    $user->assignRole('admin');
                } elseif ($userData['email'] === 'manager@dashcraft.com') {
                    $user->assignRole('manager');
                } elseif ($userData['email'] === 'viewer@dashcraft.com') {
                    $user->assignRole('viewer');
                } else {
                    $user->assignRole('manager'); // Default role for other users
                }
            }
        }

        $this->command->info('Users seeded successfully!');
        $this->command->info('Demo credentials:');
        $this->command->info('Admin: admin@dashcraft.com / password');
        $this->command->info('Manager: manager@dashcraft.com / password');
        $this->command->info('Viewer: viewer@dashcraft.com / password');
    }
}