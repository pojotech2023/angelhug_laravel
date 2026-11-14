@extends('layouts.app')

@section('content')
<div class="container-fluid" style="max-width: 950px;">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1" style="color: #048444;"><i class="fas fa-file-invoice me-2"></i> Service Booking Details</h3>
            <p class="text-muted small mb-0">Booking Number: <strong>{{ $booking->booking_number }}</strong></p>
        </div>
        <a href="{{ route('admin.bookings.index') }}" class="btn btn-outline-secondary fw-bold">
            <i class="fas fa-arrow-left me-1"></i> Back to Bookings
        </a>
    </div>

    <div class="row g-4">
        <!-- Main details -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                <!-- Service Summary -->
                <div class="d-flex align-items-center gap-3 p-3 bg-light rounded-3 mb-4">
                    <img src="{{ $booking->service->image_url ?? asset('img/about-1.jpg') }}" alt="Service" 
                         style="width: 80px; height: 80px; object-fit: cover; border-radius: 10px;">
                    <div>
                        <span class="badge bg-primary mb-1">Booked Service</span>
                        <h4 class="fw-bold mb-1" style="color: #048444;">{{ $booking->service->title ?? 'Specialized Service' }}</h4>
                        @if(!empty($booking->sub_service_name))
                            <div class="mb-1">
                                <span class="badge" style="background: #e0f2fe; color: #0284c7; border: 1px solid #bae6fd; font-size: 11.5px; font-weight: 700;">
                                    <i class="fas fa-layer-group me-1"></i> Care Plan: {{ $booking->sub_service_name }}
                                </span>
                            </div>
                        @endif
                        <div class="text-muted small">Duration: {{ $booking->service->duration ?? '60 Mins' }}</div>
                    </div>
                    <div class="ms-auto text-end">
                        <span class="text-muted small d-block">Price</span>
                        <h4 class="fw-bold text-success mb-0">₹{{ number_format($booking->amount, 2) }}</h4>
                    </div>
                </div>

                <!-- Schedule & Location -->
                <h5 class="fw-bold mb-3" style="color: #048444;">Appointment Details</h5>
                <div class="row g-3 mb-4">
                    <div class="col-sm-4">
                        <div class="p-3 border rounded-3 bg-light">
                            <small class="text-muted text-uppercase fw-bold d-block mb-1">Plan / Duration</small>
                            <h6 class="fw-bold mb-0 text-success">{{ $booking->duration_type ?: 'Standard Shift' }}</h6>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="p-3 border rounded-3">
                            <small class="text-muted text-uppercase fw-bold d-block mb-1">{{ $booking->booking_end_date ? 'Care Period' : 'Appointment Date' }}</small>
                            <h6 class="fw-bold mb-0 text-dark">
                                @if($booking->booking_end_date)
                                    {{ \Carbon\Carbon::parse($booking->booking_date)->format('M d') }} – {{ \Carbon\Carbon::parse($booking->booking_end_date)->format('M d, Y') }}
                                @else
                                    {{ \Carbon\Carbon::parse($booking->booking_date)->format('l, F j, Y') }}
                                @endif
                            </h6>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="p-3 border rounded-3">
                            <small class="text-muted text-uppercase fw-bold d-block mb-1">Daily Shift / Time</small>
                            <h6 class="fw-bold mb-0 text-primary">{{ $booking->booking_time }}</h6>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="p-3 border rounded-3 bg-light">
                            <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-2">
                                <small class="text-muted text-uppercase fw-bold"><i class="fas fa-map-marker-alt text-danger me-1"></i> Service Address / Visit Location</small>
                                @php
                                    $mapUrl = $booking->google_maps_link ?: ($booking->customer_address ? 'https://www.google.com/maps/search/?api=1&query=' . urlencode($booking->customer_address) : null);
                                @endphp
                                @if($mapUrl)
                                    <a href="{{ $mapUrl }}" target="_blank" class="btn btn-sm btn-outline-danger fw-bold py-1 px-2" style="font-size: 11.5px;">
                                        <i class="fas fa-external-link-alt me-1"></i> Open in Google Maps
                                    </a>
                                @endif
                            </div>
                            <p class="mb-2 fs-6 fw-semibold text-dark">{{ $booking->customer_address ?: 'Clinic Visit / In-Office appointment' }}</p>

                            @if($booking->customer_address)
                                <div class="rounded-3 overflow-hidden border mt-2" style="height: 180px;">
                                    <iframe width="100%" height="180" style="border:0;" loading="lazy" allowfullscreen 
                                            src="https://maps.google.com/maps?q={{ urlencode($booking->customer_address) }}&t=&z=15&ie=UTF8&iwloc=&output=embed">
                                    </iframe>
                                </div>
                            @endif
                        </div>
                    </div>
                    @if($booking->notes)
                    <div class="col-12">
                        <div class="p-3 border rounded-3">
                            <small class="text-muted text-uppercase fw-bold d-block mb-1">Customer Notes / Symptoms</small>
                            <p class="mb-0 text-muted fst-italic">{{ $booking->notes }}</p>
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Caller / Booking Person Details -->
                <h5 class="fw-bold mb-3" style="color: #048444;"><i class="fas fa-user-friends text-info me-2"></i> Caller / Family Member Details</h5>
                <div class="row g-3 mb-4 p-3 border rounded-3 bg-light">
                    <div class="col-sm-4">
                        <small class="text-muted text-uppercase fw-bold d-block mb-1">Caller Name</small>
                        <strong class="text-dark">{{ $booking->caller_name ?: $booking->customer_name }}</strong>
                    </div>
                    <div class="col-sm-4">
                        <small class="text-muted text-uppercase fw-bold d-block mb-1">Relationship to Patient</small>
                        <span class="badge bg-white text-dark border">{{ $booking->caller_relationship ?: 'Self' }}</span>
                    </div>
                    <div class="col-sm-4">
                        <small class="text-muted text-uppercase fw-bold d-block mb-1">Primary Phone</small>
                        <strong class="text-dark">+91 {{ $booking->customer_phone }}</strong>
                    </div>
                    @if($booking->customer_email)
                    <div class="col-sm-6">
                        <small class="text-muted text-uppercase fw-bold d-block mb-1">Email Address</small>
                        <span class="text-dark">{{ $booking->customer_email }}</span>
                    </div>
                    @endif
                </div>

                <!-- Patient Profile & Clinical Condition -->
                <h5 class="fw-bold mb-3" style="color: #048444;"><i class="fas fa-user-injured text-success me-2"></i> Patient Profile & Clinical Condition</h5>
                <div class="row g-3 mb-4 p-3 border rounded-3">
                    <div class="col-sm-4">
                        <small class="text-muted text-uppercase fw-bold d-block mb-1">Patient Name</small>
                        <strong class="text-dark">{{ $booking->patient_name ?: $booking->customer_name }}</strong>
                    </div>
                    <div class="col-sm-4">
                        <small class="text-muted text-uppercase fw-bold d-block mb-1">Age</small>
                        <strong class="text-dark">{{ $booking->patient_age ? $booking->patient_age . ' Years' : 'Not specified' }}</strong>
                    </div>
                    <div class="col-sm-4">
                        <small class="text-muted text-uppercase fw-bold d-block mb-1">Gender</small>
                        <strong class="text-dark">{{ $booking->patient_gender ?: 'Not specified' }}</strong>
                    </div>
                    @if($booking->patient_condition)
                    <div class="col-12 mt-2">
                        <small class="text-muted text-uppercase fw-bold d-block mb-1">Primary Condition / Reason for Care</small>
                        <span class="badge bg-success-subtle text-success border border-success p-2" style="font-size: 13px;">
                            {{ $booking->patient_condition }}
                        </span>
                    </div>
                    @endif
                </div>

                <!-- Patient Medical Documents -->
                @if(!empty($booking->patient_documents) && is_array($booking->patient_documents) && count($booking->patient_documents) > 0)
                <h5 class="fw-bold mb-3" style="color: #048444;"><i class="fas fa-file-medical text-danger me-2"></i> Uploaded Patient Medical Documents</h5>
                <div class="p-3 border rounded-3 mb-4 bg-light">
                    <div class="d-flex flex-wrap gap-2">
                        @foreach($booking->patient_documents as $doc)
                            <a href="{{ asset('storage/' . ($doc['path'] ?? '')) }}" target="_blank" class="btn btn-sm btn-white border bg-white shadow-sm d-inline-flex align-items-center gap-2 py-2 px-3">
                                <i class="fas fa-file-pdf text-danger fs-5"></i>
                                <div class="text-start">
                                    <div class="fw-bold text-dark text-truncate" style="max-width: 200px; font-size: 12px;">{{ $doc['name'] ?? 'Medical Document' }}</div>
                                    <small class="text-success" style="font-size: 10.5px;">Click to View / Download</small>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>

        <!-- Right sidebar: Status & Payment update -->
        <div class="col-lg-4">
            <!-- Itemized Billing Breakdown & Extra Charges Control -->
            <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="fw-bold mb-0" style="color: #048444;">
                        <i class="fas fa-file-invoice-dollar me-1 text-success"></i> Billing Breakdown
                    </h5>
                    <button type="button" class="btn btn-outline-success btn-sm py-1 px-2.5 fw-bold shadow-sm" style="font-size: 12px;"
                            onclick='openBillingModal({
                                id: {{ $booking->id }},
                                booking_number: "{{ $booking->booking_number }}",
                                service_title: "{{ addslashes($booking->service->title ?? 'Healthcare Service') }}",
                                customer_name: "{{ addslashes($booking->customer_name ?: ($booking->caller_name ?: 'Patient')) }}",
                                base_fee: {{ (float) $booking->effective_base_fee }},
                                platform_fee: {{ (float) $booking->effective_platform_fee }},
                                extra_charges: {{ (float) $booking->effective_extra_charges }},
                                gst_rate: {{ (float) $booking->effective_gst_rate }}
                            })'>
                        <i class="fas fa-sliders-h me-1"></i> Adjust Charges (Popup)
                    </button>
                </div>
                <table class="table table-sm table-borderless mb-0" style="font-size: 13px;">
                    <tr class="border-bottom">
                        <td class="text-muted py-1.5">Base Care Fee:</td>
                        <td class="text-end fw-bold py-1.5">₹{{ number_format($booking->effective_base_fee, 2) }}</td>
                    </tr>
                    <tr class="border-bottom">
                        <td class="text-muted py-1.5">Others:</td>
                        <td class="text-end fw-bold py-1.5">₹{{ number_format($booking->effective_platform_fee, 2) }}</td>
                    </tr>
                    @php
                        $rate = (float) $booking->effective_gst_rate;
                        $extraFee = (float) $booking->effective_extra_charges;
                        $extraGst = round($extraFee * ($rate / 100), 2);
                        $baseProtocolSubtotal = (float) $booking->effective_base_fee + (float) $booking->effective_platform_fee;
                        $serviceGst = round($baseProtocolSubtotal * ($rate / 100), 2);
                    @endphp
                    @if($extraFee > 0)
                    <tr class="border-bottom">
                        <td class="text-muted py-1.5"><i class="fas fa-plus-circle text-success me-1"></i> Extra Charges / Kit Fee:</td>
                        <td class="text-end fw-bold text-dark py-1.5">+ ₹{{ number_format($extraFee, 2) }}</td>
                    </tr>
                    <tr class="border-bottom" style="background: #f0fdf4;">
                        <td class="text-muted py-1 ps-2" style="font-size: 11.5px;">
                            <i class="fas fa-angle-right text-success me-1"></i> GST on Extra Fee ({{ number_format($rate, 1) }}%):
                        </td>
                        <td class="text-end fw-bold text-success py-1" style="font-size: 11.5px;">+ ₹{{ number_format($extraGst, 2) }}</td>
                    </tr>
                    <tr class="border-bottom" style="background: #f0fdf4;">
                        <td class="text-muted py-1 ps-2" style="font-size: 11.5px;">
                            <i class="fas fa-equals text-muted me-1"></i> Extra Total (with GST):
                        </td>
                        <td class="text-end fw-bold text-primary py-1" style="font-size: 11.5px;">₹{{ number_format($extraFee + $extraGst, 2) }}</td>
                    </tr>
                    @endif
                    <tr class="border-bottom">
                        <td class="text-muted py-1.5">Total GST ({{ number_format($rate, 1) }}%):</td>
                        <td class="text-end fw-bold py-1.5">₹{{ number_format($booking->effective_gst_amount, 2) }}</td>
                    </tr>
                    <tr>
                        <td class="fw-bold text-dark pt-2">Total Amount:</td>
                        <td class="text-end fw-bold text-success fs-5 pt-2">₹{{ number_format($booking->amount, 2) }}</td>
                    </tr>
                </table>
            </div>

            <!-- Payment info card -->
            <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                <h5 class="fw-bold mb-3" style="color: #048444;">
                    <i class="fas fa-wallet text-success me-2"></i> Payment Details
                </h5>

                <div class="mb-2">
                    <small class="text-muted d-block">Payment Method</small>
                    @if($booking->payment_method === 'cash')
                        <span class="badge bg-warning text-dark fs-6">
                            <i class="fas fa-money-bill-wave me-1"></i> Cash on Service (Pay at Home)
                        </span>
                    @else
                        <span class="badge bg-primary text-white fs-6">
                            <i class="fas fa-credit-card me-1"></i> Online (Razorpay)
                        </span>
                    @endif
                </div>

                <div class="mb-2">
                    <small class="text-muted d-block">Payment Status</small>
                    @if($booking->payment_status === 'paid')
                        <span class="badge bg-success fs-6"><i class="fas fa-check-circle me-1"></i> Paid</span>
                    @elseif($booking->payment_method === 'cash')
                        <span class="badge bg-info-subtle text-dark border border-info fs-6"><i class="fas fa-hand-holding-usd me-1"></i> To be collected upon service</span>
                    @else
                        <span class="badge bg-secondary fs-6">{{ ucfirst($booking->payment_status) }}</span>
                    @endif
                </div>

                @if($booking->payment_method === 'razorpay')
                <div class="mb-2">
                    <small class="text-muted d-block">Razorpay Order ID</small>
                    <code>{{ $booking->razorpay_order_id ?: 'N/A' }}</code>
                </div>

                <div class="mb-3">
                    <small class="text-muted d-block">Razorpay Payment ID</small>
                    <code>{{ $booking->razorpay_payment_id ?: 'N/A' }}</code>
                </div>

                <div class="p-2 bg-light rounded text-center small text-muted">
                    <i class="fas fa-shield-alt text-success me-1"></i> Signature Verified
                </div>
                @else
                <div class="p-2.5 bg-light rounded small text-muted mt-2 border">
                    <i class="fas fa-info-circle text-success me-1"></i> Customer selected Cash on Service. Caregiver will collect <strong>₹{{ number_format($booking->amount, 2) }}</strong> at customer's home.
                </div>
                @endif
            </div>

            <!-- Status Changer Card -->
            <div class="card border-0 shadow-sm rounded-4 p-4">
                <h5 class="fw-bold mb-3" style="color: #048444;">Update Status</h5>

                <form action="{{ route('admin.bookings.update_status', $booking->id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-bold">Booking Status</label>
                        <select name="booking_status" class="form-select">
                            <option value="pending" {{ $booking->booking_status === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="confirmed" {{ $booking->booking_status === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                            <option value="in_progress" {{ $booking->booking_status === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="completed" {{ $booking->booking_status === 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="cancelled" {{ $booking->booking_status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Payment Status</label>
                        <select name="payment_status" class="form-select">
                            <option value="pending" {{ $booking->payment_status === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="paid" {{ $booking->payment_status === 'paid' ? 'selected' : '' }}>Paid</option>
                            <option value="failed" {{ $booking->payment_status === 'failed' ? 'selected' : '' }}>Failed</option>
                            <option value="refunded" {{ $booking->payment_status === 'refunded' ? 'selected' : '' }}>Refunded</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Admin Notes</label>
                        <textarea name="notes" class="form-control" rows="2" placeholder="Internal notes...">{{ $booking->notes }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 fw-bold" style="background: #048444; border-color: #048444;">
                        Update Booking
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@include('admin.bookings.modal_adjust_billing')
@endsection
