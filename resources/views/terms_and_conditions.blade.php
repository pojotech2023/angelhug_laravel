@include('header')

<style>
.terms-hero-section {
    background: linear-gradient(135deg, var(--ah-primary-dark, #024724) 0%, var(--ah-primary, #048444) 100%);
    padding: 70px 0 60px 0 !important;
    color: #fff;
    position: relative;
    overflow: hidden;
}

.terms-hero-section::before {
    content: "";
    position: absolute;
    top: 0; left: 0; right: 0; bottom: 0;
    background: url("{{ asset('img/angelhug_docx/image5.png') }}") center/cover no-repeat;
    opacity: 0.15;
}

.terms-card-box {
    background: #ffffff;
    border: 1.5px solid #e2e8f0;
    border-radius: 18px;
    box-shadow: 0 4px 25px rgba(0, 0, 0, 0.04);
    padding: 35px;
    margin-bottom: 30px;
}
</style>

<!-- Hero Section -->
<section class="terms-hero-section text-center position-relative">
    <div class="container position-relative" style="z-index: 2;">
        <span class="badge bg-white-50 text-white border border-white-50 py-1 px-3 rounded-pill mb-2" style="font-size: 12px;">
            <i class="fas fa-shield-alt me-1"></i> Official Patient & Clinical Policy
        </span>
        <h1 class="text-white fw-bold display-6 mb-2">Terms of Service & Clinical Protocols</h1>
        <p class="lead text-white-50 mx-auto mb-0" style="max-width: 680px; font-size: 15px;">
            Standards of clinical excellence, caregiver safety guidelines, and patient service terms for {{ $brandName }}.
        </p>
    </div>
</section>

<!-- Content Section -->
<div class="py-5" style="background: #f8fafc;">
    <div class="container" style="max-width: 900px;">
        <div class="terms-card-box">
            <div class="d-flex align-items-center gap-2 pb-3 mb-4 border-bottom">
                <span class="rounded-3 p-2 text-white" style="background: #048444;">
                    <i class="fas fa-file-contract"></i>
                </span>
                <h4 class="fw-bold mb-0 text-dark">Patient Care Agreement & Service Terms</h4>
            </div>

            <div class="text-dark" style="font-size: 14.5px; line-height: 1.8; white-space: pre-line;">{{ $terms }}</div>

            @if(!empty($cancellation))
            <div class="d-flex align-items-center gap-2 pb-3 mt-5 mb-4 border-bottom">
                <span class="rounded-3 p-2 text-white" style="background: #00bbd7;">
                    <i class="fas fa-undo-alt"></i>
                </span>
                <h4 class="fw-bold mb-0 text-dark">Cancellation, Refund & Rescheduling Policy</h4>
            </div>

            <div class="text-dark" style="font-size: 14.5px; line-height: 1.8; white-space: pre-line;">{{ $cancellation }}</div>
            @endif

            <div class="mt-5 pt-3 border-top d-flex justify-content-between align-items-center flex-wrap gap-2">
                <a href="{{ route('home') }}" class="btn btn-outline-secondary fw-bold rounded-pill px-4">
                    <i class="fas fa-arrow-left me-1"></i> Return to Home
                </a>
                <a href="{{ route('service') }}" class="btn btn-success fw-bold rounded-pill px-4" style="background: #048444; border-color: #048444;">
                    <i class="fas fa-calendar-check me-1"></i> Book a Healthcare Service
                </a>
            </div>
        </div>
    </div>
</div>

@include('footer')
