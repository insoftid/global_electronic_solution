<?php

namespace Database\Seeders;

use App\Models\Partner;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PartnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $partners = [
            [
                'name' => 'PT. Indofood Sukses Makmur',
                'logo_path' => 'partners/placeholder.jpg',
                'website_url' => 'https://www.indofood.com',
                'description' => 'Mitra strategis untuk solusi otomasi industri makanan',
                'display_order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'PLN Indonesia',
                'logo_path' => 'partners/placeholder.jpg',
                'website_url' => 'https://www.pln.co.id',
                'description' => 'Kerjasama smart grid dan monitoring energi',
                'display_order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Universitas Diponegoro',
                'logo_path' => 'partners/placeholder.jpg',
                'website_url' => 'https://www.undip.ac.id',
                'description' => 'Partner riset dan pengembangan teknologi',
                'display_order' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'Schneider Electric',
                'logo_path' => 'partners/placeholder.jpg',
                'website_url' => 'https://www.se.com',
                'description' => 'Authorized partner untuk solusi automation',
                'display_order' => 4,
                'is_active' => true,
            ],
            [
                'name' => 'Siemens Indonesia',
                'logo_path' => 'partners/placeholder.jpg',
                'website_url' => 'https://www.siemens.co.id',
                'description' => 'Partner untuk solusi industri 4.0',
                'display_order' => 5,
                'is_active' => true,
            ],
        ];

        foreach ($partners as $partner) {
            Partner::firstOrCreate(
                ['name' => $partner['name']],
                $partner
            );
        }
    }
}
