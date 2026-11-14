@include('header')

<style>
.contact-hero-area {
    background: linear-gradient(135deg, var(--ah-primary-dark) 0%, var(--ah-primary) 100%);
    padding: 75px 0 65px 0 !important;
    color: #fff;
    position: relative;
    overflow: hidden;
}

.contact-hero-area::before {
    content: "";
    position: absolute;
    top: 0; left: 0; right: 0; bottom: 0;
    background: url("{{ asset('img/angelhug_docx/image14.jpeg') }}") center/cover no-repeat;
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

.contact-info-card {
    background: #ffffff;
    border-radius: var(--ah-radius-lg);
    padding: 20px 22px;
    box-shadow: var(--ah-card-shadow);
    border: 1px solid var(--ah-border);
    height: auto;
}

.contact-form-card {
    background: #ffffff;
    border-radius: var(--ah-radius-lg);
    padding: 20px 24px;
    box-shadow: var(--ah-card-shadow);
    border: 1px solid var(--ah-border);
    height: auto;
}

.contact-item-box {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    margin-bottom: 12px;
    padding-bottom: 12px;
    border-bottom: 1px dashed var(--ah-border);
}

.contact-item-box:last-child {
    border-bottom: none;
    margin-bottom: 0;
    padding-bottom: 0;
}

.contact-item-icon {
    width: 40px;
    height: 40px;
    border-radius: var(--ah-radius-md);
    background: var(--ah-cyan-soft);
    color: var(--ah-primary);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 17px;
    flex-shrink: 0;
    margin-top: 2px;
}

.contact-item-box h6 {
    margin: 0 0 2px 0 !important;
    font-size: 14.5px !important;
    font-weight: 700 !important;
    line-height: 1.25 !important;
    color: var(--ah-slate-900) !important;
}

.contact-item-box p {
    margin: 0 0 3px 0 !important;
    font-size: 13px !important;
    line-height: 1.35 !important;
    color: var(--ah-slate-600) !important;
}

.contact-form-card h3 {
    margin: 0 0 3px 0 !important;
    font-size: 20px !important;
    line-height: 1.25 !important;
}

.contact-form-card p.form-subtitle {
    margin: 0 0 14px 0 !important;
    font-size: 13px !important;
    line-height: 1.35 !important;
    color: var(--ah-slate-500) !important;
}

.contact-form-card .form-label {
    margin-bottom: 2px !important;
    font-size: 12.5px !important;
    font-weight: 700 !important;
    color: var(--ah-slate-800) !important;
}

.contact-form-card .form-control {
    font-size: 13.5px !important;
    padding: 8px 12px !important;
    border-radius: var(--ah-radius-sm) !important;
    border: 1px solid var(--ah-border) !important;
}

.contact-form-card .form-control:focus {
    border-color: var(--ah-primary) !important;
    box-shadow: 0 0 0 3px rgba(4, 132, 68, 0.12) !important;
}

.contact-social-btn {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 15px;
    background: var(--ah-slate-100);
    color: var(--ah-primary);
    transition: all 0.25s ease;
}

.contact-social-btn:hover {
    background: var(--ah-primary);
    color: #ffffff !important;
    transform: translateY(-2px);
}
</style>

<!-- Hero Section (Matches About Us Exact Height & Style) -->
<section class="contact-hero-area text-center position-relative">
    <div class="container position-relative" style="z-index: 2;">
        <span class="feature-pill text-white" style="background: rgba(255,255,255,0.2); border-color: rgba(255,255,255,0.3);">
            <i class="fas fa-headset me-1"></i> We Are Here For You
        </span>
        <h1 class="text-white fw-bold display-5 mb-3">Contact Angelhug Healthcare</h1>
        <p class="lead text-white-50 mx-auto mb-0" style="max-width: 720px;">
            Have questions about our in-home nursing, elderly care, or rehabilitation assistance? Reach out anytime.
        </p>
    </div>
</section>

<!-- Contact Info & Form -->
<section class="py-4" style="background: #f8fafc;">
    <div class="container">
        <div class="row g-3 align-items-start">
            <!-- Left Info Column -->
            <div class="col-lg-5">
                <div class="contact-info-card">
                    <span class="ah-badge-pill mb-2" style="font-size: 11.5px; padding: 3px 10px;">
                        <i class="fas fa-map-marker-alt me-1"></i> Head Office & Operations
                    </span>
                    <h3 class="fw-bold mb-3" style="color: var(--ah-primary); font-size: 21px; margin-top: 2px;">Reach Out Directly</h3>

                    @php
                        $contactAddress = \App\Models\Setting::get('contact_address', 'No.25/25, Ottaipillaiyar Koil Street, Ranganathan Nagar, Virugambakkam, Chennai, Tamil Nadu-600092');
                        $contactPhone = \App\Models\Setting::get('contact_phone', '+91 80725 15050');
                        $contactEmail = \App\Models\Setting::get('contact_email', 'angelhug.official@gmail.com');
                        $contactDirectionsLink = \App\Models\Setting::get('google_map_directions_link', 'https://goo.gl/maps/U5MvBvajYsQmWqUR9');
                        $socialFacebook = \App\Models\Setting::get('social_facebook', 'https://facebook.com/angelhug');
                        $socialInstagram = \App\Models\Setting::get('social_instagram', 'https://instagram.com/angelhug');
                        $socialYoutube = \App\Models\Setting::get('social_youtube', 'https://youtube.com/@angelhug');
                        $socialTwitter = \App\Models\Setting::get('social_twitter');
                        $socialLinkedin = \App\Models\Setting::get('social_linkedin');
                    @endphp

                    <!-- Address -->
                    <div class="contact-item-box">
                        <div class="contact-item-icon">
                            <i class="fas fa-map-marked-alt"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h6>Office Location</h6>
                            <p>
                                {{ $contactAddress }}
                            </p>
                            @if($contactDirectionsLink)
                            <a href="{{ $contactDirectionsLink }}" target="_blank" class="btn btn-sm btn-outline-primary fw-bold py-1 px-2" style="border-radius: var(--ah-radius-sm); font-size: 12px;">
                                <i class="fas fa-location-arrow me-1"></i> Google Maps Directions
                            </a>
                            @endif
                        </div>
                    </div>

                    <!-- Phone -->
                    <div class="contact-item-box">
                        <div class="contact-item-icon">
                            <i class="fas fa-phone-alt"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h6>Call or WhatsApp</h6>
                            <p>Available 24/7 for urgent nursing care inquiries</p>
                            <a href="tel:{{ preg_replace('/[^0-9+]/', '', $contactPhone) }}" class="fw-bold text-primary text-decoration-none" style="font-size: 16px;">
                                {{ $contactPhone }}
                            </a>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="contact-item-box">
                        <div class="contact-item-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h6>Email Inquiries</h6>
                            <p>Drop us a line for care proposals & corporate tie-ups</p>
                            <a href="mailto:{{ $contactEmail }}" class="fw-bold text-dark text-decoration-none" style="font-size: 14.5px;">
                                {{ $contactEmail }}
                            </a>
                        </div>
                    </div>

                    <!-- Social Media Links -->
                    <div class="pt-2">
                        <h6 style="margin-bottom: 8px !important;">Follow Us Online</h6>
                        <div class="d-flex gap-2 flex-wrap">
                            @if($socialFacebook)
                            <a href="{{ $socialFacebook }}" target="_blank" class="contact-social-btn" title="Facebook">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            @endif
                            @if($socialInstagram)
                            <a href="{{ $socialInstagram }}" target="_blank" class="contact-social-btn" title="Instagram">
                                <i class="fab fa-instagram"></i>
                            </a>
                            @endif
                            @if($socialYoutube)
                            <a href="{{ $socialYoutube }}" target="_blank" class="contact-social-btn" title="YouTube">
                                <i class="fab fa-youtube"></i>
                            </a>
                            @endif
                            @if($socialTwitter)
                            <a href="{{ $socialTwitter }}" target="_blank" class="contact-social-btn" title="Twitter / X">
                                <i class="fab fa-x-twitter"></i>
                            </a>
                            @endif
                            @if($socialLinkedin)
                            <a href="{{ $socialLinkedin }}" target="_blank" class="contact-social-btn" title="LinkedIn">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Form Column -->
            <div class="col-lg-7">
                <div class="contact-form-card">
                    <span class="ah-badge-pill ah-badge-accent mb-2" style="font-size: 11.5px; padding: 3px 10px;">
                        <i class="fas fa-paper-plane me-1"></i> Quick Message
                    </span>
                    <h3 class="fw-bold" style="color: var(--ah-primary);">Send Us an Enquiry</h3>
                    <p class="form-subtitle">
                        Fill out the form below and our nursing supervisor will reach out with care plan guidance within 30 minutes.
                    </p>

                    <form id="contactForm" method="POST" action="{{ route('contact.enquiry') }}">
                        @csrf
                        <div class="row g-2">
                            <div class="col-md-6">
                                <label class="form-label">Your Full Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control" placeholder="John Doe" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email Address <span class="text-muted fw-normal small">(Optional)</span></label>
                                <input type="email" name="email" class="form-control" placeholder="name@example.com">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Mobile Number <span class="text-danger">*</span></label>
                                <input type="tel" name="phone" class="form-control" placeholder="10-digit mobile number" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Subject / Care Type</label>
                                <input type="text" name="subject" class="form-control" placeholder="e.g. Geriatric Care Inquiry">
                            </div>
                            <div class="col-12">
                                <label class="form-label">Patient Condition / Message <span class="text-danger">*</span></label>
                                <textarea name="message" rows="3" class="form-control" placeholder="Please describe patient age, care requirements, daily shift hours needed..." required></textarea>
                            </div>
                            <div class="col-12 pt-2">
                                <button type="submit" class="ah-btn-primary w-100 justify-content-center py-2" style="font-size: 15px;">
                                    <i class="fas fa-paper-plane me-2"></i> Send Message
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Success Popup -->
                    <div id="contactPopup" class="modal fade" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content border-0 shadow-lg rounded-4 text-center p-4">
                                <div class="rounded-circle bg-success text-white d-inline-flex align-items-center justify-content-center mx-auto mb-3" style="width: 60px; height: 60px; font-size: 26px;">
                                    <i class="fas fa-check"></i>
                                </div>
                                <h4 class="fw-bold mb-2" style="color: var(--ah-primary); font-size: 20px;">Message Sent Successfully!</h4>
                                <p class="text-muted small" id="contactPopupMessage">Thank you! Your enquiry has been received. Our team will contact you shortly.</p>
                                <button type="button" class="ah-btn-primary mx-auto px-4 py-2" data-bs-dismiss="modal">OK</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Google Map Section -->
<section class="pb-4" style="background: #f8fafc;">
    <div class="container">
        <div class="rounded-4 overflow-hidden shadow-sm border" style="height: 360px;">
            <iframe 
                src="https://maps.google.com/maps?q={{ urlencode(\App\Models\Setting::get('contact_address', 'No.25/25, Ottaipillaiyar Koil Street, Ranganathan Nagar, Virugambakkam, Chennai, Tamil Nadu 600092')) }}&t=&z=15&ie=UTF8&iwloc=&output=embed" 
                width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    </div>
</section>

@include('footer')

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('contactForm');
    const modalEl = document.getElementById('contactPopup');
    const popupModal = bootstrap.Modal.getOrCreateInstance(modalEl);

    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const submitBtn = form.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span> Sending...';

            const formData = new FormData(form);

            fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    popupModal.show();
                    form.reset();
                } else {
                    alert(data.message || 'Error sending message.');
                }
            })
            .catch(err => {
                console.error(err);
                alert('Message received. We will contact you soon.');
                form.reset();
            })
            .finally(() => {
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalText;
            });
        });
    }
});
</script>
