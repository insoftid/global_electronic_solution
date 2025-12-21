<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('portfolios', function (Blueprint $table) {
            // Project metrics/statistics
            $table->string('efficiency_increase', 50)->nullable()->after('is_active'); // e.g., "45%"
            $table->string('waste_reduction', 50)->nullable()->after('efficiency_increase'); // e.g., "30%"
            $table->string('roi_months', 50)->nullable()->after('waste_reduction'); // e.g., "18 Bulan"
            $table->string('downtime_reduction', 50)->nullable()->after('roi_months'); // e.g., "60%"
            $table->string('quality_rate', 50)->nullable()->after('downtime_reduction'); // e.g., "99.7%"
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('portfolios', function (Blueprint $table) {
            $table->dropColumn([
                'efficiency_increase',
                'waste_reduction',
                'roi_months',
                'downtime_reduction',
                'quality_rate',
            ]);
        });
    }
};
