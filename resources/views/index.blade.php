@include('header')

<style>
/* Hero Slider Styles */
.hero-slider-section {
    position: relative;
    overflow: hidden;
}

.hero-slider-section .swiper-container {
    height: 75vh;
    min-height: 520px;
    max-height: 660px;
}

.hero-slide-item {
    position: relative;
    background-size: cover;
    background-position: center center;
    height: 100%;
    display: flex;
    align-items: center;
    padding: 40px 0;
}

.hero-gradient-overlay {
    position: absolute;
    top: 0; left: 0; right: 0; bottom: 0;
    background: linear-gradient(90deg, rgba(2, 43, 22, 0.92) 0%, rgba(4, 132, 68, 0.78) 55%, rgba(0, 187, 215, 0.45) 100%);
    z-index: 1;
}

.hero-slide-content {
    position: relative;
    z-index: 2;
    max-width: 680px;
}

.hero-title {
    color: #ffffff !important;
    font-size: clamp(32px, 4.5vw, 52px);
    font-weight: 800;
    line-height: 1.18;
    margin-bottom: 18px;
    letter-spacing: -0.02em;
}

.hero-subtitle {
    color: rgba(255, 255, 255, 0.9);
    font-size: clamp(15px, 1.8vw, 18px);
    line-height: 1.65;
    margin-bottom: 28px;
    font-weight: 400;
}

/* Swiper navigation buttons */
.swiper-button-next, .swiper-button-prev {
    color: #ffffff !important;
    background: rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(8px);
    width: 48px;
    height: 48px;
    border-radius: 50%;
    transition: all 0.25s ease;
}

.swiper-button-next:hover, .swiper-button-prev:hover {
    background: var(--ah-primary);
    transform: scale(1.08);
}

.swiper-button-next::after, .swiper-button-prev::after {
    font-size: 18px !important;
    font-weight: bold;
}

/* Step Cards */
.ah-step-card {
    background: #ffffff;
    border-radius: var(--ah-radius-md);
    padding: 30px 24px;
    border: 1px solid var(--ah-border);
    box-shadow: var(--ah-card-shadow);
    position: relative;
    height: 100%;
    transition: all 0.3s ease;
}

.ah-step-card:hover {
    transform: translateY(-6px);
    box-shadow: var(--ah-hover-shadow);
    border-color: rgba(10, 77, 104, 0.25);
}

.ah-step-number {
    position: absolute;
    top: 20px;
    right: 20px;
    font-size: 44px;
    font-weight: 800;
    color: rgba(10, 77, 104, 0.08);
    line-height: 1;
}

/* Testimonials */
.ah-testimonial-card {
    background: #ffffff;
    border-radius: var(--ah-radius-lg);
    padding: 32px 28px;
    border: 1px solid var(--ah-border);
    box-shadow: var(--ah-card-shadow);
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.star-rating {
    color: #f59e0b;
    font-size: 14px;
    margin-bottom: 14px;
}
</style>

<!-- =========================================================================
     HERO SLIDER
     ========================================================================= -->
<section class="hero-slider-section">
    <div class="swiper-container">
        <div class="swiper-wrapper">
            @if(isset($banners) && count($banners) > 0)
                @foreach($banners as $banner)
                <div class="swiper-slide">
                    <div class="hero-slide-item" style="background-image: url('{{ $banner->image_url }}');">
                        <div class="hero-gradient-overlay"></div>
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="hero-slide-content">
                                        <span class="ah-badge-pill" style="background: rgba(255,255,255,0.18); color: #ffffff; border: 1px solid rgba(255,255,255,0.25);">
                                            <i class="fas fa-heartbeat text-info me-1"></i> 24/7 Professional In-Home Healthcare
                                        </span>
                                        <h1 class="hero-title">{{ $banner->title }}</h1>
                                        @if($banner->subtitle)
                                            <p class="hero-subtitle">{{ $banner->subtitle }}</p>
                                        @endif
                                        <div class="d-flex gap-3 flex-wrap pt-2">
                                            <a href="{{ route('service') }}" class="ah-btn-primary" style="padding: 13px 28px; font-size: 15px;">
                                                <i class="fas fa-stethoscope"></i> Our Services
                                            </a>
                                            <a href="{{ route('contact') }}" class="btn btn-outline-light px-4 py-3 fw-bold" style="border-radius: var(--ah-radius-sm); font-size: 15px;">
                                                <i class="fas fa-envelope me-1"></i> Contact Us
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            @else
                <div class="swiper-slide">
                    <div class="hero-slide-item" style="background-image: url('{{ asset('img/angelhug_docx/image5.png') }}');">
                        <div class="hero-gradient-overlay"></div>
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="hero-slide-content">
                                        <span class="ah-badge-pill" style="background: rgba(255,255,255,0.18); color: #ffffff;">
                                            <i class="fas fa-heartbeat text-info me-1"></i> Compassionate Home Nursing
                                        </span>
                                        <h1 class="hero-title">Dedicated Care & Medical Assistance at Your Doorstep</h1>
                                        <p class="hero-subtitle">
                                            Angelhug brings trusted, licensed nurses, specialized geriatric caregivers, and therapists directly to your home with transparent pricing.
                                        </p>
                                        <div class="d-flex gap-3 flex-wrap pt-2">
                                            <a href="{{ route('service') }}" class="ah-btn-primary">
                                                <i class="fas fa-stethoscope"></i> Our Services
                                            </a>
                                            <a href="{{ route('contact') }}" class="btn btn-outline-light px-4 py-2 fw-bold">
                                                Contact Us
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <div class="swiper-pagination"></div>
        <div class="swiper-button-next d-none d-md-flex"></div>
        <div class="swiper-button-prev d-none d-md-flex"></div>
    </div>
</section>

<!-- =========================================================================
     STATS RIBBON AFTER HERO
     ========================================================================= -->
<div class="container">
    <div class="ah-stats-ribbon">
        <div class="row g-4 align-items-center">
            <div class="col-6 col-lg-3">
                <div class="ah-stat-item border-end-lg">
                    <div class="ah-stat-number"><i class="fas fa-user-shield text-primary me-2"></i>500+</div>
                    <div class="ah-stat-label">Happy Patients Cared</div>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="ah-stat-item border-end-lg">
                    <div class="ah-stat-number text-success"><i class="fas fa-certificate text-success me-2"></i>100%</div>
                    <div class="ah-stat-label">Certified & Vetted Staff</div>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="ah-stat-item border-end-lg">
                    <div class="ah-stat-number" style="color: var(--ah-cyan);"><i class="fas fa-clock me-2"></i>24/7</div>
                    <div class="ah-stat-label">On-Call Support & Visits</div>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="ah-stat-item">
                    <div class="ah-stat-number" style="color: var(--ah-gold);"><i class="fas fa-star me-2"></i>4.9★</div>
                    <div class="ah-stat-label">Family Satisfaction</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- =========================================================================
     ABOUT ANGELHUG (WHO WE ARE)
     ========================================================================= -->
<section class="py-5" style="background: #ffffff; padding-top: 16px !important;">
    <div class="container py-4">
        <div class="row align-items-center g-5">
            <!-- Left Narrative -->
            <div class="col-lg-6">
                @php
                    $homeBrandName = \App\Models\Setting::get('brand_name', 'Angelhug');
                    $homeAboutBadge = \App\Models\Setting::get('about_badge', 'About ' . $homeBrandName);
                    $homeAboutTitle = \App\Models\Setting::get('about_title', \App\Http\Controllers\AdminWebsiteSettingController::DEFAULT_ABOUT_TITLE);
                    $homeAboutDesc1 = \App\Models\Setting::get('about_description_1', \App\Http\Controllers\AdminWebsiteSettingController::DEFAULT_ABOUT_DESC_1);
                    $homeAboutDesc2 = \App\Models\Setting::get('about_description_2', \App\Http\Controllers\AdminWebsiteSettingController::DEFAULT_ABOUT_DESC_2);
                    $homeAboutPoint1 = \App\Models\Setting::get('about_point_1', \App\Http\Controllers\AdminWebsiteSettingController::DEFAULT_ABOUT_POINT_1);
                    $homeAboutPoint2 = \App\Models\Setting::get('about_point_2', \App\Http\Controllers\AdminWebsiteSettingController::DEFAULT_ABOUT_POINT_2);
                    $homeAboutPoint3 = \App\Models\Setting::get('about_point_3', \App\Http\Controllers\AdminWebsiteSettingController::DEFAULT_ABOUT_POINT_3);
                    $homeAboutPoint4 = \App\Models\Setting::get('about_point_4', \App\Http\Controllers\AdminWebsiteSettingController::DEFAULT_ABOUT_POINT_4);
                @endphp
                <span class="ah-badge-pill"><i class="fas fa-info-circle me-1"></i> {{ $homeAboutBadge }}</span>
                <h2 class="ah-section-title mb-3">{{ $homeAboutTitle }}</h2>
                <p class="text-muted" style="line-height: 1.8; font-size: 15.5px;">
                    {!! nl2br(e($homeAboutDesc1)) !!}
                </p>
                @if(!empty($homeAboutDesc2))
                <p class="text-muted" style="line-height: 1.8; font-size: 15.5px;">
                    {!! nl2br(e($homeAboutDesc2)) !!}
                </p>
                @endif

                <!-- Checkpoints -->
                <div class="row g-3 mt-2 mb-4">
                    @if(!empty($homeAboutPoint1))
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center gap-2">
                            <i class="fas fa-check-circle text-success fs-5"></i>
                            <span class="fw-bold text-dark">{{ $homeAboutPoint1 }}</span>
                        </div>
                    </div>
                    @endif
                    @if(!empty($homeAboutPoint2))
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center gap-2">
                            <i class="fas fa-check-circle text-success fs-5"></i>
                            <span class="fw-bold text-dark">{{ $homeAboutPoint2 }}</span>
                        </div>
                    </div>
                    @endif
                    @if(!empty($homeAboutPoint3))
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center gap-2">
                            <i class="fas fa-check-circle text-success fs-5"></i>
                            <span class="fw-bold text-dark">{{ $homeAboutPoint3 }}</span>
                        </div>
                    </div>
                    @endif
                    @if(!empty($homeAboutPoint4))
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center gap-2">
                            <i class="fas fa-check-circle text-success fs-5"></i>
                            <span class="fw-bold text-dark">{{ $homeAboutPoint4 }}</span>
                        </div>
                    </div>
                    @endif
                </div>

                <div class="d-flex gap-3 flex-wrap">
                    <a href="{{ route('service') }}" class="ah-btn-primary">
                        <i class="fas fa-stethoscope"></i> Explore Services
                    </a>
                    <a href="{{ route('about') }}" class="ah-btn-outline">
                        Learn More About Us
                    </a>
                </div>
            </div>

            <!-- Right Image Showcase -->
            <div class="col-lg-6">
                <div class="position-relative">
                    @php
                        $aboutImage = \App\Models\Setting::get('about_image');
                        $aboutImageUrl = $aboutImage ? asset('storage/' . $aboutImage) : asset('img/about_nurse_patient.jpg');
                    @endphp
                    <img src="{{ $aboutImageUrl }}" alt="{{ \App\Models\Setting::get('brand_name', 'Angelhug') }} Healthcare" 
                         class="img-fluid rounded-4 shadow-lg w-100" style="object-fit: cover; max-height: 480px; border: 1px solid rgba(4, 132, 68, 0.15);">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- =========================================================================
     FEATURED HEALTHCARE SERVICES
     ========================================================================= -->
<section class="py-5 ah-light-bg" id="servicesSection">
    <div class="container py-4">
        <!-- Section Header -->
        <div class="text-center mb-5">
            <span class="ah-badge-pill"><i class="fas fa-hand-holding-medical me-1"></i> Dedicated Solutions</span>
            <h2 class="ah-section-title">Our Healthcare Services</h2>
            <p class="ah-section-subtitle">
                Explore our specialized services below. Click <strong>"Book This Service"</strong> on any card to choose your date, time slot, and confirm online.
            </p>
        </div>

        <!-- Services Grid -->
        <div class="row g-4">
            @if(isset($services) && count($services) > 0)
                @foreach($services as $service)
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
                                <span class="ms-auto"><i class="fas fa-shield-alt text-success me-1"></i> Verified</span>
                            </div>

                            <h3 class="ah-service-title">{{ $service->title }}</h3>

                            <p class="ah-service-desc mb-3" style="flex-grow: 0;">
                                {{ Str::limit($service->subtitle ?: strip_tags($service->description), 110) }}
                            </p>

                            @if($service->subServices && $service->subServices->isNotEmpty())
                            @php
                                $minHomePrice = $service->subServices->min('price');
                            @endphp
                            <!-- Inline Sub-Services (NO POPUP) -->
                            <div class="mb-3">
                                <button type="button" class="btn btn-sm btn-light border w-100 text-start d-flex justify-content-between align-items-center py-2 px-3 rounded-3" 
                                        style="background: #f0fdf4; border-color: #bbf7d0 !important;"
                                        data-bs-toggle="collapse" 
                                        data-bs-target="#homeCardSub{{ $service->id }}" 
                                        aria-expanded="false">
                                    <span class="fw-bold text-success" style="font-size: 12px;">
                                        <i class="fas fa-layer-group me-1"></i> {{ $service->subServices->count() }} Care Plans
                                    </span>
                                    <span class="badge bg-white text-success border border-success-subtle fw-bold" style="font-size: 11px;">
                                        From ₹{{ number_format($minHomePrice, 0) }} <i class="fas fa-chevron-down ms-1" style="font-size: 9px;"></i>
                                    </span>
                                </button>

                                <div class="collapse mt-2" id="homeCardSub{{ $service->id }}">
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
                                                <small class="text-muted" style="font-size: 10.5px;"><i class="far fa-clock text-primary me-1"></i> {{ $sub->duration ?: 'Shift' }}</small>
                                                <a href="{{ route('booking.create', ['service_id' => $service->id, 'sub_service' => $sub->id]) }}" 
                                                   class="btn btn-sm btn-success px-2.5 py-0.5 text-white fw-bold" 
                                                   style="font-size: 11px; border-radius: 6px; background-color: #048444; border-color: #048444;">
                                                    Book <i class="fas fa-arrow-right ms-0.5"></i>
                                                </a>
                                            </div>
                                        </div>
                                        @endforeach
                                        <a href="{{ route('servicedetails', $service->id) }}#carePlansSection" class="text-center text-success small fw-bold text-decoration-none py-1" style="font-size: 11.5px;">
                                            View Inclusions Checklist <i class="fas fa-arrow-right ms-1"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endif

                            <!-- Booking & Details Button (Single direct link) -->
                            <div class="pt-2 border-top mt-auto">
                                <a href="{{ route('servicedetails', $service->id) }}" class="ah-btn-primary w-100 justify-content-center py-2.5 shadow-sm" title="View details and book service">
                                    <i class="fas fa-calendar-check me-2"></i> Book / View Service
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            @else
                <div class="col-12 text-center py-5">
                    <p class="text-muted">Services are being loaded. Please check back shortly.</p>
                </div>
            @endif
        </div>

        <div class="text-center mt-5">
            <a href="{{ route('service') }}" class="ah-btn-outline px-4 py-3" style="font-size: 15px;">
                View All Services & Packages <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
</section>

<!-- =========================================================================
     WHY CHOOSE ANGELHUG
     ========================================================================= -->
<section class="py-5" style="background: #ffffff;">
    <div class="container py-4">
        <div class="text-center mb-5">
            <span class="ah-badge-pill ah-badge-accent"><i class="fas fa-award me-1"></i> Why Angelhug</span>
            <h2 class="ah-section-title">Why Families Entrust Us With Their Loved Ones</h2>
            <p class="ah-section-subtitle">
                We blend medical excellence with personal warmth, giving families total peace of mind every single day.
            </p>
        </div>

        <div class="row g-4">
            <div class="col-lg-3 col-md-6">
                <div class="ah-feature-card">
                    <div class="ah-feature-icon">
                        <i class="fas fa-user-check"></i>
                    </div>
                    <h5 class="fw-bold mb-2">Licensed & Vetted Staff</h5>
                    <p class="text-muted small mb-0">Every nurse and caregiver undergoes stringent background screening, credential checks, and hospital clinical training.</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="ah-feature-card">
                    <div class="ah-feature-icon">
                        <i class="fas fa-clipboard-list"></i>
                    </div>
                    <h5 class="fw-bold mb-2">Tailored Care Plans</h5>
                    <p class="text-muted small mb-0">We customize our nursing routines to align precisely with patient mobility, vital schedules, and physician guidelines.</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="ah-feature-card">
                    <div class="ah-feature-icon">
                        <i class="fas fa-tag"></i>
                    </div>
                    <h5 class="fw-bold mb-2">Transparent Pricing</h5>
                    <p class="text-muted small mb-0">Clear, upfront rates with no surprise charges. Easy online OTP booking and secure Razorpay payment options.</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="ah-feature-card">
                    <div class="ah-feature-icon">
                        <i class="fas fa-headset"></i>
                    </div>
                    <h5 class="fw-bold mb-2">24/7 Family Updates</h5>
                    <p class="text-muted small mb-0">Detailed daily health and vital log updates so you always stay informed of your loved one's wellness progress.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- =========================================================================
     HOW IT WORKS (3 SIMPLE STEPS)
     ========================================================================= -->
<section class="py-5 ah-light-bg">
    <div class="container py-4">
        <div class="text-center mb-5">
            <span class="ah-badge-pill"><i class="fas fa-route me-1"></i> Simple Process</span>
            <h2 class="ah-section-title">How To Receive Care in 3 Easy Steps</h2>
            <p class="ah-section-subtitle">
                Scheduling trusted in-home healthcare takes only a few minutes.
            </p>
        </div>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="ah-step-card">
                    <div class="ah-step-number">01</div>
                    <div class="ah-feature-icon">
                        <i class="fas fa-th-list"></i>
                    </div>
                    <h4 class="fw-bold mb-2" style="color: var(--ah-primary);">1. Browse Services</h4>
                    <p class="text-muted mb-0" style="font-size: 14.5px;">
                        Explore our service offerings—from elderly care and post-operative recovery to mother & newborn assistance or therapy.
                    </p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="ah-step-card">
                    <div class="ah-step-number">02</div>
                    <div class="ah-feature-icon">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <h4 class="fw-bold mb-2" style="color: var(--ah-primary);">2. Choose Date & Time</h4>
                    <p class="text-muted mb-0" style="font-size: 14.5px;">
                        Click "Book This Service", choose your preferred date, select a convenient time slot, verify your mobile via OTP, and confirm.
                    </p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="ah-step-card">
                    <div class="ah-step-number">03</div>
                    <div class="ah-feature-icon">
                        <i class="fas fa-home"></i>
                    </div>
                    <h4 class="fw-bold mb-2" style="color: var(--ah-primary);">3. Compassionate Home Care</h4>
                    <p class="text-muted mb-0" style="font-size: 14.5px;">
                        Our licensed nurse or therapist arrives right at your doorstep on schedule, ready to deliver attentive, high-standard healthcare.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- =========================================================================
     PATIENT & FAMILY TESTIMONIALS
     ========================================================================= -->
<section class="py-5" style="background: #ffffff;">
    <div class="container py-4">
        <div class="text-center mb-5">
            <span class="ah-badge-pill ah-badge-accent"><i class="fas fa-quote-left me-1"></i> Patient Feedback</span>
            <h2 class="ah-section-title">Stories of Healing & Relief</h2>
            <p class="ah-section-subtitle">
                Read what families across Chennai say about their journey with Angelhug caregivers.
            </p>
        </div>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="ah-testimonial-card">
                    <div>
                        <div class="star-rating">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                        </div>
                        <p class="text-muted fst-italic mb-4" style="line-height: 1.7; font-size: 14.5px;">
                            "The post-operative nursing care my father received from Angelhug was outstanding. The nurse managed his surgical dressings and medication on time every day. It gave our whole family immense relief."
                        </p>
                    </div>
                    <div class="d-flex align-items-center gap-3 pt-3 border-top">
                        <div class="rounded-circle bg-light d-flex align-items-center justify-content-center text-primary fw-bold" style="width: 44px; height: 44px;">
                            RK
                        </div>
                        <div>
                            <h6 class="mb-0 fw-bold" style="color: var(--ah-slate-900);">Rajesh Kumar</h6>
                            <small class="text-muted">Virugambakkam, Chennai</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="ah-testimonial-card">
                    <div>
                        <div class="star-rating">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                        </div>
                        <p class="text-muted fst-italic mb-4" style="line-height: 1.7; font-size: 14.5px;">
                            "As a new mother, having Angelhug’s newborn care specialist at home was a lifesaver. She was so gentle with our baby and guided me with feeding and sleep schedules. Truly grateful!"
                        </p>
                    </div>
                    <div class="d-flex align-items-center gap-3 pt-3 border-top">
                        <div class="rounded-circle bg-light d-flex align-items-center justify-content-center text-primary fw-bold" style="width: 44px; height: 44px;">
                            SP
                        </div>
                        <div>
                            <h6 class="mb-0 fw-bold" style="color: var(--ah-slate-900);">Sujatha Parthasarathy</h6>
                            <small class="text-muted">Anna Nagar, Chennai</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="ah-testimonial-card">
                    <div>
                        <div class="star-rating">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                        </div>
                        <p class="text-muted fst-italic mb-4" style="line-height: 1.7; font-size: 14.5px;">
                            "My 82-year-old mother requires daily mobility support and vital checks. Angelhug provided a wonderful geriatric caregiver who treats her with utmost respect and affection."
                        </p>
                    </div>
                    <div class="d-flex align-items-center gap-3 pt-3 border-top">
                        <div class="rounded-circle bg-light d-flex align-items-center justify-content-center text-primary fw-bold" style="width: 44px; height: 44px;">
                            MN
                        </div>
                        <div>
                            <h6 class="mb-0 fw-bold" style="color: var(--ah-slate-900);">M. Narayanan</h6>
                            <small class="text-muted">Tambaram, Chennai</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- =========================================================================
     CALLOUT CTA BANNER
     ========================================================================= -->
<section class="py-5 text-white" style="background: linear-gradient(135deg, var(--ah-primary-dark) 0%, var(--ah-primary) 100%);">
    <div class="container py-4 text-center">
        <h2 class="text-white fw-bold display-6 mb-3">Have Questions or Need Immediate Patient Care?</h2>
        <p class="lead text-white-50 mb-4 mx-auto" style="max-width: 650px;">
            Our healthcare coordinators are available to discuss customized care plans for your family members.
        </p>
        @php
            $contactPhone = \App\Models\Setting::get('contact_phone', '+91 80725 15050');
        @endphp
        <div class="d-flex justify-content-center gap-3 flex-wrap">
            <a href="{{ route('service') }}" class="btn btn-light px-4 py-3 fw-bold shadow-sm" style="border-radius: var(--ah-radius-sm); color: var(--ah-primary) !important;">
                <i class="fas fa-stethoscope me-2"></i> Browse Our Services
            </a>
            <a href="tel:{{ preg_replace('/[^0-9+]/', '', $contactPhone) }}" class="btn btn-outline-light px-4 py-3 fw-bold" style="border-radius: var(--ah-radius-sm);">
                <i class="fas fa-phone-alt me-2"></i> Call {{ $contactPhone }}
            </a>
            <a href="{{ route('contact') }}" class="btn btn-outline-info text-white px-4 py-3 fw-bold" style="border-radius: var(--ah-radius-sm);">
                <i class="fas fa-envelope me-2"></i> Send Enquiry
            </a>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function () {
    if (typeof Swiper !== 'undefined') {
        new Swiper('.swiper-container', {
            loop: true,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            speed: 700
        });
    }
});
</script>

@include('footer')
