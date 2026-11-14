<?php

namespace Tests\Feature;

use App\Models\Caretaker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\View\View as ViewInstance;
use Tests\TestCase;

class CaretakerSubmissionTest extends TestCase
{
    private array $caretakerMigrations = [];

    protected function setUp(): void
    {
        parent::setUp();

        config([
            'database.default' => 'sqlite',
            'database.connections.sqlite.database' => ':memory:',
        ]);
        DB::purge('sqlite');
        DB::setDefaultConnection('sqlite');

        foreach ([
            '2026_10_27_175238_create_caretakers_table.php',
            '2026_10_28_125902_add_resume_document_to_caretakers_table.php',
            '2026_11_13_000000_add_submission_token_to_caretakers_table.php',
        ] as $migrationFile) {
            $migration = require database_path('migrations/'.$migrationFile);
            $migration->up();
            $this->caretakerMigrations[] = $migration;
        }
    }

    protected function tearDown(): void
    {
        foreach (array_reverse($this->caretakerMigrations) as $migration) {
            $migration->down();
        }

        DB::disconnect('sqlite');
        parent::tearDown();
    }

    public function test_repeated_submission_with_the_same_form_token_creates_only_one_application(): void
    {
        $submissionToken = (string) Str::uuid();
        $application = [
            'submission_token' => $submissionToken,
            'name' => 'Test Applicant',
            'type' => 'Nurse',
            'gender' => 'Female',
            'highest_education' => 'Nursing Diploma',
            'specialization_role' => 'General nursing',
            'overall_experience' => '6 months',
            'practise_type' => 'Full Time',
            'personal_phone_1' => '9876543210',
            'personal_email' => 'applicant@example.com',
            'present_address' => '1 Test Street',
            'city_town' => 'Chennai',
            'pincode' => '600001',
            'age' => 25,
            'dob' => '2001-01-01',
        ];

        $this->post(route('caretaker.store'), $application)->assertRedirect();
        $applicationNumber = Caretaker::sole()->application_no;

        $this->post(route('caretaker.store'), $application)->assertRedirect();

        $this->assertDatabaseCount('caretakers', 1);
        $this->assertSame($applicationNumber, Caretaker::sole()->application_no);
    }

    public function test_caretaker_form_includes_a_submission_token(): void
    {
        $view = app(\App\Http\Controllers\CaretakerController::class)->create();

        $this->assertInstanceOf(ViewInstance::class, $view);
        $this->assertMatchesRegularExpression(
            '/^[0-9a-f]{8}-(?:[0-9a-f]{4}-){3}[0-9a-f]{12}$/i',
            $view->getData()['submissionToken']
        );
    }
}
