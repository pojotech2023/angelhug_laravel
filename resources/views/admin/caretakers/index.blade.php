@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1" style="color: #048444;"><i class="fas fa-user-nurse me-2"></i> Caretaker & Nurse Applications</h3>
            <p class="text-muted small mb-0">Review submitted healthcare staff applications, verify credentials, and manage onboarding status.</p>
        </div>
        <div class="d-flex align-items-center gap-2">
            <a href="{{ route('admin.caretakers.create') }}" class="btn btn-success fw-bold rounded-pill px-3" style="background: #048444; border-color: #048444;">
                <i class="fas fa-plus me-1"></i> Add Caretaker
            </a>
            <a href="{{ route('caretaker.apply') }}" target="_blank" class="btn btn-outline-success fw-bold rounded-pill px-3">
                <i class="fas fa-external-link-alt me-1"></i> Public Form
            </a>
        </div>
    </div>

    <!-- Quick Stats Cards -->
    <div class="row g-3 mb-4">
        <div class="col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-4 p-3 bg-white">
                <div class="d-flex align-items-center">
                    <div class="rounded-3 p-3 text-white me-3" style="background: linear-gradient(135deg, #048444, #024724);">
                        <i class="fas fa-users-cog fs-4"></i>
                    </div>
                    <div>
                        <small class="text-muted fw-bold d-block">TOTAL APPLICANTS</small>
                        <h3 class="fw-bold text-dark mb-0">{{ $typeCounts['total'] ?? 0 }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-4 p-3 bg-white">
                <div class="d-flex align-items-center">
                    <div class="rounded-3 p-3 text-white me-3" style="background: linear-gradient(135deg, #00bbd7, #0099b0);">
                        <i class="fas fa-user-nurse fs-4"></i>
                    </div>
                    <div>
                        <small class="text-muted fw-bold d-block">NURSES (RN/GNM)</small>
                        <h3 class="fw-bold text-dark mb-0">{{ $typeCounts['Nurse'] ?? 0 }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-4 p-3 bg-white">
                <div class="d-flex align-items-center">
                    <div class="rounded-3 p-3 text-white me-3" style="background: linear-gradient(135deg, #3a9f48, #2a7334);">
                        <i class="fas fa-heartbeat fs-4"></i>
                    </div>
                    <div>
                        <small class="text-muted fw-bold d-block">CAREGIVERS</small>
                        <h3 class="fw-bold text-dark mb-0">{{ $typeCounts['Care giver'] ?? 0 }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-4 p-3 bg-white">
                <div class="d-flex align-items-center">
                    <div class="rounded-3 p-3 text-white me-3" style="background: linear-gradient(135deg, #f59e0b, #d97706);">
                        <i class="fas fa-hands-helping fs-4"></i>
                    </div>
                    <div>
                        <small class="text-muted fw-bold d-block">THERAPISTS</small>
                        <h3 class="fw-bold text-dark mb-0">{{ $typeCounts['Therapist'] ?? 0 }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters & Table Card -->
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
        <div class="card-body p-4 border-bottom bg-light">
            <form action="{{ route('admin.caretakers.index') }}" method="GET" class="row g-2 align-items-center">
                <div class="col-md-5">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0"><i class="fas fa-search text-muted"></i></span>
                        <input type="text" name="search" class="form-control border-start-0 ps-0" 
                               value="{{ request('search') }}" placeholder="Search by name, phone, email, app #, city...">
                    </div>
                </div>
                <div class="col-sm-3 col-md-3">
                    <select name="type" class="form-select" onchange="this.form.submit()">
                        <option value="">All Types (Nurse, Caregiver...)</option>
                        <option value="Nurse" {{ request('type') == 'Nurse' ? 'selected' : '' }}>Nurse</option>
                        <option value="Therapist" {{ request('type') == 'Therapist' ? 'selected' : '' }}>Therapist</option>
                        <option value="Care giver" {{ request('type') == 'Care giver' ? 'selected' : '' }}>Care giver</option>
                        <option value="Others" {{ request('type') == 'Others' ? 'selected' : '' }}>Others</option>
                    </select>
                </div>
                <div class="col-sm-3 col-md-2">
                    <select name="status" class="form-select" onchange="this.form.submit()">
                        <option value="">All Statuses</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="reviewed" {{ request('status') == 'reviewed' ? 'selected' : '' }}>Reviewed</option>
                        <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                    </select>
                </div>
                <div class="col-sm-2 col-md-2 d-flex gap-2">
                    <button type="submit" class="btn btn-primary fw-bold w-100" style="background: #048444; border-color: #048444;">
                        Filter
                    </button>
                    @if(request()->anyFilled(['search', 'type', 'status']))
                        <a href="{{ route('admin.caretakers.index') }}" class="btn btn-outline-secondary" title="Reset Filters">
                            <i class="fas fa-undo"></i>
                        </a>
                    @endif
                </div>
            </form>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">Applicant</th>
                        <th>Type</th>
                        <th>Education & Specialization</th>
                        <th>Experience</th>
                        <th>Contact</th>
                        <th>Location</th>
                        <th>Status</th>
                        <th class="text-end pe-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($caretakers as $ct)
                        <tr>
                            <td class="ps-4">
                                <div class="d-flex align-items-center">
                                    <img src="{{ $ct->photo_url }}" alt="{{ $ct->name }}" 
                                         class="rounded-circle me-3 border shadow-sm" style="width: 44px; height: 44px; object-fit: cover;">
                                    <div>
                                        <strong class="text-dark d-block" style="font-size: 14px;">{{ $ct->name }}</strong>
                                        <small class="text-muted d-block" style="font-size: 11px;">
                                            <span class="badge bg-light text-dark border">{{ $ct->application_no }}</span>
                                            • {{ $ct->gender }}, Age: {{ $ct->age }}
                                        </small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                @if($ct->type === 'Nurse')
                                    <span class="badge" style="background: #e8f7ee; color: #048444; border: 1px solid rgba(4, 132, 68, 0.3); font-weight: 700;">Nurse</span>
                                @elseif($ct->type === 'Therapist')
                                    <span class="badge" style="background: #fffbeb; color: #b45309; border: 1px solid rgba(180, 83, 9, 0.3); font-weight: 700;">Therapist</span>
                                @elseif($ct->type === 'Care giver')
                                    <span class="badge" style="background: #e0f8fa; color: #0099b0; border: 1px solid rgba(0, 153, 176, 0.3); font-weight: 700;">Care giver</span>
                                @else
                                    <span class="badge bg-secondary">{{ $ct->type }}</span>
                                @endif
                            </td>
                            <td>
                                <strong class="d-block text-dark" style="font-size: 13px;">{{ $ct->highest_education }}</strong>
                                <small class="text-muted" style="font-size: 11.5px;">{{ $ct->specialization_role }}</small>
                            </td>
                            <td>
                                <span class="badge bg-light text-dark border fw-bold">{{ $ct->experience_breakdown ?: $ct->overall_experience }}</span>
                                <small class="text-muted d-block" style="font-size: 11px;">{{ $ct->practise_type }}</small>
                            </td>
                            <td>
                                <div style="font-size: 13px;">
                                    <a href="tel:{{ $ct->personal_phone_1 }}" class="text-dark fw-bold text-decoration-none">
                                        <i class="fas fa-phone-alt text-success me-1"></i> {{ $ct->personal_phone_1 }}
                                    </a>
                                </div>
                                <small class="text-muted">{{ $ct->personal_email }}</small>
                            </td>
                            <td>
                                <span class="fw-semibold text-dark">{{ $ct->city_town }}</span>
                                <small class="text-muted d-block">{{ $ct->pincode }}</small>
                            </td>
                            <td>
                                @if($ct->status === 'approved')
                                    <span class="badge bg-success">Approved</span>
                                @elseif($ct->status === 'reviewed')
                                    <span class="badge bg-info text-dark">Reviewed</span>
                                @elseif($ct->status === 'rejected')
                                    <span class="badge bg-danger">Rejected</span>
                                @else
                                    <span class="badge bg-warning text-dark">Pending</span>
                                @endif
                            </td>
                            <td class="text-end pe-4">
                                <a href="{{ route('admin.caretakers.show', $ct->id) }}" class="btn btn-sm btn-outline-primary me-1" title="View Application">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <form action="{{ route('admin.caretakers.destroy', $ct->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Permanently delete application #{{ $ct->application_no }} for {{ addslashes($ct->name) }}?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>

                        <!-- Detailed View & Status Modal -->
                        <div class="modal fade" id="caretakerModal{{ $ct->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content border-0 shadow rounded-4">
                                    <div class="modal-header text-white" style="background: linear-gradient(135deg, #048444, #024724);">
                                        <div>
                                            <h5 class="modal-title fw-bold mb-0">
                                                <i class="fas fa-id-badge me-2"></i> Caretaker Profile: {{ $ct->name }}
                                            </h5>
                                            <small class="text-white-50">Application Ref: {{ $ct->application_no }} • Registered on {{ $ct->created_at->format('M d, Y') }}</small>
                                        </div>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body p-4">
                                        <div class="d-flex align-items-center gap-4 p-3 bg-light rounded-3 mb-4">
                                            <img src="{{ $ct->photo_url }}" alt="{{ $ct->name }}" 
                                                 class="rounded-3 border shadow-sm" style="width: 90px; height: 90px; object-fit: cover;">
                                            <div>
                                                <h4 class="fw-bold mb-1 text-dark">{{ $ct->name }}</h4>
                                                <div class="d-flex flex-wrap gap-2 align-items-center">
                                                    <span class="badge bg-success">{{ $ct->type }}</span>
                                                    <span class="badge bg-secondary">{{ $ct->gender }}</span>
                                                    <span class="badge bg-info text-dark">Age: {{ $ct->age }} (DOB: {{ $ct->dob ? $ct->dob->format('d/m/Y') : 'N/A' }})</span>
                                                </div>
                                                <div class="text-muted small mt-1">
                                                    <i class="fas fa-phone-alt me-1 text-success"></i> +91 {{ $ct->personal_phone_1 }} &nbsp;|&nbsp;
                                                    <i class="fas fa-envelope me-1 text-success"></i> {{ $ct->personal_email }}
                                                </div>
                                            </div>
                                        </div>

                                        <!-- 24 Fields Breakdown Grid -->
                                        <h6 class="fw-bold text-success mb-3"><i class="fas fa-user-md me-1"></i> Qualifications & Clinical Practice</h6>
                                        <div class="row g-2 mb-4" style="font-size: 13px;">
                                            <div class="col-sm-6 p-2 border rounded-2 bg-white">
                                                <strong class="text-muted d-block small">5. Highest Education Details:</strong>
                                                <span class="fw-bold text-dark">{{ $ct->highest_education }}</span>
                                            </div>
                                            <div class="col-sm-6 p-2 border rounded-2 bg-white">
                                                <strong class="text-muted d-block small">6. Specialization / Role:</strong>
                                                <span class="fw-bold text-dark">{{ $ct->specialization_role }}</span>
                                            </div>
                                            <div class="col-sm-6 p-2 border rounded-2 bg-white">
                                                <strong class="text-muted d-block small">7. Place of Registration:</strong>
                                                <span class="text-dark">{{ $ct->place_of_registration ?: 'Not specified' }}</span>
                                            </div>
                                            <div class="col-sm-6 p-2 border rounded-2 bg-white">
                                                <strong class="text-muted d-block small">8. Registration Number:</strong>
                                                <span class="fw-bold text-primary">{{ $ct->registration_no ?: 'N/A' }}</span>
                                            </div>
                                            <div class="col-sm-6 p-2 border rounded-2 bg-white">
                                                <strong class="text-muted d-block small">9. Place of Practicing:</strong>
                                                <span class="text-dark">{{ $ct->place_of_practicing ?: 'Independent Home Care' }}</span>
                                            </div>
                                            <div class="col-sm-6 p-2 border rounded-2 bg-white">
                                                <strong class="text-muted d-block small">10. Experience Breakdown:</strong>
                                                <span class="fw-bold text-dark">{{ $ct->experience_breakdown }}</span>
                                            </div>
                                            <div class="col-sm-6 p-2 border rounded-2 bg-white">
                                                <strong class="text-muted d-block small">11. Overall Clinical Experience:</strong>
                                                <span class="text-dark">{{ $ct->overall_experience }}</span>
                                            </div>
                                            <div class="col-sm-6 p-2 border rounded-2 bg-white">
                                                <strong class="text-muted d-block small">12. Practise Type:</strong>
                                                <span class="badge bg-light text-dark border">{{ $ct->practise_type }}</span>
                                            </div>
                                        </div>

                                        <!-- Contact & Residential Details -->
                                        <h6 class="fw-bold text-success mb-3"><i class="fas fa-map-marker-alt me-1"></i> Contact & Residential Details</h6>
                                        <div class="row g-2 mb-4" style="font-size: 13px;">
                                            <div class="col-sm-6 p-2 border rounded-2 bg-white">
                                                <strong class="text-muted d-block small">13. Personal Phone Number 1:</strong>
                                                <span class="fw-bold text-dark">+91 {{ $ct->personal_phone_1 }}</span>
                                            </div>
                                            <div class="col-sm-6 p-2 border rounded-2 bg-white">
                                                <strong class="text-muted d-block small">14. Emergency Phone Number 2:</strong>
                                                <span class="text-dark">{{ $ct->emergency_phone_2 ? '+91 ' . $ct->emergency_phone_2 : 'Not provided' }}</span>
                                            </div>
                                            <div class="col-sm-6 p-2 border rounded-2 bg-white">
                                                <strong class="text-muted d-block small">15. Personal Mail ID:</strong>
                                                <a href="mailto:{{ $ct->personal_email }}" class="text-primary">{{ $ct->personal_email }}</a>
                                            </div>
                                            <div class="col-sm-6 p-2 border rounded-2 bg-white">
                                                <strong class="text-muted d-block small">16. House / Building Number:</strong>
                                                <span class="text-dark">{{ $ct->house_building_no ?: 'N/A' }}</span>
                                            </div>
                                            <div class="col-sm-6 p-2 border rounded-2 bg-white">
                                                <strong class="text-muted d-block small">17. Present Address:</strong>
                                                <span class="text-dark">{{ $ct->present_address }}</span>
                                            </div>
                                            <div class="col-sm-6 p-2 border rounded-2 bg-white">
                                                <strong class="text-muted d-block small">18. Permanent Address:</strong>
                                                <span class="text-dark">{{ $ct->permanent_address }}</span>
                                            </div>
                                            <div class="col-sm-6 p-2 border rounded-2 bg-white">
                                                <strong class="text-muted d-block small">19. City / Town Name:</strong>
                                                <span class="fw-bold text-dark">{{ $ct->city_town }}</span>
                                            </div>
                                            <div class="col-sm-6 p-2 border rounded-2 bg-white">
                                                <strong class="text-muted d-block small">20. Pin Code:</strong>
                                                <span class="fw-bold text-dark">{{ $ct->pincode }}</span>
                                            </div>
                                        </div>

                                        <!-- Uploaded Documents (Fields 21 & 24) -->
                                        <h6 class="fw-bold text-success mb-3"><i class="fas fa-file-pdf me-1"></i> Uploaded Documents & Verifications</h6>
                                        <div class="row g-3 mb-4">
                                            <div class="col-sm-6">
                                                <div class="p-3 border rounded-3 bg-light text-center">
                                                    <i class="fas fa-graduation-cap text-success fs-3 mb-2 d-block"></i>
                                                    <strong class="d-block mb-1" style="font-size: 13px;">21. Education Certificate</strong>
                                                    @if($ct->education_doc_url)
                                                        <a href="{{ $ct->education_doc_url }}" target="_blank" class="btn btn-sm btn-outline-success fw-bold">
                                                            <i class="fas fa-download me-1"></i> View / Download Document
                                                        </a>
                                                    @else
                                                        <span class="text-muted small">No document uploaded</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="p-3 border rounded-3 bg-light text-center">
                                                    <i class="fas fa-id-card text-primary fs-3 mb-2 d-block"></i>
                                                    <strong class="d-block mb-1" style="font-size: 13px;">24. Govt ID Proof Document</strong>
                                                    @if($ct->govt_id_doc_url)
                                                        <a href="{{ $ct->govt_id_doc_url }}" target="_blank" class="btn btn-sm btn-outline-primary fw-bold">
                                                            <i class="fas fa-download me-1"></i> View / Download ID Proof
                                                        </a>
                                                    @else
                                                        <span class="text-muted small">No ID proof uploaded</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Admin Status Form -->
                                        <form action="{{ route('admin.caretakers.update_status', $ct->id) }}" method="POST">
                                            @csrf
                                            <div class="p-3 border rounded-3" style="background: #f8fafc;">
                                                <h6 class="fw-bold text-dark mb-2"><i class="fas fa-tasks text-success me-1"></i> Application Review & Verification Status</h6>
                                                <div class="row g-2 align-items-center">
                                                    <div class="col-sm-4">
                                                        <label class="form-label small fw-bold">Change Status</label>
                                                        <select name="status" class="form-select form-select-sm fw-bold">
                                                            <option value="pending" {{ $ct->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                                            <option value="reviewed" {{ $ct->status === 'reviewed' ? 'selected' : '' }}>Reviewed</option>
                                                            <option value="approved" {{ $ct->status === 'approved' ? 'selected' : '' }}>Approved</option>
                                                            <option value="rejected" {{ $ct->status === 'rejected' ? 'selected' : '' }}>Rejected</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <label class="form-label small fw-bold">Internal Admin Notes</label>
                                                        <input type="text" name="admin_notes" class="form-control form-control-sm" 
                                                               value="{{ $ct->admin_notes }}" placeholder="e.g. Verified nursing registration number with council, background clear...">
                                                    </div>
                                                    <div class="col-12 text-end mt-3">
                                                        <button type="submit" class="btn btn-sm btn-primary fw-bold px-3" style="background: #048444; border-color: #048444;">
                                                            <i class="fas fa-save me-1"></i> Save Changes
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-5 text-muted">
                                <i class="fas fa-user-nurse fs-1 mb-2 d-block text-secondary"></i>
                                No caretaker applications found matching the selected criteria.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($caretakers->hasPages())
        <div class="p-3 border-top d-flex justify-content-center">
            {{ $caretakers->links('pagination::bootstrap-5') }}
        </div>
        @endif
    </div>
</div>
@endsection
