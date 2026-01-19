<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create Admin Users
        User::firstOrCreate(
            ['email' => 'admin@globalelectronic.com'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('admin123'),
                'role' => 'Superadmin',
                'status' => 'Aktif',
            ]
        );

        User::firstOrCreate(
            ['email' => 'editor@globalelectronic.com'],
            [
                'name' => 'Editor',
                'password' => Hash::make('editor123'),
                'role' => 'Editor',
                'status' => 'Aktif',
            ]
        );

        // 2. Run all seeders in correct order
        $this->call([
            // Site settings first (no dependencies)
            SiteSettingSeeder::class,
            GalleryPhotoSeeder::class,

            // Categories and Tags before Portfolio
            CategorySeeder::class,
            TagSeeder::class,

            // Portfolio depends on Categories and Tags
            PortfolioSeeder::class,
            PortfolioImageSeeder::class,

            // Independent seeders
            CertificateSeeder::class,
            PartnerSeeder::class,
            ContactMessageSeeder::class,
        ]);
    }
}
