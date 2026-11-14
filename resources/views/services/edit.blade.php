@extends('layouts.app')

@section('content')
<div class="container-fluid" style="max-width: 900px;">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1" style="color: #048444;"><i class="fas fa-edit me-2"></i> Edit Service</h3>
            <p class="text-muted small mb-0">Update service information, pricing, duration, and images.</p>
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
        <form action="{{ route('services.update', $service->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row g-3">
                <div class="col-md-12">
                    <label class="form-label fw-bold">Service Title <span class="text-danger">*</span></label>
                    <input type="text" name="title" value="{{ old('title', $service->title) }}" class="form-control" required>
                </div>

                <div class="col-md-12">
                    <label class="form-label fw-bold">Subtitle / Short Summary</label>
                    <input type="text" name="subtitle" value="{{ old('subtitle', $service->subtitle) }}" class="form-control">
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-bold">Service Price (₹) <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text">₹</span>
                        <input type="number" step="0.01" min="0" name="price" value="{{ old('price', $service->price) }}" class="form-control" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-bold">Duration</label>
                    <input type="text" name="duration" value="{{ old('duration', $service->duration) }}" placeholder="e.g. 60 Mins, 2 Hours" class="form-control">
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
                                    <input type="number" step="0.01" min="0" max="100" name="gst_rate" value="{{ old('gst_rate', $service->gst_rate) }}" class="form-control" placeholder="Default (5%)">
                                    <span class="input-group-text">%</span>
                                </div>
                                <div class="form-check mt-1">
                                    <input class="form-check-input" type="checkbox" name="gst_exempt" id="gst_exempt" value="1" {{ old('gst_exempt', $service->gst_exempt) ? 'checked' : '' }}>
                                    <label class="form-check-label small text-muted" for="gst_exempt">Tax Exempt (0% GST)</label>
                                </div>
                            </div>

                            <!-- Platform Fee -->
                            <div class="col-md-4">
                                <label class="form-label fw-bold small text-dark">Platform / Protocol Fee (₹)</label>
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text">₹</span>
                                    <input type="number" step="0.01" min="0" name="platform_fee" value="{{ old('platform_fee', $service->platform_fee) }}" class="form-control" placeholder="Default (₹99)">
                                </div>
                                <small class="text-muted d-block" style="font-size: 11px;">Leave empty to use global ₹99 fee.</small>
                            </div>

                            <!-- Extra Charges -->
                            <div class="col-md-4">
                                <label class="form-label fw-bold small text-dark">Extra Charges / Kit Fee (₹)</label>
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text">₹</span>
                                    <input type="number" step="0.01" min="0" name="extra_charges" value="{{ old('extra_charges', $service->extra_charges ?? 0) }}" class="form-control" placeholder="0.00">
                                </div>
                                <small class="text-muted d-block" style="font-size: 11px;">e.g. ₹50 for dressing/PPE kit</small>
                            </div>

                            <div class="col-12 mt-1">
                                <label class="form-label fw-bold small text-dark">Extra Charges Custom Label (Optional)</label>
                                <input type="text" name="extra_charges_label" value="{{ old('extra_charges_label', $service->extra_charges_label) }}" class="form-control form-control-sm" placeholder="e.g. Clinical Dressing & Antiseptic Consumables Kit">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <label class="form-label fw-bold">Full Description</label>
                    <textarea name="description" rows="5" class="form-control">{{ old('description', $service->description) }}</textarea>
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-bold">Date</label>
                    <input type="date" name="date" value="{{ old('date', $service->date ? \Carbon\Carbon::parse($service->date)->format('Y-m-d') : '') }}" class="form-control">
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-bold">Replace Main Image</label>
                    @if($service->image)
                        <div class="mb-2">
                            <img src="{{ $service->image_url }}" alt="Current Image" style="height: 60px; object-fit: cover; border-radius: 6px;" class="border">
                            <small class="text-muted ms-2">Current Image</small>
                        </div>
                    @endif
                    <input type="file" name="image" accept="image/*" class="form-control">
                </div>

                <div class="col-md-12">
                    <label class="form-label fw-bold">Additional Gallery Images</label>
                    @if(!empty($service->gallery_urls))
                        <div class="d-flex gap-2 mb-2 flex-wrap align-items-center">
                            @foreach($service->gallery_urls as $url)
                                <div class="position-relative">
                                    <img src="{{ $url }}" style="width: 64px; height: 64px; object-fit: cover; border-radius: 8px;" class="border shadow-sm" alt="Gallery Image">
                                </div>
                            @endforeach
                        </div>
                    @endif
                    <input type="file" name="images[]" multiple accept="image/*" class="form-control">
                    <small class="text-muted">Upload additional equipment, nurse, or clinical care photos for this service.</small>
                </div>

                <div class="col-md-12 pt-2">
                    <div class="form-check form-switch mb-2">
                        <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" {{ $service->is_active ? 'checked' : '' }}>
                        <label class="form-check-label fw-bold" for="is_active">Publish Service (Visible to customers)</label>
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="featured" id="featured" value="1" {{ $service->featured ? 'checked' : '' }}>
                        <label class="form-check-label fw-bold" for="featured">Featured Service (Show on Homepage)</label>
                    </div>
                </div>

                <div class="col-md-12 pt-3 border-top mt-4">
                    <button type="submit" class="btn btn-primary fw-bold px-4 py-2" style="background-color: #048444; border-color: #048444; border-radius: 8px;">
                        <i class="fas fa-save me-1"></i> Update Service
                    </button>
                    <a href="{{ route('services.index') }}" class="btn btn-outline-secondary px-4 py-2 ms-2">
                        Cancel
                    </a>
                </div>
            </div>
        </form>
    </div>

    <!-- Specialized Care Plans / Sub-Services Management Card -->
    <div class="card border-0 shadow-sm rounded-4 p-4 mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
            <div>
                <h5 class="fw-bold mb-1" style="color: #048444;">
                    <i class="fas fa-layer-group me-2"></i> Specialized Care Plans & Sub-Services
                </h5>
                <p class="text-muted small mb-0">
                    Add specific packages (e.g. "Post Hospitalization Recovery", "Cancer & Palliative Care") with custom checklists and pricing.
                </p>
            </div>
            <button type="button" class="btn btn-success fw-bold px-3 py-2 shadow-sm" style="background-color: #048444; border-color: #048444; border-radius: 8px;" data-bs-toggle="modal" data-bs-target="#addSubServiceModal">
                <i class="fas fa-plus me-1"></i> Add Care Plan / Sub-Service
            </button>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show rounded-3 shadow-sm mb-3">
                <i class="fas fa-check-circle me-1"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th style="width: 50px;">#</th>
                        <th>Care Plan Title</th>
                        <th>Starting Price</th>
                        <th>Duration / Shift</th>
                        <th>Inclusions / Duties</th>
                        <th>Status</th>
                        <th style="width: 140px;" class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($service->allSubServices as $index => $sub)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <strong class="text-dark d-block">{{ $sub->title }}</strong>
                            @if($sub->subtitle)
                                <small class="text-muted">{{ Str::limit($sub->subtitle, 45) }}</small>
                            @endif
                        </td>
                        <td>
                            <strong class="text-success">{{ $sub->formatted_price }}</strong>
                        </td>
                        <td>
                            <span class="badge bg-light text-dark border">{{ $sub->duration ?: '12 Hours' }}</span>
                        </td>
                        <td>
                            <span class="badge" style="background: #e8f7ee; color: #048444; border: 1px solid rgba(4,132,68,0.25);">
                                <i class="fas fa-tasks me-1"></i> {{ count($sub->features_list) }} tasks
                            </span>
                        </td>
                        <td>
                            @if($sub->is_active)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-secondary">Inactive</span>
                            @endif
                        </td>
                        <td class="text-end">
                            <button type="button" class="btn btn-sm btn-outline-warning me-1" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#editSubModal{{ $sub->id }}" 
                                    title="Edit Plan">
                                <i class="fas fa-edit"></i>
                            </button>
                            <form action="{{ route('admin.sub_services.destroy', $sub->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this care plan?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete Plan">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>

                    <!-- Edit Sub-Service Modal -->
                    <div class="modal fade" id="editSubModal{{ $sub->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" style="max-width: 580px;">
                            <div class="modal-content rounded-4 border-0 shadow">
                                <form action="{{ route('admin.sub_services.update', $sub->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header border-bottom">
                                        <h5 class="modal-title fw-bold text-dark"><i class="fas fa-edit text-success me-1"></i> Edit Care Plan: {{ $sub->title }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body p-4">
                                        <div class="mb-3">
                                            <label class="form-label fw-bold small">Plan Title <span class="text-danger">*</span></label>
                                            <input type="text" name="title" class="form-control" value="{{ $sub->title }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label fw-bold small">Subtitle / Brief</label>
                                            <input type="text" name="subtitle" class="form-control" value="{{ $sub->subtitle }}">
                                        </div>
                                        <div class="row g-2 mb-3">
                                            <div class="col-6">
                                                <label class="form-label fw-bold small">Price (₹) <span class="text-danger">*</span></label>
                                                <input type="number" step="0.01" min="0" name="price" class="form-control" value="{{ $sub->price }}" required>
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label fw-bold small">Duration / Shift</label>
                                                <input type="text" name="duration" class="form-control" value="{{ $sub->duration }}">
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label fw-bold small">Included Duties / Features (One per line)</label>
                                            <textarea name="features" rows="5" class="form-control" placeholder="Basic Bathroom Support&#10;Diaper change&#10;Vitals Monitoring...">{{ implode("\n", $sub->features_list) }}</textarea>
                                            <small class="text-muted" style="font-size: 11px;">Enter each task or clinical inclusion on a new line.</small>
                                        </div>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" name="is_active" id="sub_active_{{ $sub->id }}" value="1" {{ $sub->is_active ? 'checked' : '' }}>
                                            <label class="form-check-label fw-bold small" for="sub_active_{{ $sub->id }}">Active & Visible</label>
                                        </div>
                                    </div>
                                    <div class="modal-footer border-top">
                                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary fw-bold" style="background-color: #048444; border-color: #048444;">Save Changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-4 text-muted">
                            <i class="fas fa-layer-group fs-3 mb-2 d-block text-secondary"></i>
                            No specialized sub-services added yet for this service. Click "Add Care Plan / Sub-Service" above.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add Sub-Service Modal -->
<div class="modal fade" id="addSubServiceModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 580px;">
        <div class="modal-content rounded-4 border-0 shadow">
            <form action="{{ route('admin.sub_services.store', $service->id) }}" method="POST">
                @csrf
                <div class="modal-header border-bottom">
                    <h5 class="modal-title fw-bold text-dark"><i class="fas fa-plus-circle text-success me-1"></i> Add Care Plan / Sub-Service</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-bold small">Plan Title <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control" placeholder="e.g. Post hospitalization recovery" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold small">Subtitle / Brief Description</label>
                        <input type="text" name="subtitle" class="form-control" placeholder="e.g. Explore care, support & benefits">
                    </div>
                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="form-label fw-bold small">Starting Price (₹) <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" min="0" name="price" class="form-control" placeholder="700.00" required>
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-bold small">Duration / Shift</label>
                            <input type="text" name="duration" class="form-control" placeholder="e.g. 12 Hours Shift">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold small">Included Duties & Clinical Tasks (One per line)</label>
                        <textarea name="features" rows="5" class="form-control" placeholder="Basic Bathroom Support&#10;Diaper change&#10;Serving meals&#10;Medicine arrangement&#10;Basic Vitals Monitoring..."></textarea>
                        <small class="text-muted" style="font-size: 11px;">Enter each task or inclusion on a new line.</small>
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="is_active" id="new_sub_active" value="1" checked>
                        <label class="form-check-label fw-bold small" for="new_sub_active">Active & Visible</label>
                    </div>
                </div>
                <div class="modal-footer border-top">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary fw-bold" style="background-color: #048444; border-color: #048444;">Add Care Plan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
