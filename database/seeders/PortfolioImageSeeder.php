<?php

namespace Database\Seeders;

use App\Models\PortfolioImage;
use App\Models\Portfolio;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PortfolioImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get portfolios
        $portfolios = Portfolio::all();

        // Add placeholder images for each portfolio
        foreach ($portfolios as $portfolio) {
            // Only seed if no images exist
            if ($portfolio->images()->count() === 0) {
                for ($i = 1; $i <= 3; $i++) {
                    PortfolioImage::create([
                        'portfolio_id' => $portfolio->id,
                        'image_path' => 'portfolios/placeholder.jpg', // Placeholder, will be replaced via admin
                        'caption' => "Gambar {$i} - {$portfolio->title}",
                        'display_order' => $i,
                    ]);
                }
            }
        }
    }
}
