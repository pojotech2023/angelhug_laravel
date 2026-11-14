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
            $table->string('booking_end_time')->nullable()->after('booking_time');
            $table->string('caller_name')->nullable()->after('customer_name');
            $table->string('caller_relationship')->nullable()->after('caller_name');
            $table->string('patient_name')->nullable()->after('caller_relationship');
            $table->integer('patient_age')->nullable()->after('patient_name');
            $table->string('patient_gender')->nullable()->after('patient_age');
            $table->text('patient_condition')->nullable()->after('patient_gender');
            $table->text('patient_documents')->nullable()->after('patient_condition');
            $table->text('google_maps_link')->nullable()->after('customer_address');
            $table->decimal('base_fee', 10, 2)->default(0)->after('amount');
            $table->decimal('platform_fee', 10, 2)->default(0)->after('base_fee');
            $table->decimal('gst_amount', 10, 2)->default(0)->after('platform_fee');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('service_bookings', function (Blueprint $table) {
            $table->dropColumn([
                'booking_end_time',
                'caller_name',
                'caller_relationship',
                'patient_name',
                'patient_age',
                'patient_gender',
                'patient_condition',
                'patient_documents',
                'google_maps_link',
                'base_fee',
                'platform_fee',
                'gst_amount',
            ]);
        });
    }
};
