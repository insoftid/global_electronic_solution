<?php

namespace Database\Seeders;

use App\Models\Portfolio;
use App\Models\PortfolioVariant;
use App\Models\PortfolioVariantImage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PortfolioVariantSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil beberapa portfolio sebagai sampel
        $portfolios = Portfolio::take(3)->get();

        foreach ($portfolios as $portfolio) {
            // Buat 2 varian contoh jika belum ada
            if ($portfolio->variants()->count() === 0) {
                $variantsData = [
                    [
                        'name' => 'Tipe A',
                        'slug' => $portfolio->slug . '-tipe-a',
                        'description' => 'Varian Tipe A untuk ' . $portfolio->title,
                        'display_order' => 1,
                    ],
                    [
                        'name' => 'Tipe B',
                        'slug' => $portfolio->slug . '-tipe-b',
                        'description' => 'Varian Tipe B untuk ' . $portfolio->title,
                        'display_order' => 2,
                    ],
                ];

                foreach ($variantsData as $variantData) {
                    $variant = PortfolioVariant::create(array_merge($variantData, [
                        'portfolio_id' => $portfolio->id,
                        'is_active' => true,
                        'thumbnail_image' => 'portfolios/placeholder-variant.jpg',
                    ]));

                    // Seed 3 placeholder images per variant jika belum ada
                    for ($i = 1; $i <= 3; $i++) {
                        PortfolioVariantImage::create([
                            'portfolio_variant_id' => $variant->id,
                            'image_path' => 'portfolios/placeholder-variant.jpg',
                            'caption' => "Gambar {$i} - {$variant->name}",
                            'display_order' => $i,
                        ]);
                    }
                }
            }
        }
    }
}
