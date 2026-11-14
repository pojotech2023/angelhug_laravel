@extends('layouts.app')

@section('content')
<div class="container-fluid" style="max-width: 1020px;">
    <!-- Top Bar -->
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
        <div>
            <h3 class="fw-bold mb-1" style="color: #048444;">
                <i class="fas fa-id-badge me-2"></i> Caretaker Application Form
            </h3>
            <p class="text-muted small mb-0">Application No: <strong class="text-dark">{{ $caretaker->application_no }}</strong> • Submitted on {{ $caretaker->created_at->format('M d, Y h:i A') }}</p>
        </div>
        <div class="d-flex gap-2">
            <button onclick="window.print()" class="btn btn-outline-secondary fw-bold">
                <i class="fas fa-print me-1"></i> Print Form
            </button>
            <a href="{{ route('admin.caretakers.index') }}" class="btn btn-outline-success fw-bold">
                <i class="fas fa-arrow-left me-1"></i> Back to All Caretakers
            </a>
        </div>
    </div>

    <!-- Main Application Profile Card -->
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
        <!-- Applicant Header Banner -->
        <div class="p-4 text-white position-relative" style="background: linear-gradient(135deg, #048444 0%, #024724 100%);">
            <div class="d-flex align-items-center flex-wrap gap-4">
                <div class="position-relative">
                    <img src="{{ $caretaker->photo_url }}" alt="{{ $caretaker->name }}" 
                         class="rounded-circle border border-3 border-white shadow" 
                         style="width: 100px; height: 100px; object-fit: cover;">
                </div>
                <div class="flex-grow-1">
                    <div class="d-flex align-items-center gap-2 mb-1 flex-wrap">
                        <h3 class="fw-bold text-white mb-0">{{ $caretaker->name }}</h3>
                        <span class="badge bg-white text-success fw-bold fs-6 px-3 py-1">{{ $caretaker->type }}</span>
                        @if($caretaker->status === 'approved')
                            <span class="badge bg-success border border-white">Approved</span>
                        @elseif($caretaker->status === 'reviewed')
                            <span class="badge bg-info text-dark">Reviewed</span>
                        @elseif($caretaker->status === 'rejected')
                            <span class="badge bg-danger">Rejected</span>
                        @else
                            <span class="badge bg-warning text-dark">Pending</span>
                        @endif
                    </div>
                    <p class="text-white-50 mb-1" style="font-size: 14px;">
                        <i class="fas fa-certificate me-1"></i> {{ $caretaker->highest_education }} • {{ $caretaker->specialization_role }}
                    </p>
                    <div class="text-white-50 small d-flex flex-wrap gap-3">
                        <span><i class="fas fa-venus-mars me-1"></i> Gender: {{ $caretaker->gender }}</span>
                        <span><i class="fas fa-birthday-cake me-1"></i> Age: {{ $caretaker->age }} (DOB: {{ $caretaker->dob ? $caretaker->dob->format('M d, Y') : 'N/A' }})</span>
                        <span><i class="fas fa-briefcase me-1"></i> Experience: {{ $caretaker->overall_experience }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body p-4">
            <!-- 1. Personal & Identity -->
            <div class="mb-4">
                <h5 class="fw-bold text-success mb-3 pb-2 border-bottom d-flex align-items-center">
                    <i class="fas fa-user-circle me-2"></i> 1. Personal & Identity Information
                </h5>
                <div class="table-responsive rounded-3 border">
                    <table class="table table-bordered align-middle mb-0" style="font-size: 13.5px;">
                        <tbody>
                            <tr>
                                <th class="bg-light text-muted fw-bold text-uppercase" style="width: 20%; font-size: 11px;">1. Applicant Photo</th>
                                <td style="width: 30%;">
                                    <div class="d-flex align-items-center gap-2">
                                        <img src="{{ $caretaker->photo_url }}" alt="{{ $caretaker->name }}" class="rounded-circle border" style="width: 42px; height: 42px; object-fit: cover;">
                                        <span class="fw-semibold text-dark">{{ $caretaker->photo ? 'Uploaded & Verified' : 'Default Avatar' }}</span>
                                    </div>
                                </td>
                                <th class="bg-light text-muted fw-bold text-uppercase" style="width: 20%; font-size: 11px;">2. Full Legal Name</th>
                                <td style="width: 30%;" class="fw-bold text-dark fs-6">{{ $caretaker->name }}</td>
                            </tr>
                            <tr>
                                <th class="bg-light text-muted fw-bold text-uppercase" style="font-size: 11px;">3. Healthcare Professional Type</th>
                                <td><span class="badge bg-success-subtle text-success border border-success fw-bold px-3 py-1">{{ $caretaker->type }}</span></td>
                                <th class="bg-light text-muted fw-bold text-uppercase" style="font-size: 11px;">4. Gender</th>
                                <td class="text-dark fw-semibold">{{ $caretaker->gender }}</td>
                            </tr>
                            <tr>
                                <th class="bg-light text-muted fw-bold text-uppercase" style="font-size: 11px;">5. Date of Birth</th>
                                <td class="text-dark">{{ $caretaker->dob ? $caretaker->dob->format('l, F j, Y') : 'N/A' }}</td>
                                <th class="bg-light text-muted fw-bold text-uppercase" style="font-size: 11px;">6. Age</th>
                                <td class="text-dark fw-bold">{{ $caretaker->age }} Years</td>
                            </tr>
                            <tr>
                                <th class="bg-light text-muted fw-bold text-uppercase" style="font-size: 11px;">7. Govt ID Proof Doc</th>
                                <td colspan="3">
                                    @if($caretaker->govt_id_doc_url)
                                        <a href="{{ $caretaker->govt_id_doc_url }}" target="_blank" class="btn btn-sm btn-outline-primary fw-bold">
                                            <i class="fas fa-file-download me-1"></i> View / Download Govt ID Document
                                        </a>
                                    @else
                                        <span class="badge bg-secondary">Not Uploaded</span>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- 2. Professional Qualifications -->
            <div class="mb-4">
                <h5 class="fw-bold text-success mb-3 pb-2 border-bottom d-flex align-items-center">
                    <i class="fas fa-graduation-cap me-2"></i> 2. Professional Qualifications & Registration
                </h5>
                <div class="table-responsive rounded-3 border">
                    <table class="table table-bordered align-middle mb-0" style="font-size: 13.5px;">
                        <tbody>
                            <tr>
                                <th class="bg-light text-muted fw-bold text-uppercase" style="width: 20%; font-size: 11px;">8. Highest Education</th>
                                <td style="width: 30%;" class="fw-bold text-dark">{{ $caretaker->highest_education }}</td>
                                <th class="bg-light text-muted fw-bold text-uppercase" style="width: 20%; font-size: 11px;">9. Specialization / Role</th>
                                <td style="width: 30%;" class="fw-bold text-dark">{{ $caretaker->specialization_role }}</td>
                            </tr>
                            <tr>
                                <th class="bg-light text-muted fw-bold text-uppercase" style="font-size: 11px;">10. Place of Registration</th>
                                <td class="text-dark">{{ $caretaker->place_of_registration ?: 'Not specified' }}</td>
                                <th class="bg-light text-muted fw-bold text-uppercase" style="font-size: 11px;">11. Professional Registration No.</th>
                                <td><span class="fw-bold text-primary">{{ $caretaker->registration_no ?: 'N/A' }}</span></td>
                            </tr>
                            <tr>
                                <th class="bg-light text-muted fw-bold text-uppercase" style="font-size: 11px;">12. Education Certificate Document</th>
                                <td colspan="3">
                                    @if($caretaker->education_doc_url)
                                        <a href="{{ $caretaker->education_doc_url }}" target="_blank" class="btn btn-sm btn-outline-success fw-bold">
                                            <i class="fas fa-file-download me-1"></i> View / Download Education Certificate
                                        </a>
                                    @else
                                        <span class="badge bg-secondary">Not Uploaded</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th class="bg-light text-muted fw-bold text-uppercase" style="font-size: 11px;">13. Resume / CV Document</th>
                                <td colspan="3">
                                    @if($caretaker->resume_doc_url)
                                        <a href="{{ $caretaker->resume_doc_url }}" target="_blank" class="btn btn-sm btn-outline-primary fw-bold">
                                            <i class="fas fa-file-alt me-1"></i> View / Download Resume / CV
                                        </a>
                                    @else
                                        <span class="badge bg-secondary">Not Uploaded</span>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- 3. Work Experience & Practice -->
            <div class="mb-4">
                <h5 class="fw-bold text-success mb-3 pb-2 border-bottom d-flex align-items-center">
                    <i class="fas fa-briefcase me-2"></i> 3. Clinical Experience & Practice Details
                </h5>
                <div class="table-responsive rounded-3 border">
                    <table class="table table-bordered align-middle mb-0" style="font-size: 13.5px;">
                        <tbody>
                            <tr>
                                <th class="bg-light text-muted fw-bold text-uppercase" style="width: 20%; font-size: 11px;">13. Place of Practicing</th>
                                <td style="width: 30%;" class="text-dark">{{ $caretaker->place_of_practicing ?: 'Independent Home Care' }}</td>
                                <th class="bg-light text-muted fw-bold text-uppercase" style="width: 20%; font-size: 11px;">14. Practise Type</th>
                                <td style="width: 30%;"><span class="badge bg-light text-dark border fw-bold">{{ $caretaker->practise_type }}</span></td>
                            </tr>
                            <tr>
                                <th class="bg-light text-muted fw-bold text-uppercase" style="font-size: 11px;">15. Years / Months Experience</th>
                                <td class="fw-bold text-dark">{{ $caretaker->experience_breakdown }}</td>
                                <th class="bg-light text-muted fw-bold text-uppercase" style="font-size: 11px;">16. Overall Experience</th>
                                <td class="fw-bold text-dark">{{ $caretaker->overall_experience }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- 4. Contact & Address -->
            <div class="mb-4">
                <h5 class="fw-bold text-success mb-3 pb-2 border-bottom d-flex align-items-center">
                    <i class="fas fa-address-book me-2"></i> 4. Contact Numbers & Residential Address
                </h5>
                <div class="table-responsive rounded-3 border">
                    <table class="table table-bordered align-middle mb-0" style="font-size: 13.5px;">
                        <tbody>
                            <tr>
                                <th class="bg-light text-muted fw-bold text-uppercase" style="width: 20%; font-size: 11px;">17. Personal Phone Number 1</th>
                                <td style="width: 30%;">
                                    <a href="tel:{{ $caretaker->personal_phone_1 }}" class="fw-bold text-dark text-decoration-none">
                                        <i class="fas fa-phone-alt text-success me-1"></i> +91 {{ $caretaker->personal_phone_1 }}
                                    </a>
                                </td>
                                <th class="bg-light text-muted fw-bold text-uppercase" style="width: 20%; font-size: 11px;">18. Emergency Phone Number 2</th>
                                <td style="width: 30%;" class="text-dark">
                                    {{ $caretaker->emergency_phone_2 ? '+91 ' . $caretaker->emergency_phone_2 : 'Not provided' }}
                                </td>
                            </tr>
                            <tr>
                                <th class="bg-light text-muted fw-bold text-uppercase" style="font-size: 11px;">19. Personal Mail ID</th>
                                <td>
                                    <a href="mailto:{{ $caretaker->personal_email }}" class="text-primary fw-semibold">{{ $caretaker->personal_email }}</a>
                                </td>
                                <th class="bg-light text-muted fw-bold text-uppercase" style="font-size: 11px;">20. House / Building Number</th>
                                <td class="text-dark">{{ $caretaker->house_building_no ?: 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th class="bg-light text-muted fw-bold text-uppercase" style="font-size: 11px;">21. City / Town Name</th>
                                <td class="fw-bold text-dark">{{ $caretaker->city_town }}</td>
                                <th class="bg-light text-muted fw-bold text-uppercase" style="font-size: 11px;">22. Pin Code</th>
                                <td class="fw-bold text-dark">{{ $caretaker->pincode }}</td>
                            </tr>
                            <tr>
                                <th class="bg-light text-muted fw-bold text-uppercase" style="font-size: 11px;">23. Present Residential Address</th>
                                <td class="text-dark">{{ $caretaker->present_address }}</td>
                                <th class="bg-light text-muted fw-bold text-uppercase" style="font-size: 11px;">24. Permanent Address</th>
                                <td class="text-dark">{{ $caretaker->permanent_address ?: $caretaker->present_address }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Status & Verification Actions -->
            <div class="p-4 border rounded-4 bg-light">
                <h5 class="fw-bold text-dark mb-3">
                    <i class="fas fa-tasks text-success me-2"></i> Application Status & Verification
                </h5>
                <form action="{{ route('admin.caretakers.update_status', $caretaker->id) }}" method="POST">
                    @csrf
                    <div class="row g-3 align-items-center">
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Update Status</label>
                            <select name="status" class="form-select fw-bold">
                                <option value="pending" {{ $caretaker->status === 'pending' ? 'selected' : '' }}>Pending Verification</option>
                                <option value="reviewed" {{ $caretaker->status === 'reviewed' ? 'selected' : '' }}>Reviewed / Under Check</option>
                                <option value="approved" {{ $caretaker->status === 'approved' ? 'selected' : '' }}>Approved & Onboarded</option>
                                <option value="rejected" {{ $caretaker->status === 'rejected' ? 'selected' : '' }}>Rejected</option>
                            </select>
                        </div>
                        <div class="col-md-8">
                            <label class="form-label fw-bold">Internal Admin Verification Notes</label>
                            <input type="text" name="admin_notes" class="form-control" 
                                   value="{{ $caretaker->admin_notes }}" placeholder="e.g. Verified Nursing registration with TNMNC, identity documents verified...">
                        </div>
                        <div class="col-12 text-end pt-2">
                            <button type="submit" class="btn btn-primary fw-bold px-4" style="background: #048444; border-color: #048444;">
                                <i class="fas fa-check-circle me-1"></i> Update Caretaker Status
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
