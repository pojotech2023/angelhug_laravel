@include('header')

<style>
.service-detail-hero {
    background: linear-gradient(135deg, var(--ah-primary-dark) 0%, var(--ah-primary) 100%);
    padding: 44px 0 34px 0;
    color: #fff;
    position: relative;
    overflow: hidden;
}

.service-detail-hero::before {
    content: "";
    position: absolute;
    top: 0; left: 0; right: 0; bottom: 0;
    background: url("{{ asset('img/angelhug_docx/image9.png') }}") center/cover no-repeat;
    opacity: 0.16;
}

.service-info-card {
    background: #ffffff;
    border-radius: var(--ah-radius-lg);
    padding: 35px;
    box-shadow: var(--ah-card-shadow);
    border: 1px solid var(--ah-border);
}

.booking-sidebar-card {
    background: #ffffff;
    border-radius: var(--ah-radius-lg);
    padding: 24px;
    box-shadow: var(--ah-card-shadow);
    border: 2px solid var(--ah-cyan-border);
    position: sticky;
    top: 95px;
}

.gallery-thumbnail {
    height: 95px;
    width: 100%;
    object-fit: cover;
    border-radius: var(--ah-radius-sm);
    cursor: pointer;
    transition: transform 0.25s ease, box-shadow 0.25s ease;
}

.gallery-thumbnail:hover {
    transform: scale(1.05);
    box-shadow: 0 8px 18px rgba(4, 132, 68, 0.2);
}

.care-plan-features-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 8px 24px;
}
@media (min-width: 600px) {
    .care-plan-features-grid {
        grid-template-columns: 1fr 1fr;
    }
}
.care-plan-feature-item {
    display: flex;
    align-items: flex-start;
    gap: 9px;
    padding: 4px 0;
}
.care-plan-feature-item i {
    font-size: 14.5px;
    color: #048444;
    margin-top: 2px;
    flex-shrink: 0;
}
.care-plan-feature-item span {
    font-size: 13px;
    font-weight: 500;
    color: #1e293b;
    line-height: 1.45;
}

@media (max-width: 575.98px) {
    .service-detail-hero,
    .service-detail-hero .container,
    section.py-5 > .container {
        width: 100%;
        max-width: 100%;
        min-width: 0;
        box-sizing: border-box;
    }

    .service-detail-hero .container,
    section.py-5 > .container {
        padding-left: 12px;
        padding-right: 12px;
    }

    .service-detail-hero h1 {
        font-size: 28px;
        line-height: 1.2;
        overflow-wrap: anywhere;
    }

    .service-info-card,
    .booking-sidebar-card {
        width: 100%;
        max-width: 100%;
        min-width: 0;
        padding: 16px;
        box-sizing: border-box;
    }

    .service-info-card > *,
    .booking-sidebar-card > * {
        min-width: 0;
        max-width: 100%;
    }

    .service-info-card h2,
    .service-info-card h3,
    .service-info-card h4,
    .booking-sidebar-card h4 {
        overflow-wrap: anywhere;
    }

    #carePlansSection .d-flex.align-items-center.gap-2.mb-1 {
        flex-wrap: wrap;
        min-width: 0;
    }

    #carePlansSection .d-flex.align-items-center.gap-2.mb-1 .badge {
        max-width: 100%;
        white-space: normal;
        overflow-wrap: anywhere;
    }

    #carePlansSection h3 {
        font-size: 19px !important;
        line-height: 1.35;
    }

    #subServicesAccordion .card > [data-bs-toggle="collapse"] {
        flex-wrap: wrap;
        gap: 10px !important;
        padding: 14px 12px !important;
    }

    #subServicesAccordion .card > [data-bs-toggle="collapse"] > div:first-child {
        flex: 1 1 100%;
        min-width: 0;
        gap: 10px !important;
    }

    #subServicesAccordion .card > [data-bs-toggle="collapse"] > div:first-child > div {
        min-width: 0;
        overflow-wrap: anywhere;
    }

    #subServicesAccordion .card > [data-bs-toggle="collapse"] > div:last-child {
        flex: 1 1 100%;
        justify-content: space-between;
        padding-left: 44px;
    }

    #subServicesAccordion .card .collapse > div {
        padding: 16px 12px !important;
    }

    .care-plan-features-grid {
        grid-template-columns: minmax(0, 1fr);
    }

    .service-description,
    .care-plan-feature-item span {
        overflow-wrap: anywhere;
    }
}
</style>

<!-- Hero Section -->
<section class="service-detail-hero text-center position-relative">
    <div class="container position-relative" style="z-index: 2;">
        <span class="ah-badge-pill" style="background: rgba(255,255,255,0.2); color: #ffffff;">
            <i class="fas fa-stethoscope me-1"></i> Detailed Service Overview
        </span>
        <h1 class="text-white fw-bold display-5 mb-2">{{ $service->title }}</h1>
        <p class="lead text-white-50 mx-auto" style="max-width: 680px; font-size: 16px;">
            {{ $service->subtitle ?: 'Compassionate, verified healthcare support customized to your family member’s needs.' }}
        </p>
    </div>
</section>

<!-- Service Details Section -->
<section class="py-5" style="background: #f8fafc;">
    <div class="container py-3">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show rounded-3 shadow-sm mb-4" role="alert">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row g-4">
            <!-- Left Main Column -->
            <div class="col-lg-8">
                <div class="service-info-card mb-4">
                    <!-- Main Hero Image -->
                    <div class="mb-4 overflow-hidden rounded-4 shadow-sm" style="max-height: 450px;">
                        <img src="{{ $service->image_url }}" alt="{{ $service->title }}" class="w-100 h-100" style="object-fit: cover;">
                    </div>

                    <!-- Multiple Images Gallery -->
                    @if(!empty($service->gallery_urls) && count($service->gallery_urls) > 0)
                    <div class="mb-4">
                        <h6 class="fw-bold text-muted text-uppercase mb-2" style="font-size: 13px; letter-spacing: 0.5px;">Service Gallery & Equipment</h6>
                        <div class="row g-2">
                            @foreach($service->gallery_urls as $url)
                            <div class="col-3 col-sm-2">
                                <a href="{{ $url }}" target="_blank">
                                    <img src="{{ $url }}" class="gallery-thumbnail shadow-sm border" alt="Gallery">
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <div class="d-flex align-items-center gap-3 mb-2 flex-wrap">
                        <span class="badge bg-success px-3 py-2"><i class="fas fa-check-circle me-1"></i> Available for Booking</span>
                        @if($service->duration)
                            <span class="badge bg-light text-dark border px-3 py-2"><i class="far fa-clock text-primary me-1"></i> {{ $service->duration }}</span>
                        @endif
                    </div>

                    <h2 class="fw-bold mb-2" style="color: var(--ah-primary);">{{ $service->title }}</h2>

                    @if($service->subtitle)
                        <h5 class="text-muted mb-4" style="font-weight: 500; font-size: 17px;">{{ $service->subtitle }}</h5>
                    @endif

                    <hr class="my-4">

                    <h4 class="fw-bold mb-3" style="color: var(--ah-primary);"><i class="fas fa-notes-medical me-2"></i> Clinical Overview & Care Protocol</h4>
                    <div class="service-description" style="line-height: 1.85; color: var(--ah-slate-600); font-size: 15.5px;">
                        {!! nl2br(e($service->description)) !!}
                    </div>

                    @if($service->subServices && $service->subServices->isNotEmpty())
                    @php
                        $minPlanPrice = $service->subServices->min('price');
                    @endphp
                    <!-- Care Plans & Sub-Services (Directly on Page - NO POPUP) -->
                    <div class="mt-4 pt-4 border-top" id="carePlansSection">
                        <div class="d-flex align-items-center justify-content-between mb-3 pb-2 border-bottom flex-wrap gap-2">
                            <div>
                                <div class="d-flex align-items-center gap-2 mb-1">
                                    <span class="badge" style="background: #e8f7ee; color: #048444; border: 1px solid rgba(4, 132, 68, 0.25); font-size: 11.5px; font-weight: 700; padding: 5px 12px; border-radius: 20px;">
                                        <i class="fas fa-layer-group me-1"></i> Care Plans & Sub-Services
                                    </span>
                                    <span class="badge bg-light text-success border border-success-subtle fw-bold" style="font-size: 11.5px;">
                                        <i class="fas fa-check-double me-1"></i> {{ $service->subServices->count() }} Specialized Plans Available
                                    </span>
                                </div>
                                <h3 class="fw-bold mb-1 text-dark" style="font-size: 22px; letter-spacing: -0.3px;">
                                    Select a Specialized Care Plan
                                </h3>
                                <p class="text-muted small mb-0" style="font-size: 13px;">
                                    Browse the clinical task checklist and pricing below. Click <strong>"Choose This Care Plan & Book"</strong> to proceed.
                                </p>
                            </div>
                        </div>

                        <div class="accordion" id="subServicesAccordion">
                            @foreach($service->subServices as $index => $sub)
                            <div class="card mb-3 border shadow-sm rounded-4 overflow-hidden" style="border: 1.5px solid {{ $index === 0 ? '#048444' : '#e2e8f0' }} !important;">
                                <div class="d-flex align-items-center justify-content-between gap-3"
                                     style="background: {{ $index === 0 ? '#f0fdf4' : '#ffffff' }}; cursor: pointer; padding: 18px 24px !important;"
                                     data-bs-toggle="collapse" 
                                     data-bs-target="#subCollapse{{ $sub->id }}" 
                                     aria-expanded="{{ $index === 0 ? 'true' : 'false' }}">
                                    
                                    <div class="d-flex align-items-center gap-3 min-w-0 flex-grow-1">
                                        <span style="width: 34px; height: 34px; min-width: 34px; border-radius: 50%; background: #048444; color: #ffffff; font-weight: 800; font-size: 14px; display: inline-flex; align-items: center; justify-content: center; box-shadow: 0 2px 6px rgba(4, 132, 68, 0.25);">
                                            {{ $loop->iteration }}
                                        </span>
                                        <div class="min-w-0">
                                            <h5 class="fw-bold mb-0 text-dark" style="font-size: 16.5px; letter-spacing: -0.2px;">
                                                {{ $sub->title }}
                                            </h5>
                                            @if($sub->subtitle)
                                                <small class="text-muted d-block text-truncate" style="font-size: 12px;">{{ $sub->subtitle }}</small>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center gap-3 flex-shrink-0">
                                        <div class="text-end">
                                            <small class="text-muted d-block text-uppercase" style="font-size: 10px; letter-spacing: 0.5px;">Starts at</small>
                                            <strong class="text-success fs-5 fw-bold" style="font-family: inherit;">{{ $sub->formatted_price }}</strong>
                                        </div>
                                        <span class="btn btn-sm btn-light rounded-circle border p-0 d-flex align-items-center justify-content-center" style="width: 30px; height: 30px; background: #f8fafc;">
                                            <i class="fas fa-chevron-down text-muted" style="font-size: 11px;"></i>
                                        </span>
                                    </div>
                                </div>

                                <div id="subCollapse{{ $sub->id }}" class="collapse {{ $index === 0 ? 'show' : '' }}" data-bs-parent="#subServicesAccordion">
                                    <div class="border-top" style="background: #ffffff; padding: 22px 24px !important;">
                                        @if(!empty($sub->features_list) && count($sub->features_list) > 0)
                                        <div class="mb-3">
                                            <div class="d-flex align-items-center gap-2 mb-3 pb-2 border-bottom">
                                                <span class="badge" style="background: #e8f7ee; color: #048444; border: 1px solid rgba(4, 132, 68, 0.25); font-size: 11px; font-weight: 700; padding: 4px 10px; border-radius: 6px;">
                                                    <i class="fas fa-clipboard-check me-1"></i> CLINICAL PROTOCOL
                                                </span>
                                                <strong class="text-dark small" style="font-size: 12.5px;">
                                                    What's Included in This Care Plan ({{ count($sub->features_list) }} Tasks):
                                                </strong>
                                            </div>
                                            <div class="care-plan-features-grid">
                                                @foreach($sub->features_list as $feature)
                                                <div class="care-plan-feature-item">
                                                    <i class="fas fa-check-circle text-success"></i>
                                                    <span>{{ $feature }}</span>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        @endif

                                        <div class="d-flex align-items-center justify-content-between p-3 rounded-3 mt-4 border flex-wrap gap-3" style="background: #f0fdf4; border: 1.5px solid #bbf7d0 !important;">
                                            <div class="d-flex align-items-center gap-3">
                                                <div>
                                                    <small class="text-muted text-uppercase fw-bold d-block" style="font-size: 10.5px; letter-spacing: 0.5px;">Standard Care Rate</small>
                                                    <span class="fs-4 fw-bold text-success" style="line-height: 1.1;">{{ $sub->formatted_price }}</span>
                                                </div>
                                                @if($sub->duration)
                                                <div class="border-start ps-3" style="border-color: #bbf7d0 !important;">
                                                    <small class="text-muted text-uppercase fw-bold d-block" style="font-size: 10.5px; letter-spacing: 0.5px;">Shift Duration</small>
                                                    <span class="fw-bold text-dark" style="font-size: 14px;"><i class="far fa-clock text-primary me-1"></i> {{ $sub->duration }}</span>
                                                </div>
                                                @endif
                                            </div>

                                            <div>
                                                <a href="{{ route('booking.create', ['service_id' => $service->id, 'sub_service' => $sub->id]) }}" 
                                                   class="btn btn-success fw-bold px-4 py-2 shadow-sm d-inline-flex align-items-center gap-2" 
                                                   style="background-color: #048444; border-color: #048444; border-radius: 8px; font-size: 13.5px; padding-top: 10px; padding-bottom: 10px;">
                                                    <span>Choose This Care Plan & Book</span> <i class="fas fa-arrow-right"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Action buttons -->
                    <div class="mt-4 pt-4 border-top d-flex gap-3 flex-wrap">
                        <a href="{{ route('booking.create', $service->id) }}" class="ah-btn-primary btn-lg px-4 py-3" style="font-size: 16px;">
                            <i class="fas fa-calendar-check me-2"></i> Book This Service Now
                        </a>
                        <a href="{{ route('service') }}" class="ah-btn-outline btn-lg px-4 py-3" style="font-size: 16px;">
                            <i class="fas fa-arrow-left me-2"></i> Back to All Services
                        </a>
                    </div>
                </div>
            </div>

            <!-- Right Sidebar Column -->
            <div class="col-lg-4">
                <div class="booking-sidebar-card mb-4">
                    <span class="ah-badge-pill ah-badge-accent mb-3"><i class="fas fa-bolt me-1"></i> Direct Booking</span>
                    <h4 class="fw-bold mb-2" style="color: var(--ah-primary);">Schedule Appointment</h4>

                    <div class="p-3 bg-light rounded-3 my-3">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <span class="text-muted fw-semibold" style="font-size: 13.5px;">Standard Fee:</span>
                            <span class="fw-bold fs-4 text-success">{{ $service->formatted_price }}</span>
                        </div>
                        @if($service->duration)
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-muted fw-semibold" style="font-size: 13.5px;">Shift / Duration:</span>
                            <span class="fw-bold text-dark" style="font-size: 13.5px;"><i class="far fa-clock text-primary me-1"></i> {{ $service->duration }}</span>
                        </div>
                        @endif
                    </div>

                    @if($service->subServices && $service->subServices->isNotEmpty())
                    @php
                        $sidebarMinPrice = $service->subServices->min('price');
                    @endphp
                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-2.5 flex-wrap gap-1">
                            <span class="fw-bold text-dark text-uppercase" style="font-size: 11.5px; letter-spacing: 0.5px;">
                                <i class="fas fa-layer-group text-success me-1"></i> Care Plans ({{ $service->subServices->count() }})
                            </span>
                            <span class="badge bg-success-subtle text-success border border-success-subtle fw-bold" style="font-size: 11px;">
                                From ₹{{ number_format($sidebarMinPrice, 0) }}
                            </span>
                        </div>

                        <div class="d-flex flex-column" style="gap: 10px;">
                            @foreach($service->subServices as $sub)
                            <a href="{{ route('booking.create', ['service_id' => $service->id, 'sub_service' => $sub->id]) }}" 
                               class="rounded-3 border text-dark d-block text-decoration-none shadow-sm"
                               style="background: #ffffff; border: 1.5px solid #e2e8f0; padding: 12px 14px; transition: all 0.2s ease;"
                               onmouseover="this.style.background='#f0fdf4'; this.style.borderColor='#048444';"
                               onmouseout="this.style.background='#ffffff'; this.style.borderColor='#e2e8f0';"
                               title="Book {{ $sub->title }} at {{ $sub->formatted_price }}">
                                
                                <!-- Top row: Number circle + Title spanning full available width -->
                                <div class="d-flex align-items-start" style="gap: 10px;">
                                    <span style="width: 22px; height: 22px; min-width: 22px; border-radius: 50%; background: #048444; color: #ffffff; font-size: 11px; font-weight: 800; display: inline-flex; align-items: center; justify-content: center; margin-top: 1px; flex-shrink: 0;">
                                        {{ $loop->iteration }}
                                    </span>
                                    <div class="fw-bold text-dark flex-grow-1" style="font-size: 13px; line-height: 1.35; min-height: 35px;">
                                        {{ $sub->title }}
                                    </div>
                                </div>

                                <!-- Bottom row: Duration on left, Price Badge on right -->
                                <div class="d-flex align-items-center justify-content-between pt-2 mt-2 border-top" style="padding-left: 32px; border-color: #f1f5f9 !important;">
                                    <span class="text-muted" style="font-size: 11px;">
                                        <i class="far fa-clock text-primary me-1"></i> {{ $sub->duration ?: '12 Hours Shift' }}
                                    </span>
                                    <span class="badge bg-success-subtle text-success border border-success-subtle fw-bold" style="font-size: 12px; padding: 3px 8px; border-radius: 6px;">
                                        {{ $sub->formatted_price }}
                                    </span>
                                </div>
                            </a>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Prominent Book Button (Directs to booking flow) -->
                    <a href="{{ route('booking.create', $service->id) }}" class="ah-btn-primary w-100 justify-content-center py-3 fs-5 shadow-sm mt-3 mb-3">
                        <i class="fas fa-calendar-alt me-2"></i> Book This Service
                    </a>

                    <div class="d-flex align-items-center justify-content-center gap-2 text-muted small mb-4">
                        <i class="fas fa-shield-alt text-success"></i> OTP Verified & Razorpay Secure
                    </div>

                    <hr>

                    <!-- Quick Enquiry Form -->
                    <h5 class="fw-bold mt-3 mb-2" style="color: var(--ah-primary);"><i class="fas fa-question-circle me-1"></i> Have Inquiries?</h5>
                    <p class="text-muted small mb-3">Send a message and our nurse supervisor will contact you shortly.</p>

                    <form action="{{ route('contact.enquiry') }}" method="POST">
                        @csrf
                        <input type="hidden" name="service_id" value="{{ $service->id }}">
                        <input type="hidden" name="subject" value="Enquiry for {{ $service->title }}">

                        <div class="mb-2">
                            <input type="text" name="name" class="form-control" placeholder="Your Full Name" required>
                        </div>
                        <div class="mb-2">
                            <input type="email" name="email" class="form-control" placeholder="Your Email" required>
                        </div>
                        <div class="mb-2">
                            <input type="text" name="phone" class="form-control" placeholder="Mobile Number" required>
                        </div>
                        <div class="mb-3">
                            <textarea name="message" class="form-control" rows="3" placeholder="Describe patient condition or special requests..." required></textarea>
                        </div>
                        <button type="submit" class="btn btn-outline-primary w-100 fw-bold py-2" style="border-radius: var(--ah-radius-sm);">
                            <i class="fas fa-paper-plane me-1"></i> Send Enquiry
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Related Services Grid -->
        @if(isset($details) && $details->count() > 0)
        <div class="mt-5 pt-3">
            <h3 class="fw-bold mb-4" style="color: var(--ah-primary);"><i class="fas fa-hand-holding-medical me-2"></i> Other Popular Services</h3>
            <div class="row g-4">
                @foreach($details as $item)
                <div class="col-md-4">
                    <div class="ah-service-card">
                        <div class="ah-service-img-wrapper" style="height: 180px;">
                            <img src="{{ $item->image_url }}" alt="{{ $item->title }}">
                            <div class="ah-service-price-tag">{{ $item->formatted_price }}</div>
                        </div>
                        <div class="ah-service-body p-3">
                            <h5 class="fw-bold mb-2" style="color: var(--ah-primary);">{{ $item->title }}</h5>
                            <div class="mt-auto d-flex gap-2">
                                <a href="{{ route('booking.create', $item->id) }}" class="ah-btn-primary btn-sm flex-fill justify-content-center py-2">
                                    <i class="fas fa-calendar-check me-1"></i> Book
                                </a>
                                <a href="{{ route('servicedetails', $item->id) }}" class="btn btn-outline-secondary btn-sm px-3 py-2 fw-bold" style="border-radius: var(--ah-radius-sm);">
                                    Details
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</section>

@include('footer')
