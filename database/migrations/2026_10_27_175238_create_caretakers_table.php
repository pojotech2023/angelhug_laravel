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
        Schema::create('caretakers', function (Blueprint $table) {
            $table->id();
            $table->string('application_no')->unique(); // Application Ref: AH-CT-YYYYMM-XXXX
            
            // 1. Photo
            $table->string('photo')->nullable();
            
            // 2. Name
            $table->string('name');
            
            // 3. Type (Nurse/Therapist/Care giver/Others)
            $table->string('type'); 
            
            // 4. Gender
            $table->string('gender', 20);
            
            // 5. Highest Education details
            $table->string('highest_education');
            
            // 6. Specialization/Role
            $table->string('specialization_role');
            
            // 7. Place of registration
            $table->string('place_of_registration')->nullable();
            
            // 8. Registration No.
            $table->string('registration_no')->nullable();
            
            // 9. Place of Practicing
            $table->string('place_of_practicing')->nullable();
            
            // 10. Years/Months of experience
            $table->string('experience_breakdown')->nullable();
            
            // 11. overall Experience
            $table->string('overall_experience');
            
            // 12. Practise type
            $table->string('practise_type');
            
            // 13. Personal Phone number 1
            $table->string('personal_phone_1', 20);
            
            // 14. Emergency Phone number 2
            $table->string('emergency_phone_2', 20)->nullable();
            
            // 15. Personal Mail ID
            $table->string('personal_email');
            
            // 16. House Building Number
            $table->string('house_building_no')->nullable();
            
            // 17. Present Address
            $table->text('present_address');
            
            // 18. Permanent Address
            $table->text('permanent_address')->nullable();
            
            // 19. City/town Name
            $table->string('city_town');
            
            // 20. Pin code
            $table->string('pincode', 10);
            
            // 21. Upload Education Documents
            $table->string('education_document')->nullable();
            
            // 22. Age
            $table->integer('age');
            
            // 23. Date of Birth
            $table->date('dob');
            
            // 24. Upload Govt ID Proof Doc
            $table->string('govt_id_proof')->nullable();

            // Admin management fields
            $table->string('status', 30)->default('pending'); // pending, reviewed, approved, rejected
            $table->text('admin_notes')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('caretakers');
    }
};
