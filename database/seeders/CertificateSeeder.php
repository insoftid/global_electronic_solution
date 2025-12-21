<?php

namespace Database\Seeders;

use App\Models\Certificate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CertificateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $certificates = [
            [
                'name' => 'ISO 9001:2015',
                'image_path' => 'certificates/placeholder.jpg',
                'description' => 'Sertifikasi Sistem Manajemen Mutu',
                'display_order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'ISO 14001:2015',
                'image_path' => 'certificates/placeholder.jpg',
                'description' => 'Sertifikasi Sistem Manajemen Lingkungan',
                'display_order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'OHSAS 18001',
                'image_path' => 'certificates/placeholder.jpg',
                'description' => 'Sertifikasi Keselamatan dan Kesehatan Kerja',
                'display_order' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'Sertifikat TKDN',
                'image_path' => 'certificates/placeholder.jpg',
                'description' => 'Tingkat Komponen Dalam Negeri',
                'display_order' => 4,
                'is_active' => true,
            ],
            [
                'name' => 'Sertifikat Kompetensi Teknik',
                'image_path' => 'certificates/placeholder.jpg',
                'description' => 'Sertifikasi Kompetensi dari BNSP',
                'display_order' => 5,
                'is_active' => true,
            ],
        ];

        foreach ($certificates as $certificate) {
            Certificate::firstOrCreate(
                ['name' => $certificate['name']],
                $certificate
            );
        }
    }
}
