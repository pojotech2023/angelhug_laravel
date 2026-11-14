<?php

namespace App\Http\Controllers;

use App\Models\Caretaker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CaretakerController extends Controller
{
    /**
     * Show Public Caretaker / Healthcare Staff Registration Form.
     */
    public function create()
    {
        return view('caretaker.apply', [
            'submissionToken' => (string) Str::uuid(),
        ]);
    }

    /**
     * Store submitted Caretaker Application.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'submission_token' => 'required|uuid',
            // 1. Photo
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            // 2. Name
            'name' => 'required|string|max:150',
            // 3. Type
            'type' => 'required|string|max:60',
            // 4. Gender
            'gender' => 'required|string|in:Male,Female,Other',
            // 5. Highest Education
            'highest_education' => 'required|string|max:255',
            // 6. Specialization/Role
            'specialization_role' => 'required|string|max:255',
            // 7. Place of registration
            'place_of_registration' => 'nullable|string|max:255',
            // 8. Registration No.
            'registration_no' => 'nullable|string|max:100',
            // 9. Place of Practicing
            'place_of_practicing' => 'nullable|string|max:255',
            // 10. Years/Months of experience
            'experience_breakdown' => 'nullable|string|max:100',
            // 11. Overall Experience
            'overall_experience' => 'required|string|max:100',
            // 12. Practise type
            'practise_type' => 'required|string|max:100',
            // 13. Personal Phone 1
            'personal_phone_1' => 'required|digits:10',
            // 14. Emergency Phone 2
            'emergency_phone_2' => 'nullable|digits:10',
            // 15. Personal Email
            'personal_email' => 'required|email|max:150',
            // 16. House Building Number
            'house_building_no' => 'nullable|string|max:150',
            // 17. Present Address
            'present_address' => 'required|string|max:500',
            // 18. Permanent Address
            'permanent_address' => 'nullable|string|max:500',
            // 19. City/town Name
            'city_town' => 'required|string|max:120',
            // 20. Pin code
            'pincode' => 'required|digits:6',
            // 21. Upload Education Documents
            'education_document' => 'nullable|file|mimes:pdf,jpeg,png,jpg|max:10240',
            // Upload Resume / CV
            'resume_document' => 'nullable|file|mimes:pdf,doc,docx,jpeg,png,jpg|max:10240',
            // 22. Age
            'age' => 'required|integer|min:18|max:85',
            // 23. Date of Birth
            'dob' => 'required|date|before:today',
            // 24. Upload Govt ID Proof Doc
            'govt_id_proof' => 'nullable|file|mimes:pdf,jpeg,png,jpg|max:10240',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $submissionToken = $request->input('submission_token');
        $existingApplication = Caretaker::where('submission_token', $submissionToken)->first();
        if ($existingApplication) {
            return $this->applicationSubmittedResponse($existingApplication);
        }

        // File uploads
        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('caretakers/photos', 'public');
        }

        $educationDocPath = null;
        if ($request->hasFile('education_document')) {
            $educationDocPath = $request->file('education_document')->store('caretakers/education', 'public');
        }

        $govtIdPath = null;
        if ($request->hasFile('govt_id_proof')) {
            $govtIdPath = $request->file('govt_id_proof')->store('caretakers/govt_id', 'public');
        }

        $resumeDocPath = null;
        if ($request->hasFile('resume_document')) {
            $resumeDocPath = $request->file('resume_document')->store('caretakers/resumes', 'public');
        }

        $applicationNo = Caretaker::generateApplicationNo();

        // If permanent address is blank, fallback to present address
        $permanentAddress = $request->permanent_address ?: $request->present_address;

        $caretaker = Caretaker::firstOrCreate(
            ['submission_token' => $submissionToken],
            [
                'application_no' => $applicationNo,
                'photo' => $photoPath,
                'name' => $request->name,
                'type' => $request->type,
                'gender' => $request->gender,
                'highest_education' => $request->highest_education,
                'specialization_role' => $request->specialization_role,
                'place_of_registration' => $request->place_of_registration,
                'registration_no' => $request->registration_no,
                'place_of_practicing' => $request->place_of_practicing,
                'experience_breakdown' => $request->experience_breakdown,
                'overall_experience' => $request->overall_experience,
                'practise_type' => $request->practise_type,
                'personal_phone_1' => $request->personal_phone_1,
                'emergency_phone_2' => $request->emergency_phone_2,
                'personal_email' => $request->personal_email,
                'house_building_no' => $request->house_building_no,
                'present_address' => $request->present_address,
                'permanent_address' => $permanentAddress,
                'city_town' => $request->city_town,
                'pincode' => $request->pincode,
                'education_document' => $educationDocPath,
                'resume_document' => $resumeDocPath,
                'age' => $request->age,
                'dob' => $request->dob,
                'govt_id_proof' => $govtIdPath,
                'status' => 'pending',
            ]
        );

        if (!$caretaker->wasRecentlyCreated) {
            foreach ([$photoPath, $educationDocPath, $govtIdPath, $resumeDocPath] as $path) {
                if ($path) {
                    Storage::disk('public')->delete($path);
                }
            }
        }

        return $this->applicationSubmittedResponse($caretaker);
    }

    private function applicationSubmittedResponse(Caretaker $caretaker)
    {
        return redirect()->back()->with('application_submitted', [
            'application_no' => $caretaker->application_no,
            'name' => $caretaker->name,
            'type' => $caretaker->type,
        ]);
    }

    /**
     * Admin: List all Caretaker Applications.
     */
    public function index(Request $request)
    {
        $query = Caretaker::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('application_no', 'like', "%{$search}%")
                  ->orWhere('personal_phone_1', 'like', "%{$search}%")
                  ->orWhere('personal_email', 'like', "%{$search}%")
                  ->orWhere('city_town', 'like', "%{$search}%");
            });
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $caretakers = $query->latest()->paginate(15)->appends($request->query());

        $typeCounts = [
            'total' => Caretaker::count(),
            'Nurse' => Caretaker::where('type', 'Nurse')->count(),
            'Therapist' => Caretaker::where('type', 'Therapist')->count(),
            'Care giver' => Caretaker::where('type', 'Care giver')->count(),
            'Others' => Caretaker::where('type', 'Others')->count(),
        ];

        return view('admin.caretakers.index', compact('caretakers', 'typeCounts'));
    }

    /**
     * Admin: Show Caretaker Registration Form inside Admin Panel.
     */
    public function adminCreate()
    {
        return view('admin.caretakers.create');
    }

    /**
     * Admin: Store Caretaker Application submitted via Admin Panel.
     */
    public function adminStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'name' => 'required|string|max:150',
            'type' => 'required|string|max:60',
            'gender' => 'required|string|in:Male,Female,Other',
            'highest_education' => 'required|string|max:255',
            'specialization_role' => 'required|string|max:255',
            'place_of_registration' => 'nullable|string|max:255',
            'registration_no' => 'nullable|string|max:100',
            'place_of_practicing' => 'nullable|string|max:255',
            'experience_breakdown' => 'nullable|string|max:100',
            'overall_experience' => 'required|string|max:100',
            'practise_type' => 'required|string|max:100',
            'personal_phone_1' => 'required|digits:10',
            'emergency_phone_2' => 'nullable|digits:10',
            'personal_email' => 'required|email|max:150',
            'house_building_no' => 'nullable|string|max:150',
            'present_address' => 'required|string|max:500',
            'permanent_address' => 'nullable|string|max:500',
            'city_town' => 'required|string|max:120',
            'pincode' => 'required|digits:6',
            'education_document' => 'nullable|file|mimes:pdf,jpeg,png,jpg|max:10240',
            'age' => 'required|integer|min:18|max:85',
            'dob' => 'required|date|before:today',
            'govt_id_proof' => 'nullable|file|mimes:pdf,jpeg,png,jpg|max:10240',
            'status' => 'nullable|in:pending,reviewed,approved,rejected',
            'admin_notes' => 'nullable|string|max:1000',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('caretakers/photos', 'public');
        }

        $educationDocPath = null;
        if ($request->hasFile('education_document')) {
            $educationDocPath = $request->file('education_document')->store('caretakers/education', 'public');
        }

        $govtIdPath = null;
        if ($request->hasFile('govt_id_proof')) {
            $govtIdPath = $request->file('govt_id_proof')->store('caretakers/govt_id', 'public');
        }

        $resumeDocPath = null;
        if ($request->hasFile('resume_document')) {
            $resumeDocPath = $request->file('resume_document')->store('caretakers/resumes', 'public');
        }

        $applicationNo = Caretaker::generateApplicationNo();
        $permanentAddress = $request->permanent_address ?: $request->present_address;

        $caretaker = Caretaker::create([
            'application_no' => $applicationNo,
            'photo' => $photoPath,
            'name' => $request->name,
            'type' => $request->type,
            'gender' => $request->gender,
            'highest_education' => $request->highest_education,
            'specialization_role' => $request->specialization_role,
            'place_of_registration' => $request->place_of_registration,
            'registration_no' => $request->registration_no,
            'place_of_practicing' => $request->place_of_practicing,
            'experience_breakdown' => $request->experience_breakdown,
            'overall_experience' => $request->overall_experience,
            'practise_type' => $request->practise_type,
            'personal_phone_1' => $request->personal_phone_1,
            'emergency_phone_2' => $request->emergency_phone_2,
            'personal_email' => $request->personal_email,
            'house_building_no' => $request->house_building_no,
            'present_address' => $request->present_address,
            'permanent_address' => $permanentAddress,
            'city_town' => $request->city_town,
            'pincode' => $request->pincode,
            'education_document' => $educationDocPath,
            'resume_document' => $resumeDocPath,
            'age' => $request->age,
            'dob' => $request->dob,
            'govt_id_proof' => $govtIdPath,
            'status' => $request->input('status', 'approved'),
            'admin_notes' => $request->input('admin_notes', 'Manually registered by Administrator'),
        ]);

        return redirect()->route('admin.caretakers.index')->with('success', "Caretaker application #{$applicationNo} created successfully.");
    }

    /**
     * Admin: Show dedicated full-page Caretaker Profile Form with all 24 fields.
     */
    public function show($id)
    {
        $caretaker = Caretaker::findOrFail($id);
        return view('admin.caretakers.show', compact('caretaker'));
    }

    /**
     * Admin: Update application status and admin notes.
     */
    public function updateStatus(Request $request, $id)
    {
        $caretaker = Caretaker::findOrFail($id);

        $request->validate([
            'status' => 'required|in:pending,reviewed,approved,rejected',
            'admin_notes' => 'nullable|string|max:1000',
        ]);

        $caretaker->status = $request->status;
        $caretaker->admin_notes = $request->admin_notes;
        $caretaker->save();

        return redirect()->back()->with('success', "Application #{$caretaker->application_no} status updated to " . ucfirst($caretaker->status));
    }

    /**
     * Admin: Delete Caretaker Application.
     */
    public function destroy($id)
    {
        $caretaker = Caretaker::findOrFail($id);

        // Remove files
        if ($caretaker->photo && Storage::disk('public')->exists($caretaker->photo)) {
            Storage::disk('public')->delete($caretaker->photo);
        }
        if ($caretaker->education_document && Storage::disk('public')->exists($caretaker->education_document)) {
            Storage::disk('public')->delete($caretaker->education_document);
        }
        if ($caretaker->govt_id_proof && Storage::disk('public')->exists($caretaker->govt_id_proof)) {
            Storage::disk('public')->delete($caretaker->govt_id_proof);
        }

        $caretaker->delete();

        return redirect()->back()->with('success', 'Caretaker application record deleted successfully.');
    }
}
