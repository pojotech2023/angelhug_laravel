@extends('layouts.app')

@section('content')
<style>
    .kpi-card {
        background: #ffffff;
        border-radius: 16px;
        padding: 22px 20px;
        box-shadow: 0 4px 20px rgba(15, 23, 42, 0.05);
        border: 1px solid #e2e8f0;
        transition: all 0.28s cubic-bezier(0.4, 0, 0.2, 1);
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        position: relative;
        overflow: hidden;
    }

    .kpi-card::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3.5px;
        background: var(--kpi-accent, #048444);
        border-radius: 16px 16px 0 0;
    }

    .kpi-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 14px 30px rgba(15, 23, 42, 0.1);
        border-color: rgba(4, 132, 68, 0.25);
    }

    .kpi-card:hover .kpi-icon {
        transform: scale(1.08);
    }

    .kpi-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        transition: transform 0.25s ease;
        flex-shrink: 0;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04);
    }

    .kpi-title {
        font-size: 11.5px;
        font-weight: 700;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        color: #64748b;
        margin-bottom: 4px;
        display: block;
    }

    .kpi-value {
        font-size: 26px;
        font-weight: 800;
        letter-spacing: -0.5px;
        line-height: 1.15;
        margin: 0;
    }

    .kpi-footer {
        border-top: 1px solid #f1f5f9;
        padding-top: 10px;
        margin-top: 14px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        font-size: 12px;
    }

    .kpi-link {
        font-weight: 700;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        transition: gap 0.2s ease;
    }

    .kpi-card:hover .kpi-link {
        gap: 8px;
    }

    .admin-welcome-card {
        background: linear-gradient(135deg, #024724 0%, #048444 100%);
        border-radius: 20px;
        padding: 28px 32px;
        color: #ffffff;
        box-shadow: 0 12px 30px rgba(2, 71, 36, 0.18);
        margin-bottom: 24px;
    }
</style>

<!-- Welcome Header Card -->
<div class="admin-welcome-card">
    <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
        <div class="d-flex align-items-center gap-3">
            <img src="{{ asset('Angelhug Logo/FullLogo_Transparent_NoBuffer.png') }}" alt="AngelHug Logo" 
                 style="height: 75px; width: auto; object-fit: contain; background: #fff; border-radius: 16px; padding: 8px;">
            <div>
                <h2 class="fw-bold mb-1 text-white">Angelhug Administration Dashboard</h2>
                <p class="mb-0 text-white-50">Welcome back, <strong>{{ session('user.email') ?? 'Administrator' }}</strong>! Here is an overview of healthcare services, bookings, and customer enquiries.</p>
            </div>
        </div>
        <div class="d-flex gap-2 flex-wrap">
            <a href="{{ route('services.create') }}" class="btn btn-light fw-bold shadow-sm" style="color: #048444 !important;">
                <i class="fas fa-plus me-1"></i> Add Service
            </a>
            <a href="{{ route('admin.banners.create') }}" class="btn btn-outline-light fw-bold">
                <i class="fas fa-image me-1"></i> Add Banner
            </a>
            <a href="{{ route('admin.caretakers.create') }}" class="btn btn-outline-light fw-bold">
                <i class="fas fa-user-nurse me-1"></i> Caretaker Form
            </a>
            <a href="{{ route('admin.billing.index') }}" class="btn btn-outline-light fw-bold">
                <i class="fas fa-percentage me-1"></i> GST & Extra Fees
            </a>
        </div>
    </div>
</div>

<!-- KPI Metric Cards: Exactly 2 Balanced Rows (4 Cards per Row on Desktop) -->
<div class="row g-4 mb-4">
    <!-- ROW 1, CARD 1: Active Services -->
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="kpi-card" style="--kpi-accent: #048444;">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <div>
                    <span class="kpi-title">Active Services</span>
                    <h3 class="kpi-value" style="color: #048444;">{{ $totalServices ?? 0 }}</h3>
                </div>
                <div class="kpi-icon" style="background: #e8f7ee; color: #048444;">
                    <i class="fas fa-stethoscope"></i>
                </div>
            </div>
            <div class="kpi-footer">
                <a href="{{ route('services.index') }}" class="kpi-link" style="color: #048444;">
                    Manage Services <i class="fas fa-arrow-right"></i>
                </a>
                <span class="badge" style="background: #e8f7ee; color: #048444; font-size: 10.5px;">Live</span>
            </div>
        </div>
    </div>

    <!-- ROW 1, CARD 2: Service Bookings -->
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="kpi-card" style="--kpi-accent: #00bbd7;">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <div>
                    <span class="kpi-title">Service Bookings</span>
                    <h3 class="kpi-value" style="color: #00bbd7;">{{ $totalBookings ?? 0 }}</h3>
                </div>
                <div class="kpi-icon" style="background: #e0f8fa; color: #00bbd7;">
                    <i class="fas fa-calendar-check"></i>
                </div>
            </div>
            <div class="kpi-footer">
                <a href="{{ route('admin.bookings.index') }}" class="kpi-link" style="color: #00bbd7;">
                    View Bookings <i class="fas fa-arrow-right"></i>
                </a>
                <span class="badge" style="background: #e0f8fa; color: #00bbd7; font-size: 10.5px;">All Shifts</span>
            </div>
        </div>
    </div>

    <!-- ROW 1, CARD 3: Total Revenue (Paid) -->
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="kpi-card" style="--kpi-accent: #10b981;">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <div>
                    <span class="kpi-title">Total Revenue (Paid)</span>
                    <h3 class="kpi-value text-success" style="font-size: 22px;">₹{{ number_format($totalRevenue ?? 0, 2) }}</h3>
                </div>
                <div class="kpi-icon" style="background: #ecfdf5; color: #10b981;">
                    <i class="fas fa-wallet"></i>
                </div>
            </div>
            <div class="kpi-footer">
                <span class="small text-muted"><i class="fas fa-check-circle text-success me-1"></i> Razorpay Verified</span>
                <span class="badge bg-success text-white" style="font-size: 10px;">Settled</span>
            </div>
        </div>
    </div>

    <!-- ROW 1, CARD 4: Registered Customers -->
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="kpi-card" style="--kpi-accent: #6366f1;">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <div>
                    <span class="kpi-title">Registered Customers</span>
                    <h3 class="kpi-value" style="color: #6366f1;">{{ $totalCustomers ?? 0 }}</h3>
                </div>
                <div class="kpi-icon" style="background: #eef2ff; color: #6366f1;">
                    <i class="fas fa-users"></i>
                </div>
            </div>
            <div class="kpi-footer">
                <a href="{{ route('admin.customers.index') }}" class="kpi-link" style="color: #6366f1;">
                    View Customers <i class="fas fa-arrow-right"></i>
                </a>
                <span class="badge" style="background: #eef2ff; color: #6366f1; font-size: 10.5px;">Profiles</span>
            </div>
        </div>
    </div>

    <!-- ROW 2, CARD 5: Caretaker Applications -->
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="kpi-card" style="--kpi-accent: #f59e0b;">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <div>
                    <span class="kpi-title">Caretaker Applications</span>
                    <h3 class="kpi-value" style="color: #f59e0b;">{{ $totalCaretakers ?? 0 }}</h3>
                </div>
                <div class="kpi-icon" style="background: #fef3c7; color: #d97706;">
                    <i class="fas fa-user-nurse"></i>
                </div>
            </div>
            <div class="kpi-footer">
                <a href="{{ route('admin.caretakers.index') }}" class="kpi-link" style="color: #d97706;">
                    Review Forms <i class="fas fa-arrow-right"></i>
                </a>
                <span class="badge" style="background: #fef3c7; color: #d97706; font-size: 10.5px;">Resumes</span>
            </div>
        </div>
    </div>

    <!-- ROW 2, CARD 6: Service Enquiries -->
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="kpi-card" style="--kpi-accent: #ef4444;">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <div>
                    <span class="kpi-title">New Service Enquiries</span>
                    <h3 class="kpi-value text-danger">{{ $newEnquiriesCount ?? 0 }}</h3>
                </div>
                <div class="kpi-icon" style="background: #fee2e2; color: #dc2626;">
                    <i class="fas fa-envelope-open-text"></i>
                </div>
            </div>
            <div class="kpi-footer">
                <a href="{{ route('admin.enquiries.index') }}" class="kpi-link text-danger">
                    Review Enquiries <i class="fas fa-arrow-right"></i>
                </a>
                <span class="badge bg-danger text-white" style="font-size: 10px;">{{ $newEnquiriesCount ?? 0 }} New</span>
            </div>
        </div>
    </div>

    <!-- ROW 2, CARD 7: Home Banners -->
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="kpi-card" style="--kpi-accent: #0ea5e9;">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <div>
                    <span class="kpi-title">Home Banners</span>
                    <h3 class="kpi-value" style="color: #0284c7;">{{ $totalBanners ?? 0 }}</h3>
                </div>
                <div class="kpi-icon" style="background: #e0f2fe; color: #0284c7;">
                    <i class="fas fa-images"></i>
                </div>
            </div>
            <div class="kpi-footer">
                <a href="{{ route('admin.banners.index') }}" class="kpi-link" style="color: #0284c7;">
                    Manage Banners <i class="fas fa-arrow-right"></i>
                </a>
                <span class="badge" style="background: #e0f2fe; color: #0284c7; font-size: 10.5px;">Active</span>
            </div>
        </div>
    </div>

    <!-- ROW 2, CARD 8: GST & Extra Charges -->
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="kpi-card" style="--kpi-accent: #8b5cf6;">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <div>
                    <span class="kpi-title">GST & Extra Charges</span>
                    <h3 class="kpi-value" style="color: #7c3aed; font-size: 22px;">
                        {{ \App\Models\Setting::get('gst_percentage', 5) }}% <small class="fw-bold" style="font-size: 14px; color: #64748b;">GST</small>
                    </h3>
                </div>
                <div class="kpi-icon" style="background: #ede9fe; color: #7c3aed;">
                    <i class="fas fa-file-invoice-dollar"></i>
                </div>
            </div>
            <div class="kpi-footer">
                <a href="{{ route('admin.billing.index') }}" class="kpi-link" style="color: #7c3aed;">
                    Manage Billing <i class="fas fa-arrow-right"></i>
                </a>
                <span class="badge" style="background: #ede9fe; color: #7c3aed; font-size: 10.5px;">₹{{ number_format(\App\Models\Setting::get('platform_fee', 99), 0) }} Protocol</span>
            </div>
        </div>
    </div>
</div>

    <!-- Recent Bookings and Enquiries Row -->
    <div class="row g-4 mb-4">
        <!-- Recent Bookings -->
        <div class="col-lg-7">
            <div class="card border-0 shadow-sm rounded-4 p-4 h-100">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="fw-bold mb-0" style="color: #048444;"><i class="fas fa-calendar-alt text-primary me-2"></i> Recent Service Bookings</h5>
                    <a href="{{ route('admin.bookings.index') }}" class="btn btn-outline-primary btn-sm fw-bold">View All</a>
                </div>

                @if(isset($recentBookings) && $recentBookings->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Booking Ref</th>
                                <th>Service</th>
                                <th>Customer</th>
                                <th>Date & Time</th>
                                <th>Amount</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentBookings as $bk)
                            <tr>
                                <td>
                                    <a href="{{ route('admin.bookings.show', $bk->id) }}" class="fw-bold text-primary">
                                        {{ $bk->booking_number }}
                                    </a>
                                </td>
                                <td>{{ Str::limit($bk->service->title ?? 'Service', 18) }}</td>
                                <td>
                                    <div><strong>{{ $bk->customer_name }}</strong></div>
                                    <small class="text-muted">{{ $bk->customer_phone }}</small>
                                </td>
                                <td>
                                    <div>{{ \Carbon\Carbon::parse($bk->booking_date)->format('M d') }}</div>
                                    <small class="text-muted">{{ $bk->booking_time }}</small>
                                </td>
                                <td><strong>₹{{ number_format($bk->amount, 2) }}</strong></td>
                                <td>
                                    @if($bk->booking_status === 'confirmed')
                                        <span class="badge bg-success">Confirmed</span>
                                    @elseif($bk->booking_status === 'completed')
                                        <span class="badge bg-info">Completed</span>
                                    @else
                                        <span class="badge bg-secondary">{{ ucfirst($bk->booking_status) }}</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="text-center py-4 text-muted">
                    <i class="far fa-calendar-times fs-2 mb-2 d-block"></i>
                    No bookings recorded yet.
                </div>
                @endif
            </div>
        </div>

        <!-- Recent Enquiries -->
        <div class="col-lg-5">
            <div class="card border-0 shadow-sm rounded-4 p-4 h-100">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="fw-bold mb-0" style="color: #048444;"><i class="fas fa-inbox text-warning me-2"></i> Recent Enquiries</h5>
                    <a href="{{ route('admin.enquiries.index') }}" class="btn btn-outline-primary btn-sm fw-bold">View All</a>
                </div>

                @if(isset($recentEnquiries) && $recentEnquiries->count() > 0)
                <div class="d-flex flex-column gap-3">
                    @foreach($recentEnquiries as $enq)
                    <div class="p-3 border rounded-3 bg-light">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <strong style="color: #048444;">{{ $enq->name }}</strong>
                            <small class="text-muted">{{ $enq->created_at->diffForHumans() }}</small>
                        </div>
                        <div class="small text-muted mb-2">
                            <i class="fas fa-phone-alt me-1"></i> {{ $enq->phone ?: 'N/A' }} | 
                            <i class="fas fa-envelope me-1"></i> {{ $enq->email }}
                        </div>
                        <p class="small mb-2 text-dark">{{ Str::limit($enq->message, 85) }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            @if($enq->status === 'new')
                                <span class="badge bg-danger">New</span>
                            @elseif($enq->status === 'contacted')
                                <span class="badge bg-warning text-dark">Contacted</span>
                            @else
                                <span class="badge bg-success">Resolved</span>
                            @endif
                            <a href="{{ route('admin.enquiries.index') }}" class="small fw-bold">View Details</a>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="text-center py-4 text-muted">
                    <i class="far fa-envelope-open fs-2 mb-2 d-block"></i>
                    No enquiries recorded yet.
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Recent Caretaker Applications Table -->
    @if(isset($recentCaretakers) && $recentCaretakers->count() > 0)
    <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="fw-bold mb-0" style="color: #048444;">
                <i class="fas fa-user-nurse text-success me-2"></i> Recent Caretaker / Nurse Applications
            </h5>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.caretakers.create') }}" class="btn btn-sm btn-success fw-bold" style="background: #048444; border-color: #048444;">
                    <i class="fas fa-plus me-1"></i> Add Caretaker
                </a>
                <a href="{{ route('admin.caretakers.index') }}" class="btn btn-outline-success btn-sm fw-bold">
                    View All Caretakers
                </a>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Applicant</th>
                        <th>Type</th>
                        <th>Education & Specialization</th>
                        <th>Experience</th>
                        <th>Phone</th>
                        <th>City</th>
                        <th>Status</th>
                        <th class="text-end">Full Form</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentCaretakers as $ct)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="{{ $ct->photo_url }}" alt="{{ $ct->name }}" class="rounded-circle me-2 border shadow-sm" style="width: 36px; height: 36px; object-fit: cover;">
                                <div>
                                    <strong class="d-block text-dark">{{ $ct->name }}</strong>
                                    <small class="text-muted">{{ $ct->application_no }}</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="badge" style="background: #e8f7ee; color: #048444; border: 1px solid rgba(4, 132, 68, 0.25);">{{ $ct->type }}</span>
                        </td>
                        <td>
                            <strong class="d-block text-dark" style="font-size: 13px;">{{ $ct->highest_education }}</strong>
                            <small class="text-muted">{{ $ct->specialization_role }}</small>
                        </td>
                        <td>{{ $ct->overall_experience }}</td>
                        <td>
                            <a href="tel:{{ $ct->personal_phone_1 }}" class="text-dark fw-bold text-decoration-none">
                                <i class="fas fa-phone-alt text-success me-1"></i> {{ $ct->personal_phone_1 }}
                            </a>
                        </td>
                        <td>{{ $ct->city_town }}</td>
                        <td>
                            @if($ct->status === 'approved')
                                <span class="badge bg-success">Approved</span>
                            @elseif($ct->status === 'reviewed')
                                <span class="badge bg-info text-dark">Reviewed</span>
                            @else
                                <span class="badge bg-warning text-dark">Pending</span>
                            @endif
                        </td>
                        <td class="text-end">
                            <a href="{{ route('admin.caretakers.show', $ct->id) }}" class="btn btn-sm btn-outline-success fw-bold" title="View Full Caretaker Form">
                                <i class="fas fa-file-invoice me-1"></i> View Form
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif

    <!-- Login History Table -->
    @if(isset($customerLogins) && $customerLogins->count())
        <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="fw-bold mb-0" style="color: #048444;"><i class="fas fa-history text-secondary me-2"></i> User Login Activity</h5>
                <a href="{{ route('dashboard.login_export') }}" class="btn btn-primary btn-sm fw-bold text-white" style="background-color: #048444; border-color: #048444;">
                    <i class="fas fa-download me-1"></i> Export Excel
                </a>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile Number</th>
                            <th>Last Activity</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($customerLogins as $index => $login)
                        <tr>
                            <td>{{ $customerLogins->firstItem() + $index }}</td>
                            <td><strong>{{ $login->name }}</strong></td>
                            <td>{{ $login->email }}</td>
                            <td>{{ $login->mobile_no ?? '-' }}</td>
                            <td>{{ \Carbon\Carbon::parse($login->updated_at)->format('d-M-Y H:i') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-3 d-flex justify-content-center">
                {{ $customerLogins->links('pagination::bootstrap-5') }}
            </div>
        </div>
    @endif
@endsection
