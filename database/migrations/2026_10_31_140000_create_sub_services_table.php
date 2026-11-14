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
        if (!Schema::hasTable('sub_services')) {
            Schema::create('sub_services', function (Blueprint $table) {
                $table->id();
                $table->foreignId('service_id')->constrained('services')->onDelete('cascade');
                $table->string('title');
                $table->string('subtitle')->nullable();
                $table->decimal('price', 10, 2)->default(0.00);
                $table->string('duration', 100)->nullable();
                $table->longText('features')->nullable(); // JSON array of inclusion bullet points
                $table->boolean('is_active')->default(true);
                $table->integer('sort_order')->default(0);
                $table->timestamps();
            });
        }

        if (Schema::hasTable('service_bookings')) {
            Schema::table('service_bookings', function (Blueprint $table) {
                if (!Schema::hasColumn('service_bookings', 'sub_service_id')) {
                    $table->unsignedBigInteger('sub_service_id')->nullable()->after('service_id');
                }
                if (!Schema::hasColumn('service_bookings', 'sub_service_name')) {
                    $table->string('sub_service_name', 255)->nullable()->after('sub_service_id');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('service_bookings')) {
            Schema::table('service_bookings', function (Blueprint $table) {
                if (Schema::hasColumn('service_bookings', 'sub_service_name')) {
                    $table->dropColumn('sub_service_name');
                }
                if (Schema::hasColumn('service_bookings', 'sub_service_id')) {
                    $table->dropColumn('sub_service_id');
                }
            });
        }

        Schema::dropIfExists('sub_services');
    }
};
