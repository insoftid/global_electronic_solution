<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            // Identitas Perusahaan
            'company_name' => 'CV. Global Electronic Solution',
            'tagline' => 'Solusi Sistem Elektrikal Modern untuk Industri Indonesia',
            'logo' => null,
            'favicon' => null,

            // Tentang Kami
            'about_description' => 'CV. Global Electronic Solution adalah perusahaan yang berfokus pada riset dan inovasi sistem elektrikal. Berbasis di Semarang, kami membantu klien merancang, mengintegrasikan, dan mengoptimalkan sistem elektronika serta solusi otomasi yang efisien dan andal.',
            'about_vision' => 'Menjadi perusahaan terdepan dalam solusi sistem elektrikal dan otomasi industri di Indonesia, dengan fokus pada inovasi teknologi dan kepuasan pelanggan.',
            'about_mission' => "1. Menyediakan solusi sistem elektrikal yang inovatif dan berkualitas tinggi\n2. Membangun kemitraan jangka panjang dengan klien melalui layanan terbaik\n3. Mengembangkan SDM yang kompeten dan profesional\n4. Berkontribusi pada kemajuan teknologi industri nasional",
            'quality_policy' => 'Kami berkomitmen untuk menyediakan produk dan layanan berkualitas tinggi yang memenuhi standar internasional, dengan fokus pada kepuasan pelanggan dan perbaikan berkelanjutan.',

            // Kontak
            'email' => 'info@globalelectronicsolution.com',
            'whatsapp' => '+6281234567890',
            'phone' => '+62248765432',
            'address' => 'Perum Jl. Beringin Asri, RT 06/RW 12, Wonosari, Kec. Ngaliyan, Kota Semarang, Jawa Tengah, 50244',
            'google_maps_url' => 'https://maps.google.com/maps?width=535&height=400&hl=en&q=CV%20GLOBAL%20ELECTRONIC%20SOLUTION%2C%20Semarang&t=&z=14&ie=UTF8&iwloc=B&output=embed',

            // Social Media
            'instagram_url' => 'https://instagram.com/globalelectronicsolution',
            'facebook_url' => 'https://facebook.com/globalelectronicsolution',
            'youtube_url' => 'https://youtube.com/@globalelectronicsolution',
            'tiktok_url' => 'https://tiktok.com/@globalelectronicsolution',

            // Section Visibility
            'section_portfolio_active' => '1',
            'section_certificate_active' => '1',
            'section_partner_active' => '1',
        ];

        foreach ($settings as $key => $value) {
            SiteSetting::set($key, $value);
        }
    }
}
