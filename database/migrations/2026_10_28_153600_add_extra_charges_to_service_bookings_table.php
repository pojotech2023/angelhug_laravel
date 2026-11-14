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
        Schema::table('service_bookings', function (Blueprint $table) {
            if (!Schema::hasColumn('service_bookings', 'extra_charges')) {
                $table->decimal('extra_charges', 10, 2)->default(0)->after('platform_fee');
            }
            if (!Schema::hasColumn('service_bookings', 'gst_rate')) {
                $table->decimal('gst_rate', 5, 2)->default(5.00)->after('extra_charges');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('service_bookings', function (Blueprint $table) {
            $table->dropColumn(['extra_charges', 'gst_rate']);
        });
    }
};
