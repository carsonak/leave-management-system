<?php

namespace Database\Seeders;

use App\Models\LeaveRequest;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'is_admin' => true,
        ]);

        $user = User::create([
            'name' => 'Normal User',
            'email' => 'user@example.com',
            'password' => bcrypt('password'),
            'is_admin' => false,
        ]);

        // Generate Sanctum tokens
        $adminToken = $admin->createToken('admin-token')->plainTextToken;
        $userToken = $user->createToken('user-token')->plainTextToken;

        $this->command->info('');
        $this->command->info('=== API Tokens (save these for testing) ===');
        $this->command->info("Admin Token: {$adminToken}");
        $this->command->info("User  Token: {$userToken}");
        $this->command->info('==========================================');
        $this->command->info('');

        // Create dummy leave requests for the normal user
        LeaveRequest::create([
            'user_id' => $user->id,
            'start_date' => now()->addDays(5)->toDateString(),
            'end_date' => now()->addDays(7)->toDateString(),
            'reason' => 'Family vacation',
            'status' => 'pending',
        ]);

        LeaveRequest::create([
            'user_id' => $user->id,
            'start_date' => now()->addDays(15)->toDateString(),
            'end_date' => now()->addDays(16)->toDateString(),
            'reason' => 'Medical appointment',
            'status' => 'pending',
        ]);

        LeaveRequest::create([
            'user_id' => $user->id,
            'start_date' => now()->addDays(30)->toDateString(),
            'end_date' => now()->addDays(32)->toDateString(),
            'reason' => 'Personal errands',
            'status' => 'approved',
        ]);
    }
}
