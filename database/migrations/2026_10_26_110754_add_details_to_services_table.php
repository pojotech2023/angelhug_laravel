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
            if (!Schema::hasColumn('services', 'price')) {
                $table->decimal('price', 10, 2)->default(0)->after('subtitle');
            }
            if (!Schema::hasColumn('services', 'duration')) {
                $table->string('duration')->nullable()->after('price');
            }
            if (!Schema::hasColumn('services', 'is_active')) {
                $table->boolean('is_active')->default(true)->after('images');
            }
            if (!Schema::hasColumn('services', 'featured')) {
                $table->boolean('featured')->default(false)->after('is_active');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn(['price', 'duration', 'is_active', 'featured']);
        });
    }
};
