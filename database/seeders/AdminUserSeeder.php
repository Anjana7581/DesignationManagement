<?php



namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User; // Ensure you have the correct User model namespace
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => env('ADMIN_EMAIL', 'admin@example.com')], // Ensures idempotency
            [
                'name' => 'Admin',
                'password' => Hash::make(env('ADMIN_PASSWORD', 'admin123')), // Secure password
                'is_admin' => 1, // Ensure you have this field in your users table
                'status' => 1, // Active admin user
            ]
        );
    }
}

