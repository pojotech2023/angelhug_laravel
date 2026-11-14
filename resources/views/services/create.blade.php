@extends('layouts.app')

@section('content')
<div class="container-fluid" style="max-width: 900px;">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1" style="color: #048444;"><i class="fas fa-plus-circle me-2"></i> Add New Service</h3>
            <p class="text-muted small mb-0">Fill in the details below to publish a new healthcare service.</p>
        </div>
        <a href="{{ route('services.index') }}" class="btn btn-outline-secondary fw-bold">
            <i class="fas fa-arrow-left me-1"></i> Back to Services
        </a>
    </div>

    @if (isset($errors) && $errors->any())
        <div class="alert alert-danger alert-dismissible fade show">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card border-0 shadow-sm rounded-4 p-4">
        <form action="{{ route('services.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row g-3">
                <div class="col-md-12">
                    <label class="form-label fw-bold">Service Title <span class="text-danger">*</span></label>
                    <input type="text" name="title" value="{{ old('title') }}" placeholder="e.g. Post-Surgical Home Nursing Care" class="form-control" required>
                </div>

                <div class="col-md-12">
                    <label class="form-label fw-bold">Subtitle / Short Summary</label>
                    <input type="text" name="subtitle" value="{{ old('subtitle') }}" placeholder="e.g. Dedicated 24/7 post-operative monitoring by certified nurses" class="form-control">
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-bold">Service Price (₹) <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text">₹</span>
                        <input type="number" step="0.01" min="0" name="price" value="{{ old('price', '1499.00') }}" placeholder="0.00" class="form-control" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-bold">Duration</label>
                    <input type="text" name="duration" value="{{ old('duration', '60 Mins') }}" placeholder="e.g. 60 Mins, 2 Hours, Full Day" class="form-control">
                </div>

                <!-- Service-Specific GST, Platform & Extra Charges -->
                <div class="col-12">
                    <div class="p-3 rounded-3 border" style="background: #f8fafc; border-left: 4px solid #048444 !important;">
                        <h6 class="fw-bold mb-1 text-dark"><i class="fas fa-file-invoice-dollar text-success me-1"></i> Custom Service GST & Extra Charges</h6>
                        <small class="text-muted d-block mb-3">Override global billing rates for this specific healthcare service.</small>

                        <div class="row g-3">
                            <!-- GST Rate -->
                            <div class="col-md-4">
                                <label class="form-label fw-bold small text-dark">Service GST Rate (%)</label>
                                <div class="input-group input-group-sm">
                                    <input type="number" step="0.01" min="0" max="100" name="gst_rate" value="{{ old('gst_rate') }}" class="form-control" placeholder="Default (5%)">
                                    <span class="input-group-text">%</span>
                                </div>
                                <div class="form-check mt-1">
                                    <input class="form-check-input" type="checkbox" name="gst_exempt" id="gst_exempt" value="1" {{ old('gst_exempt') ? 'checked' : '' }}>
                                    <label class="form-check-label small text-muted" for="gst_exempt">Tax Exempt (0% GST)</label>
                                </div>
                            </div>

                            <!-- Platform Fee -->
                            <div class="col-md-4">
                                <label class="form-label fw-bold small text-dark">Platform / Protocol Fee (₹)</label>
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text">₹</span>
                                    <input type="number" step="0.01" min="0" name="platform_fee" value="{{ old('platform_fee') }}" class="form-control" placeholder="Default (₹99)">
                                </div>
                                <small class="text-muted d-block" style="font-size: 11px;">Leave empty to use global ₹99 fee.</small>
                            </div>

                            <!-- Extra Charges -->
                            <div class="col-md-4">
                                <label class="form-label fw-bold small text-dark">Extra Charges / Kit Fee (₹)</label>
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text">₹</span>
                                    <input type="number" step="0.01" min="0" name="extra_charges" value="{{ old('extra_charges', '0.00') }}" class="form-control" placeholder="0.00">
                                </div>
                                <small class="text-muted d-block" style="font-size: 11px;">e.g. ₹50 for dressing/PPE kit</small>
                            </div>

                            <div class="col-12 mt-1">
                                <label class="form-label fw-bold small text-dark">Extra Charges Custom Label (Optional)</label>
                                <input type="text" name="extra_charges_label" value="{{ old('extra_charges_label') }}" class="form-control form-control-sm" placeholder="e.g. Clinical Dressing & Antiseptic Consumables Kit">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <label class="form-label fw-bold">Full Description</label>
                    <textarea name="description" rows="5" placeholder="Detailed service description, patient prerequisites, inclusions, etc." class="form-control">{{ old('description') }}</textarea>
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-bold">Service Start / Publish Date</label>
                    <input type="date" name="date" value="{{ old('date', date('Y-m-d')) }}" class="form-control">
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-bold">Main Service Image</label>
                    <input type="file" name="image" accept="image/*" class="form-control">
                    <small class="text-muted">Recommended: JPG/PNG, 800x600px</small>
                </div>

                <div class="col-md-12">
                    <label class="form-label fw-bold">Additional Gallery Images</label>
                    <input type="file" name="images[]" multiple accept="image/*" class="form-control">
                    <small class="text-muted">Select multiple images to show in the service gallery</small>
                </div>

                <div class="col-md-12 pt-2">
                    <div class="form-check form-switch mb-2">
                        <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" checked>
                        <label class="form-check-label fw-bold" for="is_active">Publish Service (Visible to customers)</label>
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="featured" id="featured" value="1">
                        <label class="form-check-label fw-bold" for="featured">Featured Service (Show on Homepage)</label>
                    </div>
                </div>

                <div class="col-md-12 pt-3 border-top mt-4">
                    <button type="submit" class="btn btn-primary fw-bold px-4 py-2" style="background-color: #048444; border-color: #048444; border-radius: 8px;">
                        <i class="fas fa-save me-1"></i> Save Service
                    </button>
                    <a href="{{ route('services.index') }}" class="btn btn-outline-secondary px-4 py-2 ms-2">
                        Cancel
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
