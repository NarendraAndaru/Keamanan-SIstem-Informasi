<?php

namespace Database\Seeders;

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
        // Seeder Akun Admin Keamanan
        User::factory()->create([
            'name' => 'Admin Keamanan',
            'email' => 'admin@keamanansi.test',
            'password' => bcrypt('AdminKeamanan123!'), // Memenuhi kriteria password kuat
            'role' => \App\Enums\Role::ADMIN,
            'email_verified_at' => now(), // Bypass verifikasi email untuk testing
        ]);

        // Seeder Akun User Biasa
        User::factory()->create([
            'name' => 'User Biasa',
            'email' => 'user@keamanansi.test',
            'password' => bcrypt('UserBiasa123!'), // Memenuhi kriteria password kuat
            'role' => \App\Enums\Role::USER,
            'email_verified_at' => now(), // Bypass verifikasi email untuk testing
        ]);
    }
}
