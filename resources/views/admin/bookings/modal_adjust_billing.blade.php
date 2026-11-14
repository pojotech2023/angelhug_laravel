<!-- Reusable Admin Modal: Adjust Extra Charges & GST with Live Preview -->
<div class="modal fade" id="adjustBillingModal" tabindex="-1" aria-labelledby="adjustBillingModalLabel" aria-hidden="true" style="z-index: 1060;">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 520px; z-index: 1065;">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden" style="background: #ffffff !important;">
            <div class="modal-header text-white" style="background: linear-gradient(135deg, #024724 0%, #048444 100%); padding: 18px 24px;">
                <div>
                    <h5 class="modal-title fw-bold text-white mb-0" id="adjustBillingModalLabel" style="font-size: 16.5px;">
                        <i class="fas fa-file-invoice-dollar text-warning me-2"></i> Adjust Extra Charges & GST
                    </h5>
                    <small class="text-white-50" id="modalBookingRef" style="font-size: 12px;">Booking Ref: #AH...</small>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <form id="adjustBillingForm" method="POST" action="">
                @csrf
                <div class="modal-body p-4">
                    <!-- Service & Customer Summary Strip -->
                    <div class="p-3 bg-light rounded-3 border mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-1.5">
                            <span class="text-muted small"><i class="fas fa-stethoscope text-success me-1"></i> Booked Service:</span>
                            <strong class="text-dark" id="modalServiceName" style="font-size: 13.5px;">Service</strong>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-muted small"><i class="fas fa-user text-primary me-1"></i> Customer / Patient:</span>
                            <strong class="text-dark" id="modalCustomerName" style="font-size: 13.5px;">Customer</strong>
                        </div>
                    </div>

                    <!-- 1. Extra Charges Input with Live GST Indicator -->
                    <div class="mb-3">
                        <label class="form-label fw-bold text-dark small mb-1">
                            <i class="fas fa-plus-circle text-success me-1"></i> Extra Charges / Kit Fee (₹)
                        </label>
                        <div class="input-group">
                            <span class="input-group-text bg-light fw-bold text-dark">₹</span>
                            <input type="number" step="0.01" min="0" class="form-control fw-bold text-dark" id="modal_extra_charges" name="extra_charges" value="0.00" placeholder="0.00" oninput="calculateModalBilling()">
                        </div>
                        
                        <!-- Live GST on Extra Fee Indicator Strip -->
                        <div class="d-flex justify-content-between align-items-center mt-1.5 p-2 rounded-2" style="background: #f0fdf4; border: 1px dashed #16a34a;">
                            <span class="small text-muted" style="font-size: 11.5px;">
                                <i class="fas fa-percentage text-success me-1"></i> GST on Extra (<span class="previewGstRate">5.0</span>%):
                                <strong class="text-success" id="extraGstAmountDisplay">+₹0.00</strong>
                            </span>
                            <span class="badge bg-success-subtle text-success border border-success fw-bold" style="font-size: 11px;">
                                Extra Total with GST: <span id="extraTotalWithGstDisplay">₹0.00</span>
                            </span>
                        </div>
                        <small class="text-muted d-block mt-1" style="font-size: 11px;">e.g. Consumables & PPE kit, night duty surcharge, emergency medical equipment</small>
                    </div>

                    <!-- 2. GST Rate Input with 5% Default & Presets -->
                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <label class="form-label fw-bold text-dark small mb-0">
                                <i class="fas fa-percent text-success me-1"></i> GST Tax Rate (%)
                            </label>
                            <span class="badge bg-light text-success border border-success fw-bold" style="font-size: 10px;">Default: 5%</span>
                        </div>
                        <div class="input-group mb-2">
                            <input type="number" step="0.01" min="0" max="100" class="form-control fw-bold text-dark" id="modal_gst_rate" name="gst_rate" value="5.0" required oninput="calculateModalBilling()">
                            <span class="input-group-text bg-light fw-bold">%</span>
                        </div>

                        <!-- One-click GST Preset Pills -->
                        <div class="d-flex gap-1.5 flex-wrap">
                            <button type="button" class="btn btn-sm btn-outline-secondary py-1 px-2.5 rounded-pill" style="font-size: 11px;" onclick="setModalGstRate(0)">0% (Exempt)</button>
                            <button type="button" class="btn btn-sm btn-success py-1 px-2.5 rounded-pill fw-bold" style="font-size: 11px; background: #048444; border-color: #048444;" onclick="setModalGstRate(5)">5% (Default)</button>
                            <button type="button" class="btn btn-sm btn-outline-secondary py-1 px-2.5 rounded-pill" style="font-size: 11px;" onclick="setModalGstRate(12)">12%</button>
                            <button type="button" class="btn btn-sm btn-outline-secondary py-1 px-2.5 rounded-pill" style="font-size: 11px;" onclick="setModalGstRate(18)">18%</button>
                        </div>
                    </div>

                    <!-- Base Care Fee & Platform Fee (Optional Adjustment) -->
                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="form-label text-muted small mb-1">Base Care Fee (₹)</label>
                            <input type="number" step="0.01" min="0" class="form-control form-control-sm bg-light" id="modal_base_fee" name="base_fee" value="0.00" oninput="calculateModalBilling()">
                        </div>
                        <div class="col-6">
                            <label class="form-label text-muted small mb-1">Protocol Fee (₹)</label>
                            <input type="number" step="0.01" min="0" class="form-control form-control-sm bg-light" id="modal_platform_fee" name="platform_fee" value="99.00" oninput="calculateModalBilling()">
                        </div>
                    </div>

                    <!-- Live Calculation Preview Card: Fully Itemized with Extra Fee GST -->
                    <div class="p-3 rounded-3 bg-light border">
                        <div class="d-flex justify-content-between small text-muted mb-1">
                            <span>Base Care & Protocol Subtotal:</span>
                            <span class="fw-bold text-dark" id="modalPreviewBaseProtocol">₹0.00</span>
                        </div>
                        <div class="d-flex justify-content-between small text-muted mb-1 ps-2">
                            <span><i class="fas fa-angle-right text-muted me-1"></i> GST on Service & Protocol (<span class="previewGstRate">5.0</span>%):</span>
                            <span class="fw-semibold text-dark" id="modalPreviewServiceGst">₹0.00</span>
                        </div>

                        <!-- Explicit Extra Fee & GST on Extra Fee -->
                        <div class="d-flex justify-content-between small text-muted mb-1 mt-2 pt-2 border-top">
                            <span><i class="fas fa-plus-circle text-success me-1"></i> Extra Charges / Kit Fee:</span>
                            <span class="fw-bold text-dark" id="modalPreviewExtraFee">₹0.00</span>
                        </div>
                        <div class="d-flex justify-content-between small text-muted mb-1 ps-2">
                            <span><i class="fas fa-angle-right text-success me-1"></i> <strong>+ GST on Extra Fee (<span class="previewGstRate">5.0</span>%):</strong></span>
                            <span class="fw-bold text-success" id="modalPreviewExtraGst">+₹0.00</span>
                        </div>
                        <div class="d-flex justify-content-between small text-muted mb-1 ps-2">
                            <span class="text-muted"><i class="fas fa-equals text-muted me-1"></i> Extra Charges Total (with GST):</span>
                            <span class="fw-bold text-primary" id="modalPreviewExtraWithGst">₹0.00</span>
                        </div>

                        <hr class="my-2" style="border-color: #cbd5e1;">

                        <div class="d-flex justify-content-between small text-muted mb-1">
                            <span>Total Combined GST (<span class="previewGstRate">5.0</span>%):</span>
                            <span class="fw-bold text-dark" id="modalPreviewTotalGst">₹0.00</span>
                        </div>

                        <div class="d-flex justify-content-between align-items-center pt-1">
                            <div>
                                <strong class="text-dark d-block" style="font-size: 13.5px;">Total Customer Payable:</strong>
                                <small class="text-muted" style="font-size: 10.5px;">(Service + Extra Charges + All Applicable GST)</small>
                            </div>
                            <span class="fs-4 fw-bold text-success" id="modalPreviewTotal">₹0.00</span>
                        </div>
                    </div>
                </div>

                <div class="modal-footer bg-light p-3 border-top">
                    <button type="button" class="btn btn-outline-secondary fw-bold rounded-pill px-3" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success fw-bold rounded-pill px-4 shadow-sm" style="background: #048444; border-color: #048444;">
                        <i class="fas fa-check-circle me-1"></i> Save Changes & Recalculate
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function openBillingModal(booking) {
    const form = document.getElementById('adjustBillingForm');
    form.action = '/admin/bookings/' + booking.id + '/billing';

    document.getElementById('modalBookingRef').innerText = 'Booking #' + booking.booking_number;
    document.getElementById('modalServiceName').innerText = booking.service_title || 'Healthcare Service';
    document.getElementById('modalCustomerName').innerText = booking.customer_name || 'Patient';

    document.getElementById('modal_extra_charges').value = booking.extra_charges !== undefined ? parseFloat(booking.extra_charges).toFixed(2) : '0.00';
    // Default 5% if not set or set to booking's rate
    document.getElementById('modal_gst_rate').value = (booking.gst_rate !== undefined && booking.gst_rate !== null) ? parseFloat(booking.gst_rate).toFixed(1) : '5.0';
    document.getElementById('modal_base_fee').value = booking.base_fee !== undefined ? parseFloat(booking.base_fee).toFixed(2) : '0.00';
    document.getElementById('modal_platform_fee').value = booking.platform_fee !== undefined ? parseFloat(booking.platform_fee).toFixed(2) : '99.00';

    calculateModalBilling();

    const modal = new bootstrap.Modal(document.getElementById('adjustBillingModal'));
    modal.show();
}

function setModalGstRate(rate) {
    document.getElementById('modal_gst_rate').value = rate;
    calculateModalBilling();
}

function calculateModalBilling() {
    const baseFee = parseFloat(document.getElementById('modal_base_fee').value) || 0;
    const platformFee = parseFloat(document.getElementById('modal_platform_fee').value) || 0;
    const extraCharges = parseFloat(document.getElementById('modal_extra_charges').value) || 0;
    const gstRate = parseFloat(document.getElementById('modal_gst_rate').value) || 0;

    // Service & Protocol portion
    const baseProtocolSubtotal = baseFee + platformFee;
    const serviceGst = Math.round(baseProtocolSubtotal * (gstRate / 100) * 100) / 100;

    // Extra Charges portion with GST
    const extraGst = Math.round(extraCharges * (gstRate / 100) * 100) / 100;
    const extraTotalWithGst = Math.round((extraCharges + extraGst) * 100) / 100;

    // Combined Totals
    const totalGst = Math.round((serviceGst + extraGst) * 100) / 100;
    const grandTotal = Math.round((baseProtocolSubtotal + serviceGst + extraTotalWithGst) * 100) / 100;

    // Update displays
    document.querySelectorAll('.previewGstRate').forEach(el => el.innerText = gstRate.toFixed(1));
    document.getElementById('extraGstAmountDisplay').innerText = '+₹' + extraGst.toFixed(2);
    document.getElementById('extraTotalWithGstDisplay').innerText = '₹' + extraTotalWithGst.toFixed(2);

    document.getElementById('modalPreviewBaseProtocol').innerText = '₹' + baseProtocolSubtotal.toFixed(2);
    document.getElementById('modalPreviewServiceGst').innerText = '₹' + serviceGst.toFixed(2);
    document.getElementById('modalPreviewExtraFee').innerText = '₹' + extraCharges.toFixed(2);
    document.getElementById('modalPreviewExtraGst').innerText = '+₹' + extraGst.toFixed(2);
    document.getElementById('modalPreviewExtraWithGst').innerText = '₹' + extraTotalWithGst.toFixed(2);

    document.getElementById('modalPreviewTotalGst').innerText = '₹' + totalGst.toFixed(2);
    document.getElementById('modalPreviewTotal').innerText = '₹' + grandTotal.toFixed(2);
}
</script>
