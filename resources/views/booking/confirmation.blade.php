@include('header')

<style>
/* Clean Clinical Receipt / Invoice Styling */
.confirmation-hero {
    background: linear-gradient(135deg, var(--ah-primary-dark) 0%, var(--ah-primary) 100%);
    padding: 60px 0 50px 0 !important;
    color: #fff;
    position: relative;
    overflow: hidden;
}

.confirmation-hero::before {
    content: "";
    position: absolute;
    top: 0; left: 0; right: 0; bottom: 0;
    background: url("{{ asset('img/angelhug_docx/image5.png') }}") center/cover no-repeat;
    opacity: 0.15;
}

.confirmation-page-wrap {
    background: #f8fafc;
    padding: 30px 0 60px;
}

.confirmation-page-wrap > .container {
    max-width: 900px;
}

/* Medical Invoice Wrapper */
.invoice-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
    overflow: hidden;
}

/* Clinical Header */
.invoice-top-header {
    background: #f8fafc;
    border-bottom: 2px solid #048444;
    padding: 24px 30px;
}

.invoice-brand-title {
    color: #048444;
    font-size: 20px;
    font-weight: 800;
    letter-spacing: -0.3px;
    margin: 0;
}

.invoice-meta-badge {
    background: #e8f7ee;
    color: #048444;
    border: 1px solid rgba(4, 132, 68, 0.25);
    font-size: 12px;
    font-weight: 700;
    padding: 4px 12px;
    border-radius: 20px;
}

.invoice-body {
    padding: 30px;
}

.invoice-table th {
    background: #f1f5f9;
    color: #334155;
    font-weight: 700;
    font-size: 12px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    border-bottom: 1.5px solid #cbd5e1;
    padding: 10px 14px;
}

.invoice-table td {
    padding: 12px 14px;
    font-size: 13.5px;
    vertical-align: middle;
    border-bottom: 1px solid #eef2f6;
}

/* Stamp & Signature Area */
.clinical-stamp-box {
    border: 1.5px dashed #048444;
    background: #f4faf6;
    border-radius: 8px;
    padding: 14px 18px;
    text-align: center;
}

/* Print Specific Rules: Strict Invoice A4 formatting */
@media print {
    header, footer, .no-print, .confirmation-hero, .top-header, .main-header {
        display: none !important;
    }
    body {
        padding-top: 0 !important;
        background: #ffffff !important;
        font-family: Arial, sans-serif !important;
        color: #000000 !important;
    }
    .confirmation-page-wrap {
        padding: 0 !important;
        background: #ffffff !important;
    }
    .invoice-card {
        border: none !important;
        box-shadow: none !important;
        border-radius: 0 !important;
        max-width: 100% !important;
    }
    .invoice-top-header {
        background: #ffffff !important;
        border-bottom: 2px solid #000000 !important;
        padding: 10px 0 !important;
    }
    .invoice-body {
        padding: 15px 0 !important;
    }
    .invoice-table th {
        background: #f0f0f0 !important;
        color: #000 !important;
        border-bottom: 2px solid #000 !important;
    }
}
</style>

<!-- Hero Section (No Print) -->
<section class="confirmation-hero text-center position-relative no-print">
    <div class="container position-relative" style="z-index: 2;">
        <span class="badge px-3 py-1 mb-2 text-white" style="background: rgba(255,255,255,0.25); border: 1px solid rgba(255,255,255,0.3); font-size: 12px; border-radius: 20px;">
            <i class="fas fa-check-circle me-1"></i> Verified Appointment Receipt
        </span>
        <h1 class="text-white fw-bold display-6 mb-2">Booking Confirmation</h1>
        <p class="lead text-white-50 mx-auto mb-0" style="max-width: 680px; font-size: 15px;">
            Your healthcare service has been scheduled and registered with {{ \App\Models\Setting::get('brand_name', 'Angelhug') }} Healthcare.
        </p>
    </div>
</section>

<!-- Invoice Section -->
<div class="confirmation-page-wrap">
    <div class="container">
        <div class="invoice-card">
            <!-- Clinical Header -->
            <div class="invoice-top-header">
                <div class="row align-items-center">
                    <div class="col-sm-7 mb-3 mb-sm-0">
                        @php
                            $customLogo = \App\Models\Setting::get('website_logo');
                            $brandLogoUrl = $customLogo ? asset('storage/' . $customLogo) : asset('Angelhug Logo/FullLogo_Transparent_NoBuffer.png');
                        @endphp
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <img src="{{ $brandLogoUrl }}" alt="{{ \App\Models\Setting::get('brand_name', 'Angelhug') }}" style="height: 44px; width: auto; max-width: 140px; object-fit: contain;">
                            <h2 class="invoice-brand-title mb-0" style="font-size: 19px;">{{ \App\Models\Setting::get('brand_name', 'Angelhug') }} Healthcare & Nursing Services</h2>
                        </div>
                        <p class="text-muted small mb-0" style="font-size: 12px; line-height: 1.45;">
                            {{ \App\Models\Setting::get('contact_address', 'No.25/25, Ottaipillaiyar Koil Street, Ranganathan Nagar, Virugambakkam, Chennai, TN 600092') }}<br>
                            <strong>24/7 Helpline:</strong> {{ \App\Models\Setting::get('contact_phone', '+91 80725 15050') }} | <strong>Email:</strong> {{ \App\Models\Setting::get('contact_email', 'angelhug.official@gmail.com') }}<br>
                            <strong>Clinical Registration / GSTIN:</strong> {{ \App\Models\Setting::get('gstin_number', '33AAHCA8492C1ZP') }}
                        </p>
                    </div>
                    <div class="col-sm-5 text-sm-end">
                        <span class="invoice-meta-badge d-inline-block mb-1">
                            <i class="fas fa-receipt me-1"></i> APPOINTMENT INVOICE
                        </span>
                        <div class="fw-bold text-dark" style="font-size: 16px;">
                            #{{ $booking->booking_number }}
                        </div>
                        <div class="text-muted small" style="font-size: 12px;">
                            Date: {{ $booking->created_at->format('M d, Y') }} | {{ $booking->created_at->format('h:i A') }}
                        </div>
                        <div class="mt-1">
                            @if($booking->payment_method === 'cash')
                                <span class="badge bg-warning text-dark fw-bold px-2 py-0.5" style="font-size: 11px;">
                                    <i class="fas fa-money-bill-wave me-1"></i> CASH ON SERVICE (PAY AT HOME)
                                </span>
                            @else
                                <span class="badge bg-success text-white fw-bold px-2 py-0.5" style="font-size: 11px;">
                                    <i class="fas fa-check-circle me-1"></i> PAYMENT CONFIRMED (PAID)
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Invoice Body -->
            <div class="invoice-body">
                <!-- Two Column Parties Overview -->
                <div class="row g-3 mb-4 pb-3 border-bottom">
                    <!-- Column 1: Caller / Family Contact -->
                    <div class="col-sm-6">
                        <div class="p-3 rounded-2 bg-light border h-100">
                            <span class="text-muted fw-bold d-block text-uppercase mb-2" style="font-size: 11px; letter-spacing: 0.5px;">
                                <i class="fas fa-user-friends text-info me-1"></i> Caller / Family Member Details
                            </span>
                            <div class="fw-bold text-dark" style="font-size: 14px;">
                                {{ $booking->caller_name ?: $booking->customer_name }}
                            </div>
                            <div class="text-muted small" style="font-size: 12.5px;">
                                Relationship: <strong>{{ $booking->caller_relationship ?: 'Self' }}</strong>
                            </div>
                            <div class="text-muted small" style="font-size: 12.5px;">
                                Phone: <strong>+91 {{ $booking->customer_phone }}</strong>
                            </div>
                            @if($booking->customer_email)
                            <div class="text-muted small" style="font-size: 12.5px;">
                                Email: {{ $booking->customer_email }}
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Column 2: Patient Receiving Healthcare -->
                    <div class="col-sm-6">
                        <div class="p-3 rounded-2 bg-light border h-100">
                            <span class="text-muted fw-bold d-block text-uppercase mb-2" style="font-size: 11px; letter-spacing: 0.5px;">
                                <i class="fas fa-user-injured text-success me-1"></i> Patient Receiving Care
                            </span>
                            <div class="fw-bold text-dark" style="font-size: 14px;">
                                {{ $booking->patient_name ?: $booking->customer_name }}
                            </div>
                            <div class="text-muted small" style="font-size: 12.5px;">
                                Profile: <strong>{{ $booking->patient_age ? $booking->patient_age . ' Years' : 'Adult' }} • {{ $booking->patient_gender ?: 'Patient' }}</strong>
                            </div>
                            @if($booking->patient_condition)
                            <div class="text-muted small" style="font-size: 12.5px;">
                                Condition: <strong>{{ $booking->patient_condition }}</strong>
                            </div>
                            @endif
                            <div class="text-muted small text-truncate" style="font-size: 12.5px;" title="{{ $booking->customer_address }}">
                                <i class="fas fa-map-marker-alt text-danger me-1"></i> Address: {{ $booking->customer_address ?: 'GPS Location Provided' }}
                            </div>
                            @if($booking->google_maps_link)
                            <div class="mt-1">
                                <a href="{{ $booking->google_maps_link }}" target="_blank" class="text-success fw-bold" style="font-size: 11.5px;">
                                    <i class="fas fa-external-link-alt me-1"></i> Open Google Maps Live Location
                                </a>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Schedule Strip -->
                <div class="d-flex align-items-center justify-content-between p-3 rounded-2 mb-4 bg-light border" style="font-size: 13px;">
                    <div>
                        <span class="text-muted d-block small" style="font-size: 11.5px;">Schedule Period</span>
                        <strong class="text-dark">
                            @if($booking->booking_end_date && $booking->booking_end_date != $booking->booking_date)
                                {{ \Carbon\Carbon::parse($booking->booking_date)->format('M d, Y') }} – {{ \Carbon\Carbon::parse($booking->booking_end_date)->format('M d, Y') }}
                            @else
                                {{ \Carbon\Carbon::parse($booking->booking_date)->format('D, M d, Y') }}
                            @endif
                        </strong>
                    </div>
                    <div>
                        <span class="text-muted d-block small" style="font-size: 11.5px;">Shift / Hours</span>
                        <strong class="text-primary">{{ $booking->booking_time }} @if($booking->booking_end_time) – {{ $booking->booking_end_time }} @endif</strong>
                    </div>
                    <div>
                        <span class="text-muted d-block small" style="font-size: 11.5px;">Plan Type</span>
                        <strong class="text-success">{{ $booking->duration_type ?: 'Standard Shift' }}</strong>
                    </div>
                    <div class="text-end">
                        <span class="text-muted d-block small" style="font-size: 11.5px;">Payment Gateway</span>
                        <strong class="text-dark">Razorpay (Ref: {{ substr($booking->razorpay_payment_id ?: 'pay_online', 0, 16) }})</strong>
                    </div>
                </div>

                <!-- Itemized Invoice Table -->
                <div class="table-responsive mb-4">
                    <table class="table invoice-table w-100">
                        <thead>
                            <tr>
                                <th style="width: 5%;">#</th>
                                <th style="width: 55%;">Service Description</th>
                                <th style="width: 20%;" class="text-center">Rate</th>
                                <th style="width: 20%;" class="text-end">Amount (INR)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php 
                                $itemIndex = 1; 
                                $platformFeeAmount = (float) ($booking->platform_fee !== null ? $booking->platform_fee : $booking->effective_platform_fee);
                            @endphp
                            <tr>
                                <td>{{ $itemIndex++ }}</td>
                                <td>
                                    <strong>{{ $booking->service->title ?? 'Specialized Healthcare Service' }}</strong>
                                    <div class="text-muted small" style="font-size: 11.5px;">
                                        @if(!empty($booking->sub_service_name))
                                            <strong>Plan:</strong> <span class="text-success fw-bold">{{ $booking->sub_service_name }}</span> |
                                        @endif
                                        Shift: {{ $booking->duration_type ?: 'Standard Shift' }} | In-home clinical caregiver assistance
                                    </div>
                                </td>
                                <td class="text-center">Standard Care</td>
                                <td class="text-end fw-bold">
                                    ₹{{ number_format($booking->base_fee ?: max(0, round(($booking->amount / (1 + (($booking->gst_rate ?: 5.0) / 100))) - $platformFeeAmount, 2)), 2) }}
                                </td>
                            </tr>
                            @if($platformFeeAmount > 0)
                            <tr>
                                <td>{{ $itemIndex++ }}</td>
                                <td>
                                    <strong>Others</strong>
                                </td>
                                <td class="text-center">Others</td>
                                <td class="text-end fw-bold">
                                    ₹{{ number_format($platformFeeAmount, 2) }}
                                </td>
                            </tr>
                            @endif
                            @if(!empty($booking->extra_charges) && $booking->extra_charges > 0)
                            <tr>
                                <td>{{ $itemIndex++ }}</td>
                                <td>
                                    <strong>{{ \App\Models\Setting::get('extra_charge_label', 'Extra Care Charges / Consumables Kit') }}</strong>
                                    <div class="text-muted small" style="font-size: 11.5px;">
                                        Sanitization, emergency response & medical supplies kit
                                    </div>
                                </td>
                                <td class="text-center">Surcharge</td>
                                <td class="text-end fw-bold">
                                    ₹{{ number_format($booking->extra_charges, 2) }}
                                </td>
                            </tr>
                            @endif
                            <tr>
                                <td>{{ $itemIndex++ }}</td>
                                <td>
                                    <strong>Healthcare Service Tax (GST {{ number_format($booking->gst_rate ?: 5.0, 1) }}%)</strong>
                                    <div class="text-muted small" style="font-size: 11.5px;">
                                        Central GST ({{ number_format(($booking->gst_rate ?: 5.0) / 2, 2) }}%) + State GST ({{ number_format(($booking->gst_rate ?: 5.0) / 2, 2) }}%)
                                    </div>
                                </td>
                                <td class="text-center">{{ number_format($booking->gst_rate ?: 5.0, 1) }}%</td>
                                <td class="text-end fw-bold">
                                    ₹{{ number_format($booking->gst_amount ?: round($booking->amount - ($booking->amount / 1.05), 2), 2) }}
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" class="text-end fw-bold pt-3" style="font-size: 14px;">
                                    {{ $booking->payment_method === 'cash' ? 'Total Amount Payable on Service (Cash):' : 'Total Amount Paid (Inclusive of All Taxes):' }}
                                </td>
                                <td class="text-end fw-bold text-success fs-5 pt-3">
                                    ₹{{ number_format($booking->amount, 2) }}
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <!-- Digital Stamp & Seal Area -->
                <div class="row align-items-center mt-3 pt-2">
                    <div class="col-sm-7 mb-3 mb-sm-0">
                        <div class="clinical-stamp-box text-start">
                            <div class="fw-bold text-success" style="font-size: 12.5px;">
                                <i class="fas fa-shield-alt me-1"></i> Digitally Verified Clinical Service Voucher
                            </div>
                            <p class="text-muted mb-0" style="font-size: 11px; line-height: 1.4;">
                                This receipt confirms your home visit appointment. Assigned healthcare personnel will carry official {{ \App\Models\Setting::get('brand_name', 'Angelhug') }} badge identification and follow sterile medical protocol.
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-5 text-sm-end">
                        <div class="text-muted small" style="font-size: 11px;">Authorized Signatory</div>
                        <div class="fw-bold text-dark" style="font-size: 13px;">{{ \App\Models\Setting::get('brand_name', 'Angelhug') }} Healthcare Team</div>
                        <div class="badge bg-light text-success border border-success px-2 py-1 mt-1" style="font-size: 10px;">
                            <i class="fas fa-certificate me-1"></i> Clinically Certified
                        </div>
                    </div>
                </div>

                <!-- Action Buttons (Hidden on Print) -->
                <div class="d-flex justify-content-center align-items-center gap-2 flex-wrap no-print pt-4 border-top mt-4">
                    <button type="button" class="btn btn-outline-success px-4 py-2 fw-bold" onclick="window.print()" style="border-radius: 8px; font-size: 13.5px;">
                        <i class="fas fa-print me-1"></i> Print Invoice / Receipt
                    </button>
                    <a href="{{ route('service.history') }}" class="ah-btn-primary px-3 py-2 fw-bold" style="border-radius: 8px; font-size: 13.5px;">
                        <i class="fas fa-calendar-check me-1"></i> Booking History
                    </a>
                    <a href="{{ route('service') }}" class="btn btn-outline-primary px-3 py-2 fw-bold" style="border-radius: 8px; font-size: 13.5px;">
                        <i class="fas fa-plus me-1"></i> Book Another Service
                    </a>
                    <a href="{{ route('home') }}" class="btn btn-light border px-3 py-2 fw-semibold text-secondary" style="border-radius: 8px; font-size: 13.5px;">
                        <i class="fas fa-home me-1"></i> Return Home
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@include('footer')
