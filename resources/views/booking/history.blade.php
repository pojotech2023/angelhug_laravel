@include('header')

<style>
/* Modern Healthcare Hero Banner (Matches About Us Hero Size Exactly) */
.history-hero {
    background: linear-gradient(135deg, var(--ah-primary-dark) 0%, var(--ah-primary) 100%);
    padding: 75px 0 65px 0 !important;
    color: #fff;
    position: relative;
    overflow: hidden;
}

.history-hero::before {
    content: "";
    position: absolute;
    top: 0; left: 0; right: 0; bottom: 0;
    background: url("{{ asset('img/angelhug_docx/image5.png') }}") center/cover no-repeat;
    opacity: 0.18;
}

.feature-pill {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 8px 18px;
    background: var(--ah-primary-soft);
    color: var(--ah-primary);
    border: 1px solid rgba(4, 132, 68, 0.18);
    border-radius: 30px;
    font-weight: 700;
    font-size: 13px;
    margin-bottom: 15px;
}

/* Page Background Wrapper (Clean, Natural Positioning) */
.history-page-wrap {
    background: #f8fafc;
    padding: 45px 0 70px 0;
}

/* Patient Profile Widget Card */
.patient-profile-widget {
    background: #ffffff;
    border-radius: 20px;
    box-shadow: 0 12px 35px rgba(4, 132, 68, 0.07), 0 2px 8px rgba(0,0,0,0.03);
    border: 1px solid rgba(4, 132, 68, 0.12);
    padding: 28px 22px;
    text-align: center;
}

.patient-avatar-circle {
    width: 76px;
    height: 76px;
    border-radius: 50%;
    background: #e8f7ee;
    color: var(--ah-primary);
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 34px;
    border: 3px solid rgba(4, 132, 68, 0.25);
    box-shadow: 0 8px 20px rgba(4, 132, 68, 0.15);
    margin-bottom: 14px;
}

.patient-info-pill {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 10px;
    padding: 8px 14px;
    font-size: 13px;
    color: var(--ah-slate-700);
    display: inline-flex;
    align-items: center;
    gap: 10px;
    width: 100%;
    margin-bottom: 10px;
    word-break: break-all;
}

/* Main Dashboard Card */
.history-feed-card {
    background: #ffffff;
    border-radius: 20px;
    box-shadow: 0 12px 35px rgba(4, 132, 68, 0.07), 0 2px 8px rgba(0,0,0,0.03);
    border: 1px solid rgba(4, 132, 68, 0.12);
    padding: 26px 26px;
}

/* Modern Streamlined Appointment Ticket Card (Perfect Alignment, Zero Dead Space) */
.appointment-ticket-card {
    background: #ffffff;
    border: 1.5px solid #e2e8f0;
    border-radius: 16px;
    overflow: hidden;
    transition: all 0.25s ease;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
}

.appointment-ticket-card:hover {
    border-color: var(--ah-primary);
    box-shadow: 0 10px 30px rgba(4, 132, 68, 0.12);
    transform: translateY(-2px);
}

.ticket-header-bar {
    background: #f8fafc;
    border-bottom: 1px solid #eef2f6;
    padding: 10px 18px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 10px;
}

.ticket-body-bar {
    padding: 18px 20px;
}

.ticket-service-img {
    width: 72px;
    height: 72px;
    border-radius: 12px;
    object-fit: cover;
    border: 1.5px solid rgba(4, 132, 68, 0.2);
    flex-shrink: 0;
}

.ticket-meta-tag {
    background: #f1f5f9;
    border-radius: 8px;
    padding: 3px 8px;
    font-size: 12px;
    color: var(--ah-slate-700);
    display: inline-flex;
    align-items: center;
    gap: 4px;
}
</style>

<!-- Hero Section (Matches About Us Exact Height & Style) -->
<section class="history-hero text-center position-relative">
    <div class="container position-relative" style="z-index: 2;">
        <span class="feature-pill text-white" style="background: rgba(255,255,255,0.2); border-color: rgba(255,255,255,0.3);">
            <i class="fas fa-user-circle me-1"></i> Patient Portal & Care History
        </span>
        <h1 class="text-white fw-bold display-5 mb-3">Service History & Appointments</h1>
        <p class="lead text-white-50 mx-auto mb-0" style="max-width: 720px;">
            Manage your healthcare services, download official payment receipts, and schedule follow-up care visits.
        </p>
    </div>
</section>

<!-- Main History Content (Proper Positioning & Clean Spacing) -->
<div class="history-page-wrap">
    <div class="container">
        <div class="row g-4 align-items-start">
            <!-- Patient Identity Column (Left) -->
            <div class="col-lg-4 col-xl-3">
                <div class="patient-profile-widget">
                    <div class="patient-avatar-circle">
                        <i class="fas fa-user-check"></i>
                    </div>
                    <h5 class="fw-bold mb-1" style="color: var(--ah-slate-900); font-size: 18px;">{{ $user->name ?: 'Customer' }}</h5>
                    <span class="badge bg-success-subtle text-success border border-success mb-3" style="font-size: 11px;">
                        <i class="fas fa-check-circle me-1"></i> Verified Patient
                    </span>

                    <div class="patient-info-pill">
                        <i class="fas fa-phone-alt text-success"></i>
                        <span>+91 {{ $user->mobile_no }}</span>
                    </div>

                    @if($user->email)
                    <div class="patient-info-pill">
                        <i class="fas fa-envelope text-success"></i>
                        <span>{{ $user->email }}</span>
                    </div>
                    @endif

                    <div class="d-grid gap-2 mt-3 pt-2 border-top">
                        <a href="{{ route('booking.create') }}" class="ah-btn-primary w-100 justify-content-center py-2 shadow-sm" style="font-size: 13.5px; border-radius: 10px;">
                            <i class="fas fa-plus-circle me-1"></i> Book New Service
                        </a>
                        <a href="{{ route('logout') }}" class="btn btn-outline-danger btn-sm py-2 fw-bold" style="font-size: 12.5px; border-radius: 10px;">
                            <i class="fas fa-sign-out-alt me-1"></i> Logout
                        </a>
                    </div>
                </div>
            </div>

            <!-- Appointment Feed Column (Right) -->
            <div class="col-lg-8 col-xl-9">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show rounded-4 p-3 mb-3 shadow-sm border-0 d-flex align-items-center gap-3" style="background: #e8f7ee; border-left: 5px solid var(--ah-primary) !important;" role="alert">
                        <div class="rounded-circle bg-success text-white d-flex align-items-center justify-content-center flex-shrink-0" style="width: 38px; height: 38px; font-size: 18px;">
                            <i class="fas fa-check"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="fw-bold mb-0" style="color: var(--ah-primary); font-size: 14.5px;">Appointment Booked Successfully!</h6>
                            <p class="mb-0 text-dark small" style="font-size: 13px;">{{ session('success') }}</p>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="history-feed-card">
                    <!-- Header with Inline Pill Badge & New Booking CTA -->
                    <div class="d-flex justify-content-between align-items-center pb-3 mb-3 border-bottom flex-wrap gap-2">
                        <div class="d-flex align-items-center gap-2">
                            <h5 class="fw-bold mb-0" style="color: var(--ah-primary); font-size: 18px;">Your Service Appointments</h5>
                            <span class="badge bg-success-subtle text-success border border-success fw-bold px-2 py-1" style="font-size: 11.5px;">
                                {{ $bookings->total() }} {{ Str::plural('Booking', $bookings->total()) }}
                            </span>
                        </div>
                        <a href="{{ route('booking.create') }}" class="ah-btn-primary btn-sm py-2 px-3 fw-bold" style="font-size: 13px; border-radius: 10px;">
                            <i class="fas fa-calendar-plus me-1"></i> Book New Service
                        </a>
                    </div>

                    @if($bookings->isEmpty())
                        <div class="text-center py-5">
                            <div class="p-3 bg-light rounded-circle d-inline-block mb-3 text-muted" style="width: 76px; height: 76px; line-height: 52px;">
                                <i class="fas fa-calendar-times fs-1 text-success"></i>
                            </div>
                            <h5 class="fw-bold text-dark mb-1">No appointments booked yet</h5>
                            <p class="text-muted small mb-4 mx-auto" style="max-width: 440px;">
                                You haven't scheduled any healthcare visits so far. Browse our certified nursing services and book an appointment with verified caregivers today.
                            </p>
                            <a href="{{ route('booking.create') }}" class="ah-btn-primary px-4 py-2 fw-bold" style="font-size: 14px; border-radius: 12px;">
                                <i class="fas fa-stethoscope me-1"></i> Book Your First Service
                            </a>
                        </div>
                    @else
                        <div class="d-flex flex-column gap-3">
                            @foreach($bookings as $booking)
                            <div class="appointment-ticket-card">
                                <!-- Top Bar: Booking Reference, Status & Schedule -->
                                <div class="ticket-header-bar">
                                    <div class="d-flex align-items-center gap-2 flex-wrap">
                                        <span class="badge bg-light text-dark border fw-bold px-2 py-1" style="font-size: 11px;">
                                            <i class="fas fa-hashtag text-muted me-1"></i>{{ $booking->booking_number }}
                                        </span>
                                        @if($booking->booking_status === 'confirmed')
                                            <span class="badge bg-success" style="font-size: 11px;"><i class="fas fa-check-circle me-1"></i>Confirmed</span>
                                        @elseif($booking->booking_status === 'completed')
                                            <span class="badge bg-info text-dark" style="font-size: 11px;">Completed</span>
                                        @elseif($booking->booking_status === 'cancelled')
                                            <span class="badge bg-danger" style="font-size: 11px;">Cancelled</span>
                                        @else
                                            <span class="badge bg-warning text-dark" style="font-size: 11px;">{{ ucfirst($booking->booking_status) }}</span>
                                        @endif

                                        @if($booking->payment_status === 'paid')
                                            <span class="badge bg-success-subtle text-success border border-success fw-bold" style="font-size: 11px;">
                                                <i class="fas fa-check-circle me-1"></i> Paid
                                            </span>
                                        @else
                                            <span class="badge bg-secondary" style="font-size: 11px;">{{ ucfirst($booking->payment_status) }}</span>
                                        @endif
                                    </div>

                                    <!-- Scheduled Date & Time Badge -->
                                    <div class="d-flex align-items-center gap-2 text-dark fw-bold" style="font-size: 13px;">
                                        <span><i class="far fa-calendar-alt text-success me-1"></i> {{ \Carbon\Carbon::parse($booking->booking_date)->format('D, M d, Y') }}</span>
                                        <span class="text-muted">•</span>
                                        <span class="text-primary"><i class="far fa-clock text-primary me-1"></i> {{ $booking->booking_time }}</span>
                                    </div>
                                </div>

                                <!-- Body Bar: Service Details & Pricing/Actions (Balanced 2-Side Layout) -->
                                <div class="ticket-body-bar">
                                    <div class="row align-items-center g-3">
                                        <!-- Service Info (Left & Center) -->
                                        <div class="col-lg-8 d-flex align-items-start gap-3">
                                            <img src="{{ $booking->service->image_url ?? asset('img/about-1.jpg') }}" alt="Service" class="ticket-service-img">
                                            <div class="flex-grow-1 min-w-0">
                                                <h6 class="fw-bold mb-1" style="color: var(--ah-primary); font-size: 16px; line-height: 1.3;">
                                                    {{ $booking->service->title ?? 'Specialized Healthcare Service' }}
                                                </h6>

                                                <div class="d-flex align-items-center gap-2 flex-wrap mb-2">
                                                    <span class="ticket-meta-tag">
                                                        <i class="fas fa-clock text-success"></i>
                                                        {{ $booking->duration_type ?: (Str::contains($booking->service->duration, 'Shift') ? $booking->service->duration : ($booking->service->duration ? $booking->service->duration . ' Shift' : '8 Hrs Shift')) }}
                                                    </span>
                                                    <span class="ticket-meta-tag">
                                                        <i class="far fa-user text-primary"></i>
                                                        Patient: <strong class="text-dark">{{ $booking->patient_name ?: $booking->customer_name }}</strong>
                                                        @if($booking->patient_age) ({{ $booking->patient_age }}y, {{ $booking->patient_gender ?: '' }}) @endif
                                                    </span>
                                                    @if($booking->caller_name && $booking->caller_name !== $booking->patient_name)
                                                    <span class="ticket-meta-tag">
                                                        <i class="fas fa-user-friends text-info"></i>
                                                        Caller: <span class="text-dark">{{ $booking->caller_name }} ({{ $booking->caller_relationship ?: 'Family' }})</span>
                                                    </span>
                                                    @endif
                                                </div>

                                                @if($booking->customer_address || $booking->google_maps_link)
                                                <div class="p-2 rounded-2 bg-light border mt-2" style="font-size: 12.5px; line-height: 1.45;">
                                                    <div class="d-flex align-items-start gap-2">
                                                        <i class="fas fa-map-marker-alt text-danger mt-1 flex-shrink-0"></i>
                                                        <div>
                                                            <span class="fw-bold text-dark">Service Address:</span>
                                                            <span class="text-muted">{{ $booking->customer_address ?: 'GPS Location Provided' }}</span>
                                                            @if($booking->google_maps_link)
                                                                <div class="mt-1">
                                                                    <a href="{{ $booking->google_maps_link }}" target="_blank" class="text-success fw-bold" style="font-size: 11.5px; text-decoration: underline;">
                                                                        <i class="fas fa-external-link-alt me-1"></i> View on Google Maps / Live Pin
                                                                    </a>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif
                                            </div>
                                        </div>

                                        <!-- Amount & Actions Panel (Right - Tightly Grouped & Aligned) -->
                                        <div class="col-lg-4 text-lg-end pt-2 pt-lg-0 border-top border-lg-0">
                                            <div class="d-flex flex-column align-items-lg-end gap-2">
                                                <div>
                                                    <small class="text-muted d-block" style="font-size: 11px;">Total Amount Paid</small>
                                                    <span class="fw-bold text-success" style="font-size: 22px;">₹{{ number_format($booking->amount, 2) }}</span>
                                                </div>
                                                <div class="d-flex gap-2 justify-content-lg-end w-100 flex-wrap">
                                                    <a href="{{ route('booking.confirmation', $booking->booking_number) }}" class="btn btn-outline-success btn-sm fw-bold py-1 px-3" style="font-size: 12.5px; border-color: var(--ah-primary); color: var(--ah-primary); border-radius: 8px;">
                                                        <i class="fas fa-file-invoice me-1"></i> Receipt
                                                    </a>
                                                    <a href="{{ route('booking.create', $booking->service_id) }}" class="ah-btn-primary btn-sm py-1 px-3 fw-bold" style="font-size: 12.5px; border-radius: 8px;">
                                                        <i class="fas fa-redo me-1"></i> Re-book
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        @if($bookings->hasPages())
                        <div class="mt-4 d-flex justify-content-center">
                            {{ $bookings->links('pagination::bootstrap-5') }}
                        </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@include('footer')
