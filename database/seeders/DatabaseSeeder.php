<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Superadmin',
                'password' => 'password',
                'email_verified_at' => now(),
            ]
        );

        User::factory(3)->withoutTwoFactor()->create();

        $this->call([
            ProductSeeder::class,
        ]);
    }
}
