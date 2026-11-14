@include('header')

<style>
/* Universal Standardized Hero Section */
.summary-hero-section {
    background: linear-gradient(135deg, var(--ah-primary-dark) 0%, var(--ah-primary) 100%);
    padding: 60px 0 50px 0 !important;
    color: #fff;
    position: relative;
    overflow: hidden;
}

.summary-hero-section::before {
    content: "";
    position: absolute;
    top: 0; left: 0; right: 0; bottom: 0;
    background: url("{{ asset('img/angelhug_docx/image5.png') }}") center/cover no-repeat;
    opacity: 0.15;
}

/* Stepper Indicator */
.checkout-stepper {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 16px;
    margin-top: 18px;
    flex-wrap: wrap;
}

.step-item {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 13px;
    font-weight: 700;
    color: rgba(255, 255, 255, 0.7);
}

.step-item.active {
    color: #ffffff;
}

.step-badge {
    width: 24px;
    height: 24px;
    border-radius: 50%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 11.5px;
    font-weight: 800;
    background: rgba(255, 255, 255, 0.2);
    color: #ffffff;
}

.step-item.active .step-badge {
    background: #00bbd7;
    color: #ffffff;
    box-shadow: 0 0 10px rgba(0, 187, 215, 0.6);
}

.step-item.done .step-badge {
    background: #ffffff;
    color: #048444;
}

.step-divider-line {
    width: 30px;
    height: 2px;
    background: rgba(255, 255, 255, 0.25);
}

/* Page Background Wrap */
.summary-page-wrap {
    background: #f8fafc;
    padding: 35px 0 65px;
    width: 100%;
}

.summary-page-wrap > .container {
    max-width: 1320px;
    width: 100%;
    margin-left: auto;
    margin-right: auto;
    padding-left: 20px;
    padding-right: 20px;
}

/* Cards */
.summary-card-box {
    background: #ffffff;
    border: 1.5px solid #e2e8f0;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
    padding: 24px;
    margin-bottom: 22px;
    min-width: 0;
}

.summary-card-title {
    font-size: 15px;
    font-weight: 800;
    color: #0f172a;
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 14px;
    padding-bottom: 10px;
    border-bottom: 1.5px solid #f1f5f9;
}

.care-plan-badge {
    display: inline-flex;
    max-width: 100%;
    white-space: normal;
    text-align: left;
    overflow-wrap: anywhere;
    line-height: 1.4;
}

@media (max-width: 575.98px) {
    .summary-page-wrap {
        padding: 20px 0 40px;
        overflow-x: hidden;
    }

    .summary-page-wrap > .container {
        padding-left: 12px;
        padding-right: 12px;
    }

    .summary-card-box {
        padding: 16px 12px;
    }

    .summary-card-box .badge {
        max-width: 100%;
        white-space: normal;
        overflow-wrap: anywhere;
        text-align: left;
    }

    .summary-card-title {
        align-items: flex-start;
        min-width: 0;
        overflow-wrap: anywhere;
        line-height: 1.45;
    }

    .summary-card-title i {
        margin-top: 3px;
        flex-shrink: 0;
    }
}

/* Right Sticky Summary */
.summary-sidebar-col {
    position: relative;
    display: flex;
    flex-direction: column;
}

.summary-checkout-card {
    position: sticky;
    top: 95px;
    background: #ffffff;
    border: 1.5px solid #e2e8f0;
    border-radius: 16px;
    box-shadow: 0 6px 25px rgba(4, 132, 68, 0.06);
    padding: 24px;
    z-index: 20;
}

.btn-pay-now {
    background: linear-gradient(135deg, #048444 0%, #00bbd7 100%);
    color: #ffffff !important;
    border: none;
    border-radius: 10px;
    font-weight: 800;
    font-size: 15px;
    padding: 14px 20px;
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
}

/* Payment Popup Modal */
.modal-backdrop {
    z-index: 1040 !important;
}

#paymentDetailsModal {
    z-index: 1060 !important;
}

#paymentDetailsModal .modal-dialog {
    z-index: 1065 !important;
}

#paymentDetailsModal .modal-content {
    background: #ffffff !important;
    border-radius: 18px;
    border: 1px solid #cbd5e1;
    box-shadow: 0 25px 60px rgba(0,0,0,0.3) !important;
    overflow: hidden;
}

#paymentDetailsModal .modal-header {
    background: linear-gradient(135deg, #024724 0%, #048444 100%) !important;
    color: #fff !important;
    padding: 20px 24px;
    border: none;
}

#paymentDetailsModal .modal-body {
    background: #ffffff !important;
}

.payment-tab-btn {
    border-radius: 8px;
    padding: 10px 14px;
    font-size: 13px;
    font-weight: 700;
    border: 1.5px solid #e2e8f0;
    background: #ffffff;
    color: #475569;
    cursor: pointer;
    transition: all 0.2s ease;
    display: flex;
    align-items: center;
    gap: 8px;
}

.payment-tab-btn.active {
    background: #e8f7ee;
    border-color: #048444;
    color: #048444;
}
</style>

<!-- Hero Section with Stepper -->
<section class="summary-hero-section text-center position-relative">
    <div class="container position-relative" style="z-index: 2;">
        <span class="badge bg-white-50 text-white border border-white-50 py-1 px-3 rounded-pill mb-2" style="font-size: 12px;">
            <i class="fas fa-file-invoice me-1"></i> Step 2 of 3: Appointment Summary & Review
        </span>
        <h1 class="text-white fw-bold display-6 mb-2">Review Appointment Summary</h1>
        <p class="lead text-white-50 mx-auto mb-0" style="max-width: 680px; font-size: 14.5px;">
            Please review the patient details, scheduled timings, and itemized billing below before completing your secure payment.
        </p>

        <!-- Stepper -->
        <div class="checkout-stepper">
            <span class="step-item done">
                <span class="step-badge"><i class="fas fa-check"></i></span>
                1. Schedule & Details
            </span>
            <span class="step-divider-line"></span>
            <span class="step-item active">
                <span class="step-badge">2</span>
                2. Appointment Summary
            </span>
            <span class="step-divider-line"></span>
            <span class="step-item">
                <span class="step-badge">3</span>
                3. Confirmed Receipt
            </span>
        </div>
    </div>
</section>

<!-- Main Appointment Summary Wrap -->
<div class="summary-page-wrap">
    <div class="container">
        <div class="row g-4">
            <!-- Left Column: Comprehensive Appointment Details -->
            <div class="col-lg-7 col-xl-7">
                
                <!-- 1. Service Overview & Scheduled Timings -->
                <div class="summary-card-box">
                    <div class="summary-card-title">
                        <i class="fas fa-stethoscope text-success"></i> 1. Booked Healthcare Service & Schedule
                    </div>
                    <div class="p-3 bg-light rounded-3 mb-3 border">
                        <div>
                            <span class="badge" style="background: #e8f7ee; color: #048444; border: 1px solid rgba(4, 132, 68, 0.2); font-size: 11px;">
                                {{ $booking->duration_type ?: 'Standard Care' }}
                            </span>
                            <h5 class="fw-bold mb-1 mt-1 text-dark">{{ $booking->service->title }}</h5>
                            @if(!empty($booking->sub_service_name))
                                <div class="mb-1">
                                    <span class="badge care-plan-badge" style="background: #e0f2fe; color: #0284c7; border: 1px solid #bae6fd; font-size: 11.5px; font-weight: 700;">
                                        <i class="fas fa-layer-group me-1"></i> Care Plan: {{ $booking->sub_service_name }}
                                    </span>
                                </div>
                            @endif
                            <small class="text-muted"><i class="far fa-clock me-1 text-success"></i> Standard Session: {{ $booking->service->duration ?: '60 Mins' }}</small>
                        </div>
                    </div>

                    <div class="row g-3">
                        <div class="col-sm-6">
                            <div class="p-3 border rounded-3 bg-white">
                                <small class="text-muted text-uppercase fw-bold d-block mb-1" style="font-size: 11px;">
                                    <i class="far fa-calendar-alt text-success me-1"></i> Care Schedule Period
                                </small>
                                <strong class="text-dark" style="font-size: 13.5px;">
                                    @if($booking->booking_end_date && $booking->booking_end_date != $booking->booking_date)
                                        {{ \Carbon\Carbon::parse($booking->booking_date)->format('M d, Y') }} – {{ \Carbon\Carbon::parse($booking->booking_end_date)->format('M d, Y') }}
                                    @else
                                        {{ \Carbon\Carbon::parse($booking->booking_date)->format('l, M d, Y') }}
                                    @endif
                                </strong>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="p-3 border rounded-3 bg-white">
                                <small class="text-muted text-uppercase fw-bold d-block mb-1" style="font-size: 11px;">
                                    <i class="far fa-clock text-primary me-1"></i> Daily Shift Hours
                                </small>
                                <strong class="text-primary" style="font-size: 13.5px;">
                                    {{ $booking->booking_time }} @if($booking->booking_end_time && $booking->booking_end_time != $booking->booking_time) – {{ $booking->booking_end_time }} @endif
                                </strong>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 2. Patient Profile & Clinical Condition -->
                <div class="summary-card-box">
                    <div class="summary-card-title">
                        <i class="fas fa-user-injured text-success"></i> 2. Patient Profile & Clinical Condition
                    </div>
                    <div class="row g-3">
                        <div class="col-sm-4">
                            <small class="text-muted text-uppercase fw-bold d-block mb-1" style="font-size: 11px;">Patient Full Name</small>
                            <strong class="text-dark">{{ $booking->patient_name ?: $booking->customer_name }}</strong>
                        </div>
                        <div class="col-sm-4">
                            <small class="text-muted text-uppercase fw-bold d-block mb-1" style="font-size: 11px;">Age</small>
                            <strong class="text-dark">{{ $booking->patient_age ? $booking->patient_age . ' Years' : 'Not specified' }}</strong>
                        </div>
                        <div class="col-sm-4">
                            <small class="text-muted text-uppercase fw-bold d-block mb-1" style="font-size: 11px;">Gender</small>
                            <strong class="text-dark">{{ $booking->patient_gender ?: 'Not specified' }}</strong>
                        </div>
                        @if($booking->patient_condition)
                        <div class="col-12 mt-2">
                            <small class="text-muted text-uppercase fw-bold d-block mb-1" style="font-size: 11px;">Primary Condition / Reason for Care</small>
                            <span class="badge bg-success-subtle text-success border border-success p-2" style="font-size: 12.5px;">
                                <i class="fas fa-heartbeat me-1"></i> {{ $booking->patient_condition }}
                            </span>
                        </div>
                        @endif
                        @if($booking->notes)
                        <div class="col-12 mt-2">
                            <small class="text-muted text-uppercase fw-bold d-block mb-1" style="font-size: 11px;">Clinical Notes / Medication Instructions</small>
                            <p class="mb-0 text-muted fst-italic p-2 bg-light rounded border" style="font-size: 12.5px;">{{ $booking->notes }}</p>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- 3. Caller / Family Member Details -->
                <div class="summary-card-box">
                    <div class="summary-card-title">
                        <i class="fas fa-user-friends text-info"></i> 3. Caller / Family Member Information
                    </div>
                    <div class="row g-3">
                        <div class="col-sm-4">
                            <small class="text-muted text-uppercase fw-bold d-block mb-1" style="font-size: 11px;">Caller Name</small>
                            <strong class="text-dark">{{ $booking->caller_name ?: $booking->customer_name }}</strong>
                        </div>
                        <div class="col-sm-4">
                            <small class="text-muted text-uppercase fw-bold d-block mb-1" style="font-size: 11px;">Relationship</small>
                            <span class="badge bg-light text-dark border">{{ $booking->caller_relationship ?: 'Self' }}</span>
                        </div>
                        <div class="col-sm-4">
                            <small class="text-muted text-uppercase fw-bold d-block mb-1" style="font-size: 11px;">Primary Mobile</small>
                            <strong class="text-dark">+91 {{ $booking->customer_phone }}</strong>
                        </div>
                        @if($booking->customer_email)
                        <div class="col-sm-12">
                            <small class="text-muted text-uppercase fw-bold d-block mb-1" style="font-size: 11px;">Email Address (For Invoice / Updates)</small>
                            <span class="text-dark">{{ $booking->customer_email }}</span>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- 4. Service Address & Google Maps Location -->
                <div class="summary-card-box">
                    <div class="summary-card-title d-flex justify-content-between align-items-center">
                        <span><i class="fas fa-map-marked-alt text-danger"></i> 4. Visit Address & Live Location</span>
                        @php
                            $mapUrl = $booking->google_maps_link ?: 'https://www.google.com/maps/search/?api=1&query=' . urlencode($booking->customer_address);
                            $embedQuery = $booking->customer_address;
                            if ($booking->google_maps_link && preg_match('/q=(-?\d+\.\d+,-?\d+\.\d+)/', $booking->google_maps_link, $coordMatch)) {
                                $embedQuery = $coordMatch[1];
                            }
                        @endphp
                        <a href="{{ $mapUrl }}" target="_blank" class="btn btn-sm btn-outline-danger fw-bold py-1 px-2" style="font-size: 11.5px;">
                            <i class="fas fa-external-link-alt me-1"></i> Open in Google Maps
                        </a>
                    </div>
                    <p class="fs-6 fw-semibold text-dark mb-2">{{ $booking->customer_address }}</p>

                    @if($booking->customer_address || $booking->google_maps_link)
                    <div class="rounded-3 overflow-hidden border mt-2" style="height: 180px;">
                        <iframe width="100%" height="180" style="border:0;" loading="lazy" allowfullscreen 
                                src="https://maps.google.com/maps?q={{ urlencode($embedQuery) }}&t=&z=16&ie=UTF8&iwloc=&output=embed">
                        </iframe>
                    </div>
                    @endif
                </div>

                <!-- 5. Uploaded Medical Documents (if any) -->
                @if(!empty($booking->patient_documents) && is_array($booking->patient_documents) && count($booking->patient_documents) > 0)
                <div class="summary-card-box">
                    <div class="summary-card-title">
                        <i class="fas fa-file-medical text-danger"></i> 5. Attached Medical Documents
                    </div>
                    <div class="d-flex flex-wrap gap-2">
                        @foreach($booking->patient_documents as $doc)
                            <a href="{{ asset('storage/' . ($doc['path'] ?? '')) }}" target="_blank" class="btn btn-sm btn-white border bg-white shadow-sm d-inline-flex align-items-center gap-2 py-2 px-3">
                                <i class="fas fa-file-pdf text-danger fs-5"></i>
                                <div class="text-start">
                                    <div class="fw-bold text-dark text-truncate" style="max-width: 220px; font-size: 12px;">{{ $doc['name'] ?? 'Medical Document' }}</div>
                                    <small class="text-success" style="font-size: 10.5px;">Click to View</small>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            <!-- Right Column: Sticky Billing Breakdown & Payment CTA -->
            <div class="col-lg-5 col-xl-5 summary-sidebar-col">
                <div class="summary-checkout-card">
                    <div class="d-flex align-items-center justify-content-between mb-3 pb-2 border-bottom">
                        <div>
                            <h5 class="fw-bold mb-0" style="color: #048444; font-size: 16px;">
                                <i class="fas fa-file-invoice-dollar text-success me-2"></i>Itemized Billing Summary
                            </h5>
                            <small class="text-muted" style="font-size: 11.5px;">Ref: <strong>#{{ $booking->booking_number }}</strong></small>
                        </div>
                        <span class="badge" style="background: #e8f7ee; color: #048444; border: 1px solid rgba(4, 132, 68, 0.2); font-size: 11px; font-weight: 700; padding: 4px 10px; border-radius: 20px;">
                            <i class="fas fa-shield-alt me-1"></i> Verified
                        </span>
                    </div>

                    <!-- Price breakdown -->
                    <div class="mb-3 px-1" style="font-size: 13.5px;">
                        <div class="d-flex justify-content-between py-1.5 border-bottom">
                            <div>
                                <span class="text-muted">Base Healthcare Fee</span>
                                @if(!empty($booking->sub_service_name))
                                    <small class="d-block text-success fw-bold" style="font-size: 11px;">
                                        <i class="fas fa-check-circle me-1"></i> Plan: {{ $booking->sub_service_name }}
                                    </small>
                                @endif
                            </div>
                            <span class="fw-bold text-dark">₹{{ number_format($booking->effective_base_fee, 2) }}</span>
                        </div>
                        @if($booking->effective_platform_fee > 0)
                        <div class="d-flex justify-content-between py-1.5 border-bottom">
                            <span class="text-muted">Others</span>
                            <span class="fw-bold text-dark">₹{{ number_format($booking->effective_platform_fee, 2) }}</span>
                        </div>
                        @endif
                        @if($booking->effective_extra_charges > 0)
                        @php
                            $extraRate = (float) $booking->effective_gst_rate;
                            $extraFee = (float) $booking->effective_extra_charges;
                            $extraGst = round($extraFee * ($extraRate / 100), 2);
                        @endphp
                        <div class="d-flex justify-content-between py-1.5 border-bottom">
                            <div>
                                <span class="text-muted d-block"><i class="fas fa-plus-circle text-success me-1"></i> Extra Charges / Kit Fee</span>
                                <small class="text-success" style="font-size: 11px;">+ ₹{{ number_format($extraGst, 2) }} ({{ number_format($extraRate, 1) }}% GST on extra)</small>
                            </div>
                            <span class="fw-bold text-dark">+ ₹{{ number_format($extraFee, 2) }}</span>
                        </div>
                        @endif
                        <div class="d-flex justify-content-between py-1.5 border-bottom">
                            <span class="text-muted">GST ({{ number_format($booking->effective_gst_rate, 1) }}% Healthcare Tax)</span>
                            <span class="fw-bold text-dark">₹{{ number_format($booking->effective_gst_amount, 2) }}</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center pt-3">
                            <div>
                                <span class="fw-bold d-block text-dark" style="font-size: 15px;">Total Payable</span>
                                <small class="text-muted" style="font-size: 11px;">Inclusive of all taxes & charges</small>
                            </div>
                            <span class="fw-bold text-success fs-3" style="letter-spacing: -0.5px;">₹{{ number_format($booking->amount, 2) }}</span>
                        </div>
                    </div>

                    <!-- Select Payment Method (Cash vs Razorpay) -->
                    <div class="mb-3 pt-2">
                        <label class="form-label fw-bold text-dark mb-2" style="font-size: 13px;">
                            <i class="fas fa-wallet text-success me-1"></i> Choose Payment Method:
                        </label>

                        <div class="d-flex flex-column gap-2 mb-1">
                            <!-- Option 1: Cash on Service -->
                            <div class="payment-selection-box p-3 rounded-3 border" id="card_mode_cash" onclick="switchPaymentMode('cash')" style="cursor: pointer; background: #e8f7ee; border-color: #048444 !important; transition: all 0.2s ease;">
                                <div class="form-check d-flex align-items-start gap-2 mb-0">
                                    <input class="form-check-input mt-1" type="radio" name="payment_mode" id="pay_mode_cash" value="cash" checked style="cursor: pointer;">
                                    <div class="flex-grow-1">
                                        <div class="d-flex align-items-center justify-content-between mb-0.5">
                                            <label class="form-check-label fw-bold text-dark mb-0" for="pay_mode_cash" style="font-size: 13.5px; cursor: pointer;">
                                                <i class="fas fa-money-bill-wave text-success me-1"></i> Cash on Service
                                            </label>
                                            <span class="badge bg-success-subtle text-success border border-success fw-bold" style="font-size: 10px; padding: 3px 8px;">Pay at Home</span>
                                        </div>
                                        <small class="text-muted d-block" style="font-size: 11px; line-height: 1.35;">
                                            Confirmed instantly. Pay ₹{{ number_format($booking->amount, 2) }} directly to our certified clinical staff upon arrival.
                                        </small>
                                    </div>
                                </div>
                            </div>

                            {{-- ONLINE PAYMENT (RAZORPAY) - TEMPORARILY COMMENTED OUT AS REQUESTED: UNCOMMENT WHEN ONLINE PAYMENT IS REQUESTED
                            <div class="payment-selection-box p-3 rounded-3 border" id="card_mode_razorpay" onclick="switchPaymentMode('razorpay')" style="cursor: pointer; background: #ffffff; border-color: #e2e8f0; transition: all 0.2s ease;">
                                <div class="form-check d-flex align-items-start gap-2 mb-0">
                                    <input class="form-check-input mt-1" type="radio" name="payment_mode" id="pay_mode_razorpay" value="razorpay" style="cursor: pointer;">
                                    <div class="flex-grow-1">
                                        <div class="d-flex align-items-center justify-content-between mb-0.5">
                                            <label class="form-check-label fw-bold text-dark mb-0" for="pay_mode_razorpay" style="font-size: 13.5px; cursor: pointer;">
                                                <i class="fas fa-credit-card text-primary me-1"></i> Online Payment (Razorpay)
                                            </label>
                                            <span class="badge bg-primary-subtle text-primary border border-primary fw-bold" style="font-size: 10px; padding: 3px 8px;">Instant Online</span>
                                        </div>
                                        <small class="text-muted d-block" style="font-size: 11px; line-height: 1.35;">
                                            Instant secure checkout via UPI (Google Pay, PhonePe, Paytm), Credit / Debit Cards, or Net Banking.
                                        </small>
                                    </div>
                                </div>
                            </div>
                            --}}
                        </div>
                    </div>

                    <!-- Terms & Conditions link notice -->
                    <div class="p-2 mb-2 rounded bg-light border text-center">
                        <small class="text-muted" style="font-size: 11.5px;">
                            By proceeding, you agree to <strong class="text-dark">{{ \App\Models\Setting::get('brand_name', 'Angelhug') }}'s</strong>
                            <a href="javascript:void(0)" onclick="openTermsModal()" class="text-success fw-bold text-decoration-underline ms-1">
                                Terms of Service & Clinical Policies
                            </a>
                        </small>
                    </div>

                    <!-- Primary Action Button -->
                    <button type="button" class="btn-pay-now shadow-sm mb-2" id="btnMainPayment" onclick="handleMainPaymentAction()" style="background: linear-gradient(135deg, #048444 0%, #16a34a 100%);">
                        <i class="fas fa-check-circle me-2"></i> Confirm Appointment (Cash on Service)
                    </button>

                    <!-- Edit appointment link (Prefills saved data for editing) -->
                    <a href="{{ route('booking.create', ['service_id' => $booking->service_id, 'edit' => $booking->booking_number]) }}" class="btn btn-outline-secondary w-100 fw-bold" style="font-size: 13px; border-radius: 9px; padding: 10px;">
                        <i class="fas fa-edit me-1"></i> Edit Appointment Details
                    </a>

                    {{-- OPTIONAL SANDBOX / DEMO SIMULATION (COMMENTED OUT)
                    <div class="text-center mt-2">
                        <button type="button" class="btn btn-link btn-sm text-decoration-none text-muted py-0" onclick="openPaymentModal()" style="font-size: 11px;">
                            <i class="fas fa-vial text-success me-1"></i> Sandbox / Demo Mode Simulator
                        </button>
                    </div>
                    --}}

                    <div class="text-center mt-3 pt-1">
                        <small class="text-muted d-flex align-items-center justify-content-center gap-1" style="font-size: 11.5px;">
                            <i class="fas fa-shield-alt text-success"></i> 100% Encrypted & Secure Payment
                        </small>
                        <img src="https://badges.razorpay.com/badge-light.png" alt="Razorpay" style="height: 18px; margin-top: 4px; opacity: 0.85;">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Dynamic Terms of Service & Clinical Protocol Modal -->
@php
    $summaryBrandName = \App\Models\Setting::get('brand_name', 'Angelhug');
    $summaryTerms = \App\Models\Setting::get('terms_and_conditions', \App\Http\Controllers\AdminWebsiteSettingController::DEFAULT_TERMS);
    $summaryCancellation = \App\Models\Setting::get('cancellation_policy', \App\Http\Controllers\AdminWebsiteSettingController::DEFAULT_CANCELLATION);
@endphp
<div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true" style="z-index: 1070;">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" style="max-width: 600px; z-index: 1075;">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            <div class="modal-header text-white" style="background: linear-gradient(135deg, #024724 0%, #048444 100%); padding: 18px 24px;">
                <h5 class="modal-title fw-bold text-white mb-0" id="termsModalLabel" style="font-size: 16.5px;">
                    <i class="fas fa-shield-alt text-warning me-2"></i> {{ $summaryBrandName }} Care Protocols & Terms
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4 text-dark" style="font-size: 13.5px; line-height: 1.7; max-height: 65vh; overflow-y: auto;">
                <h6 class="fw-bold text-success mb-2 d-flex align-items-center gap-2">
                    <i class="fas fa-file-contract"></i> Terms of Service & Care Agreement
                </h6>
                <div class="text-muted p-3 bg-light rounded-3 border mb-3" style="white-space: pre-line;">{{ $summaryTerms }}</div>

                @if(!empty($summaryCancellation))
                <h6 class="fw-bold text-primary mb-2 d-flex align-items-center gap-2 mt-3">
                    <i class="fas fa-undo-alt"></i> Cancellation & Rescheduling Policy
                </h6>
                <div class="text-muted p-3 bg-light rounded-3 border" style="white-space: pre-line;">{{ $summaryCancellation }}</div>
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

<!-- Razorpay Test Mode & Simulation Checkout Modal -->
<div class="modal fade payment-modal" id="paymentDetailsModal" tabindex="-1" aria-labelledby="paymentDetailsModalLabel" aria-hidden="true" style="z-index: 1060;">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 490px; z-index: 1065;">
        <div class="modal-content shadow-lg" style="background: #ffffff !important; color: #1e293b !important; border-radius: 18px; border: 1px solid #cbd5e1; overflow: hidden;">
            <div class="modal-header d-flex justify-content-between align-items-center" style="background: #0c2340 !important; color: #ffffff !important; padding: 18px 22px; border: none;">
                <div class="d-flex align-items-center gap-2">
                    <img src="https://badges.razorpay.com/badge-light.png" alt="Razorpay" style="height: 22px; filter: brightness(1.2);">
                    <div>
                        <h5 class="modal-title fw-bold text-white mb-0" id="paymentDetailsModalLabel" style="font-size: 15px;">
                            Razorpay Checkout <span class="badge bg-warning text-dark fw-bold ms-1" style="font-size: 9.5px; padding: 2px 6px;">TEST MODE</span>
                        </h5>
                        <small class="text-white-50" style="font-size: 11px;">Ref: <strong>#{{ $booking->booking_number }}</strong></small>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4" style="background: #ffffff !important;">
                
                <!-- Payment Total Strip -->
                <div class="d-flex align-items-center justify-content-between p-3 rounded-3 mb-3" style="background: #f8fafc; border: 1.5px solid #e2e8f0;">
                    <div>
                        <span class="text-muted d-block small" style="font-size: 11px;">Total Amount to Pay</span>
                        <h4 class="fw-bold mb-0" style="color: #0c2340;">₹{{ number_format($booking->amount, 2) }}</h4>
                    </div>
                    <span class="badge bg-info-subtle text-primary border border-primary px-2 py-1" style="font-size: 11px;">
                        <i class="fas fa-vial me-1"></i> Razorpay Simulator
                    </span>
                </div>

                <!-- Payment Method Selection Tabs -->
                <label class="form-label small fw-bold text-dark mb-2">Select Payment Method:</label>
                <div class="d-flex gap-2 mb-3">
                    <button type="button" class="payment-tab-btn active flex-fill justify-content-center" onclick="switchPaymentTab('upi', this)">
                        <i class="fas fa-mobile-alt text-success"></i> UPI / QR
                    </button>
                    <button type="button" class="payment-tab-btn flex-fill justify-content-center" onclick="switchPaymentTab('card', this)">
                        <i class="fas fa-credit-card text-primary"></i> Card
                    </button>
                    <button type="button" class="payment-tab-btn flex-fill justify-content-center" onclick="switchPaymentTab('netbanking', this)">
                        <i class="fas fa-university text-warning"></i> Net Banking
                    </button>
                </div>

                <!-- 1. UPI Tab Content -->
                <div id="paymentTab_upi">
                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-muted mb-1">Enter UPI ID / VPA</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white"><i class="fas fa-at text-muted"></i></span>
                            <input type="text" class="form-control" id="upi_id" placeholder="e.g. {{ $booking->customer_phone }}@okhdfcbank" value="{{ $booking->customer_phone }}@upi">
                        </div>
                    </div>
                    <div class="d-flex gap-2 justify-content-center mb-3">
                        <button type="button" class="btn btn-sm btn-outline-secondary py-1 px-2" style="font-size: 11px;" onclick="document.getElementById('upi_id').value = '{{ $booking->customer_phone }}@okaxis';">Google Pay</button>
                        <button type="button" class="btn btn-sm btn-outline-secondary py-1 px-2" style="font-size: 11px;" onclick="document.getElementById('upi_id').value = '{{ $booking->customer_phone }}@ybl';">PhonePe</button>
                        <button type="button" class="btn btn-sm btn-outline-secondary py-1 px-2" style="font-size: 11px;" onclick="document.getElementById('upi_id').value = '{{ $booking->customer_phone }}@paytm';">Paytm</button>
                    </div>
                </div>

                <!-- 2. Card Tab Content -->
                <div id="paymentTab_card" style="display: none;">
                    <div class="mb-2">
                        <label class="form-label small fw-semibold text-muted mb-1">Cardholder Name</label>
                        <input type="text" class="form-control" id="card_name" value="{{ $booking->caller_name ?: $booking->customer_name }}" placeholder="Name on card">
                    </div>
                    <div class="mb-2">
                        <label class="form-label small fw-semibold text-muted mb-1">Test Card Number</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white"><i class="far fa-credit-card text-muted"></i></span>
                            <input type="text" class="form-control" id="card_number" value="4111 1111 1111 1111" placeholder="4111 •••• •••• 1111">
                        </div>
                    </div>
                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="form-label small fw-semibold text-muted mb-1">Expiry (MM/YY)</label>
                            <input type="text" class="form-control" id="card_expiry" value="12/28" placeholder="MM/YY">
                        </div>
                        <div class="col-6">
                            <label class="form-label small fw-semibold text-muted mb-1">CVV</label>
                            <input type="password" maxlength="4" class="form-control" id="card_cvv" value="123" placeholder="•••">
                        </div>
                    </div>
                </div>

                <!-- 3. Net Banking Tab Content -->
                <div id="paymentTab_netbanking" style="display: none;">
                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-muted mb-1">Select Bank</label>
                        <select class="form-select" id="bank_select">
                            <option value="HDFC">HDFC Bank</option>
                            <option value="SBI">State Bank of India</option>
                            <option value="ICICI">ICICI Bank</option>
                            <option value="AXIS">Axis Bank</option>
                            <option value="KOTAK">Kotak Mahindra Bank</option>
                        </select>
                    </div>
                </div>

                <!-- Submit Button: Instant Test Confirmation -->
                <button type="button" class="btn w-100 fw-bold py-3 mt-2 shadow-sm text-white" id="btnSubmitPaymentModal" onclick="processPaymentFromModal()" style="background: linear-gradient(135deg, #0c2340 0%, #3395ff 100%); border: none; font-size: 15px; border-radius: 10px;">
                    <i class="fas fa-check-circle me-2"></i> Simulate Successful Razorpay Payment
                </button>

                <div class="text-center mt-3">
                    <small class="text-muted" style="font-size: 11px;">
                        <i class="fas fa-shield-alt text-success me-1"></i> Razorpay sandbox test environment active for local development.
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>
            </div>
        </div>
    </div>
</div>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<script>
let currentSelectedMode = 'cash';

function switchPaymentMode(mode) {
    currentSelectedMode = mode;
    const cardCash = document.getElementById('card_mode_cash');
    const cardRazorpay = document.getElementById('card_mode_razorpay');
    const radioCash = document.getElementById('pay_mode_cash');
    const radioRazorpay = document.getElementById('pay_mode_razorpay');
    const btn = document.getElementById('btnMainPayment');

    if (mode === 'cash') {
        if (radioCash) radioCash.checked = true;
        if (cardCash) {
            cardCash.style.setProperty('border-color', '#048444', 'important');
            cardCash.style.background = '#e8f7ee';
        }
        if (cardRazorpay) {
            cardRazorpay.style.setProperty('border-color', '#e2e8f0', 'important');
            cardRazorpay.style.background = '#ffffff';
        }

        if (btn) {
            btn.style.background = 'linear-gradient(135deg, #048444 0%, #16a34a 100%)';
            btn.innerHTML = '<i class="fas fa-check-circle me-2"></i> Confirm Appointment (Cash on Service - ₹{{ number_format($booking->amount, 2) }})';
        }
    } else {
        if (radioRazorpay) radioRazorpay.checked = true;
        if (cardRazorpay) {
            cardRazorpay.style.setProperty('border-color', '#00bbd7', 'important');
            cardRazorpay.style.background = '#eefbfd';
        }
        if (cardCash) {
            cardCash.style.setProperty('border-color', '#e2e8f0', 'important');
            cardCash.style.background = '#ffffff';
        }

        if (btn) {
            btn.style.background = 'linear-gradient(135deg, #048444 0%, #00bbd7 100%)';
            btn.innerHTML = '<i class="fas fa-lock me-2"></i> Proceed to Pay (Razorpay - ₹{{ number_format($booking->amount, 2) }})';
        }
    }
}

function handleMainPaymentAction() {
    if (currentSelectedMode === 'cash') {
        confirmCashBooking();
    } else {
        launchRazorpayGateway();
    }
}

function confirmCashBooking() {
    const btn = document.getElementById('btnMainPayment');
    btn.disabled = true;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Confirming Appointment...';

    fetch("{{ route('booking.confirm_cash') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify({
            booking_number: "{{ $booking->booking_number }}"
        })
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            btn.innerHTML = '<i class="fas fa-check-circle me-2"></i> Appointment Confirmed!';
            setTimeout(function() {
                window.location.href = data.redirect_url;
            }, 500);
        } else {
            alert(data.message || 'Error confirming appointment with cash');
            btn.disabled = false;
            switchPaymentMode('cash');
        }
    })
    .catch(err => {
        console.error(err);
        alert('Network connection error. Please try again.');
        btn.disabled = false;
        switchPaymentMode('cash');
    });
}

// RAZORPAY GATEWAY CHECKOUT INTEGRATION (TEST & LIVE MODES)
function launchRazorpayGateway() {
    const razorpayMode = "{{ env('RAZORPAY_MODE', 'test') }}";
    const btn = document.getElementById('btnMainPayment');
    const originalText = btn.innerHTML;

    // 1. If configured in TEST MODE, immediately open the Razorpay Test Simulator
    if (razorpayMode === 'test') {
        openPaymentModal();
        return;
    }

    // 2. LIVE MODE: Launch official Razorpay Checkout popup
    btn.disabled = true;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Launching Live Razorpay...';

    if (typeof Razorpay === 'undefined') {
        alert('Razorpay Checkout SDK is offline. Opening Razorpay Test Simulator.');
        btn.disabled = false;
        btn.innerHTML = originalText;
        openPaymentModal();
        return;
    }

    const options = {
        key: "{{ env('RAZORPAY_KEY', 'rzp_live_SXJHhsmYTl131L') }}",
        amount: {{ (int) round($booking->amount * 100) }}, // In Paise
        currency: "INR",
        name: "{{ \App\Models\Setting::get('brand_name', 'Angelhug') }} Healthcare",
        description: "{{ addslashes($booking->service->title ?? 'Healthcare Service') }} (#{{ $booking->booking_number }})",
        image: "{{ asset('Angelhug Logo/FullLogo_Transparent_NoBuffer.png') }}",
        prefill: {
            name: "{{ addslashes($booking->caller_name ?: $booking->customer_name) }}",
            email: "{{ addslashes($booking->customer_email) }}",
            contact: "{{ $booking->customer_phone }}"
        },
        notes: {
            booking_number: "{{ $booking->booking_number }}",
            service_title: "{{ addslashes($booking->service->title ?? '') }}",
            patient_name: "{{ addslashes($booking->patient_name ?: $booking->customer_name) }}"
        },
        theme: {
            color: "#048444"
        },
        handler: function (response) {
            btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Verifying Payment...';
            submitPaymentVerification(
                response.razorpay_payment_id,
                response.razorpay_order_id || null,
                response.razorpay_signature || null
            );
        },
        modal: {
            ondismiss: function() {
                btn.disabled = false;
                switchPaymentMode('razorpay');
            }
        }
    };

    try {
        const rzp = new Razorpay(options);
        rzp.on('payment.failed', function (resp) {
            console.error('Razorpay payment failed:', resp);
            if (confirm('Razorpay Notice: ' + (resp.error ? resp.error.description : 'Transaction cancelled or failed.') + '\n\nWould you like to complete this appointment using Razorpay Test Simulator?')) {
                openPaymentModal();
            } else {
                btn.disabled = false;
                switchPaymentMode('razorpay');
            }
        });
        rzp.open();
    } catch (err) {
        console.error('Razorpay execution error:', err);
        btn.disabled = false;
        switchPaymentMode('razorpay');
        openPaymentModal();
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

function openPaymentModal() {
    const modalEl = document.getElementById('paymentDetailsModal');
    // Ensure modal sits directly under document.body to prevent parent z-index backdrop clipping
    if (modalEl.parentNode !== document.body) {
        document.body.appendChild(modalEl);
    }
    const modal = bootstrap.Modal.getOrCreateInstance(modalEl);
    modal.show();
}

function switchPaymentTab(tab, element) {
    document.querySelectorAll('.payment-tab-btn').forEach(btn => btn.classList.remove('active'));
    if (element) element.classList.add('active');

    document.getElementById('paymentTab_upi').style.display = (tab === 'upi') ? 'block' : 'none';
    document.getElementById('paymentTab_card').style.display = (tab === 'card') ? 'block' : 'none';
    document.getElementById('paymentTab_netbanking').style.display = (tab === 'netbanking') ? 'block' : 'none';
}

function processPaymentFromModal() {
    const btn = document.getElementById('btnSubmitPaymentModal');
    btn.disabled = true;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Processing Secure Payment...';

    const orderId = "{{ $booking->razorpay_order_id ?: ('order_test_' . strtoupper(bin2hex(random_bytes(6)))) }}";
    const paymentId = "pay_test_" + Math.random().toString(36).substring(2, 10).toUpperCase();

    submitPaymentVerification(paymentId, orderId, "sig_test_verified", function() {
        btn.disabled = false;
        btn.innerHTML = '<i class="fas fa-lock me-2"></i> Pay ₹{{ number_format($booking->amount, 2) }} & Confirm';
    });
}

function submitPaymentVerification(paymentId, orderId, signature, errorCallback) {
    fetch("{{ route('booking.verify_payment') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify({
            booking_number: "{{ $booking->booking_number }}",
            razorpay_order_id: orderId,
            razorpay_payment_id: paymentId,
            razorpay_signature: signature
        })
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            const btn = document.getElementById('btnMainPayment');
            if (btn) btn.innerHTML = '<i class="fas fa-check-circle me-2"></i> Payment Successful!';
            setTimeout(function() {
                window.location.href = data.redirect_url;
            }, 600);
        } else {
            alert(data.message || 'Payment verification failed');
            if (errorCallback) errorCallback();
            const btn = document.getElementById('btnMainPayment');
            if (btn) {
                btn.disabled = false;
                switchPaymentMode('razorpay');
            }
        }
    })
    .catch(err => {
        console.error(err);
        alert('Network error while processing payment. Please try again.');
        if (errorCallback) errorCallback();
        const btn = document.getElementById('btnMainPayment');
        if (btn) {
            btn.disabled = false;
            switchPaymentMode('razorpay');
        }
    });
}
</script>

@include('footer')
