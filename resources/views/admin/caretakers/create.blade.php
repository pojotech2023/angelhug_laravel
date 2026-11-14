@extends('layouts.app')

@section('content')
<div class="container-fluid" style="max-width: 980px;">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1" style="color: #048444;"><i class="fas fa-user-plus me-2"></i> Register New Caretaker / Nurse</h3>
            <p class="text-muted small mb-0">Fill in all 24 fields to manually onboard a healthcare professional into the AngelHug roster.</p>
        </div>
        <a href="{{ route('admin.caretakers.index') }}" class="btn btn-outline-secondary fw-bold">
            <i class="fas fa-arrow-left me-1"></i> Back to List
        </a>
    </div>

    @if(isset($errors) && $errors->any())
        <div class="alert alert-danger rounded-4 p-3 mb-4 shadow-sm border-0">
            <strong class="d-block mb-1"><i class="fas fa-exclamation-triangle me-1"></i> Please resolve the following errors:</strong>
            <ul class="mb-0 small ps-3">
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
        <form action="{{ route('admin.caretakers.admin_store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- 1. Personal Details -->
            <h5 class="fw-bold text-success mb-3 pb-2 border-bottom">
                <i class="fas fa-user-circle me-2"></i> 1. Personal & Identity
            </h5>
            <div class="row g-3 mb-4">
                <div class="col-md-3 text-center">
                    <div style="width: 90px; height: 90px; border-radius: 50%; overflow: hidden; margin: 0 auto 10px; border: 2px solid #048444; background: #e2e8f0;">
                        <img src="{{ asset('img/angelhug_docx/image1.jpeg') }}" id="adminPhotoPrev" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    <label class="form-label small fw-bold mb-1">1. Photo</label>
                    <input type="file" name="photo" class="form-control form-control-sm" accept="image/*" onchange="previewAdminPhoto(event)">
                </div>
                <div class="col-md-9">
                    <div class="row g-2">
                        <div class="col-sm-12">
                            <label class="form-label fw-bold">2. Full Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="Full legal name" required>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label fw-bold">3. Professional Type <span class="text-danger">*</span></label>
                            <select name="type" class="form-select fw-bold" required>
                                <option value="Nurse">Nurse (RN / GNM / ANM)</option>
                                <option value="Therapist">Therapist (Physio / OT / Speech)</option>
                                <option value="Care giver">Care giver (Elderly / Bedside)</option>
                                <option value="Others">Others</option>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label fw-bold">4. Gender <span class="text-danger">*</span></label>
                            <select name="gender" class="form-select" required>
                                <option value="Female">Female</option>
                                <option value="Male">Male</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label fw-bold">5. Date of Birth <span class="text-danger">*</span></label>
                            <input type="date" name="dob" id="adminDob" class="form-control" value="{{ old('dob') }}" required onchange="calculateAdminAge()">
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label fw-bold">6. Age <span class="text-danger">*</span></label>
                            <input type="number" name="age" id="adminAge" class="form-control fw-bold" value="{{ old('age') }}" min="18" max="85" placeholder="Auto-calculated" required>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <label class="form-label fw-bold">7. Upload Govt ID Proof Doc</label>
                    <input type="file" name="govt_id_proof" class="form-control" accept=".pdf,image/*">
                </div>
            </div>

            <!-- 2. Education & Registration -->
            <h5 class="fw-bold text-success mb-3 pb-2 border-bottom">
                <i class="fas fa-graduation-cap me-2"></i> 2. Qualifications & Registration
            </h5>
            <div class="row g-3 mb-4">
                <div class="col-sm-6">
                    <label class="form-label fw-bold">8. Highest Education Details <span class="text-danger">*</span></label>
                    <input type="text" name="highest_education" class="form-control" value="{{ old('highest_education') }}" placeholder="e.g. B.Sc Nursing / GNM" required>
                </div>
                <div class="col-sm-6">
                    <label class="form-label fw-bold">9. Specialization / Role <span class="text-danger">*</span></label>
                    <input type="text" name="specialization_role" class="form-control" value="{{ old('specialization_role') }}" placeholder="e.g. Geriatric Care, ICU" required>
                </div>
                <div class="col-sm-6">
                    <label class="form-label fw-bold">10. Place of Registration</label>
                    <input type="text" name="place_of_registration" class="form-control" value="{{ old('place_of_registration') }}" placeholder="e.g. Tamil Nadu Nursing Council">
                </div>
                <div class="col-sm-6">
                    <label class="form-label fw-bold">11. Registration Number</label>
                    <input type="text" name="registration_no" class="form-control" value="{{ old('registration_no') }}" placeholder="e.g. RN-12345">
                </div>
                <div class="col-12">
                    <label class="form-label fw-bold">12. Upload Education Certificate Document</label>
                    <input type="file" name="education_document" class="form-control" accept=".pdf,image/*">
                </div>
            </div>

            <!-- 3. Experience -->
            <h5 class="fw-bold text-success mb-3 pb-2 border-bottom">
                <i class="fas fa-briefcase me-2"></i> 3. Clinical Experience
            </h5>
            <div class="row g-3 mb-4">
                <div class="col-sm-8">
                    <label class="form-label fw-bold">13. Place of Practicing</label>
                    <input type="text" name="place_of_practicing" class="form-control" value="{{ old('place_of_practicing') }}" placeholder="e.g. Apollo Hospitals / Private Care">
                </div>
                <div class="col-sm-4">
                    <label class="form-label fw-bold">14. Practise Type <span class="text-danger">*</span></label>
                    <select name="practise_type" class="form-select" required>
                        <option value="Full Time">Full Time</option>
                        <option value="Part Time">Part Time</option>
                        <option value="Home Visit Only">Home Visit Only</option>
                        <option value="Hospital & Home Care">Hospital & Home Care</option>
                    </select>
                </div>
                <div class="col-sm-6">
                    <label class="form-label fw-bold">15. Experience Breakdown <span class="text-danger">*</span></label>
                    <input type="text" name="experience_breakdown" class="form-control" value="{{ old('experience_breakdown') }}" placeholder="e.g. 3 Years 6 Months" required>
                </div>
                <div class="col-sm-6">
                    <label class="form-label fw-bold">16. Overall Experience <span class="text-danger">*</span></label>
                    <input type="text" name="overall_experience" class="form-control" value="{{ old('overall_experience') }}" placeholder="e.g. 4+ Years Total" required>
                </div>
            </div>

            <!-- 4. Contact & Address -->
            <h5 class="fw-bold text-success mb-3 pb-2 border-bottom">
                <i class="fas fa-address-book me-2"></i> 4. Contact & Address
            </h5>
            <div class="row g-3 mb-4">
                <div class="col-sm-4">
                    <label class="form-label fw-bold">17. Personal Phone 1 <span class="text-danger">*</span></label>
                    <input type="tel" name="personal_phone_1" maxlength="10" class="form-control" value="{{ old('personal_phone_1') }}" placeholder="10-digit mobile" required>
                </div>
                <div class="col-sm-4">
                    <label class="form-label fw-bold">18. Emergency Phone 2</label>
                    <input type="tel" name="emergency_phone_2" maxlength="10" class="form-control" value="{{ old('emergency_phone_2') }}" placeholder="Secondary contact">
                </div>
                <div class="col-sm-4">
                    <label class="form-label fw-bold">19. Personal Mail ID <span class="text-danger">*</span></label>
                    <input type="email" name="personal_email" class="form-control" value="{{ old('personal_email') }}" placeholder="email@example.com" required>
                </div>
                <div class="col-sm-4">
                    <label class="form-label fw-bold">20. House / Building Number</label>
                    <input type="text" name="house_building_no" class="form-control" value="{{ old('house_building_no') }}" placeholder="Door No.">
                </div>
                <div class="col-sm-4">
                    <label class="form-label fw-bold">21. City / Town <span class="text-danger">*</span></label>
                    <input type="text" name="city_town" class="form-control" value="{{ old('city_town') }}" placeholder="City" required>
                </div>
                <div class="col-sm-4">
                    <label class="form-label fw-bold">22. Pin Code <span class="text-danger">*</span></label>
                    <input type="text" name="pincode" maxlength="6" class="form-control" value="{{ old('pincode') }}" placeholder="6-digit pincode" required>
                </div>
                <div class="col-sm-6">
                    <label class="form-label fw-bold">23. Present Address <span class="text-danger">*</span></label>
                    <textarea name="present_address" id="adminPresent" class="form-control" rows="2" required>{{ old('present_address') }}</textarea>
                </div>
                <div class="col-sm-6">
                    <label class="form-label fw-bold">24. Permanent Address</label>
                    <textarea name="permanent_address" id="adminPerm" class="form-control" rows="2">{{ old('permanent_address') }}</textarea>
                </div>
            </div>

            <!-- Admin Verification Status -->
            <div class="p-3 border rounded-3 bg-light mb-4">
                <div class="row g-2">
                    <div class="col-sm-4">
                        <label class="form-label fw-bold small">Initial Status</label>
                        <select name="status" class="form-select form-select-sm fw-bold">
                            <option value="approved">Approved & Active</option>
                            <option value="reviewed">Reviewed</option>
                            <option value="pending">Pending</option>
                        </select>
                    </div>
                    <div class="col-sm-8">
                        <label class="form-label fw-bold small">Admin Verification Notes</label>
                        <input type="text" name="admin_notes" class="form-control form-control-sm" value="Manually verified and registered by Administrator">
                    </div>
                </div>
            </div>

            <div class="text-end">
                <button type="submit" class="btn btn-primary fw-bold px-4 py-2" style="background: #048444; border-color: #048444;">
                    <i class="fas fa-save me-1"></i> Register Caretaker
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function previewAdminPhoto(event) {
    const input = event.target;
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('adminPhotoPrev').src = e.target.result;
        };
        reader.readAsDataURL(input.files[0]);
    }
}

function calculateAdminAge() {
    const dobInput = document.getElementById('adminDob');
    const ageInput = document.getElementById('adminAge');
    if (!dobInput.value) return;

    const dob = new Date(dobInput.value);
    const today = new Date();
    let age = today.getFullYear() - dob.getFullYear();
    const m = today.getMonth() - dob.getMonth();
    if (m < 0 || (m === 0 && today.getDate() < dob.getDate())) {
        age--;
    }
    if (age >= 18 && age <= 100) {
        ageInput.value = age;
    }
}
</script>
@endsection
