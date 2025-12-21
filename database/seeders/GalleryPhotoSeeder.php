<?php

namespace Database\Seeders;

use App\Models\GalleryPhoto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GalleryPhotoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $slots = [
            [
                'slot_key' => 'hero_landing',
                'label' => 'Hero — Beranda',
                'image_path' => null, // Will be uploaded via admin
                'caption' => null,
                'placement_description' => 'Ditampilkan di hero halaman Landing Page',
            ],
            [
                'slot_key' => 'hero_portfolio',
                'label' => 'Hero — Produk',
                'image_path' => null,
                'caption' => null,
                'placement_description' => 'Ditampilkan di hero halaman Portfolio',
            ],
            [
                'slot_key' => 'hero_contact',
                'label' => 'Hero — Kontak',
                'image_path' => null,
                'caption' => null,
                'placement_description' => 'Ditampilkan di hero halaman Contact',
            ],
            [
                'slot_key' => 'about_1',
                'label' => 'Tentang Kami',
                'image_path' => null,
                'caption' => null,
                'placement_description' => 'Ditampilkan pada bagian Tentang Kami',
            ],
            [
                'slot_key' => 'about_2',
                'label' => 'Visi Misi — Gambar 1',
                'image_path' => null,
                'caption' => null,
                'placement_description' => 'Ditampilkan pada bagian Visi Misi (posisi 1)',
            ],
            [
                'slot_key' => 'about_3',
                'label' => 'Visi Misi — Gambar 2',
                'image_path' => null,
                'caption' => null,
                'placement_description' => 'Ditampilkan pada bagian Visi Misi (posisi 2)',
            ],
        ];

        foreach ($slots as $slot) {
            GalleryPhoto::firstOrCreate(
                ['slot_key' => $slot['slot_key']],
                $slot
            );
        }
    }
}
