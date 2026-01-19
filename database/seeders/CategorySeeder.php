<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Automation',
                'slug' => 'automation',
                'description' => 'Sistem otomasi industri dan lini produksi',
            ],
            [
                'name' => 'Control System',
                'slug' => 'control-system',
                'description' => 'Solusi SCADA, PLC, dan sistem kontrol terintegrasi',
            ],
            [
                'name' => 'Energy',
                'slug' => 'energy',
                'description' => 'Platform monitoring dan manajemen energi',
            ],
            [
                'name' => 'Optimization',
                'slug' => 'optimization',
                'description' => 'Optimasi proses produksi dan efisiensi',
            ],
            [
                'name' => 'Smart Grid',
                'slug' => 'smart-grid',
                'description' => 'Integrasi smart meter dan grid cerdas',
            ],
            [
                'name' => 'IoT Solutions',
                'slug' => 'iot-solutions',
                'description' => 'Solusi Internet of Things untuk industri',
            ],
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate(
                ['slug' => $category['slug']],
                $category
            );
        }
    }
}
