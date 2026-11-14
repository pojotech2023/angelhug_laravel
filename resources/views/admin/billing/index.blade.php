@extends('layouts.app')

@section('title', 'Service GST & Extra Charges - ' . \App\Models\Setting::get('brand_name', 'AngelHug') . ' Admin')

@section('content')
<div class="container-fluid py-2">
    <!-- Header -->
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
        <div>
            <h3 class="fw-bold mb-1" style="color: #048444;">
                <i class="fas fa-file-invoice-dollar me-2"></i> Service GST & Extra Charges
            </h3>
            <p class="text-muted small mb-0">Manage GST tax rates, Others fees, and extra consumables kit charges for each service.</p>
        </div>
        <div class="d-flex align-items-center gap-2">
            <a href="{{ route('services.index') }}" class="btn btn-outline-success fw-bold rounded-pill px-3">
                <i class="fas fa-stethoscope me-1"></i> All Services
            </a>
            <button type="button" onclick="document.getElementById('billingForm').submit()" class="btn btn-success fw-bold rounded-pill px-4" style="background: #048444; border-color: #048444;">
                <i class="fas fa-save me-1"></i> Save Changes
            </button>
        </div>
    </div>

    <form id="billingForm" action="{{ route('admin.billing.update') }}" method="POST">
        @csrf

        <!-- 1. Global Tax & Default Rates Card -->
        <div class="card border-0 shadow-sm rounded-4 p-4 mb-4 bg-white">
            <div class="d-flex align-items-center justify-content-between pb-3 border-bottom mb-3">
                <div class="d-flex align-items-center gap-2">
                    <span class="rounded-3 p-2 text-white" style="background: #048444;">
                        <i class="fas fa-building"></i>
                    </span>
                    <div>
                        <h6 class="fw-bold mb-0 text-dark">Company Tax Credentials & Default Rates</h6>
                        <small class="text-muted">Applied automatically when a service doesn't have custom rates.</small>
                    </div>
                </div>
                <div class="form-check form-switch fs-6 mb-0">
                    <input class="form-check-input" type="checkbox" id="gst_enabled" name="gst_enabled" value="1" {{ $settings['gst_enabled'] ? 'checked' : '' }} onchange="recalculateAllRows()">
                    <label class="form-check-label fw-bold text-dark small" for="gst_enabled">GST Enabled</label>
                </div>
            </div>

            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label small fw-bold text-dark mb-1">Company GSTIN Number</label>
                    <input type="text" class="form-control fw-bold text-uppercase" id="gstin_number" name="gstin_number" value="{{ $settings['gstin_number'] }}" placeholder="33AAHCA8492C1ZP">
                    <small class="text-muted" style="font-size: 11px;">Printed on official hospital tax invoice & receipt.</small>
                </div>

                <div class="col-md-4">
                    <label class="form-label small fw-bold text-dark mb-1">Default GST Rate (%)</label>
                    <div class="input-group">
                        <input type="number" step="0.01" min="0" max="100" class="form-control fw-bold text-dark" id="global_gst" name="gst_percentage" value="{{ $settings['gst_percentage'] }}" oninput="recalculateAllRows()">
                        <span class="input-group-text bg-light fw-bold">%</span>
                    </div>
                    <small class="text-muted" style="font-size: 11px;">Standard Healthcare GST (Default: 5%).</small>
                </div>

                <div class="col-md-4">
                    <label class="form-label small fw-bold text-dark mb-1">Default Others / Platform Fee (₹)</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light fw-bold">₹</span>
                        <input type="number" step="0.01" min="0" class="form-control fw-bold text-dark" id="global_platform" name="platform_fee" value="{{ $settings['platform_fee'] }}" oninput="recalculateAllRows()">
                    </div>
                    <small class="text-muted" style="font-size: 11px;">Standard "Others" additional service charge per booking.</small>
                </div>
            </div>
        </div>

        <!-- 2. Main Services Billing Table Card -->
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white mb-4">
            <div class="p-3 bg-light border-bottom d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="fw-bold mb-0 text-dark">
                        <i class="fas fa-stethoscope text-success me-1"></i> Service-Specific Rates & Charges
                    </h6>
                    <small class="text-muted">Set individual GST %, protocol fees, and consumables kit charges for each service.</small>
                </div>
                <span class="badge bg-white text-dark border px-3 py-1.5 fw-semibold" style="font-size: 12px;">
                    {{ count($services) }} Active Healthcare Services
                </span>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" id="servicesBillingTable">
                    <thead class="table-light">
                        <tr style="font-size: 12px;" class="text-muted text-uppercase">
                            <th style="width: 45px;">#</th>
                            <th style="min-width: 220px;">Healthcare Service</th>
                            <th style="width: 130px;">Base Fee</th>
                            <th style="width: 170px;">GST Rate</th>
                            <th style="width: 140px;">Others (Fee)</th>
                            <th style="width: 150px;">Extra Kit Fee</th>
                            <th style="min-width: 220px;">Kit Description / Surcharge</th>
                            <th style="width: 150px;" class="text-end">Customer Pays</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($services as $index => $svc)
                        @php
                            $effectiveGst = $svc->effective_gst_rate;
                            $effectivePlatform = $svc->effective_platform_fee;
                            $effectiveExtra = $svc->effective_extra_charges;
                            $taxable = $svc->price + $effectivePlatform + $effectiveExtra;
                            $gstAmt = ($effectiveGst > 0) ? round($taxable * ($effectiveGst / 100), 2) : 0;
                            $totalEst = round($taxable + $gstAmt, 2);
                        @endphp
                        <tr data-service-id="{{ $svc->id }}" data-base-price="{{ $svc->price }}">
                            <td>{{ $index + 1 }}</td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <img src="{{ $svc->image_url }}" alt="" class="rounded-2 border" style="width: 42px; height: 42px; object-fit: cover;">
                                    <div>
                                        <h6 class="fw-bold mb-0 text-dark" style="font-size: 13.5px;">{{ $svc->title }}</h6>
                                        <small class="text-muted">{{ $svc->duration ?: 'Standard Shift' }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <strong class="text-dark fs-6">₹{{ number_format($svc->price, 2) }}</strong>
                            </td>
                            <td>
                                <select name="services[{{ $svc->id }}][gst_rate]" class="form-select form-select-sm fw-bold row-gst-select" onchange="recalculateRow(this)">
                                    <option value="default" {{ ($svc->gst_rate === null && !$svc->gst_exempt) ? 'selected' : '' }}>
                                        Default ({{ $settings['gst_percentage'] }}%)
                                    </option>
                                    <option value="exempt" {{ $svc->gst_exempt ? 'selected' : '' }}>
                                        0% (Exempt)
                                    </option>
                                    <option value="5" {{ ($svc->gst_rate == 5.00 && !$svc->gst_exempt) ? 'selected' : '' }}>
                                        5% (Standard)
                                    </option>
                                    <option value="12" {{ ($svc->gst_rate == 12.00 && !$svc->gst_exempt) ? 'selected' : '' }}>
                                        12%
                                    </option>
                                    <option value="18" {{ ($svc->gst_rate == 18.00 && !$svc->gst_exempt) ? 'selected' : '' }}>
                                        18%
                                    </option>
                                </select>
                            </td>
                            <td>
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text bg-white">₹</span>
                                    <input type="number" step="0.01" min="0" name="services[{{ $svc->id }}][platform_fee]" 
                                           value="{{ $svc->platform_fee !== null ? $svc->platform_fee : '' }}" 
                                           placeholder="{{ number_format($settings['platform_fee'], 0) }}" 
                                           class="form-control fw-bold row-platform-input" oninput="recalculateRow(this)">
                                </div>
                            </td>
                            <td>
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text bg-white">₹</span>
                                    <input type="number" step="0.01" min="0" name="services[{{ $svc->id }}][extra_charges]" 
                                           value="{{ $svc->extra_charges > 0 ? $svc->extra_charges : '0' }}" 
                                           class="form-control fw-bold row-extra-input" oninput="recalculateRow(this)">
                                </div>
                            </td>
                            <td>
                                <input type="text" name="services[{{ $svc->id }}][extra_charges_label]" 
                                       value="{{ $svc->extra_charges_label }}" 
                                       placeholder="e.g. Consumables & PPE Kit" 
                                       class="form-control form-control-sm">
                            </td>
                            <td class="text-end">
                                <span class="badge bg-success-subtle text-success border border-success-subtle fs-6 px-2.5 py-1.5 fw-bold row-total-badge">
                                    ₹{{ number_format($totalEst, 2) }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-5 text-muted">No services found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Footer Save Actions -->
            <div class="p-3 bg-light border-top d-flex flex-wrap justify-content-between align-items-center gap-2">
                <span class="text-muted small">
                    <i class="fas fa-shield-alt text-success me-1"></i>
                    All changes update live in customer booking checkout and official Razorpay order generation.
                </span>
                <button type="submit" class="btn btn-success fw-bold px-4 py-2" style="background: #048444; border-color: #048444; border-radius: 8px;">
                    <i class="fas fa-save me-1"></i> Save All Changes
                </button>
            </div>
        </div>
    </form>
</div>

<script>
function getGlobalSettings() {
    const gstEnabled = document.getElementById('gst_enabled').checked;
    const globalGst = parseFloat(document.getElementById('global_gst').value) || 0;
    const globalPlatform = parseFloat(document.getElementById('global_platform').value) || 0;
    return { gstEnabled, globalGst, globalPlatform };
}

function recalculateRow(element) {
    const row = element.closest('tr');
    if (!row) return;

    const basePrice = parseFloat(row.getAttribute('data-base-price')) || 0;
    const { gstEnabled, globalGst, globalPlatform } = getGlobalSettings();

    const gstSelect = row.querySelector('.row-gst-select');
    let effectiveGst = globalGst;
    if (gstSelect.value === 'exempt') {
        effectiveGst = 0;
    } else if (gstSelect.value === 'default') {
        effectiveGst = gstEnabled ? globalGst : 0;
    } else {
        effectiveGst = parseFloat(gstSelect.value) || 0;
    }

    const platformInput = row.querySelector('.row-platform-input');
    const platformFee = (platformInput.value !== '') ? (parseFloat(platformInput.value) || 0) : globalPlatform;

    const extraInput = row.querySelector('.row-extra-input');
    const extraCharges = parseFloat(extraInput.value) || 0;

    const taxable = basePrice + platformFee + extraCharges;
    const gstAmount = (effectiveGst > 0) ? Math.round(taxable * (effectiveGst / 100) * 100) / 100 : 0;
    const totalPayable = Math.round((taxable + gstAmount) * 100) / 100;

    const totalBadge = row.querySelector('.row-total-badge');
    if (totalBadge) {
        totalBadge.innerText = '₹' + totalPayable.toFixed(2);
    }
}

function recalculateAllRows() {
    document.querySelectorAll('#servicesBillingTable tbody tr').forEach(row => {
        const select = row.querySelector('.row-gst-select');
        if (select) recalculateRow(select);
    });
}
</script>
@endsection
