<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;
use App\Models\SubService;

class SubServiceSeeder extends Seeder
{
    public function run()
    {
        // 1. Elderly & Geriatric Nursing Care
        $service1 = Service::find(1);
        if ($service1) {
            SubService::updateOrCreate(
                ['service_id' => $service1->id, 'title' => 'Post hospitalization recovery'],
                [
                    'subtitle' => 'Explore care, support & benefits',
                    'price' => 700.00,
                    'duration' => '12 Hours Shift',
                    'sort_order' => 1,
                    'is_active' => true,
                    'features' => [
                        'Basic Bathroom Support',
                        'Diaper change',
                        'Serving meals',
                        'Light feeding support',
                        'Medicine arrangement',
                        'Basic oil massage',
                        'Grooming, Oil Massage & Exercise Support',
                        'Basic Vitals Monitoring (BP, sugar, heart rate, temperature)',
                        'Walking with Lifting & Transfer Assistance',
                        'Hygiene with Bed Pan & Wound Care',
                        'Wound assessment, sterile dressing & infection monitoring',
                        'Medication Management',
                        'Healing progress tracking & follow-up coordination',
                        'Bedside assistance'
                    ]
                ]
            );

            SubService::updateOrCreate(
                ['service_id' => $service1->id, 'title' => 'Chronic condition and vitals management'],
                [
                    'subtitle' => 'Explore care, support & benefits',
                    'price' => 1450.00,
                    'duration' => '12 Hours Shift',
                    'sort_order' => 2,
                    'is_active' => true,
                    'features' => [
                        'Catheter care',
                        'Basic walking support',
                        'Prescription management support',
                        'IV monitoring',
                        'Tube feeding',
                        'Basic Vitals Monitoring (BP, sugar, heart rate, temperature)',
                        'Bathroom Support with Diaper/Sponge Bath',
                        'Doctor & Hospital Coordination',
                        'Wound assessment, sterile dressing & infection monitoring',
                        'Insulin administration',
                        'Wound dressing, catheter care, or injections'
                    ]
                ]
            );

            SubService::updateOrCreate(
                ['service_id' => $service1->id, 'title' => 'Cancer & Palliative care'],
                [
                    'subtitle' => 'Explore care, support & benefits',
                    'price' => 1000.00,
                    'duration' => '12 Hours Shift',
                    'sort_order' => 3,
                    'is_active' => true,
                    'features' => [
                        'Hygiene with Bed Pan & Wound Care',
                        'Pain relief & symptom management',
                        'Critical Vitals & Equipment Monitoring',
                        'Complex Medication & IV Management',
                        'Emotional & Family Support',
                        'End-of-life comfort care',
                        'Full Feeding & Nutritional Support',
                        'Positioning & Immobility Support'
                    ]
                ]
            );
        }

        // 2. Post-Surgical Rehabilitation & Care
        $service2 = Service::find(2);
        if ($service2) {
            SubService::updateOrCreate(
                ['service_id' => $service2->id, 'title' => 'Post-Op Wound Dressing & Catheter Care'],
                [
                    'subtitle' => 'Sterile surgical dressing, drain flushing, suture monitoring',
                    'price' => 950.00,
                    'duration' => 'Per Visit (60 Mins)',
                    'sort_order' => 1,
                    'is_active' => true,
                    'features' => [
                        'Sterile wound dressing change & antiseptic cleansing',
                        'Surgical drain, Foley catheter & stoma care',
                        'Wound healing photographic log for treating surgeon',
                        'Vital signs checking (BP, Pulse, Temperature, SpO2)',
                        'Safe suture / staple inspection and reporting'
                    ]
                ]
            );

            SubService::updateOrCreate(
                ['service_id' => $service2->id, 'title' => 'Intensive Day Surgical Recovery'],
                [
                    'subtitle' => 'Dedicated bed-side post-op nursing shift',
                    'price' => 1999.00,
                    'duration' => '12 Hours Shift',
                    'sort_order' => 2,
                    'is_active' => true,
                    'features' => [
                        'Strict medication timing & IV infusion therapy',
                        'Assisted transfer, bed turns & breathing exercises',
                        'Bed bath, sponge wash & personal grooming',
                        'Early mobilization to prevent stiffness & DVT',
                        'Direct emergency coordination with family doctor'
                    ]
                ]
            );
        }

        // 3. Mother & Newborn Baby Care
        $service3 = Service::find(3);
        if ($service3) {
            SubService::updateOrCreate(
                ['service_id' => $service3->id, 'title' => 'Newborn Hygiene & Lactation Coaching'],
                [
                    'subtitle' => 'Professional baby handling, warm bath, feeding coaching',
                    'price' => 1200.00,
                    'duration' => '4 Hours / Visit',
                    'sort_order' => 1,
                    'is_active' => true,
                    'features' => [
                        'Gentle newborn oil massage & warm water bath',
                        'Umbilical cord stump care & diaper rash treatment',
                        'Lactation latching & posture guidance for mother',
                        'Burping techniques, sleep soothing & colic relief',
                        'Weight, jaundice & temperature tracking log'
                    ]
                ]
            );

            SubService::updateOrCreate(
                ['service_id' => $service3->id, 'title' => 'Full Postnatal Mother & Baby Night Shift'],
                [
                    'subtitle' => 'Night-time relief so mother gets deep restorative rest',
                    'price' => 1799.00,
                    'duration' => '12 Hours Shift',
                    'sort_order' => 2,
                    'is_active' => true,
                    'features' => [
                        'Complete overnight baby soothing, feeding & diapering',
                        'C-section / episiotomy dressing & maternal hygiene support',
                        'Sterilization of pumps, feeding bottles & utensils',
                        'Nutritional soup & herbal decoction prep guidance',
                        'Emergency pediatric alert protocol'
                    ]
                ]
            );
        }
    }
}
