<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('portfolio_variants', function (Blueprint $table) {
            $table->string('thumbnail_image')->nullable()->after('description');
        });

        // Backfill thumbnail_image from first variant image when available
        if (Schema::hasTable('portfolio_variant_images')) {
            $firstImages = DB::table('portfolio_variant_images')
                ->select('portfolio_variant_id', 'image_path')
                ->orderBy('display_order')
                ->orderBy('id')
                ->get()
                ->groupBy('portfolio_variant_id');

            foreach ($firstImages as $variantId => $images) {
                $image = $images->first();
                if ($image) {
                    DB::table('portfolio_variants')
                        ->where('id', $variantId)
                        ->whereNull('thumbnail_image')
                        ->update(['thumbnail_image' => $image->image_path]);
                }
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('portfolio_variants', function (Blueprint $table) {
            $table->dropColumn('thumbnail_image');
        });
    }
};
