@include('header')

<style>
.about-hero-section {
    background: linear-gradient(135deg, var(--ah-primary-dark) 0%, var(--ah-primary) 100%);
    padding: 75px 0 65px 0;
    color: #fff;
    position: relative;
    overflow: hidden;
}

.about-hero-section::before {
    content: "";
    position: absolute;
    top: 0; left: 0; right: 0; bottom: 0;
    background: url("{{ asset('img/angelhug_docx/image5.png') }}") center/cover no-repeat;
    opacity: 0.18;
}

.about-card {
    background: #fff;
    padding: 32px 28px;
    border-radius: 16px;
    box-shadow: 0 10px 30px rgba(4, 132, 68, 0.06);
    height: 100%;
    transition: all 0.3s ease;
    border: 1px solid rgba(4, 132, 68, 0.12);
}

.about-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 18px 40px rgba(4, 132, 68, 0.14);
    border-color: rgba(4, 132, 68, 0.3);
}

.about-card .icon-box {
    width: 60px;
    height: 60px;
    border-radius: 14px;
    background: var(--ah-cyan-soft);
    color: var(--ah-primary);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 26px;
    margin-bottom: 20px;
    transition: all 0.25s ease;
}

.about-card:hover .icon-box {
    background: var(--ah-gradient-primary);
    color: #ffffff;
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

<!-- Hero Section -->
<section class="about-hero-section text-center position-relative">
    <div class="container position-relative" style="z-index: 2;">
        <span class="feature-pill text-white" style="background: rgba(255,255,255,0.2); border-color: rgba(255,255,255,0.3);"><i class="fas fa-heartbeat"></i> Compassionate & Professional Care</span>
        <h1 class="text-white fw-bold display-5 mb-3">About Angelhug</h1>
        <p class="lead text-white-50 mx-auto" style="max-width: 720px;">
            Delivering dignified, empathetic, and expert healthcare & home nursing support services right when and where you need them most.
        </p>
    </div>
</section>

<!-- Company Overview -->
<section class="py-5" style="background: #ffffff;">
    <div class="container py-4">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <span class="feature-pill"><i class="fas fa-info-circle"></i> Who We Are</span>
                <h2 class="fw-bold mb-4" style="color: var(--ah-primary); font-size: 34px;">Your Trusted Partner in Compassionate Healthcare</h2>
                <p class="text-muted" style="line-height: 1.8;">
                    <strong>Angelhug</strong> was established with a heartfelt commitment to provide world-class, human-centered healthcare and dedicated home nursing. We believe health recovery and wellness are personal journeys that thrive when delivered in the peace, security, and familiarity of home.
                </p>
                <p class="text-muted" style="line-height: 1.8;">
                    From round-the-clock elderly companionship and post-surgical rehabilitation to maternal infant support and physical therapy, our certified healthcare providers ensure every patient receives compassionate, diligent, and personalized care.
                </p>
                <div class="row g-3 mt-3">
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center gap-3">
                            <i class="fas fa-check-circle text-success fs-4"></i>
                            <span class="fw-bold" style="color: var(--ah-primary-dark);">Certified & Vetted Staff</span>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center gap-3">
                            <i class="fas fa-check-circle text-success fs-4"></i>
                            <span class="fw-bold" style="color: var(--ah-primary-dark);">24/7 Home Nursing</span>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center gap-3">
                            <i class="fas fa-check-circle text-success fs-4"></i>
                            <span class="fw-bold" style="color: var(--ah-primary-dark);">Transparent Pricing</span>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center gap-3">
                            <i class="fas fa-check-circle text-success fs-4"></i>
                            <span class="fw-bold" style="color: var(--ah-primary-dark);">Doorstep Lab & Doctors</span>
                        </div>
                    </div>
                </div>
                <div class="mt-4 pt-2">
                    <a href="{{ route('service') }}" class="ah-btn-primary px-4 py-2 fw-bold">
                        <i class="fas fa-stethoscope me-2"></i> Explore Our Services
                    </a>
                    <a href="{{ route('contact') }}" class="ah-btn-outline px-4 py-2 ms-2 fw-bold">
                        Contact Us
                    </a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="position-relative">
                    @php
                        $aboutImage = \App\Models\Setting::get('about_image');
                        $aboutImageUrl = $aboutImage ? asset('storage/' . $aboutImage) : asset('img/about_nurse_patient.jpg');
                    @endphp
                    <img src="{{ $aboutImageUrl }}" alt="About {{ \App\Models\Setting::get('brand_name', 'Angelhug') }}" class="img-fluid rounded-4 shadow-lg w-100" style="object-fit: cover; max-height: 490px; border: 1px solid rgba(4, 132, 68, 0.15);">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Mission & Vision Cards Section -->
<section class="py-5" style="background: #f8fafc;">
    <div class="container py-4">
        <div class="row g-4">
            <div class="col-md-6">
                <div class="about-card">
                    <div class="icon-box">
                        <i class="fas fa-bullseye"></i>
                    </div>
                    <h4 class="fw-bold mb-3" style="color: var(--ah-primary);">Our Mission Statement</h4>
                    <p class="text-muted" style="line-height: 1.8; font-size: 15px;">
                        To deliver continuous, highest-grade medical nursing and home healthcare services that empower patients, accelerate rehabilitation, and comfort families through genuine empathy, skilled professionalism, and unwavering clinical rigor.
                    </p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="about-card">
                    <div class="icon-box">
                        <i class="fas fa-eye"></i>
                    </div>
                    <h4 class="fw-bold mb-3" style="color: var(--ah-primary);">Our Vision Statement</h4>
                    <p class="text-muted" style="line-height: 1.8; font-size: 15px;">
                        To be the most trusted, dependable, and compassionate healthcare companion nationwide, recognized for exceptional patient outcomes, human dignity, clinical safety, and accessible home wellness support.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Core Values Section -->
<section class="py-5" style="background: #ffffff;">
    <div class="container py-3">
        <div class="row text-center mb-5 justify-content-center">
            <div class="col-lg-7">
                <span class="feature-pill"><i class="fas fa-star"></i> Guiding Principles</span>
                <h3 class="fw-bold" style="color: var(--ah-primary);">The Values That Define Angelhug</h3>
                <p class="text-muted">Our practice is built on unyielding commitments to patient dignity and clinical excellence.</p>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-md-3 col-sm-6 text-center">
                <div class="p-4 rounded-4 bg-light h-100" style="border: 1px solid var(--ah-border);">
                    <div class="d-inline-flex p-3 rounded-circle bg-white fs-3 shadow-sm mb-3" style="color: var(--ah-primary);">
                        <i class="fas fa-hand-holding-heart"></i>
                    </div>
                    <h5 class="fw-bold mb-2" style="color: var(--ah-primary);">Empathy First</h5>
                    <p class="text-muted small mb-0">Every treatment starts with deep listening, respect, and emotional reassurance.</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 text-center">
                <div class="p-4 rounded-4 bg-light h-100" style="border: 1px solid var(--ah-border);">
                    <div class="d-inline-flex p-3 rounded-circle bg-white fs-3 shadow-sm mb-3" style="color: var(--ah-primary);">
                        <i class="fas fa-certificate"></i>
                    </div>
                    <h5 class="fw-bold mb-2" style="color: var(--ah-primary);">Clinical Rigor</h5>
                    <p class="text-muted small mb-0">Strict medical hygiene standards, accurate medication logs, and licensed nurses.</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 text-center">
                <div class="p-4 rounded-4 bg-light h-100" style="border: 1px solid var(--ah-border);">
                    <div class="d-inline-flex p-3 rounded-circle bg-white fs-3 shadow-sm mb-3" style="color: var(--ah-primary);">
                        <i class="fas fa-clock"></i>
                    </div>
                    <h5 class="fw-bold mb-2" style="color: var(--ah-primary);">Punctuality & Trust</h5>
                    <p class="text-muted small mb-0">On-time scheduled visits and transparent communication with families.</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 text-center">
                <div class="p-4 rounded-4 bg-light h-100" style="border: 1px solid var(--ah-border);">
                    <div class="d-inline-flex p-3 rounded-circle bg-white fs-3 shadow-sm mb-3" style="color: var(--ah-primary);">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h5 class="fw-bold mb-2" style="color: var(--ah-primary);">Safety & Integrity</h5>
                    <p class="text-muted small mb-0">Complete background verification and continuous patient monitoring.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Call to action -->
<section class="py-5 text-center text-white" style="background: linear-gradient(135deg, var(--ah-primary-dark) 0%, var(--ah-primary) 100%);">
    <div class="container py-4">
        <h2 class="text-white fw-bold mb-3">Experience Compassionate Healthcare With Angelhug</h2>
        <p class="lead text-white-50 mb-4 mx-auto" style="max-width: 650px;">
            Explore our specialized healthcare services, choose the care plan that fits your family, and schedule a visit directly.
        </p>
        <a href="{{ route('service') }}" class="btn btn-light btn-lg px-5 py-3 fw-bold shadow" style="border-radius: 30px; color: var(--ah-primary) !important;">
            <i class="fas fa-stethoscope me-2"></i> View Our Services
        </a>
    </div>
</section>

@include('footer')
