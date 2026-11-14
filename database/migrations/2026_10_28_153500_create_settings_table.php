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
        if (!Schema::hasTable('settings')) {
            Schema::create('settings', function (Blueprint $table) {
                $table->id();
                $table->string('key')->unique();
                $table->text('value')->nullable();
                $table->string('type')->default('string'); // string, decimal, integer, boolean, json
                $table->string('group')->default('billing');
                $table->string('label')->nullable();
                $table->text('description')->nullable();
                $table->timestamps();
            });

            // Seed default billing settings
            $defaults = [
                [
                    'key' => 'gst_enabled',
                    'value' => '1',
                    'type' => 'boolean',
                    'group' => 'billing',
                    'label' => 'Enable GST Calculation',
                    'description' => 'Calculate and itemize GST on customer bookings.',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'key' => 'gst_percentage',
                    'value' => '5.00',
                    'type' => 'decimal',
                    'group' => 'billing',
                    'label' => 'GST Tax Percentage (%)',
                    'description' => 'Goods & Services Tax rate (e.g., 5.00 for 5%, 18.00 for 18%).',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'key' => 'platform_fee',
                    'value' => '99.00',
                    'type' => 'decimal',
                    'group' => 'billing',
                    'label' => 'Platform / Clinical Protocols Fee (₹)',
                    'description' => 'Flat clinical protocol and safety infrastructure fee per appointment.',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'key' => 'platform_fee_label',
                    'value' => 'Clinical Protocols & Safety Fee',
                    'type' => 'string',
                    'group' => 'billing',
                    'label' => 'Platform Fee Display Label',
                    'description' => 'Label displayed to customer on invoice and checkout.',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'key' => 'extra_charge_enabled',
                    'value' => '0',
                    'type' => 'boolean',
                    'group' => 'billing',
                    'label' => 'Enable Extra Charges / Surcharges',
                    'description' => 'Turn on optional extra fees like PPE kit, night care, or transport surcharge.',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'key' => 'extra_charge_amount',
                    'value' => '0.00',
                    'type' => 'decimal',
                    'group' => 'billing',
                    'label' => 'Extra Charge Amount (₹)',
                    'description' => 'Additional surcharge fee added to customer total payable.',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'key' => 'extra_charge_label',
                    'value' => 'Sanitization & Clinical Consumables Kit',
                    'type' => 'string',
                    'group' => 'billing',
                    'label' => 'Extra Charge Display Label',
                    'description' => 'Description of extra charges shown to the customer.',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'key' => 'gstin_number',
                    'value' => '33AAHCA8492C1ZP',
                    'type' => 'string',
                    'group' => 'billing',
                    'label' => 'Company GSTIN Number',
                    'description' => 'Official GST identification number printed on tax receipts.',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ];

            DB::table('settings')->insert($defaults);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
