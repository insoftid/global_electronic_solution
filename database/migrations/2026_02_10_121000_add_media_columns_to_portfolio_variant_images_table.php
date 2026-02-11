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
        Schema::table('portfolio_variant_images', function (Blueprint $table) {
            $table->string('media_type')->default('image')->after('portfolio_variant_id');
            $table->string('media_path')->nullable()->after('media_type');
        });

        DB::table('portfolio_variant_images')
            ->whereNull('media_type')
            ->update(['media_type' => 'image']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('portfolio_variant_images', function (Blueprint $table) {
            $table->dropColumn(['media_type', 'media_path']);
        });
    }
};
