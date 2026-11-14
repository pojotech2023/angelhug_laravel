@include('header')

<link rel="stylesheet" href="{{ asset('css/flatpickr.min.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

<style>
/* Universal Standardized Hero Section (Matches About Us Exact Size) */
.booking-hero-section {
    background: linear-gradient(135deg, var(--ah-primary-dark) 0%, var(--ah-primary) 100%);
    padding: 75px 0 65px 0 !important;
    color: #fff;
    position: relative;
    overflow: hidden;
}

.booking-hero-section::before {
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
    padding: 7px 16px;
    background: rgba(255, 255, 255, 0.2);
    color: #ffffff;
    border: 1px solid rgba(255, 255, 255, 0.3);
    border-radius: 30px;
    font-weight: 700;
    font-size: 12.5px;
    margin-bottom: 14px;
}

/* Page Background Wrap */
.booking-page-wrap {
    background: #f8fafc;
    padding: 35px 0 65px;
    width: 100%;
}

.booking-page-wrap > .container {
    max-width: 1320px;
    width: 100%;
    margin-left: auto;
    margin-right: auto;
    padding-left: 20px;
    padding-right: 20px;
}

/* Sidebar Column Layout & Continuous Sticky Behavior */
.booking-sidebar-col {
    position: relative;
    display: flex;
    flex-direction: column;
}

/* Left Booking Form Main Card */
.booking-main-card {
    background: #ffffff;
    border: 1.5px solid #e2e8f0;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
    padding: 26px;
}

/* Step Header & Number Badge */
.booking-step-header {
    display: flex !important;
    align-items: center !important;
    gap: 10px !important;
    margin-bottom: 12px !important;
}

.booking-step-num {
    width: 26px !important;
    height: 26px !important;
    min-width: 26px !important;
    border-radius: 50% !important;
    background: #048444 !important;
    color: #ffffff !important;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    font-size: 13px !important;
    font-weight: 800 !important;
    line-height: 1 !important;
    box-shadow: 0 2px 6px rgba(4, 132, 68, 0.25) !important;
    flex-shrink: 0 !important;
}

.booking-step-title {
    margin: 0 !important;
    font-size: 15.5px !important;
    font-weight: 800 !important;
    color: #0f172a !important;
    letter-spacing: -0.2px;
}

.step-divider {
    height: 1px;
    background: #f1f5f9;
    margin: 18px 0;
    border: none;
}

/* Form Controls */
.booking-main-card .form-control,
.booking-main-card .form-select {
    width: 100%;
    min-height: 40px;
    box-sizing: border-box;
    font-size: 13.5px;
    border-radius: 9px;
    border: 1.5px solid #dbe2ea;
    background-color: #ffffff;
    transition: all 0.2s ease;
}

.booking-main-card .form-control:focus,
.booking-main-card .form-select:focus {
    border-color: #048444;
    box-shadow: 0 0 0 3px rgba(4, 132, 68, 0.12);
    outline: none;
}

.booking-main-card .form-label {
    display: block;
    margin-bottom: 5px !important;
    line-height: 1.35;
    font-size: 12.5px;
    font-weight: 700;
    color: #1e293b;
}

/* Input Group */
.booking-main-card .input-group {
    display: flex !important;
    flex-wrap: nowrap !important;
    align-items: stretch !important;
    width: 100% !important;
}

.booking-main-card .input-group > .input-group-text {
    flex: 0 0 auto !important;
    width: auto !important;
    min-height: 40px !important;
    border: 1.5px solid #dbe2ea !important;
    font-size: 13px !important;
    border-top-left-radius: 9px !important;
    border-bottom-left-radius: 9px !important;
    border-right: none !important;
}

.booking-main-card .input-group > .form-control {
    flex: 1 1 auto !important;
    min-height: 40px !important;
    border-radius: 0 !important;
    border: 1.5px solid #dbe2ea !important;
}

.booking-main-card .input-group > #verifiedBadge {
    flex: 0 0 auto !important;
    min-height: 40px !important;
    border: 1.5px solid #048444 !important;
    border-top-right-radius: 9px !important;
    border-bottom-right-radius: 9px !important;
    border-left: none !important;
    background: #048444 !important;
    color: #ffffff !important;
    font-size: 12.5px !important;
    font-weight: 700 !important;
}

/* Package Info Strip & Date Picker Styles */
.package-info-strip {
    display: flex !important;
    flex-direction: row !important;
    align-items: center !important;
    justify-content: space-between !important;
    background: #ffffff !important;
    border: 1px solid #dbe2ea !important;
    border-left: 3.5px solid #048444 !important;
    min-height: 40px !important;
    height: 40px !important;
    padding: 0 12px !important;
    margin-top: 10px !important;
    margin-bottom: 0 !important;
    border-radius: 8px !important;
    box-sizing: border-box !important;
}

.package-info-strip, 
.package-info-strip * {
    margin-top: 0 !important;
    margin-bottom: 0 !important;
}

#packageDaysCountBadge {
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    background: #e8f7ee !important;
    color: #048444 !important;
    border: 1px solid rgba(4, 132, 68, 0.25) !important;
    font-size: 11.5px !important;
    font-weight: 700 !important;
    padding: 4px 10px !important;
    border-radius: 6px !important;
    line-height: 1 !important;
    height: auto !important;
    width: auto !important;
    position: static !important;
}

.booking-main-card input[type="date"] {
    min-height: 40px !important;
    height: 40px !important;
    font-size: 13.5px !important;
    font-weight: 700 !important;
    color: #1e293b !important;
    padding: 6px 10px !important;
    border: 1.5px solid #dbe2ea !important;
    border-radius: 8px !important;
    background-color: #ffffff !important;
}

.booking-main-card input[type="date"]:focus {
    border-color: #048444 !important;
    box-shadow: 0 0 0 3px rgba(4, 132, 68, 0.12) !important;
}

.booking-main-card input[type="date"][readonly] {
    background-color: #f8fafc !important;
    color: #334155 !important;
    border-color: #e2e8f0 !important;
    cursor: default !important;
}

/* Shift Slot Buttons */
#timeSlotsContainer {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 8px !important;
    margin-top: 6px;
}

.time-slot-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-height: 36px;
    padding: 7px 12px;
    white-space: nowrap;
    border: 1.5px solid #e2e8f0;
    background: #ffffff;
    color: #334155;
    border-radius: 8px;
    font-weight: 700;
    font-size: 12px;
    cursor: pointer;
    transition: all 0.2s ease;
    gap: 6px;
}

.time-slot-btn:hover {
    border-color: #048444;
    background: #e8f7ee;
    color: #048444;
}

.time-slot-btn.selected {
    border-color: #048444;
    background: #048444;
    color: #ffffff !important;
    box-shadow: 0 3px 8px rgba(4, 132, 68, 0.24);
}

.time-slot-btn.selected i {
    color: #95ca57;
}

/* Custom Flatpickr Time Picker Styling (AngelHug Brand) */
.flatpickr-calendar.hasTime.noCalendar {
    width: auto !important;
    min-width: 220px !important;
    padding: 10px 14px !important;
    border-radius: 12px !important;
    border: 1.5px solid #048444 !important;
    box-shadow: 0 12px 28px rgba(4, 132, 68, 0.18), 0 4px 10px rgba(0, 0, 0, 0.06) !important;
    background: #ffffff !important;
    z-index: 9999 !important;
}

.flatpickr-time {
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    gap: 8px !important;
    height: 48px !important;
    line-height: 48px !important;
    background: transparent !important;
}

.flatpickr-time .numInputWrapper {
    width: 62px !important;
    height: 44px !important;
    border-radius: 8px !important;
    background: #f8fafc !important;
    border: 1px solid #cbd5e1 !important;
    transition: all 0.2s ease;
}

.flatpickr-time .numInputWrapper:hover,
.flatpickr-time .numInputWrapper:focus-within {
    border-color: #048444 !important;
    background: #ffffff !important;
    box-shadow: 0 0 0 2px rgba(4, 132, 68, 0.15) !important;
}

.flatpickr-time input.flatpickr-hour,
.flatpickr-time input.flatpickr-minute {
    font-weight: 800 !important;
    font-size: 18px !important;
    color: #0f172a !important;
    height: 44px !important;
    border: none !important;
    background: transparent !important;
    text-align: center !important;
}

.flatpickr-time .flatpickr-time-separator {
    font-size: 20px !important;
    font-weight: 800 !important;
    color: #334155 !important;
}

.flatpickr-time .flatpickr-am-pm {
    height: 44px !important;
    line-height: 44px !important;
    padding: 0 16px !important;
    border-radius: 8px !important;
    background: #048444 !important;
    color: #ffffff !important;
    font-weight: 800 !important;
    font-size: 14px !important;
    letter-spacing: 0.5px !important;
    transition: all 0.2s ease !important;
    cursor: pointer !important;
    user-select: none !important;
}

.flatpickr-time .flatpickr-am-pm:hover {
    background: #02592d !important;
    transform: scale(1.04);
}

/* Duration & Shift Plan Cards */
.duration-group-label {
    font-size: 11px;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    color: #64748b;
    margin-bottom: 6px;
    display: flex;
    align-items: center;
    gap: 6px;
}

.duration-plan-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(105px, 1fr));
    gap: 8px;
    margin-bottom: 12px;
}

.duration-plan-card {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 10px 6px;
    background: #ffffff;
    border: 1.5px solid #e2e8f0;
    border-radius: 10px;
    cursor: pointer;
    text-align: center;
    transition: all 0.2s ease;
    user-select: none;
}

.duration-plan-card:hover {
    border-color: #048444;
    background: #f4faf6;
}

.duration-plan-card.active {
    border-color: #048444;
    background: #e8f7ee;
    box-shadow: 0 2px 8px rgba(4, 132, 68, 0.18);
}

.duration-plan-card .plan-icon {
    font-size: 15px;
    color: #64748b;
    margin-bottom: 3px;
    transition: color 0.2s ease;
}

.duration-plan-card.active .plan-icon {
    color: #048444;
}

.duration-plan-card .plan-title {
    font-size: 12.5px;
    font-weight: 800;
    color: #0f172a;
    line-height: 1.2;
}

.duration-plan-card.active .plan-title {
    color: #048444;
}

.duration-plan-card .plan-sub {
    font-size: 10px;
    color: #64748b;
    margin-top: 2px;
}

.duration-plan-card.active .plan-sub {
    color: #024724;
    font-weight: 700;
}

/* Right Column: Sticky Summary Card */
.checkout-summary-card {
    position: sticky;
    top: 95px;
    background: #ffffff;
    border: 1.5px solid #e2e8f0;
    border-radius: 16px;
    box-shadow: 0 6px 25px rgba(4, 132, 68, 0.06);
    padding: 24px;
    max-height: calc(100vh - 115px);
    overflow-y: auto;
    z-index: 20;
}

.checkout-summary-card::-webkit-scrollbar {
    width: 4px;
}

.checkout-summary-card::-webkit-scrollbar-thumb {
    background: #cbd5e1;
    border-radius: 4px;
}

.checkout-summary-card::-webkit-scrollbar-track {
    background: transparent;
}

.summary-service-panel {
    background: #f8fafc;
    border: 1.5px solid #e2e8f0;
    border-radius: 12px;
    padding: 12px 14px;
    margin-bottom: 12px;
}

.summary-service-img {
    width: 60px;
    height: 60px;
    object-fit: cover;
    border-radius: 9px;
    border: 1px solid rgba(4, 132, 68, 0.2);
    flex-shrink: 0;
}

.summary-schedule-card {
    background: #ffffff;
    border: 1px solid #eef2f6;
    border-radius: 10px;
    padding: 10px 12px;
    margin-bottom: 12px;
}

.btn-pay-now {
    background: linear-gradient(135deg, #048444 0%, #00bbd7 100%);
    color: #ffffff !important;
    border: none;
    border-radius: 10px;
    font-weight: 800;
    font-size: 15px;
    padding: 13px 20px;
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    box-shadow: 0 5px 18px rgba(4, 132, 68, 0.25);
    transition: all 0.25s ease;
    cursor: pointer;
}

.btn-pay-now:hover {
    box-shadow: 0 7px 22px rgba(4, 132, 68, 0.35);
    transform: translateY(-1px);
    color: #ffffff !important;
}

.patient-verified-banner {
    display: flex;
    align-items: center;
    gap: 10px;
    background: #e8f7ee;
    border: 1px solid rgba(4, 132, 68, 0.22);
    border-radius: 10px;
    padding: 8px 12px;
    margin-bottom: 12px;
}

/* Compact Single-Line Success Notification Banner */
.booking-login-alert {
    display: flex !important;
    align-items: center !important;
    justify-content: space-between !important;
    background: #e8f7ee !important;
    border: 1px solid #c3e6cb !important;
    border-left: 4px solid #048444 !important;
    border-radius: 10px !important;
    padding: 10px 18px !important;
    margin-bottom: 22px !important;
    box-shadow: 0 2px 10px rgba(4, 132, 68, 0.08) !important;
}

.booking-login-alert-content {
    display: flex !important;
    align-items: center !important;
    gap: 10px !important;
    min-width: 0 !important;
}

.booking-login-alert-icon {
    color: #048444 !important;
    font-size: 16px !important;
    line-height: 1 !important;
    flex-shrink: 0 !important;
}

.booking-login-alert-text {
    font-size: 13.5px !important;
    font-weight: 700 !important;
    color: #1e293b !important;
    line-height: 1.4 !important;
    margin: 0 !important;
}

.booking-login-alert-close {
    background: transparent !important;
    border: none !important;
    color: #048444 !important;
    opacity: 0.7 !important;
    font-size: 14px !important;
    line-height: 1 !important;
    cursor: pointer !important;
    padding: 4px 6px !important;
    margin-left: 14px !important;
    border-radius: 4px !important;
    transition: all 0.2s ease !important;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
}

.booking-login-alert-close:hover {
    opacity: 1 !important;
    background: rgba(4, 132, 68, 0.12) !important;
    color: #024724 !important;
}

@media (max-width: 991.98px) {
    .checkout-summary-card {
        position: static;
        margin-top: 0;
    }
}

.sub-plan-card {
    width: 100%;
    min-width: 0;
}

.sub-plan-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    min-width: 0;
}

.sub-plan-info {
    display: flex;
    align-items: center;
    gap: 12px;
    flex: 1 1 auto;
    min-width: 0;
}

.sub-plan-details {
    min-width: 0;
    overflow-wrap: anywhere;
}

.sub-plan-price {
    flex: 0 0 auto;
    text-align: right;
}

@media (max-width: 575.98px) {
    html,
    body {
        max-width: 100%;
        overflow-x: hidden;
    }

    .booking-hero-section,
    .booking-page-wrap,
    .booking-page-wrap > .container,
    #bookingForm,
    .booking-main-card {
        width: 100%;
        max-width: 100%;
        min-width: 0;
        box-sizing: border-box;
    }

    #bookingForm .row,
    #bookingForm [class*="col-"] {
        min-width: 0;
    }

    .booking-page-wrap {
        padding: 20px 0 40px;
    }

    .booking-page-wrap > .container {
        padding-left: 12px;
        padding-right: 12px;
    }

    .booking-main-card {
        padding: 16px 12px;
    }

    #bookingForm [class*="col-"] {
        flex-shrink: 1;
    }

    .sub-plan-card {
        padding: 12px !important;
    }

    .sub-plan-header {
        flex-wrap: wrap;
        gap: 8px;
    }

    .sub-plan-info {
        flex: 1 1 100%;
        gap: 8px;
    }

    .sub-plan-details strong {
        font-size: 13px !important;
    }

    .sub-plan-price {
        display: flex;
        align-items: baseline;
        justify-content: flex-end;
        flex-wrap: wrap;
        gap: 4px 8px;
        width: 100%;
        padding-top: 6px;
        border-top: 1px solid #eef2f6;
    }

    .sub-plan-price small {
        display: inline !important;
    }

    .sub-plan-features {
        padding-left: 0 !important;
    }

    .sub-plan-features-grid {
        grid-template-columns: minmax(0, 1fr) !important;
    }
}
</style>

<!-- Hero Section (Matches About Us Exact Height & Style) -->
<section class="booking-hero-section text-center position-relative">
    <div class="container position-relative" style="z-index: 2;">
        <span class="feature-pill">
            <i class="fas fa-calendar-check me-1"></i> Online Patient Scheduling
        </span>
        <h1 class="text-white fw-bold display-5 mb-2">Book Your Healthcare Service</h1>
        <p class="lead text-white-50 mx-auto mb-0" style="max-width: 720px; font-size: 15px;">
            Choose preferred service, pick your date & time slot, enter patient details, and confirm appointment securely.
        </p>
    </div>
</section>

<!-- Main Booking Section -->
<div class="booking-page-wrap">
    <div class="container">
        @if(session('success'))
            <div class="booking-login-alert" id="bookingSuccessAlert" role="alert">
                <div class="booking-login-alert-content">
                    <i class="fas fa-check-circle booking-login-alert-icon"></i>
                    <span class="booking-login-alert-text">{{ session('success') }}</span>
                </div>
                <button type="button" class="booking-login-alert-close" onclick="document.getElementById('bookingSuccessAlert').remove();" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        @endif

        @if(!empty($editingBooking))
            <div class="alert alert-warning border-0 rounded-4 mb-4 d-flex align-items-center justify-content-between p-3 shadow-sm" style="background: #fff8e6; border-left: 5px solid #f59e0b !important;">
                <div class="d-flex align-items-center gap-3">
                    <div style="background: #f59e0b; color: #fff; width: 42px; height: 42px; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                        <i class="fas fa-edit fs-5"></i>
                    </div>
                    <div>
                        <strong class="text-dark" style="font-size: 14.5px;">Editing Saved Appointment #{{ $editingBooking->booking_number }}</strong>
                        <small class="text-muted d-block" style="font-size: 12px;">All your previously entered details have been pre-filled below. Change any service, dates, patient condition or address, and click "Update & Proceed to Summary".</small>
                    </div>
                </div>
                <a href="{{ route('booking.summary', $editingBooking->booking_number) }}" class="btn btn-sm btn-outline-secondary fw-bold px-3 py-1.5 text-nowrap" style="border-radius: 6px; font-size: 12px;">
                    <i class="fas fa-arrow-left me-1"></i> Cancel & View Summary
                </a>
            </div>
        @endif

        <form id="bookingForm" onsubmit="event.preventDefault(); handleBookingPayment();">
            @csrf
            <input type="hidden" id="editing_booking_number" name="editing_booking_number" value="{{ $editingBooking->booking_number ?? '' }}">

            <div class="row g-4">
                <!-- Centered Patient Booking Form -->
                <div class="col-lg-9 col-xl-8 mx-auto">
                    <div class="booking-main-card">
                        <!-- Step 1: Select Service -->
                        <div>
                            <div class="booking-step-header">
                                <span class="booking-step-num">1</span>
                                <span class="booking-step-title">Choose Healthcare Service</span>
                            </div>

                            <select class="form-select fw-bold mt-1" id="service_id" name="service_id" onchange="updateServiceDetails()" required style="color: #0f172a;">
                                @foreach($services as $svc)
                                    <option value="{{ $svc->id }}" 
                                            data-title="{{ $svc->title }}"
                                            data-price="{{ $svc->price }}" 
                                            data-duration="{{ $svc->duration ?: '60 Mins' }}"
                                            data-gst-rate="{{ $svc->effective_gst_rate }}"
                                            data-platform-fee="{{ $svc->effective_platform_fee }}"
                                            data-extra-charges="{{ $svc->effective_extra_charges }}"
                                            data-extra-label="{{ $svc->effective_extra_charges_label }}"
                                            {{ (isset($selectedService) && $selectedService->id == $svc->id) ? 'selected' : '' }}>
                                        {{ $svc->title }}
                                    </option>
                                @endforeach
                            </select>

                            <!-- Sub-Services / Care Plans Selector (Rendered Inline - NO POPUP) -->
                            <div id="subServicesWrapper" class="mt-3 p-3 rounded-3 border" style="background: #f8fafc; border: 1.5px solid #e2e8f0 !important;">
                                <div class="d-flex align-items-center justify-content-between mb-2 flex-wrap gap-2">
                                    <label class="form-label mb-0 fw-bold text-dark" style="font-size: 13px;">
                                        <i class="fas fa-layer-group text-success me-1"></i> Choose Care Plan / Sub-Service:
                                    </label>
                                    <span class="badge" id="subServiceCountBadge" style="background: #e8f7ee; color: #048444; border: 1px solid rgba(4,132,68,0.25); font-size: 11px;">
                                        Care Plans Available
                                    </span>
                                </div>

                                <p class="text-muted small mb-2.5" style="font-size: 12px;">
                                    Click any care plan below to preview its clinical duties and select its customized pricing.
                                </p>

                                <!-- Hidden input to send selected sub-service ID with form submission -->
                                <input type="hidden" id="sub_service_id" name="sub_service_id" value="{{ $selectedSubService->id ?? ($editingBooking->sub_service_id ?? '') }}">

                                <!-- Dynamic Interactive Sub-Services Cards (NO POPUP) -->
                                <div id="subServiceCardsContainer" class="d-flex flex-column gap-2">
                                    <!-- Rendered dynamically by JavaScript -->
                                </div>
                            </div>
                        </div>

                        <div class="step-divider"></div>

                        <!-- Step 2: Date, Duration & Shift Selection -->
                        <div>
                            <div class="booking-step-header">
                                <span class="booking-step-num">2</span>
                                <span class="booking-step-title">Select Duration & Time Slot</span>
                            </div>

                            @php
                                $currentDuration = $editingBooking->duration_type ?? '8 Hrs';
                            @endphp

                            <!-- Duration Plan Selection -->
                            <div class="mb-3">
                                <label class="form-label mb-2"><i class="fas fa-history text-success me-1"></i> Choose Care Duration / Plan Type <span class="text-danger">*</span></label>
                                
                                <input type="hidden" id="duration_type" name="duration_type" value="{{ $currentDuration }}">

                                <!-- Day-Wise Shifts -->
                                <div class="mb-2">
                                    <div class="duration-group-label">
                                        <i class="fas fa-sun text-warning"></i> Day-Wise Shifts
                                    </div>
                                    <div class="duration-plan-grid" style="grid-template-columns: repeat(2, 1fr);">
                                        <div class="duration-plan-card {{ $currentDuration == '8 Hrs' ? 'active' : '' }}" data-plan="8 Hrs" onclick="selectDurationPlan('8 Hrs', this)">
                                            <i class="fas fa-sun plan-icon"></i>
                                            <span class="plan-title">8 Hrs</span>
                                            <span class="plan-sub">Single Shift</span>
                                        </div>
                                        <div class="duration-plan-card {{ $currentDuration == '24 Hrs' ? 'active' : '' }}" data-plan="24 Hrs" onclick="selectDurationPlan('24 Hrs', this)">
                                            <i class="fas fa-moon plan-icon"></i>
                                            <span class="plan-title">24 Hrs</span>
                                            <span class="plan-sub">Full Day Care (Live-in)</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Long-Term Packages & Custom -->
                                <div>
                                    <div class="duration-group-label">
                                        <i class="fas fa-calendar-alt text-success"></i> Long-Term Packages & Custom Period
                                    </div>
                                    <div class="duration-plan-grid">
                                        <div class="duration-plan-card {{ ($currentDuration == 'Week wise' || $currentDuration == 'Week wise (7 Days)') ? 'active' : '' }}" data-plan="Week wise" onclick="selectDurationPlan('Week wise', this)">
                                            <i class="fas fa-calendar-week plan-icon"></i>
                                            <span class="plan-title">Week wise</span>
                                            <span class="plan-sub">7 Days</span>
                                        </div>
                                        <div class="duration-plan-card {{ $currentDuration == '15 Days' ? 'active' : '' }}" data-plan="15 Days" onclick="selectDurationPlan('15 Days', this)">
                                            <i class="fas fa-calendar-alt plan-icon"></i>
                                            <span class="plan-title">15 Days</span>
                                            <span class="plan-sub">Fortnight</span>
                                        </div>
                                        <div class="duration-plan-card {{ ($currentDuration == 'Month wise' || $currentDuration == 'Month wise (30 Days)') ? 'active' : '' }}" data-plan="Month wise" onclick="selectDurationPlan('Month wise', this)">
                                            <i class="fas fa-calendar-check plan-icon"></i>
                                            <span class="plan-title">Month wise</span>
                                            <span class="plan-sub">30 Days</span>
                                        </div>
                                        <div class="duration-plan-card {{ $currentDuration == 'Custom' ? 'active' : '' }}" data-plan="Custom" onclick="selectDurationPlan('Custom', this)">
                                            <i class="fas fa-sliders-h plan-icon"></i>
                                            <span class="plan-title">Custom</span>
                                            <span class="plan-sub">Pick Dates & Times</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Unified Start & End Date Panel -->
                            <div class="p-3 rounded-3 mb-3" style="background: #f8fafc; border: 1.5px solid #e2e8f0;">
                                <div class="row g-3">
                                    <!-- Start Date -->
                                    <div class="col-sm-6">
                                        <label class="form-label fw-semibold"><i class="far fa-calendar-alt text-success me-1"></i> Start Date <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control form-control-lg fw-bold text-dark" id="booking_date" name="booking_date" 
                                               min="{{ date('Y-m-d') }}" value="{{ $editingBooking ? $editingBooking->booking_date : date('Y-m-d', strtotime('+1 day')) }}" required onchange="handleDateChange()">
                                    </div>

                                    <!-- End Date -->
                                    <div class="col-sm-6">
                                        <label class="form-label fw-semibold"><i class="far fa-calendar-check text-success me-1"></i> End Date <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control form-control-lg fw-bold text-dark" id="booking_end_date" name="booking_end_date" 
                                               value="{{ $editingBooking ? ($editingBooking->booking_end_date ?: $editingBooking->booking_date) : date('Y-m-d', strtotime('+1 day')) }}" {{ ($editingBooking && $editingBooking->duration_type == 'Custom') ? '' : 'readonly' }} onchange="handleDateChange()">
                                    </div>
                                </div>
                                @php
                                    $currentTime = $editingBooking->booking_time ?? '08:00 AM';
                                    $currentEndTime = $editingBooking->booking_end_time ?? '06:00 PM';
                                @endphp
                            </div>

                            <!-- Shift Time Selection (Modern 12-Hour AM/PM Time Picker & Quick Pick Slots) -->
                            <div class="p-3 rounded-3 mb-2 bg-white border" style="border: 1.5px solid #e2e8f0 !important;">
                                <div class="d-flex align-items-center justify-content-between mb-2.5 flex-wrap gap-2">
                                    <label class="form-label fw-bold text-dark mb-0" style="font-size: 13px;">
                                        <i class="fas fa-clock text-success me-1"></i> Shift Appointment Time <span class="text-danger">*</span>
                                    </label>
                                    <span class="badge bg-success-subtle text-success border border-success-subtle fw-bold" id="selectedTimeBadge" style="font-size: 11px;">
                                        {{ $currentTime }} @if(!empty($currentEndTime)) – {{ $currentEndTime }} @endif
                                    </span>
                                </div>

                                <!-- Custom 12-Hour AM/PM Time Inputs (Matches Date Input Style) -->
                                <div class="p-3 rounded-3 mb-3 border bg-light" style="border-color: #e2e8f0 !important;">
                                    <div class="row g-3">
                                        <!-- Shift Start Time -->
                                        <div class="col-sm-6">
                                            <label class="form-label small fw-semibold text-dark mb-1" for="booking_time">
                                                <i class="far fa-clock text-success me-1"></i> Shift Start Time (Pick Any Time) <span class="text-danger">*</span>
                                            </label>
                                            <div class="input-group">
                                                <input type="text" 
                                                       class="form-control form-control-lg fw-bold text-dark bg-white" 
                                                       id="booking_time" 
                                                       name="booking_time" 
                                                       value="{{ $currentTime }}" 
                                                       readonly 
                                                       style="cursor: pointer; font-size: 15px;" 
                                                       placeholder="08:00 AM"
                                                       onclick="openStartTimePicker()">
                                                <span class="input-group-text bg-white text-success border-start-0" style="cursor: pointer;" onclick="openStartTimePicker()">
                                                    <i class="far fa-clock fs-5"></i>
                                                </span>
                                            </div>
                                            <small class="text-muted d-block mt-1" style="font-size: 10.5px;">Click to pick custom 12-hour start time (AM / PM)</small>
                                        </div>

                                        <!-- Shift End Time -->
                                        <div class="col-sm-6">
                                            <label class="form-label small fw-semibold text-dark mb-1" for="booking_end_time">
                                                <i class="far fa-clock text-primary me-1"></i> Shift End Time (Optional / Auto)
                                            </label>
                                            <div class="input-group">
                                                <input type="text" 
                                                       class="form-control form-control-lg fw-bold text-dark bg-white" 
                                                       id="booking_end_time" 
                                                       name="booking_end_time" 
                                                       value="{{ $currentEndTime }}" 
                                                       readonly 
                                                       style="cursor: pointer; font-size: 15px;" 
                                                       placeholder="06:00 PM"
                                                       onclick="openEndTimePicker()">
                                                <span class="input-group-text bg-white text-primary border-start-0" style="cursor: pointer;" onclick="openEndTimePicker()">
                                                    <i class="far fa-clock fs-5"></i>
                                                </span>
                                            </div>
                                            <small class="text-muted d-block mt-1" style="font-size: 10.5px;">Auto-calculated for shifts or custom completion time</small>
                                        </div>
                                    </div>
                                </div>

                                <!-- Quick Pick Slots -->
                                <label class="form-label text-muted d-block mb-1.5" style="font-size: 11.5px;">
                                    <i class="fas fa-magic text-muted me-1"></i> Or Quick Pick a Standard Start Time:
                                </label>
                                <div id="timeSlotsContainer">
                                    @php
                                        $slots = ['08:00 AM', '09:00 AM', '10:00 AM', '12:00 PM', '02:00 PM', '04:00 PM', '06:00 PM', '08:00 PM'];
                                    @endphp
                                    @foreach($slots as $index => $slot)
                                        <div class="time-slot-btn {{ $slot === $currentTime ? 'selected' : '' }}" onclick="selectQuickTimeSlot('{{ $slot }}', this)">
                                            <i class="far fa-clock"></i> {{ $slot }}
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="step-divider"></div>

                        <!-- Step 3: Caller & Patient Details (Reference: helpee.in) -->
                        <div>
                            <div class="booking-step-header mb-3">
                                <span class="booking-step-num">3</span>
                                <div>
                                    <span class="booking-step-title">Caller & Patient Details</span>
                                    <small class="text-muted d-block" style="font-size: 11.5px;">Detailed medical profiling ensures certified clinical staff assignment</small>
                                </div>
                            </div>

                            <!-- 3A: Caller / Family Member Details -->
                            <div class="p-3 rounded-3 mb-3 bg-white border" style="border-left: 3.5px solid #00bbd7 !important;">
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <span class="fw-bold text-dark" style="font-size: 13px;">
                                        <i class="fas fa-user-friends text-info me-1"></i> 1. Caller / Family Member Information
                                    </span>
                                    <span class="badge bg-light text-muted border" style="font-size: 10.5px;">Person Booking</span>
                                </div>
                                <div class="row g-2 mb-2">
                                    <div class="col-md-6">
                                        <label class="form-label">Caller Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="caller_name" name="caller_name" 
                                               value="{{ $editingBooking ? $editingBooking->caller_name : Auth::user()->name }}" placeholder="Your full name" required>
                                    </div>
                                    <div class="col-md-6">
                                        @php $currentRel = $editingBooking->caller_relationship ?? ''; @endphp
                                        <label class="form-label">Relationship to Patient <span class="text-danger">*</span></label>
                                        <select class="form-select fw-semibold" id="caller_relationship" name="caller_relationship" required>
                                            <option value="" disabled {{ empty($currentRel) ? 'selected' : '' }}>-- Select Relationship to Patient --</option>
                                            <option value="Self" {{ $currentRel == 'Self' ? 'selected' : '' }}>Self (I am the patient)</option>
                                            <option value="Son / Daughter" {{ $currentRel == 'Son / Daughter' ? 'selected' : '' }}>Son / Daughter</option>
                                            <option value="Spouse" {{ $currentRel == 'Spouse' ? 'selected' : '' }}>Spouse (Husband / Wife)</option>
                                            <option value="Sibling" {{ $currentRel == 'Sibling' ? 'selected' : '' }}>Sibling (Brother / Sister)</option>
                                            <option value="Parent" {{ $currentRel == 'Parent' ? 'selected' : '' }}>Parent (Father / Mother)</option>
                                            <option value="Grandchild" {{ $currentRel == 'Grandchild' ? 'selected' : '' }}>Grandchild</option>
                                            <option value="Guardian / Relative" {{ $currentRel == 'Guardian / Relative' ? 'selected' : '' }}>Guardian / Relative</option>
                                            <option value="Care Manager / Friend" {{ $currentRel == 'Care Manager / Friend' ? 'selected' : '' }}>Care Manager / Friend</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Caller Mobile Number <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light fw-bold text-dark px-2">+91</span>
                                            <input type="tel" class="form-control fw-bold text-dark bg-light" id="customer_phone" name="customer_phone" 
                                                   maxlength="10" value="{{ $editingBooking ? $editingBooking->customer_phone : Auth::user()->mobile_no }}" readonly required>
                                            <span class="input-group-text bg-success text-white fw-bold px-2" style="font-size: 11px;">
                                                <i class="fas fa-check-circle me-1"></i> Verified
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Email Address <span class="text-muted fw-normal small">(For Invoices)</span></label>
                                        <input type="email" class="form-control" id="customer_email" name="customer_email" 
                                               value="{{ $editingBooking ? $editingBooking->customer_email : Auth::user()->email }}" placeholder="digital invoice recipient">
                                    </div>
                                </div>
                            </div>

                            <!-- 3B: Patient Receiving Healthcare -->
                            <div class="p-3 rounded-3 mb-3 bg-white border" style="border-left: 3.5px solid #048444 !important;">
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <span class="fw-bold text-dark" style="font-size: 13px;">
                                        <i class="fas fa-user-injured text-success me-1"></i> 2. Patient Profile & Clinical Condition
                                    </span>
                                    <span class="badge bg-light text-success border border-success fw-bold" style="font-size: 10.5px;">Receiving Care</span>
                                </div>
                                <div class="row g-2 mb-2">
                                    <div class="col-md-6">
                                        <label class="form-label">Patient Full Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control fw-bold" id="patient_name" name="patient_name" 
                                               value="{{ $editingBooking ? $editingBooking->patient_name : '' }}" placeholder="Enter patient full name" required>
                                    </div>
                                    <div class="col-md-3 col-6">
                                        <label class="form-label">Age <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control" id="patient_age" name="patient_age" 
                                               min="0" max="120" value="{{ $editingBooking ? $editingBooking->patient_age : '' }}" placeholder="e.g. 65" required>
                                    </div>
                                    <div class="col-md-3 col-6">
                                        @php $currentGender = $editingBooking->patient_gender ?? 'Female'; @endphp
                                        <label class="form-label">Gender <span class="text-danger">*</span></label>
                                        <select class="form-select" id="patient_gender" name="patient_gender" required>
                                            <option value="Female" {{ $currentGender == 'Female' ? 'selected' : '' }}>Female</option>
                                            <option value="Male" {{ $currentGender == 'Male' ? 'selected' : '' }}>Male</option>
                                            <option value="Other" {{ $currentGender == 'Other' ? 'selected' : '' }}>Other</option>
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        @php $currentCond = $editingBooking->patient_condition ?? 'Elderly & Geriatric Assistance'; @endphp
                                        <label class="form-label">Primary Medical Condition / Care Reason <span class="text-danger">*</span></label>
                                        <select class="form-select" id="patient_condition" name="patient_condition" required>
                                            <option value="Elderly & Geriatric Assistance" {{ str_contains($currentCond, 'Elderly') ? 'selected' : '' }}>Elderly & Geriatric Assistance (Mobility / Bedside / Hygiene)</option>
                                            <option value="Post-Surgical Rehabilitation" {{ str_contains($currentCond, 'Post-Surgical') ? 'selected' : '' }}>Post-Surgical Rehabilitation & Wound Care</option>
                                            <option value="Bedridden / Stroke / Paralysis Care" {{ str_contains($currentCond, 'Bedridden') ? 'selected' : '' }}>Bedridden / Stroke / Neurological Care</option>
                                            <option value="Physiotherapy & Mobility Restoration" {{ (str_contains($currentCond, 'Physiotherapy') || str_contains($currentCond, 'Therapist')) ? 'selected' : '' }}>Certified Therapist & Mobility Restoration</option>
                                            <option value="Palliative & Chronic Care" {{ (str_contains($currentCond, 'Chronic') || str_contains($currentCond, 'Palliative')) ? 'selected' : '' }}>Chronic Illness Management & Palliative Care</option>
                                            <option value="Mother & Newborn Baby Care" {{ (str_contains($currentCond, 'Mother') || str_contains($currentCond, 'Newborn')) ? 'selected' : '' }}>Mother & Newborn Post-Natal Care</option>
                                            <option value="Physician Check-up & Vital Monitoring" {{ str_contains($currentCond, 'Physician') ? 'selected' : '' }}>Certified Physician Consultation & Vital Monitoring</option>
                                            <option value="Other Medical Requirement" {{ str_contains($currentCond, 'Other') ? 'selected' : '' }}>Other Clinical Requirement</option>
                                        </select>
                                    </div>
                                    <div class="col-12 mt-2">
                                        <label class="form-label">Special Clinical Instructions / Medication Schedule <span class="text-muted fw-normal small">(Optional)</span></label>
                                        <textarea class="form-control" id="notes" name="notes" rows="2" placeholder="e.g. Patient requires oxygen support, strict insulin timing at 8 AM, catheter dressing, dietary restrictions...">{{ $editingBooking ? $editingBooking->notes : '' }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <!-- 3C: Medical Documents Upload (Multi-file) -->
                            <div class="p-3 rounded-3 mb-3 bg-white border">
                                <label class="form-label d-flex align-items-center justify-content-between mb-1">
                                    <span><i class="fas fa-file-medical text-success me-1"></i> 3. Patient Medical Documents <span class="text-muted fw-normal small">(Optional)</span></span>
                                    <span class="badge bg-light text-muted border" style="font-size: 10px;">PDF, PNG, JPG, DOC</span>
                                </label>
                                <div class="p-3 rounded-3" style="background: #f8fafc; border: 1.5px dashed #cbd5e1;">
                                    <input type="file" class="form-control" id="patient_docs" name="patient_docs[]" multiple accept=".pdf,.doc,.docx,image/*" onchange="handlePatientDocsChange(this)">
                                    <small class="text-muted d-block mt-1" style="font-size: 11.5px;">
                                        <i class="fas fa-shield-alt text-success me-1"></i> Upload Hospital Discharge Summaries, Doctor's Prescriptions, Diagnostic Reports, or Patient ID Proof (Max 10MB each).
                                    </small>
                                    @if(!empty($editingBooking->patient_documents) && is_array($editingBooking->patient_documents))
                                        <div class="mt-2 d-flex flex-wrap gap-2">
                                            @foreach($editingBooking->patient_documents as $doc)
                                                <span class="badge bg-white text-dark border p-2 d-inline-flex align-items-center gap-1 shadow-sm" style="font-size: 11.5px;">
                                                    <i class="fas fa-file-pdf text-danger"></i> {{ $doc['name'] ?? 'Attached Document' }}
                                                </span>
                                            @endforeach
                                        </div>
                                    @endif
                                    <div id="selected_docs_list" class="mt-2 d-flex flex-wrap gap-2" style="display: none !important;"></div>
                                </div>
                            </div>

                            <!-- 3D: Service Address & Live Google Maps Location -->
                            <div class="p-3 rounded-3 mb-2 bg-white border">
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <span class="fw-bold text-dark" style="font-size: 13px;">
                                        <i class="fas fa-map-marked-alt text-danger me-1"></i> 4. Visit Address & Live Google Maps Location <span class="text-danger">*</span>
                                    </span>
                                    <button type="button" class="btn btn-sm btn-outline-success fw-bold py-1 px-2" style="font-size: 11.5px; border-radius: 6px;" onclick="detectLiveLocation()">
                                        <i class="fas fa-crosshairs me-1"></i> Detect Live GPS
                                    </button>
                                </div>
                                <div id="gps_status" class="small text-muted mb-2" style="font-size: 11.5px;">
                                    <i class="fas fa-info-circle text-muted me-1"></i> Click "Detect Live GPS" to autofill your live coordinates or enter address below.
                                </div>
                                <div class="mb-2">
                                    <textarea class="form-control" id="customer_address" name="customer_address" rows="2" placeholder="House / Flat No., Apartment / Building Name, Street, Landmark, City & Pincode" required oninput="handleAddressTyping(this.value)" onchange="handleAddressTyping(this.value)">{{ $editingBooking ? $editingBooking->customer_address : '' }}</textarea>
                                    <small class="text-muted d-block mt-1" style="font-size: 11px;">
                                        <i class="fas fa-map-marker-alt text-danger me-1"></i> GPS pins your location on Google Maps. Please verify and add your exact <strong>Flat / Door No. & Street Name</strong>.
                                    </small>
                                </div>
                                <div>
                                    <label class="form-label text-muted" style="font-size: 11.5px; margin-bottom: 3px !important;">
                                        <i class="fab fa-google text-primary me-1"></i> Google Maps Live Pin Link <span class="fw-normal">(Auto-captured or paste link)</span>
                                    </label>
                                    <input type="url" class="form-control" id="google_maps_link" name="google_maps_link" value="{{ $editingBooking ? $editingBooking->google_maps_link : '' }}" placeholder="https://maps.google.com/?q=..." onchange="handleManualMapsLinkChange(this.value)">
                                </div>
                                <!-- Interactive Google Maps Live Location Box -->
                                <div id="map_preview_box" class="mt-2 rounded-2 overflow-hidden border" style="display: none; height: 160px;">
                                    <iframe id="map_embed_frame" width="100%" height="160" style="border:0;" loading="lazy" allowfullscreen></iframe>
                                </div>
                            </div>
                        </div>

                        <div class="step-divider"></div>

                        <!-- Terms & Conditions Agreement -->
                        <div class="mb-3 p-3 rounded-3 bg-light border">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="terms_agree" required checked>
                                <label class="form-check-label text-muted" for="terms_agree" style="font-size: 12px; line-height: 1.45;">
                                    I confirm details are accurate and agree to {{ \App\Models\Setting::get('brand_name', 'Angelhug') }}'s <a href="javascript:void(0)" onclick="openTermsModal()" class="text-success fw-bold text-decoration-underline">Terms of Service, Clinical Protocols & Cancellation Policy</a>.
                                </label>
                            </div>
                        </div>

                        <!-- Proceed to Book Bar -->
                        <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 p-3 rounded-3 bg-white border shadow-sm">
                            <div>
                                <small class="text-muted d-block" style="font-size: 11.5px;">Next Step:</small>
                                <strong class="text-dark" style="font-size: 13.5px;"><i class="fas fa-file-invoice text-success me-1"></i> Step 2: Appointment Summary & Payment Review</strong>
                            </div>
                            <button type="submit" class="btn-pay-now shadow-sm" id="btnPayNow" style="max-width: 320px; width: 100%;">
                                <i class="fas fa-{{ !empty($editingBooking) ? 'check-circle' : 'arrow-right' }} me-1"></i> {{ !empty($editingBooking) ? 'Update & Proceed to Summary' : 'Proceed to Book' }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script src="{{ asset('js/flatpickr.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script>
window.billingConfig = {
    gstEnabled: {{ !empty($billingSettings['gst_enabled']) ? 'true' : 'false' }},
    gstPercentage: {{ (float) ($billingSettings['gst_percentage'] ?? 5.0) }},
    platformFee: {{ (float) ($billingSettings['platform_fee'] ?? 0.0) }},
    platformFeeLabel: "{{ addslashes($billingSettings['platform_fee_label'] ?? 'Others') }}",
    extraChargeEnabled: {{ !empty($billingSettings['extra_charge_enabled']) ? 'true' : 'false' }},
    extraChargeAmount: {{ (float) ($billingSettings['extra_charge_amount'] ?? 0.0) }},
    extraChargeLabel: "{{ addslashes($billingSettings['extra_charge_label'] ?? 'Extra Charges / Kit Fee') }}"
};

window.allServicesData = {
    @foreach($services as $svc)
    "{{ $svc->id }}": {
        id: {{ $svc->id }},
        title: @json($svc->title),
        price: {{ (float) $svc->price }},
        formatted_price: @json($svc->formatted_price),
        duration: @json($svc->duration ?: '60 Mins'),
        subServices: [
            @foreach($svc->subServices as $sub)
            {
                id: {{ $sub->id }},
                title: @json($sub->title),
                subtitle: @json($sub->subtitle),
                price: {{ (float) $sub->price }},
                formatted_price: @json($sub->formatted_price),
                duration: @json($sub->duration ?: '12 Hours Shift'),
                features: @json($sub->features_list)
            },
            @endforeach
        ]
    },
    @endforeach
};

let currentSelectedSubServiceId = "{{ $selectedSubService->id ?? ($editingBooking->sub_service_id ?? '') }}";
let currentPlan = "{{ $editingBooking ? $editingBooking->duration_type : '8 Hrs' }}";
let baseServicePrice = 0;

function selectDurationPlan(plan, element) {
    currentPlan = plan;
    document.querySelectorAll('.duration-plan-card').forEach(card => card.classList.remove('active'));
    if (element) element.classList.add('active');
    document.getElementById('duration_type').value = plan;

    const startDateInput = document.getElementById('booking_date');
    const endDateInput = document.getElementById('booking_end_date');
    const startTimeInput = document.getElementById('booking_time');
    const endTimeInput = document.getElementById('booking_end_time');

    const startDateVal = startDateInput.value || new Date().toISOString().split('T')[0];

    if (plan === '8 Hrs') {
        endDateInput.value = startDateVal;
        endDateInput.setAttribute('readonly', 'readonly');
        updateEndTimeFor8Hrs();
    } else if (plan === '24 Hrs') {
        const d = new Date(startDateVal);
        d.setDate(d.getDate() + 1);
        endDateInput.value = d.toISOString().split('T')[0];
        endDateInput.setAttribute('readonly', 'readonly');
        if (endTimeInput && startTimeInput) {
            endTimeInput.value = startTimeInput.value;
            if (endTimePickerInstance) {
                endTimePickerInstance.setDate(startTimeInput.value, false);
            }
        }
    } else if (plan === 'Week wise') {
        const d = new Date(startDateVal);
        d.setDate(d.getDate() + 7);
        endDateInput.value = d.toISOString().split('T')[0];
        endDateInput.setAttribute('readonly', 'readonly');
        if (endTimeInput && startTimeInput) {
            endTimeInput.value = startTimeInput.value;
            if (endTimePickerInstance) {
                endTimePickerInstance.setDate(startTimeInput.value, false);
            }
        }
    } else if (plan === '15 Days') {
        const d = new Date(startDateVal);
        d.setDate(d.getDate() + 15);
        endDateInput.value = d.toISOString().split('T')[0];
        endDateInput.setAttribute('readonly', 'readonly');
        if (endTimeInput && startTimeInput) {
            endTimeInput.value = startTimeInput.value;
            if (endTimePickerInstance) {
                endTimePickerInstance.setDate(startTimeInput.value, false);
            }
        }
    } else if (plan === 'Month wise') {
        const d = new Date(startDateVal);
        d.setDate(d.getDate() + 30);
        endDateInput.value = d.toISOString().split('T')[0];
        endDateInput.setAttribute('readonly', 'readonly');
        if (endTimeInput && startTimeInput) {
            endTimeInput.value = startTimeInput.value;
            if (endTimePickerInstance) {
                endTimePickerInstance.setDate(startTimeInput.value, false);
            }
        }
    } else if (plan === 'Custom') {
        endDateInput.removeAttribute('readonly');
        if (!endDateInput.value || endDateInput.value < startDateVal) {
            endDateInput.value = startDateVal;
        }
        endDateInput.min = startDateVal;
    }

    calculatePricingAndSummary();
}

function addHoursTo12h(time12, hoursToAdd) {
    if (!time12) return '06:00 PM';
    const match = time12.match(/(\d+):(\d+)\s*(AM|PM)/i);
    if (!match) return '06:00 PM';
    let h = parseInt(match[1], 10);
    const m = parseInt(match[2], 10);
    const ampm = match[3].toUpperCase();
    if (ampm === 'PM' && h < 12) h += 12;
    if (ampm === 'AM' && h === 12) h = 0;
    
    let totalMinutes = (h * 60) + m + (hoursToAdd * 60);
    totalMinutes = (totalMinutes % 1440 + 1440) % 1440;
    
    let newH = Math.floor(totalMinutes / 60);
    let newM = totalMinutes % 60;
    const newAmpm = newH >= 12 ? 'PM' : 'AM';
    newH = newH % 12 || 12;
    
    const hStr = newH < 10 ? '0' + newH : '' + newH;
    const mStr = newM < 10 ? '0' + newM : '' + newM;
    return hStr + ':' + mStr + ' ' + newAmpm;
}

function updateEndTimeFor8Hrs() {
    const startTime = document.getElementById('booking_time')?.value || '08:00 AM';
    const autoEnd = addHoursTo12h(startTime, 8);
    const endTimeInput = document.getElementById('booking_end_time');
    if (endTimeInput) {
        endTimeInput.value = autoEnd;
        if (endTimePickerInstance) {
            endTimePickerInstance.setDate(autoEnd, false);
        }
    }
    updateSelectedTimeBadge();
}

function handleDateChange() {
    const startDateInput = document.getElementById('booking_date');
    const endDateInput = document.getElementById('booking_end_date');
    const startDateVal = startDateInput.value;

    if (currentPlan === '8 Hrs') {
        endDateInput.value = startDateVal;
    } else if (currentPlan === '24 Hrs') {
        const d = new Date(startDateVal);
        d.setDate(d.getDate() + 1);
        endDateInput.value = d.toISOString().split('T')[0];
    } else if (currentPlan === 'Week wise') {
        const d = new Date(startDateVal);
        d.setDate(d.getDate() + 7);
        endDateInput.value = d.toISOString().split('T')[0];
    } else if (currentPlan === '15 Days') {
        const d = new Date(startDateVal);
        d.setDate(d.getDate() + 15);
        endDateInput.value = d.toISOString().split('T')[0];
    } else if (currentPlan === 'Month wise') {
        const d = new Date(startDateVal);
        d.setDate(d.getDate() + 30);
        endDateInput.value = d.toISOString().split('T')[0];
    } else if (currentPlan === 'Custom') {
        endDateInput.min = startDateVal;
        if (endDateInput.value && endDateInput.value < startDateVal) {
            endDateInput.value = startDateVal;
        }
    }

    calculatePricingAndSummary();
}

let startTimePickerInstance = null;
let endTimePickerInstance = null;

function initFlatpickrTimePickers() {
    if (typeof flatpickr === 'undefined') return;

    const startEl = document.getElementById('booking_time');
    if (startEl && !startTimePickerInstance) {
        startTimePickerInstance = flatpickr(startEl, {
            enableTime: true,
            noCalendar: true,
            dateFormat: "h:i K",
            minuteIncrement: 15,
            defaultDate: startEl.value || "08:00 AM",
            allowInput: false,
            clickOpens: true,
            onChange: function(selectedDates, dateStr) {
                handleTimeSelect(dateStr);
            }
        });
    }

    const endEl = document.getElementById('booking_end_time');
    if (endEl && !endTimePickerInstance) {
        endTimePickerInstance = flatpickr(endEl, {
            enableTime: true,
            noCalendar: true,
            dateFormat: "h:i K",
            minuteIncrement: 15,
            defaultDate: endEl.value || "06:00 PM",
            allowInput: false,
            clickOpens: true,
            onChange: function(selectedDates, dateStr) {
                handleEndTimeSelect(dateStr);
            }
        });
    }
}

function openStartTimePicker() {
    if (!startTimePickerInstance) initFlatpickrTimePickers();
    if (startTimePickerInstance) startTimePickerInstance.open();
}

function openEndTimePicker() {
    if (!endTimePickerInstance) initFlatpickrTimePickers();
    if (endTimePickerInstance) endTimePickerInstance.open();
}

function handleTimeSelect(time12) {
    if (!time12) return;
    const timeInput = document.getElementById('booking_time');
    if (timeInput) {
        timeInput.value = time12;
        if (startTimePickerInstance && startTimePickerInstance.input.value !== time12) {
            startTimePickerInstance.setDate(time12, false);
        }
    }

    if (currentPlan === '8 Hrs') {
        const autoEnd = addHoursTo12h(time12, 8);
        const endTimeInput = document.getElementById('booking_end_time');
        if (endTimeInput) {
            endTimeInput.value = autoEnd;
            if (endTimePickerInstance) {
                endTimePickerInstance.setDate(autoEnd, false);
            }
        }
    } else if (['24 Hrs', 'Week wise', '15 Days', 'Month wise'].includes(currentPlan)) {
        const endTimeInput = document.getElementById('booking_end_time');
        if (endTimeInput) {
            endTimeInput.value = time12;
            if (endTimePickerInstance) {
                endTimePickerInstance.setDate(time12, false);
            }
        }
    }

    document.querySelectorAll('.time-slot-btn').forEach(btn => {
        if (btn.innerText.trim().toUpperCase() === time12.toUpperCase()) {
            btn.classList.add('selected');
        } else {
            btn.classList.remove('selected');
        }
    });

    updateSelectedTimeBadge();
    calculatePricingAndSummary();
}

function handleEndTimeSelect(time12) {
    if (!time12) return;
    const endTimeInput = document.getElementById('booking_end_time');
    if (endTimeInput) {
        endTimeInput.value = time12;
        if (endTimePickerInstance && endTimePickerInstance.input.value !== time12) {
            endTimePickerInstance.setDate(time12, false);
        }
    }

    updateSelectedTimeBadge();
    calculatePricingAndSummary();
}

function selectQuickTimeSlot(slot, element) {
    document.querySelectorAll('.time-slot-btn').forEach(btn => btn.classList.remove('selected'));
    if (element) element.classList.add('selected');
    handleTimeSelect(slot);
}

function updateSelectedTimeBadge() {
    const startTime = document.getElementById('booking_time')?.value || '';
    const endTime = document.getElementById('booking_end_time')?.value || '';
    const badge = document.getElementById('selectedTimeBadge');
    if (badge) {
        badge.innerText = startTime + (endTime ? ' – ' + endTime : '');
    }
}

function formatTo12Hour(time24) {
    if (!time24) return '10:00 AM';
    const parts = time24.split(':');
    let hour = parseInt(parts[0], 10);
    const minute = parts[1] || '00';
    const ampm = hour >= 12 ? 'PM' : 'AM';
    hour = hour % 12;
    hour = hour ? hour : 12;
    const hourStr = hour < 10 ? '0' + hour : '' + hour;
    return hourStr + ':' + minute + ' ' + ampm;
}

function formatTo24Hour(time12) {
    if (!time12) return '10:00';
    const match = time12.match(/(\d+):(\d+)\s*(AM|PM)/i);
    if (!match) return '10:00';
    let hour = parseInt(match[1], 10);
    const minute = match[2];
    const ampm = match[3].toUpperCase();
    if (ampm === 'PM' && hour < 12) hour += 12;
    if (ampm === 'AM' && hour === 12) hour = 0;
    return (hour < 10 ? '0' + hour : '' + hour) + ':' + minute;
}

function handleManualTimeChange(time24) {
    handleTimeSelect(formatTo12Hour(time24));
}

function handleManualEndTimeChange(time24) {
    handleEndTimeSelect(formatTo12Hour(time24));
}

function calculatePricingAndSummary() {
    const startDateInput = document.getElementById('booking_date');
    const endDateInput = document.getElementById('booking_end_date');
    const startTimeVal = document.getElementById('booking_time').value;
    const endTimeVal = document.getElementById('booking_end_time').value;

    const options = { year: 'numeric', month: 'short', day: 'numeric' };
    const dateVal = startDateInput.value;
    const startDateObj = dateVal ? new Date(dateVal) : new Date();

    let computedPrice = baseServicePrice;
    let planLabel = currentPlan;
    let durationBadgeText = currentPlan;

    const summaryDate = document.getElementById('summary_date');
    if (currentPlan === '8 Hrs') {
        planLabel = '8 Hours Single Shift';
        durationBadgeText = '8 Hrs Shift';
        computedPrice = baseServicePrice;
        if (summaryDate) summaryDate.innerText = startDateObj.toLocaleDateString('en-US', options);
    } else if (currentPlan === '24 Hrs') {
        planLabel = '24 Hours Full Day Care';
        durationBadgeText = '24 Hrs Care';
        computedPrice = Math.round(baseServicePrice * 1.85);
        const endObj = endDateInput.value ? new Date(endDateInput.value) : new Date(startDateObj.getTime() + 86400000);
        if (summaryDate) summaryDate.innerText = startDateObj.toLocaleDateString('en-US', options) + ' – ' + endObj.toLocaleDateString('en-US', options);
    } else if (currentPlan === 'Week wise') {
        planLabel = 'Week wise Package (7 Days)';
        durationBadgeText = 'Week wise (7 Days)';
        computedPrice = Math.round(baseServicePrice * 6.5);
        const endObj = endDateInput.value ? new Date(endDateInput.value) : new Date(startDateObj.getTime() + 7 * 86400000);
        if (summaryDate) summaryDate.innerText = startDateObj.toLocaleDateString('en-US', options) + ' – ' + endObj.toLocaleDateString('en-US', options);
    } else if (currentPlan === '15 Days') {
        planLabel = '15 Days Care Package';
        durationBadgeText = '15 Days Package';
        computedPrice = Math.round(baseServicePrice * 13.0);
        const endObj = endDateInput.value ? new Date(endDateInput.value) : new Date(startDateObj.getTime() + 15 * 86400000);
        if (summaryDate) summaryDate.innerText = startDateObj.toLocaleDateString('en-US', options) + ' – ' + endObj.toLocaleDateString('en-US', options);
    } else if (currentPlan === 'Month wise') {
        planLabel = 'Month wise Package (30 Days)';
        durationBadgeText = 'Month wise (30 Days)';
        computedPrice = Math.round(baseServicePrice * 25.0);
        const endObj = endDateInput.value ? new Date(endDateInput.value) : new Date(startDateObj.getTime() + 30 * 86400000);
        if (summaryDate) summaryDate.innerText = startDateObj.toLocaleDateString('en-US', options) + ' – ' + endObj.toLocaleDateString('en-US', options);
    } else if (currentPlan === 'Custom') {
        const startParts = (dateVal || '').split('-');
        const endVal = endDateInput.value || dateVal;
        const endParts = endVal.split('-');
        
        let diffDays = 1;
        if (startParts.length === 3 && endParts.length === 3) {
            const sObj = new Date(parseInt(startParts[0], 10), parseInt(startParts[1], 10) - 1, parseInt(startParts[2], 10));
            const eObj = new Date(parseInt(endParts[0], 10), parseInt(endParts[1], 10) - 1, parseInt(endParts[2], 10));
            diffDays = (eObj >= sObj) ? Math.max(1, Math.round((eObj - sObj) / 86400000) + 1) : 1;
        }
        
        planLabel = 'Custom Plan (' + diffDays + ' Day' + (diffDays > 1 ? 's' : '') + ')';
        durationBadgeText = 'Custom (' + diffDays + ' Day' + (diffDays > 1 ? 's' : '') + ')';
        computedPrice = Math.round(baseServicePrice * diffDays);
        if (summaryDate) {
            if (diffDays === 1) {
                summaryDate.innerText = startDateObj.toLocaleDateString('en-US', options);
            } else {
                const endObj = new Date(parseInt(endParts[0], 10), parseInt(endParts[1], 10) - 1, parseInt(endParts[2], 10));
                summaryDate.innerText = startDateObj.toLocaleDateString('en-US', options) + ' – ' + endObj.toLocaleDateString('en-US', options);
            }
        }
    }

    // Read dynamic billing rules configured by admin
    const platformFee = window.billingConfig ? window.billingConfig.platformFee : 100.00;
    const extraCharges = (window.billingConfig && window.billingConfig.extraChargeEnabled) ? window.billingConfig.extraChargeAmount : 0.00;
    const taxableSubtotal = computedPrice + platformFee + extraCharges;
    const gstRate = (window.billingConfig && window.billingConfig.gstEnabled) ? window.billingConfig.gstPercentage : 0.00;
    const gstAmount = (window.billingConfig && window.billingConfig.gstEnabled) ? Math.round(taxableSubtotal * (gstRate / 100) * 100) / 100 : 0.00;
    const totalAmount = Math.round((taxableSubtotal + gstAmount) * 100) / 100;

    const planLabelElem = document.getElementById('summary_plan_label');
    if (planLabelElem) planLabelElem.innerText = planLabel;

    const summaryDuration = document.getElementById('summary_duration');
    if (summaryDuration) summaryDuration.innerHTML = '<i class="far fa-clock me-1"></i> ' + durationBadgeText;

    const summaryTime = document.getElementById('summary_time');
    if (summaryTime) summaryTime.innerText = startTimeVal + (endTimeVal ? ' – ' + endTimeVal : '');

    const summaryPrice = document.getElementById('summary_price');
    if (summaryPrice) summaryPrice.innerText = '₹' + computedPrice.toFixed(2);

    const breakdownFee = document.getElementById('breakdown_fee');
    if (breakdownFee) breakdownFee.innerText = '₹' + computedPrice.toFixed(2);

    const breakdownPlatformFee = document.getElementById('breakdown_platform_fee');
    if (breakdownPlatformFee) breakdownPlatformFee.innerText = '₹' + platformFee.toFixed(2);

    const extraContainer = document.getElementById('breakdown_extra_container');
    if (extraContainer) {
        if (extraCharges > 0) {
            extraContainer.style.setProperty('display', 'flex', 'important');
            const extraFeeElem = document.getElementById('breakdown_extra_fee');
            if (extraFeeElem) extraFeeElem.innerText = '₹' + extraCharges.toFixed(2);
        } else {
            extraContainer.style.setProperty('display', 'none', 'important');
        }
    }

    const gstLabelElem = document.getElementById('breakdown_gst_label');
    if (gstLabelElem) {
        gstLabelElem.innerText = (window.billingConfig && window.billingConfig.gstEnabled) ? ('GST (' + gstRate + '% Healthcare Tax)') : 'GST (Exempt)';
    }

    const breakdownGst = document.getElementById('breakdown_gst');
    if (breakdownGst) breakdownGst.innerText = '₹' + gstAmount.toFixed(2);

    const breakdownTotal = document.getElementById('breakdown_total');
    if (breakdownTotal) breakdownTotal.innerText = '₹' + totalAmount.toFixed(2);

    const btnPay = document.getElementById('btnPayNow');
    if (btnPay) {
        btnPay.innerHTML = '<i class="fas fa-arrow-right me-1"></i> Proceed to Book (₹' + totalAmount.toFixed(2) + ')';
    }
}

function renderSubServices(serviceId) {
    const container = document.getElementById('subServiceCardsContainer');
    const wrapper = document.getElementById('subServicesWrapper');
    const badge = document.getElementById('subServiceCountBadge');
    const hiddenSubInput = document.getElementById('sub_service_id');
    if (!container || !wrapper) return;

    const svcData = window.allServicesData[serviceId];
    if (!svcData || !svcData.subServices || svcData.subServices.length === 0) {
        wrapper.style.display = 'none';
        hiddenSubInput.value = '';
        currentSelectedSubServiceId = '';
        return;
    }

    wrapper.style.display = 'block';
    badge.innerText = svcData.subServices.length + ' Specialized Plans Available';
    container.innerHTML = '';

    // Check if the current selected sub service belongs to this service
    let activeSubId = currentSelectedSubServiceId;
    const subExists = svcData.subServices.some(s => String(s.id) === String(activeSubId));
    if (!subExists) {
        // Default to the first sub-service of this service!
        activeSubId = String(svcData.subServices[0].id);
        currentSelectedSubServiceId = activeSubId;
        hiddenSubInput.value = activeSubId;
    }

    svcData.subServices.forEach((sub, idx) => {
        const isSelected = String(sub.id) === String(activeSubId);
        if (isSelected) {
            baseServicePrice = parseFloat(sub.price);
        }

        const card = document.createElement('div');
        card.className = 'sub-plan-card p-3 rounded-3 border bg-white';
        card.id = 'subCard_' + sub.id;
        card.style.cursor = 'pointer';
        card.style.transition = 'all 0.2s ease';
        card.style.border = isSelected ? '2px solid #048444' : '1.5px solid #e2e8f0';
        card.style.background = isSelected ? '#f0fdf4' : '#ffffff';

        let featuresHtml = '';
        if (sub.features && sub.features.length > 0) {
            featuresHtml = `
                <div class="sub-plan-features mt-2 pt-2 border-top">
                    <button type="button" class="btn btn-sm btn-link p-0 text-decoration-none fw-bold text-success d-inline-flex align-items-center gap-1" 
                            style="font-size: 12px;" onclick="event.stopPropagation(); toggleInclusions(${sub.id});">
                        <i class="fas fa-clipboard-check"></i> 
                        <span>What's Included (${sub.features.length} tasks)</span> 
                        <i class="fas fa-chevron-down ms-1" id="inclChevron_${sub.id}" style="font-size: 10px;"></i>
                    </button>
                    <div id="inclusionsList_${sub.id}" class="mt-2 rounded-2 border" style="display: none; background: #f8fafc; border-color: #e2e8f0 !important; padding: 12px 14px;">
                        <div class="sub-plan-features-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(230px, 1fr)); gap: 8px 18px;">
                            ${sub.features.map(f => `
                                <div class="d-flex align-items-start" style="gap: 8px; padding: 2px 0;">
                                    <i class="fas fa-check-circle text-success" style="font-size: 13px; margin-top: 2px; flex-shrink: 0;"></i>
                                    <span class="text-secondary" style="font-size: 12px; line-height: 1.4;">${f}</span>
                                </div>
                            `).join('')}
                        </div>
                    </div>
                </div>
            `;
        }

        card.innerHTML = `
            <div class="sub-plan-header">
                <div class="sub-plan-info">
                    <input type="radio" name="sub_service_select" 
                           id="radio_sub_${sub.id}" value="${sub.id}" ${isSelected ? 'checked' : ''} 
                           style="cursor: pointer; width: 18px; height: 18px; min-width: 18px; margin: 0 !important; accent-color: #048444;" 
                           onclick="event.stopPropagation(); pickSubService(${sub.id}, ${sub.price});">
                    <span style="width: 24px; height: 24px; min-width: 24px; border-radius: 50%; background: ${isSelected ? '#048444' : '#64748b'}; color: #fff; font-size: 11px; font-weight: 800; display: inline-flex; align-items: center; justify-content: center; flex-shrink: 0;">
                        ${idx + 1}
                    </span>
                    <div class="sub-plan-details">
                        <strong class="text-dark d-block" style="font-size: 13.5px; line-height: 1.35;">${sub.title}</strong>
                        ${sub.subtitle ? `<small class="text-muted d-block" style="font-size: 11px;">${sub.subtitle}</small>` : ''}
                    </div>
                </div>
                <div class="sub-plan-price">
                    <small class="text-muted d-block" style="font-size: 10px; text-transform: uppercase;">Starts at</small>
                    <strong class="text-success fs-6 fw-bold">${sub.formatted_price}</strong>
                    ${sub.duration ? `<small class="text-muted d-block" style="font-size: 10.5px;">${sub.duration}</small>` : ''}
                </div>
            </div>
            ${featuresHtml}
        `;

        card.onclick = function() {
            pickSubService(sub.id, sub.price);
        };

        container.appendChild(card);
    });

    calculatePricingAndSummary();
}

function pickSubService(subId, price) {
    currentSelectedSubServiceId = String(subId);
    document.getElementById('sub_service_id').value = currentSelectedSubServiceId;
    baseServicePrice = parseFloat(price);

    // Update radios and styles
    document.querySelectorAll('.sub-plan-card').forEach(card => {
        card.style.border = '1.5px solid #e2e8f0';
        card.style.background = '#ffffff';
    });

    const targetCard = document.getElementById('subCard_' + subId);
    if (targetCard) {
        targetCard.style.border = '2px solid #048444';
        targetCard.style.background = '#f0fdf4';
    }

    const radio = document.getElementById('radio_sub_' + subId);
    if (radio) radio.checked = true;

    calculatePricingAndSummary();
}

function toggleInclusions(subId) {
    const list = document.getElementById('inclusionsList_' + subId);
    const chevron = document.getElementById('inclChevron_' + subId);
    if (!list) return;

    if (list.style.display === 'none' || !list.style.display) {
        list.style.display = 'block';
        if (chevron) chevron.className = 'fas fa-chevron-up';
    } else {
        list.style.display = 'none';
        if (chevron) chevron.className = 'fas fa-chevron-down';
    }
}

function updateServiceDetails() {
    const select = document.getElementById('service_id');
    const selectedOption = select.options[select.selectedIndex];
    if (!selectedOption) return;

    const title = selectedOption.getAttribute('data-title') || selectedOption.text;
    baseServicePrice = parseFloat(selectedOption.getAttribute('data-price') || 0);
    if (baseServicePrice <= 0) baseServicePrice = 999;

    // Render Sub-Services cards inline (NO POPUP)
    renderSubServices(selectedOption.value);

    // Dynamically apply service-specific GST, Platform Fee & Extra Charges
    if (selectedOption.hasAttribute('data-gst-rate')) {
        const svcGstRate = parseFloat(selectedOption.getAttribute('data-gst-rate'));
        if (!isNaN(svcGstRate)) {
            window.billingConfig.gstPercentage = svcGstRate;
            window.billingConfig.gstEnabled = (svcGstRate > 0);
        }
    }
    if (selectedOption.hasAttribute('data-platform-fee')) {
        const svcPlatform = parseFloat(selectedOption.getAttribute('data-platform-fee'));
        if (!isNaN(svcPlatform)) {
            window.billingConfig.platformFee = svcPlatform;
        }
    }
    if (selectedOption.hasAttribute('data-extra-charges')) {
        const svcExtra = parseFloat(selectedOption.getAttribute('data-extra-charges'));
        window.billingConfig.extraChargeAmount = isNaN(svcExtra) ? 0.0 : svcExtra;
        window.billingConfig.extraChargeEnabled = (window.billingConfig.extraChargeAmount > 0);
    }
    if (selectedOption.hasAttribute('data-extra-label')) {
        const svcLabel = selectedOption.getAttribute('data-extra-label');
        if (svcLabel) {
            window.billingConfig.extraChargeLabel = svcLabel;
            const extraLabelElem = document.getElementById('breakdown_extra_label');
            if (extraLabelElem) extraLabelElem.innerText = svcLabel;
        }
    }

    const summaryTitle = document.getElementById('summary_title');
    if (summaryTitle) summaryTitle.innerText = title;

    calculatePricingAndSummary();
}

function handlePatientDocsChange(input) {
    const list = document.getElementById('selected_docs_list');
    list.innerHTML = '';
    if (input.files && input.files.length > 0) {
        list.style.setProperty('display', 'flex', 'important');
        for (let i = 0; i < input.files.length; i++) {
            const f = input.files[i];
            const badge = document.createElement('span');
            badge.className = 'badge bg-light text-dark border px-2 py-1';
            badge.style.fontSize = '11.5px';
            badge.innerHTML = '<i class="fas fa-file-alt text-success me-1"></i> ' + f.name + ' <small class="text-muted">(' + (f.size / 1024).toFixed(0) + ' KB)</small>';
            list.appendChild(badge);
        }
    } else {
        list.style.setProperty('display', 'none', 'important');
    }
}

function detectLiveLocation() {
    const statusText = document.getElementById('gps_status');
    if (!navigator.geolocation) {
        alert('Geolocation is not supported by your browser.');
        return;
    }
    statusText.innerHTML = '<i class="fas fa-spinner fa-spin text-success me-1"></i> Detecting live GPS coordinates...';
    navigator.geolocation.getCurrentPosition(
        function(position) {
            const lat = position.coords.latitude;
            const lng = position.coords.longitude;
            const mapsUrl = 'https://www.google.com/maps?q=' + lat + ',' + lng;
            document.getElementById('google_maps_link').value = mapsUrl;
            document.getElementById('map_preview_box').style.display = 'block';
            document.getElementById('map_embed_frame').src = 'https://maps.google.com/maps?q=' + lat + ',' + lng + '&t=&z=16&ie=UTF8&iwloc=&output=embed';
            statusText.innerHTML = '<i class="fas fa-spinner fa-spin text-success me-1"></i> GPS captured (' + lat.toFixed(5) + ', ' + lng.toFixed(5) + '). Resolving street address...';

            // Call intelligent backend reverse-geocode (cleans administrative clutter)
            fetch('/api/reverse-geocode?lat=' + lat + '&lng=' + lng)
                .then(r => r.json())
                .then(res => {
                    const addrField = document.getElementById('customer_address');
                    if (res && res.success && res.address) {
                        addrField.value = res.address;
                        statusText.innerHTML = '<i class="fas fa-check-circle text-success me-1"></i> Live GPS Pin captured on Google Maps. <strong>Please add your Flat / Door No. & Street Name above.</strong>';
                    } else {
                        statusText.innerHTML = '<i class="fas fa-check-circle text-success me-1"></i> Live GPS Pin captured (' + lat.toFixed(5) + ', ' + lng.toFixed(5) + '). Please type your house/street address.';
                    }
                })
                .catch(e => {
                    console.log('Geocoding err:', e);
                    statusText.innerHTML = '<i class="fas fa-check-circle text-success me-1"></i> Live GPS Pin captured! Please enter your Flat/Door No. and Street address above.';
                });
        },
        function(error) {
            statusText.innerHTML = '<i class="fas fa-exclamation-triangle text-danger me-1"></i> Location permission denied or timed out: ' + error.message;
        },
        { enableHighAccuracy: true, timeout: 10000, maximumAge: 0 }
    );
}

let addressTypingTimeout;
function handleAddressTyping(val) {
    clearTimeout(addressTypingTimeout);
    addressTypingTimeout = setTimeout(function() {
        if (!val || val.trim().length < 5) return;
        const mapsLinkField = document.getElementById('google_maps_link');
        // Do not overwrite coordinates if user already has captured live GPS pin
        const isLiveGps = mapsLinkField.value && mapsLinkField.value.match(/q=(-?\d+\.\d+,-?\d+\.\d+)/);
        if (!isLiveGps) {
            const queryUrl = 'https://www.google.com/maps/search/?api=1&query=' + encodeURIComponent(val.trim());
            mapsLinkField.value = queryUrl;
            document.getElementById('map_embed_frame').src = 'https://maps.google.com/maps?q=' + encodeURIComponent(val.trim()) + '&t=&z=15&ie=UTF8&iwloc=&output=embed';
            document.getElementById('map_preview_box').style.display = 'block';
            const statusText = document.getElementById('gps_status');
            if (statusText) {
                statusText.innerHTML = '<i class="fas fa-map-pin text-primary me-1"></i> Address mapped to Google Maps preview.';
            }
        }
    }, 600);
}

function handleManualMapsLinkChange(val) {
    if (val && val.includes('http')) {
        document.getElementById('map_preview_box').style.display = 'block';
        const match = val.match(/@(-?\d+\.\d+),(-?\d+\.\d+)/) || val.match(/q=(-?\d+\.\d+),(-?\d+\.\d+)/);
        if (match) {
            document.getElementById('map_embed_frame').src = 'https://maps.google.com/maps?q=' + match[1] + ',' + match[2] + '&t=&z=15&ie=UTF8&iwloc=&output=embed';
        }
    }
}

function openTermsModal() {
    const modalEl = document.getElementById('termsModal');
    if (modalEl && modalEl.parentNode !== document.body) {
        document.body.appendChild(modalEl);
    }
    const modal = bootstrap.Modal.getOrCreateInstance(modalEl);
    modal.show();
}

document.addEventListener('DOMContentLoaded', function() {
    initFlatpickrTimePickers();
    updateServiceDetails();
    selectDurationPlan('8 Hrs', document.querySelector('.duration-plan-card[data-plan="8 Hrs"]'));
});

function handleBookingPayment() {
    const termsCheck = document.getElementById('terms_agree');
    if (termsCheck && !termsCheck.checked) {
        alert('Please review and agree to the Terms of Service & Clinical Protocols before proceeding.');
        termsCheck.focus();
        return;
    }

    const callerName = document.getElementById('caller_name').value.trim();
    const callerRelation = document.getElementById('caller_relationship').value;
    const patientName = document.getElementById('patient_name').value.trim();
    const patientAge = document.getElementById('patient_age').value.trim();
    const patientGender = document.getElementById('patient_gender').value;
    const patientCondition = document.getElementById('patient_condition').value;

    const phone = document.getElementById('customer_phone').value.trim();
    const email = document.getElementById('customer_email').value.trim();
    const date = document.getElementById('booking_date').value;
    const endDate = document.getElementById('booking_end_date').value;
    const time = document.getElementById('booking_time').value;
    const endTime = document.getElementById('booking_end_time').value;
    const service_id = document.getElementById('service_id').value;
    const duration_type = document.getElementById('duration_type').value;
    const address = document.getElementById('customer_address').value.trim();
    const mapsLink = document.getElementById('google_maps_link').value.trim();
    const notes = document.getElementById('notes').value.trim();

    if (!callerName) {
        alert('Please enter Caller / Family Member Name.');
        document.getElementById('caller_name').focus();
        return;
    }

    if (!callerRelation) {
        alert('Please select Relationship to Patient.');
        document.getElementById('caller_relationship').focus();
        return;
    }

    if (!patientName) {
        alert('Please enter Patient Full Name.');
        document.getElementById('patient_name').focus();
        return;
    }

    if (!patientAge) {
        alert('Please enter Patient Age.');
        document.getElementById('patient_age').focus();
        return;
    }

    if (!phone || phone.length !== 10) {
        alert('Please provide a valid 10-digit mobile number.');
        document.getElementById('customer_phone').focus();
        return;
    }

    if (!address) {
        alert('Please enter service address / visit location.');
        document.getElementById('customer_address').focus();
        return;
    }

    if (!date) {
        alert('Please select appointment start date.');
        return;
    }

    const btn = document.getElementById('btnPayNow');
    btn.disabled = true;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Initializing Payment...';

    // Build FormData with multi-file support
    const formData = new FormData();
    formData.append('_token', '{{ csrf_token() }}');
    formData.append('service_id', service_id);
    formData.append('sub_service_id', document.getElementById('sub_service_id')?.value || '');
    formData.append('duration_type', duration_type);
    formData.append('booking_date', date);
    formData.append('booking_end_date', endDate);
    formData.append('booking_time', time);
    formData.append('booking_end_time', endTime);
    formData.append('caller_name', callerName);
    formData.append('caller_relationship', callerRelation);
    formData.append('patient_name', patientName);
    formData.append('patient_age', patientAge);
    formData.append('patient_gender', patientGender);
    formData.append('patient_condition', patientCondition);
    formData.append('customer_name', callerName);
    formData.append('customer_phone', phone);
    formData.append('customer_email', email);
    formData.append('customer_address', address);
    formData.append('google_maps_link', mapsLink);
    formData.append('notes', notes);
    formData.append('editing_booking_number', document.getElementById('editing_booking_number')?.value || '');

    const docsInput = document.getElementById('patient_docs');
    if (docsInput && docsInput.files) {
        for (let i = 0; i < docsInput.files.length; i++) {
            formData.append('patient_docs[]', docsInput.files[i]);
        }
    }

    const isEditing = !!(document.getElementById('editing_booking_number')?.value);
    btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> ' + (isEditing ? 'Updating Details & Proceeding...' : 'Saving Details & Proceeding to Summary...');

    // Step 1: Save appointment details & proceed to Appointment Summary Page
    fetch("{{ route('booking.proceed') }}", {
        method: "POST",
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        if (!data.success) {
            alert(data.message || 'Error processing appointment details');
            btn.disabled = false;
            btn.innerHTML = isEditing ? '<i class="fas fa-check-circle me-1"></i> Update & Proceed to Summary' : '<i class="fas fa-arrow-right me-1"></i> Proceed to Book';
            return;
        }

        // Successfully created/updated booking - immediately visible in Admin Panel!
        // Redirect to Appointment Summary & Payment Review Page
        window.location.href = data.redirect_url;
    })
    .catch(err => {
        console.error(err);
        alert('Network error while processing booking. Please try again.');
        btn.disabled = false;
        btn.innerHTML = isEditing ? '<i class="fas fa-check-circle me-1"></i> Update & Proceed to Summary' : '<i class="fas fa-arrow-right me-1"></i> Proceed to Book';
    });
}

document.addEventListener('DOMContentLoaded', function() {
    updateServiceDetails();
    @if(!empty($editingBooking))
        const editAddr = @json($editingBooking->customer_address ?? '');
        const editMaps = @json($editingBooking->google_maps_link ?? '');
        if (editMaps) {
            handleManualMapsLinkChange(editMaps);
        } else if (editAddr) {
            handleAddressTyping(editAddr);
        }
    @endif
});
</script>

<!-- Terms of Service & Clinical Protocol Modal -->
@php
    $bookingBrandName = \App\Models\Setting::get('brand_name', 'AngelHug');
    $bookingTerms = \App\Models\Setting::get('terms_and_conditions', \App\Http\Controllers\AdminWebsiteSettingController::DEFAULT_TERMS);
    $bookingCancellation = \App\Models\Setting::get('cancellation_policy', \App\Http\Controllers\AdminWebsiteSettingController::DEFAULT_CANCELLATION);
@endphp
<div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true" style="z-index: 1070;">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" style="max-width: 600px; z-index: 1075;">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            <div class="modal-header text-white" style="background: linear-gradient(135deg, #024724 0%, #048444 100%); padding: 18px 24px;">
                <h5 class="modal-title fw-bold text-white mb-0" id="termsModalLabel" style="font-size: 16.5px;">
                    <i class="fas fa-shield-alt text-warning me-2"></i> {{ $bookingBrandName }} Care Protocols & Terms
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4 text-dark" style="font-size: 13.5px; line-height: 1.7; max-height: 65vh; overflow-y: auto;">
                <h6 class="fw-bold text-success mb-2 d-flex align-items-center gap-2">
                    <i class="fas fa-file-contract"></i> Terms of Service & Care Agreement
                </h6>
                <div class="text-muted p-3 bg-light rounded-3 border mb-3" style="white-space: pre-line;">{{ $bookingTerms }}</div>

                @if(!empty($bookingCancellation))
                <h6 class="fw-bold text-primary mb-2 d-flex align-items-center gap-2 mt-3">
                    <i class="fas fa-undo-alt"></i> Cancellation & Rescheduling Policy
                </h6>
                <div class="text-muted p-3 bg-light rounded-3 border" style="white-space: pre-line;">{{ $bookingCancellation }}</div>
                @endif
            </div>
            <div class="modal-footer bg-light p-3 border-top d-flex justify-content-between align-items-center">
                <small class="text-muted" style="font-size: 11px;">
                    <i class="fas fa-check-circle text-success me-1"></i> Admin verified clinical standards
                </small>
                <button type="button" class="btn btn-success fw-bold rounded-pill px-4 shadow-sm" style="background: #048444; border-color: #048444;" data-bs-dismiss="modal">
                    I Understand & Agree
                </button>
            </div>
        </div>
    </div>
</div>
