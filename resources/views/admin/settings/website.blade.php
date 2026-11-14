@extends('layouts.app')

@section('title', 'Website Settings & Brand Identity - Admin Panel')

@section('content')
<div class="container-fluid py-2">
    <!-- Page Header -->
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
        <div>
            <h3 class="fw-bold mb-1" style="color: #048444;">
                <i class="fas fa-sliders-h me-2"></i> Website Identity, About Image & Contact Settings
            </h3>
            <p class="text-muted small mb-0">
                Rename company, change About Us image, customize contact information, social links, logo, and booking policies dynamically.
            </p>
        </div>
        <div class="d-flex align-items-center gap-2">
            <a href="{{ route('booking.create', ['service_id' => 1]) }}" target="_blank" class="btn btn-outline-success fw-bold rounded-pill px-3 shadow-sm">
                <i class="fas fa-external-link-alt me-1"></i> Preview Booking Page
            </a>
            <button type="button" onclick="document.getElementById('brandSettingsForm').submit()" class="btn btn-success fw-bold rounded-pill px-4 shadow-sm" style="background: #048444; border-color: #048444;">
                <i class="fas fa-save me-1"></i> Save Changes
            </button>
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show rounded-4 shadow-sm border-0 mb-4" role="alert">
        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if(isset($errors) && $errors->any())
    <div class="alert alert-danger alert-dismissible fade show rounded-4 shadow-sm border-0 mb-4" role="alert">
        <i class="fas fa-exclamation-triangle me-2"></i> <strong>Please correct the following errors:</strong>
        <ul class="mb-0 mt-1 small">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <form id="brandSettingsForm" action="{{ route('admin.website_settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Row 1: Brand & Logo Text (Left) + Terms & Policies (Right) -->
        <div class="row g-4">
            <!-- Left Column: Brand & Logo Text Settings -->
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm rounded-4 p-4 h-100 bg-white">
                    <div class="d-flex align-items-center gap-2 pb-3 border-bottom mb-4">
                        <span class="rounded-3 p-2 text-white" style="background: #048444;">
                            <i class="fas fa-paint-brush"></i>
                        </span>
                        <div>
                            <h5 class="fw-bold mb-0 text-dark">Brand Name & Logo Text</h5>
                            <small class="text-muted">Rename the company and update logo text displayed across header, footer & admin.</small>
                        </div>
                    </div>

                    <!-- 1. Brand Name Input -->
                    <div class="mb-3">
                        <label class="form-label fw-bold text-dark small mb-1">
                            <i class="fas fa-tag text-success me-1"></i> Brand / Company Name *
                        </label>
                        <input type="text" class="form-control fw-bold fs-5 text-dark" id="brand_name" name="brand_name" value="{{ old('brand_name', $brandName) }}" required placeholder="e.g. Angelhug" oninput="updateLiveBrandPreview()">
                        <small class="text-muted" style="font-size: 11.5px;">Main company name shown on navbar logo, headers, invoices, and titles.</small>
                    </div>

                    <!-- 2. Brand Tagline / Slogan -->
                    <div class="mb-3">
                        <label class="form-label fw-bold text-dark small mb-1">
                            <i class="fas fa-quote-left text-success me-1"></i> Logo Subtitle / Tagline
                        </label>
                        <input type="text" class="form-control fw-semibold" id="brand_tagline" name="brand_tagline" value="{{ old('brand_tagline', $brandTagline) }}" placeholder="e.g. Healthcare Services" oninput="updateLiveBrandPreview()">
                        <small class="text-muted" style="font-size: 11.5px;">Appears underneath your brand name in website logo.</small>
                    </div>

                    <!-- 3. Admin Panel Header Title -->
                    <div class="mb-3">
                        <label class="form-label fw-bold text-dark small mb-1">
                            <i class="fas fa-desktop text-success me-1"></i> Admin Panel Top Title
                        </label>
                        <input type="text" class="form-control" id="admin_panel_title" name="admin_panel_title" value="{{ old('admin_panel_title', $adminPanelTitle) }}" placeholder="e.g. Angelhug Web Administration">
                        <small class="text-muted" style="font-size: 11.5px;">Shown at the top navbar of this admin control panel.</small>
                    </div>

                    <!-- 4. Admin Panel Subtitle -->
                    <div class="mb-3">
                        <label class="form-label fw-bold text-dark small mb-1">
                            <i class="fas fa-id-card-alt text-success me-1"></i> Admin Sidebar Subtitle
                        </label>
                        <input type="text" class="form-control" id="admin_panel_subtitle" name="admin_panel_subtitle" value="{{ old('admin_panel_subtitle', $adminPanelSubtitle) }}" placeholder="e.g. HEALTHCARE MANAGEMENT">
                        <small class="text-muted" style="font-size: 11.5px;">Shown under the logo in the dark green admin sidebar.</small>
                    </div>

                    <!-- 5. Logo Image Upload (Optional) -->
                    <div class="mb-4">
                        <label class="form-label fw-bold text-dark small mb-1">
                            <i class="fas fa-image text-success me-1"></i> Website Logo Image (PNG / Transparent Recommended)
                        </label>
                        <input type="file" class="form-control" id="website_logo" name="website_logo" accept="image/png,image/jpeg,image/webp,image/svg+xml" onchange="previewLogoFile(event)">
                        <small class="text-muted d-block mt-1" style="font-size: 11.5px;">Leave empty to keep the current transparent Angelhug emblem.</small>
                        
                        @if($websiteLogo)
                        <div class="form-check mt-2">
                            <input class="form-check-input" type="checkbox" name="remove_custom_logo" value="1" id="remove_custom_logo">
                            <label class="form-check-label text-danger small" for="remove_custom_logo">
                                <i class="fas fa-trash-alt me-1"></i> Reset to original default Angelhug logo
                            </label>
                        </div>
                        @endif
                    </div>

                    <!-- Interactive Live Brand Preview Card -->
                    <div class="p-3 rounded-4 border bg-light">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <small class="text-uppercase fw-bold text-muted" style="font-size: 11px;">
                                <i class="fas fa-eye text-success me-1"></i> Live Website Navbar Logo Preview
                            </small>
                            <span class="badge bg-white text-success border border-success" style="font-size: 10px;">Real-Time</span>
                        </div>
                        <div class="p-3 bg-white rounded-3 border d-flex align-items-center gap-3 shadow-sm">
                            <img src="{{ $websiteLogo ? asset('storage/' . $websiteLogo) : asset('Angelhug Logo/FullLogo_Transparent_NoBuffer.png') }}" 
                                 id="liveLogoPreviewImg" 
                                 alt="Logo" 
                                 style="height: 52px; width: auto; max-width: 70px; object-fit: contain;">
                            <div>
                                <div class="fw-bold" id="liveBrandName" style="color: #048444; font-size: 20px; line-height: 1.1; letter-spacing: -0.3px;">
                                    {{ $brandName }}
                                </div>
                                <div class="text-uppercase fw-bold" id="liveBrandTagline" style="color: #00bbd7; font-size: 11.5px; letter-spacing: 0.8px;">
                                    {{ $brandTagline }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Terms, Conditions & Policies -->
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm rounded-4 p-4 h-100 bg-white">
                    <div class="d-flex align-items-center gap-2 pb-3 border-bottom mb-4">
                        <span class="rounded-3 p-2 text-white" style="background: #048444;">
                            <i class="fas fa-file-contract"></i>
                        </span>
                        <div>
                            <h5 class="fw-bold mb-0 text-dark">Terms, Conditions & Policies</h5>
                            <small class="text-muted">Content written here automatically shows on the booking page popup.</small>
                        </div>
                    </div>

                    <!-- 1. Terms & Conditions Content -->
                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <label class="form-label fw-bold text-dark small mb-0">
                                <i class="fas fa-shield-alt text-success me-1"></i> Terms of Service & Care Agreement *
                            </label>
                            <span class="badge bg-light text-success border border-success fw-bold" style="font-size: 10px;">Shows on Booking Popup</span>
                        </div>
                        <textarea class="form-control text-dark" id="terms_and_conditions" name="terms_and_conditions" rows="8" required style="font-size: 13px; line-height: 1.6;" placeholder="Enter service quality, caregiver safety, patient rights, and clinical rules...">{{ old('terms_and_conditions', $termsAndConditions) }}</textarea>
                        <small class="text-muted" style="font-size: 11.5px;">Organize in clear numbered points or paragraphs. Line breaks will be preserved cleanly.</small>
                    </div>

                    <!-- 2. Cancellation & Rescheduling Policy -->
                    <div class="mb-3">
                        <label class="form-label fw-bold text-dark small mb-1">
                            <i class="fas fa-undo-alt text-success me-1"></i> Cancellation, Refund & Rescheduling Policy
                        </label>
                        <textarea class="form-control text-dark" id="cancellation_policy" name="cancellation_policy" rows="5" style="font-size: 13px; line-height: 1.6;" placeholder="Enter cancellation notice window, refund rules, and rescheduling guidelines...">{{ old('cancellation_policy', $cancellationPolicy) }}</textarea>
                        <small class="text-muted" style="font-size: 11.5px;">Displayed alongside the main terms for transparent customer confidence.</small>
                    </div>

                    <!-- 3. Booking Checkbox Agreement Text -->
                    <div class="mb-4">
                        <label class="form-label fw-bold text-dark small mb-1">
                            <i class="fas fa-check-square text-success me-1"></i> Booking Page Agreement Checkbox Label
                        </label>
                        <input type="text" class="form-control" id="terms_checkbox_label" name="terms_checkbox_label" value="{{ old('terms_checkbox_label', $termsCheckboxLabel) }}" placeholder="e.g. I confirm details are accurate and agree to :brand's Terms of Service, Clinical Protocols & Cancellation Policy." oninput="updateLiveCheckboxPreview()">
                        <small class="text-muted" style="font-size: 11.5px;">Tip: Use <code>:brand</code> to automatically insert your dynamic brand name.</small>
                    </div>

                    <!-- Live Booking Page Checkbox Preview Card -->
                    <div class="p-3 rounded-4 border bg-light">
                        <small class="text-uppercase fw-bold text-muted d-block mb-2" style="font-size: 11px;">
                            <i class="fas fa-mobile-alt text-success me-1"></i> Live Booking Page Display Preview
                        </small>
                        <div class="p-3 bg-white rounded-3 border">
                            <div class="form-check d-flex align-items-center gap-2 mb-0">
                                <input class="form-check-input mt-0" type="checkbox" checked disabled>
                                <label class="form-check-label text-muted small mb-0" id="liveCheckboxPreview" style="font-size: 12px; line-height: 1.45;">
                                    I confirm details are accurate and agree to <span class="fw-bold text-success text-decoration-underline" id="previewBrandNameInline">{{ $brandName }}'s</span> Terms of Service, Clinical Protocols & Cancellation Policy.
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Row 2: About Us Section Content & Image (Full Width Card) -->
        <div class="row g-4 mt-1">
            <div class="col-12">
                <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
                    <div class="d-flex align-items-center justify-content-between pb-3 border-bottom mb-4 flex-wrap gap-2">
                        <div class="d-flex align-items-center gap-2">
                            <span class="rounded-3 p-2 text-white" style="background: #048444;">
                                <i class="fas fa-info-circle"></i>
                            </span>
                            <div>
                                <h5 class="fw-bold mb-0 text-dark">About Us Section Content & Image</h5>
                                <small class="text-muted">Dynamically manage headline, narrative paragraphs, 4 feature bullet points, and the showcase photo shown on the Homepage & About page.</small>
                            </div>
                        </div>
                        <span class="badge bg-success-subtle text-success border border-success-subtle fw-bold px-3 py-1.5" style="font-size: 11px;">
                            <i class="fas fa-globe me-1"></i> Live on Homepage & About Us
                        </span>
                    </div>

                    <!-- Top Section: 2 Balanced Columns (Left: Text Narrative, Right: Photo & Preview) -->
                    <div class="row g-4 align-items-stretch">
                        <!-- Left: Badge, Title & Paragraphs -->
                        <div class="col-lg-7 d-flex flex-column justify-content-between">
                            <div class="row g-3">
                                <div class="col-md-5">
                                    <label class="form-label fw-bold text-dark small mb-1">
                                        <i class="fas fa-tag text-success me-1"></i> About Badge / Pill Label
                                    </label>
                                    <input type="text" class="form-control" name="about_badge" value="{{ old('about_badge', $aboutBadge) }}" placeholder="e.g. About Angelhug">
                                    <small class="text-muted" style="font-size: 11px;">Small pill badge displayed above title.</small>
                                </div>
                                <div class="col-md-7">
                                    <label class="form-label fw-bold text-dark small mb-1">
                                        <i class="fas fa-heading text-success me-1"></i> Main Heading / Title *
                                    </label>
                                    <input type="text" class="form-control fw-bold" name="about_title" value="{{ old('about_title', $aboutTitle) }}" required placeholder="Hospital-Quality Care in the Comfort of Your Home">
                                    <small class="text-muted" style="font-size: 11px;">Main headline for the About section.</small>
                                </div>

                                <div class="col-12">
                                    <label class="form-label fw-bold text-dark small mb-1">
                                        <i class="fas fa-paragraph text-success me-1"></i> Narrative Description (Paragraph 1) *
                                    </label>
                                    <textarea class="form-control" name="about_description_1" rows="3" required style="font-size: 13.5px; line-height: 1.6;" placeholder="Primary introduction paragraph explaining your core healthcare services...">{{ old('about_description_1', $aboutDescription1) }}</textarea>
                                </div>

                                <div class="col-12">
                                    <label class="form-label fw-bold text-dark small mb-1">
                                        <i class="fas fa-align-left text-success me-1"></i> Narrative Description (Paragraph 2)
                                    </label>
                                    <textarea class="form-control" name="about_description_2" rows="3" style="font-size: 13.5px; line-height: 1.6;" placeholder="Secondary paragraph describing clinical vetting, nursing protocols, and patient empathy...">{{ old('about_description_2', $aboutDescription2) }}</textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Right: Showcase Image Upload & Live Preview -->
                        <div class="col-lg-5">
                            <div class="p-3 rounded-4 border bg-light h-100 d-flex flex-column justify-content-between">
                                <div>
                                    <label class="form-label fw-bold text-dark small mb-1">
                                        <i class="fas fa-image text-success me-1"></i> Showcase Image (Nurse & Patient)
                                    </label>
                                    <input type="file" class="form-control" id="about_image" name="about_image" accept="image/png,image/jpeg,image/webp,image/jpg" onchange="previewAboutImageFile(event)">
                                    <small class="text-muted d-block mt-1" style="font-size: 11.5px;">Recommended: High-resolution landscape image (max 5MB).</small>

                                    @if($aboutImage)
                                    <div class="form-check mt-2">
                                        <input class="form-check-input" type="checkbox" name="remove_custom_about_image" value="1" id="remove_custom_about_image">
                                        <label class="form-check-label text-danger small" for="remove_custom_about_image">
                                            <i class="fas fa-trash-alt me-1"></i> Reset to original default About photo
                                        </label>
                                    </div>
                                    @endif
                                </div>

                                <div class="mt-3">
                                    <small class="text-uppercase fw-bold text-muted d-block mb-1.5" style="font-size: 10.5px;">
                                        <i class="fas fa-eye text-success me-1"></i> Live Image Preview
                                    </small>
                                    <div class="rounded-3 overflow-hidden border shadow-sm text-center bg-white" style="height: 200px;">
                                        <img src="{{ $aboutImage ? asset('storage/' . $aboutImage) : asset('img/about_nurse_patient.jpg') }}" 
                                             id="liveAboutPreviewImg" 
                                             alt="About Section Image Preview" 
                                             class="img-fluid w-100 h-100" 
                                             style="object-fit: cover;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Divider -->
                    <hr class="my-4" style="border-top: 1.5px dashed #cbd5e1; opacity: 0.8;">

                    <!-- Full-Width Bottom Section: 4 Key Clinical Feature Bullet Points (Circled Alignment) -->
                    <div class="p-3 rounded-4 bg-light border" style="border-color: #e2e8f0 !important;">
                        <div class="d-flex align-items-center justify-content-between mb-3 flex-wrap gap-2">
                            <div class="d-flex align-items-center gap-2">
                                <span class="rounded-circle d-inline-flex align-items-center justify-content-center text-white" style="width: 26px; height: 26px; background: #048444; font-size: 12px;">
                                    <i class="fas fa-check"></i>
                                </span>
                                <div>
                                    <h6 class="fw-bold mb-0 text-dark" style="font-size: 14px;">4 Key Clinical Feature Bullet Points</h6>
                                    <small class="text-muted" style="font-size: 11.5px;">These 4 points appear in a 2x2 grid beside the About Us photo on the homepage.</small>
                                </div>
                            </div>
                            <span class="badge bg-white text-success border border-success fw-bold px-2.5 py-1" style="font-size: 11px;">
                                <i class="fas fa-check-circle me-1"></i> Displayed with Green Checkmarks
                            </span>
                        </div>

                        <!-- 4 Points arranged in 4 full-width balanced columns -->
                        <div class="row g-3">
                            <div class="col-lg-3 col-md-6">
                                <label class="form-label fw-bold text-dark small mb-1" style="font-size: 11.5px;">
                                    <i class="fas fa-check-circle text-success me-1"></i> Checkpoint 1
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white text-success border-end-0 fw-bold px-2.5">
                                        <i class="fas fa-check"></i> 1
                                    </span>
                                    <input type="text" class="form-control fw-semibold border-start-0 ps-1" name="about_point_1" value="{{ old('about_point_1', $aboutPoint1) }}" placeholder="e.g. Geriatric & Elderly Care" required>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-6">
                                <label class="form-label fw-bold text-dark small mb-1" style="font-size: 11.5px;">
                                    <i class="fas fa-check-circle text-success me-1"></i> Checkpoint 2
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white text-success border-end-0 fw-bold px-2.5">
                                        <i class="fas fa-check"></i> 2
                                    </span>
                                    <input type="text" class="form-control fw-semibold border-start-0 ps-1" name="about_point_2" value="{{ old('about_point_2', $aboutPoint2) }}" placeholder="e.g. Post-Operative Recovery" required>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-6">
                                <label class="form-label fw-bold text-dark small mb-1" style="font-size: 11.5px;">
                                    <i class="fas fa-check-circle text-success me-1"></i> Checkpoint 3
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white text-success border-end-0 fw-bold px-2.5">
                                        <i class="fas fa-check"></i> 3
                                    </span>
                                    <input type="text" class="form-control fw-semibold border-start-0 ps-1" name="about_point_3" value="{{ old('about_point_3', $aboutPoint3) }}" placeholder="e.g. Mother & Infant Care" required>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-6">
                                <label class="form-label fw-bold text-dark small mb-1" style="font-size: 11.5px;">
                                    <i class="fas fa-check-circle text-success me-1"></i> Checkpoint 4
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white text-success border-end-0 fw-bold px-2.5">
                                        <i class="fas fa-check"></i> 4
                                    </span>
                                    <input type="text" class="form-control fw-semibold border-start-0 ps-1" name="about_point_4" value="{{ old('about_point_4', $aboutPoint4) }}" placeholder="e.g. Certified Therapist Care" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Row 3: Contact Details & Location (Left) + Social Media Channels (Right) -->
        <div class="row g-4 mt-1">
            <!-- Left Column: Contact Details & Location -->
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm rounded-4 p-4 h-100 bg-white">
                    <div class="d-flex align-items-center gap-2 pb-3 border-bottom mb-4">
                        <span class="rounded-3 p-2 text-white" style="background: #048444;">
                            <i class="fas fa-map-marker-alt"></i>
                        </span>
                        <div>
                            <h5 class="fw-bold mb-0 text-dark">Contact & Location Information</h5>
                            <small class="text-muted">Updated across header topbar, website footer, booking invoices & contact page.</small>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold text-dark small mb-1">
                            <i class="fas fa-phone-alt text-success me-1"></i> 24/7 Helpline / Phone Number *
                        </label>
                        <input type="text" class="form-control fw-bold" name="contact_phone" value="{{ old('contact_phone', $contactPhone) }}" required placeholder="+91 80725 15050">
                        <small class="text-muted" style="font-size: 11.5px;">Shown at top navbar, customer invoices, footer, and contact page.</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold text-dark small mb-1">
                            <i class="fas fa-headset text-success me-1"></i> Caretaker HR Helpline Mobile Number *
                        </label>
                        <input type="text" class="form-control fw-bold" name="caretaker_hr_phone" value="{{ old('caretaker_hr_phone', $caretakerHrPhone) }}" required placeholder="+91 80725 15050">
                        <small class="text-muted" style="font-size: 11.5px;">Shown at top-right header and footer of Caretaker & Nurse Application Form.</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold text-dark small mb-1">
                            <i class="fas fa-envelope text-success me-1"></i> Official Support Email *
                        </label>
                        <input type="email" class="form-control" name="contact_email" value="{{ old('contact_email', $contactEmail) }}" required placeholder="angelhug.official@gmail.com">
                        <small class="text-muted" style="font-size: 11.5px;">Customer inquiries and booking invoices will display this email address.</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold text-dark small mb-1">
                            <i class="fas fa-building text-success me-1"></i> Office / Headquarter Address *
                        </label>
                        <textarea class="form-control" name="contact_address" rows="3" required style="font-size: 13.5px; line-height: 1.5;" placeholder="Enter office street address, city, state and pincode...">{{ old('contact_address', $contactAddress) }}</textarea>
                        <small class="text-muted" style="font-size: 11.5px;">Appears on invoice receipts, website footer, and contact page.</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold text-dark small mb-1">
                            <i class="fas fa-location-arrow text-success me-1"></i> Google Maps Directions Link
                        </label>
                        <input type="url" class="form-control" name="google_map_directions_link" value="{{ old('google_map_directions_link', $googleMapDirectionsLink) }}" placeholder="https://goo.gl/maps/...">
                        <small class="text-muted" style="font-size: 11.5px;">Users clicking "Google Maps Directions" will be redirected to this link.</small>
                    </div>

                    <div class="mb-2">
                        <label class="form-label fw-bold text-dark small mb-1">
                            <i class="fab fa-google text-primary me-1"></i> Google Maps Geocoding API Key <span class="badge bg-light text-muted border fw-normal" style="font-size: 10px;">Optional</span>
                        </label>
                        <input type="text" class="form-control" name="google_maps_api_key" value="{{ old('google_maps_api_key', $googleMapsApiKey) }}" placeholder="AIzaSy...">
                        <small class="text-muted" style="font-size: 11.5px;">If provided, booking location detector uses official Google Geocoding for 100% address accuracy.</small>
                    </div>
                </div>
            </div>

            <!-- Right Column: Social Media Channels -->
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm rounded-4 p-4 h-100 bg-white">
                    <div class="d-flex align-items-center gap-2 pb-3 border-bottom mb-4">
                        <span class="rounded-3 p-2 text-white" style="background: #048444;">
                            <i class="fas fa-share-alt"></i>
                        </span>
                        <div>
                            <h5 class="fw-bold mb-0 text-dark">Social Media Channels</h5>
                            <small class="text-muted">Manage profile links for footer and contact page icon buttons.</small>
                        </div>
                    </div>

                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label fw-bold text-dark small mb-1">
                                <i class="fab fa-facebook text-primary me-1"></i> Facebook Page URL
                            </label>
                            <input type="url" class="form-control" name="social_facebook" value="{{ old('social_facebook', $socialFacebook) }}" placeholder="https://facebook.com/angelhug">
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-bold text-dark small mb-1">
                                <i class="fab fa-instagram text-danger me-1"></i> Instagram Profile URL
                            </label>
                            <input type="url" class="form-control" name="social_instagram" value="{{ old('social_instagram', $socialInstagram) }}" placeholder="https://instagram.com/angelhug">
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-bold text-dark small mb-1">
                                <i class="fab fa-youtube text-danger me-1"></i> YouTube Channel URL
                            </label>
                            <input type="url" class="form-control" name="social_youtube" value="{{ old('social_youtube', $socialYoutube) }}" placeholder="https://youtube.com/@angelhug">
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-bold text-dark small mb-1">
                                <i class="fab fa-x-twitter text-dark me-1"></i> Twitter / X Profile URL
                            </label>
                            <input type="url" class="form-control" name="social_twitter" value="{{ old('social_twitter', $socialTwitter) }}" placeholder="https://twitter.com/angelhug">
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-bold text-dark small mb-1">
                                <i class="fab fa-linkedin text-info me-1"></i> LinkedIn Page URL
                            </label>
                            <input type="url" class="form-control" name="social_linkedin" value="{{ old('social_linkedin', $socialLinkedin) }}" placeholder="https://linkedin.com/company/angelhug">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sticky Save Floating Footer Bar -->
        <div class="mt-4 p-3 bg-white border rounded-4 shadow-sm d-flex justify-content-between align-items-center">
            <span class="text-muted small">
                <i class="fas fa-info-circle text-success me-1"></i> All changes take effect immediately across live website pages, invoices, and admin panel.
            </span>
            <button type="submit" class="btn btn-success fw-bold rounded-pill px-4 py-2 shadow-sm" style="background: #048444; border-color: #048444;">
                <i class="fas fa-check-circle me-1"></i> Save Changes Now
            </button>
        </div>
    </form>
</div>

<script>
function updateLiveBrandPreview() {
    const brandName = document.getElementById('brand_name').value || 'Angelhug';
    const brandTagline = document.getElementById('brand_tagline').value || 'Healthcare Services';

    document.getElementById('liveBrandName').innerText = brandName;
    document.getElementById('liveBrandTagline').innerText = brandTagline;
    const inlineBrand = document.getElementById('previewBrandNameInline');
    if (inlineBrand) {
        inlineBrand.innerText = brandName + "'s";
    }
}

function updateLiveCheckboxPreview() {
    const brandName = document.getElementById('brand_name').value || 'Angelhug';
    let label = document.getElementById('terms_checkbox_label').value || "I confirm details are accurate and agree to :brand's Terms of Service, Clinical Protocols & Cancellation Policy.";
    label = label.replace(':brand', brandName);
    const previewEl = document.getElementById('liveCheckboxPreview');
    if (previewEl) {
        previewEl.innerHTML = label.replace(
            /Terms of Service[^<]*/i,
            '<span class="text-success fw-bold text-decoration-underline">$&</span>'
        );
    }
}

function previewLogoFile(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('liveLogoPreviewImg').src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
}

function previewAboutImageFile(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('liveAboutPreviewImg').src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
}
</script>
@endsection
