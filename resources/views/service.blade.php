@include('header')

<style>
.service-hero-area {
    background: linear-gradient(135deg, var(--ah-primary-dark) 0%, var(--ah-primary) 100%);
    padding: 75px 0 65px 0 !important;
    color: #fff;
    position: relative;
    overflow: hidden;
}

.service-hero-area::before {
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
</style>

<!-- Hero Section (Matches About Us Exact Height & Style) -->
<section class="service-hero-area text-center position-relative">
    <div class="container position-relative" style="z-index: 2;">
        <span class="feature-pill text-white" style="background: rgba(255,255,255,0.2); border-color: rgba(255,255,255,0.3);">
            <i class="fas fa-stethoscope me-1"></i> Certified In-Home Medical Solutions
        </span>
        <h1 class="text-white fw-bold display-5 mb-3">Our Healthcare & Nursing Services</h1>
        <p class="lead text-white-50 mx-auto mb-0" style="max-width: 720px;">
            Explore our specialized patient care plans below. Click <strong>"Book This Service"</strong> on any service to pick your date, time slot, verify via OTP, and confirm online.
        </p>
    </div>
</section>

<!-- Services Grid -->
<section class="py-5" style="background: #f8fafc;">
    <div class="container py-4">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show rounded-3 shadow-sm mb-4" role="alert">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row g-4">
            @forelse($services as $service)
            <div class="col-lg-4 col-md-6 mb-4 d-flex align-items-stretch">
                <div class="ah-service-card w-100 d-flex flex-column">
                    <!-- Image & Price Tag -->
                    <div class="ah-service-img-wrapper">
                        <img src="{{ $service->image_url }}" alt="{{ $service->title }}">
                        @if($service->price > 0)
                            <div class="ah-service-price-tag">
                                {{ $service->formatted_price }}
                            </div>
                        @endif
                    </div>

                    <!-- Card Body -->
                    <div class="ah-service-body d-flex flex-column flex-grow-1">
                        <div class="ah-service-meta">
                            @if($service->duration)
                                <span><i class="far fa-clock text-primary me-1"></i> {{ $service->duration }}</span>
                            @endif
                            <span class="ms-auto"><i class="fas fa-user-shield text-success me-1"></i> Certified Nurse</span>
                        </div>

                        <h3 class="ah-service-title">{{ $service->title }}</h3>

                        <p class="ah-service-desc mb-3" style="flex-grow: 0;">
                            {{ Str::limit($service->subtitle ?: strip_tags($service->description), 110) }}
                        </p>

                        @if($service->subServices && $service->subServices->isNotEmpty())
                        @php
                            $minCardPrice = $service->subServices->min('price');
                        @endphp
                        <!-- Inline Sub-Services Accordion (NO POPUP) -->
                        <div class="mb-3">
                            <button type="button" class="btn btn-sm btn-light border w-100 text-start d-flex justify-content-between align-items-center py-2 px-3 rounded-3" 
                                    style="background: #f0fdf4; border-color: #bbf7d0 !important;"
                                    data-bs-toggle="collapse" 
                                    data-bs-target="#cardSubServices{{ $service->id }}" 
                                    aria-expanded="false">
                                <span class="fw-bold text-success" style="font-size: 12px;">
                                    <i class="fas fa-layer-group me-1"></i> {{ $service->subServices->count() }} Care Plans Available
                                </span>
                                <span class="badge bg-white text-success border border-success-subtle fw-bold" style="font-size: 11px;">
                                    From ₹{{ number_format($minCardPrice, 0) }} <i class="fas fa-chevron-down ms-1" style="font-size: 9px;"></i>
                                </span>
                            </button>

                            <div class="collapse mt-2" id="cardSubServices{{ $service->id }}">
                                <div class="p-2 border rounded-3 bg-light d-flex flex-column gap-2" style="border-color: #e2e8f0 !important;">
                                    @foreach($service->subServices as $sub)
                                    <div class="p-2 bg-white rounded-2 border" style="border-color: #e2e8f0 !important;">
                                        <div class="d-flex justify-content-between align-items-start gap-2 mb-1">
                                            <strong class="text-dark small text-wrap" style="font-size: 12px; line-height: 1.35;">{{ $sub->title }}</strong>
                                            <span class="badge bg-light text-success border border-success-subtle fw-bold flex-shrink-0" style="font-size: 11px;">
                                                {{ $sub->formatted_price }}
                                            </span>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center pt-1">
                                            <small class="text-muted" style="font-size: 10.5px;"><i class="far fa-clock text-primary me-1"></i> {{ $sub->duration ?: '12 Hours' }}</small>
                                            <a href="{{ route('booking.create', ['service_id' => $service->id, 'sub_service' => $sub->id]) }}" 
                                               class="btn btn-sm btn-success px-2.5 py-0.5 text-white fw-bold" 
                                               style="font-size: 11px; border-radius: 6px; background-color: #048444; border-color: #048444;"
                                               title="Book this specific care plan">
                                                Book Plan <i class="fas fa-arrow-right ms-0.5"></i>
                                            </a>
                                        </div>
                                    </div>
                                    @endforeach
                                    <a href="{{ route('servicedetails', $service->id) }}#carePlansSection" class="text-center text-success small fw-bold text-decoration-none py-1">
                                        View Full Inclusions Checklist <i class="fas fa-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- Action buttons: Booking is handled inside services -->
                        <div class="pt-3 border-top mt-auto">
                            <a href="{{ route('servicedetails', $service->id) }}" class="ah-btn-primary w-100 justify-content-center py-2.5 shadow-sm" title="View details and book service">
                                <i class="fas fa-calendar-check me-2"></i> Book / View Service
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <div class="p-5 bg-white rounded-4 shadow-sm">
                    <i class="fas fa-heartbeat fs-1 text-muted mb-3"></i>
                    <h4>No services currently listed</h4>
                    <p class="text-muted">Please contact our healthcare coordinators for custom service inquiries.</p>
                    <a href="{{ route('contact') }}" class="ah-btn-primary mt-2">Contact Us</a>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Bottom CTA Section -->
<section class="py-5 text-white" style="background: linear-gradient(135deg, var(--ah-primary-dark) 0%, var(--ah-primary) 100%);">
    <div class="container text-center py-3">
        <h3 class="fw-bold text-white mb-2">Need Help Deciding on the Right Care Package?</h3>
        <p class="text-white-50 mb-4 mx-auto" style="max-width: 620px;">
            Our medical staff is available around the clock to assess patient needs and guide you to the ideal care plan.
        </p>
        @php
            $contactPhone = \App\Models\Setting::get('contact_phone', '+91 80725 15050');
        @endphp
        <div class="d-flex justify-content-center gap-3 flex-wrap">
            <a href="tel:{{ preg_replace('/[^0-9+]/', '', $contactPhone) }}" class="btn btn-light px-4 py-3 fw-bold shadow-sm" style="border-radius: var(--ah-radius-sm); color: var(--ah-primary) !important;">
                <i class="fas fa-phone-alt me-2"></i> Call {{ $contactPhone }}
            </a>
            <a href="{{ route('contact') }}" class="btn btn-outline-light px-4 py-3 fw-bold" style="border-radius: var(--ah-radius-sm);">
                <i class="fas fa-envelope me-2"></i> Submit an Enquiry
            </a>
        </div>
    </div>
</section>

@include('footer')
