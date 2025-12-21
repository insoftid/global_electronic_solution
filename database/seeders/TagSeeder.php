<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            'Robotics',
            'Quality Control',
            'HMI',
            'SCADA',
            'PLC',
            'IoT',
            'Analytics',
            'Dashboard',
            'Vision System',
            'Automation',
            'Smart Grid',
            'Monitoring',
            'Integration',
            'Industrial',
            'Manufacturing',
        ];

        foreach ($tags as $tagName) {
            Tag::firstOrCreate(
                ['name' => $tagName],
                ['slug' => \Illuminate\Support\Str::slug($tagName)]
            );
        }
    }
}
