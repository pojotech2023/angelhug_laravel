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
        Schema::table('services', function (Blueprint $table) {
            if (!Schema::hasColumn('services', 'gst_rate')) {
                $table->decimal('gst_rate', 5, 2)->nullable()->after('price');
            }
            if (!Schema::hasColumn('services', 'gst_exempt')) {
                $table->boolean('gst_exempt')->default(false)->after('gst_rate');
            }
            if (!Schema::hasColumn('services', 'platform_fee')) {
                $table->decimal('platform_fee', 10, 2)->nullable()->after('gst_exempt');
            }
            if (!Schema::hasColumn('services', 'extra_charges')) {
                $table->decimal('extra_charges', 10, 2)->default(0.00)->after('platform_fee');
            }
            if (!Schema::hasColumn('services', 'extra_charges_label')) {
                $table->string('extra_charges_label', 150)->nullable()->after('extra_charges');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn([
                'gst_rate',
                'gst_exempt',
                'platform_fee',
                'extra_charges',
                'extra_charges_label',
            ]);
        });
    }
};
