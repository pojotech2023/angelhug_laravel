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
       
    Schema::table('logins', function (Blueprint $table) {
        if (!Schema::hasColumn('logins', 'mobile_no')) {
            $table->string('mobile_no')->nullable();
        }
        if (!Schema::hasColumn('logins', 'otp')) {
            $table->string('otp')->nullable();
        }
      
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
