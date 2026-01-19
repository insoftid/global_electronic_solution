<?php

namespace Database\Seeders;

use App\Models\ContactMessage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactMessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $messages = [
            [
                'name' => 'Indira Sari',
                'email' => 'indira@indofood.co.id',
                'subject' => 'Permintaan presentasi sistem otomasi',
                'message' => 'Halo tim Global Electronic Solution, kami tertarik untuk menjadwalkan presentasi terkait solusi otomasi lini produksi di pabrik kami di Kendal. Mohon info jadwal yang tersedia dalam dua minggu ke depan.',
                'status' => 'Baru',
                'ip_address' => '192.168.1.100',
            ],
            [
                'name' => 'Dr. Bambang Susilo',
                'email' => 'bambang@putrakaryabaja.co.id',
                'subject' => 'Update progres integrasi panel kontrol',
                'message' => 'Mohon update terkait progres integrasi panel kontrol untuk project kami. Apakah sudah bisa dilakukan uji coba minggu ini?',
                'status' => 'Dibaca',
                'ip_address' => '192.168.1.101',
            ],
            [
                'name' => 'Theresia Kartika W.',
                'email' => 'theresia@indonesianpeoplepower.com',
                'subject' => 'Diskusi awal pengembangan sistem monitoring energi',
                'message' => 'Kami ingin diskusi awal tentang sistem monitoring energi. Apakah bisa dijadwalkan meeting online?',
                'status' => 'Dibaca',
                'ip_address' => '192.168.1.102',
            ],
            [
                'name' => 'Arief Khristanto',
                'email' => 'arief@bkfoundation.org',
                'subject' => 'Kolaborasi riset pengelolaan energi',
                'message' => 'Kami tertarik kolaborasi riset pengelolaan energi untuk fasilitas pengolahan sampah. Mohon info PIC untuk koordinasi.',
                'status' => 'Dibalas',
                'admin_notes' => 'Sudah dihubungi via email dan dijadwalkan meeting tanggal 15 Januari 2026.',
                'ip_address' => '192.168.1.103',
            ],
        ];

        foreach ($messages as $message) {
            ContactMessage::firstOrCreate(
                ['email' => $message['email'], 'subject' => $message['subject']],
                array_merge($message, ['created_at' => now()->subDays(rand(1, 30))])
            );
        }
    }
}
