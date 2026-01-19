<?php

namespace Database\Seeders;

use App\Models\Portfolio;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PortfolioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $portfolios = [
            [
                'title' => 'Automated Production Line',
                'subtitle' => 'Indofood Manufacturing',
                'slug' => 'automated-production-line',
                'description' => 'Sistem otomatis lini produksi makanan dengan kontrol kualitas terintegrasi dan efisiensi maksimal.',
                'detail' => "Proyek ini melibatkan perancangan dan implementasi sistem otomasi lini produksi untuk pabrik makanan PT. Indofood di Semarang.\n\n**Scope Pekerjaan:**\n- Desain sistem kontrol terintegrasi\n- Instalasi PLC dan HMI\n- Integrasi quality control vision system\n- Training operator dan teknisi\n\n**Hasil:**\n- Peningkatan efisiensi produksi sebesar 35%\n- Pengurangan reject rate dari 5% menjadi 1.2%\n- ROI tercapai dalam 18 bulan",
                'category_slug' => 'automation',
                'tags' => ['Robotics', 'Quality Control', 'HMI'],
                'is_featured' => true,
                'display_order' => 1,
            ],
            [
                'title' => 'Industrial Control System',
                'subtitle' => 'PT. Teknologi Nusantara',
                'slug' => 'industrial-control-system',
                'description' => 'Solusi SCADA dan PLC terintegrasi untuk monitoring dan optimasi proses industri.',
                'detail' => "Implementasi sistem SCADA untuk monitoring real-time proses produksi di pabrik chemical.\n\n**Fitur Utama:**\n- Real-time monitoring 24/7\n- Alarm management system\n- Historical data trending\n- Report generation otomatis",
                'category_slug' => 'control-system',
                'tags' => ['SCADA', 'PLC'],
                'is_featured' => true,
                'display_order' => 2,
            ],
            [
                'title' => 'Energy Monitoring Platform',
                'subtitle' => 'GreenEnergy Co',
                'slug' => 'energy-monitoring-platform',
                'description' => 'Platform monitoring energi realtime untuk pengurangan konsumsi dan optimasi biaya.',
                'detail' => "Pengembangan platform monitoring energi berbasis IoT untuk gedung perkantoran.\n\n**Teknologi:**\n- Smart meter integration\n- Cloud-based analytics\n- Mobile app monitoring\n- AI-powered recommendations",
                'category_slug' => 'energy',
                'tags' => ['IoT', 'Analytics', 'Dashboard'],
                'is_featured' => true,
                'display_order' => 3,
            ],
            [
                'title' => 'Packaging Optimization',
                'subtitle' => 'PT. Sukses Pack',
                'slug' => 'packaging-optimization',
                'description' => 'Optimasi proses pengepakan dengan vision system untuk menurunkan reject rate.',
                'detail' => "Implementasi vision system untuk quality control otomatis pada lini packaging.",
                'category_slug' => 'optimization',
                'tags' => ['Vision System', 'Automation'],
                'is_featured' => false,
                'display_order' => 4,
            ],
            [
                'title' => 'Smart Meter Integration',
                'subtitle' => 'PLN Distribusi Jateng',
                'slug' => 'smart-meter-integration',
                'description' => 'Integrasi smart meter untuk analitik konsumsi dan penghematan biaya.',
                'detail' => "Proyek integrasi smart meter untuk pelanggan industri PLN wilayah Jawa Tengah.",
                'category_slug' => 'smart-grid',
                'tags' => ['IoT', 'Smart Grid', 'Monitoring'],
                'is_featured' => false,
                'display_order' => 5,
            ],
            [
                'title' => 'Factory IoT Dashboard',
                'subtitle' => 'PT. Manufaktur Indonesia',
                'slug' => 'factory-iot-dashboard',
                'description' => 'Dashboard IoT untuk monitoring mesin produksi secara real-time.',
                'detail' => "Pengembangan dashboard IoT untuk monitoring OEE (Overall Equipment Effectiveness) di pabrik manufaktur.",
                'category_slug' => 'iot-solutions',
                'tags' => ['IoT', 'Dashboard', 'Manufacturing'],
                'is_featured' => false,
                'display_order' => 6,
            ],
        ];

        foreach ($portfolios as $data) {
            // Find category
            $category = Category::where('slug', $data['category_slug'])->first();
            
            // Create portfolio
            $portfolio = Portfolio::firstOrCreate(
                ['slug' => $data['slug']],
                [
                    'title' => $data['title'],
                    'subtitle' => $data['subtitle'],
                    'description' => $data['description'],
                    'detail' => $data['detail'],
                    'category_id' => $category?->id,
                    'is_featured' => $data['is_featured'],
                    'display_order' => $data['display_order'],
                    'is_active' => true,
                    'project_date' => now()->subMonths(rand(1, 24)),
                ]
            );

            // Attach tags
            $tagIds = Tag::whereIn('name', $data['tags'])->pluck('id');
            $portfolio->tags()->syncWithoutDetaching($tagIds);
        }
    }
}
