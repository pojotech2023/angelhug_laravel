@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
        <div>
            <h3 class="fw-bold mb-1" style="color: #048444;"><i class="fas fa-stethoscope me-2"></i> Service Management</h3>
            <p class="text-muted small mb-0">Create, edit, view, and manage healthcare and nursing services.</p>
        </div>
        <a href="{{ route('services.create') }}" class="btn btn-primary fw-bold px-3 py-2 shadow-sm" style="background-color: #048444; border-color: #048444; border-radius: 8px;">
            <i class="fas fa-plus me-1"></i> Add New Service
        </a>
    </div>

    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th style="width: 60px;">#</th>
                        <th style="width: 100px;">Image</th>
                        <th>Title & Subtitle</th>
                        <th>Price</th>
                        <th>Duration</th>
                        <th>Status</th>
                        <th style="width: 160px;" class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($services as $index => $service)
                        <tr>
                            <td>{{ $services->firstItem() + $index }}</td>
                            <td>
                                <img src="{{ $service->image_url }}" alt="{{ $service->title }}" 
                                     style="width: 75px; height: 55px; object-fit: cover; border-radius: 8px;" class="border">
                            </td>
                            <td>
                                <h6 class="fw-bold mb-1" style="color: #048444;">{{ $service->title }}</h6>
                                <p class="text-muted small mb-1">{{ Str::limit($service->subtitle, 65) }}</p>
                                @if($service->subServices->isNotEmpty())
                                    <span class="badge" style="background: #e8f7ee; color: #048444; border: 1px solid rgba(4, 132, 68, 0.25); font-size: 11px;">
                                        <i class="fas fa-layer-group me-1"></i> {{ $service->subServices->count() }} Care Plans
                                    </span>
                                @else
                                    <span class="badge bg-light text-muted border" style="font-size: 11px;">
                                        Standard Only
                                    </span>
                                @endif
                            </td>
                            <td>
                                <strong class="text-success fs-6">{{ $service->formatted_price }}</strong>
                                <div class="text-muted" style="font-size: 11px;">
                                    <span>GST: <strong>{{ $service->gst_exempt ? 'Exempt (0%)' : ($service->gst_rate !== null ? $service->gst_rate . '%' : 'Default') }}</strong></span>
                                    @if(!empty($service->extra_charges) && $service->extra_charges > 0)
                                        <span class="d-block text-purple">+₹{{ number_format($service->extra_charges, 0) }} kit</span>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-light text-dark border"><i class="far fa-clock me-1"></i> {{ $service->duration ?: '60 Mins' }}</span>
                            </td>
                            <td>
                                @if($service->is_active)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-secondary">Inactive</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <a href="{{ route('servicedetails', $service->id) }}" target="_blank" class="btn btn-sm btn-outline-info me-1" title="View on site">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('services.edit', $service->id) }}" class="btn btn-sm btn-outline-warning me-1" title="Edit Service">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="button" class="btn btn-sm btn-outline-danger" title="Delete Service" onclick="confirmDeleteService('{{ route('services.destroy', $service->id) }}', '{{ addslashes($service->title) }}')">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <i class="fas fa-stethoscope fs-2 mb-2 d-block"></i>
                                No services found. Click "Add New Service" to create one.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($services->hasPages())
        <div class="p-3 border-top d-flex justify-content-center">
            {{ $services->links('pagination::bootstrap-5') }}
        </div>
        @endif
    </div>
</div>

<!-- Centered Delete Confirmation Modal -->
<div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-labelledby="deleteModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 440px;">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 20px; overflow: hidden;">
            <div class="modal-body p-4 text-center">
                <div class="mx-auto d-flex align-items-center justify-content-center mb-3" 
                     style="width: 72px; height: 72px; border-radius: 50%; background: #fee2e2; color: #dc2626; box-shadow: 0 4px 15px rgba(220, 38, 38, 0.15);">
                    <i class="fas fa-trash-alt" style="font-size: 28px;"></i>
                </div>
                <h4 class="fw-bold text-dark mb-2" id="deleteModalTitle" style="font-size: 20px; letter-spacing: -0.3px;">Delete Service?</h4>
                <p class="text-muted small mb-2" style="font-size: 13.5px; line-height: 1.5;">
                    Are you sure you want to permanently delete <strong class="text-dark d-block mt-1" id="deleteServiceTitle" style="font-size: 14px;"></strong>
                </p>
                <div class="alert alert-danger py-2 px-3 small border-0 mb-4 d-inline-flex align-items-center gap-2" style="background: #fef2f2; border-radius: 10px; font-size: 12px; color: #b91c1c;">
                    <i class="fas fa-exclamation-triangle"></i> This action cannot be reversed.
                </div>
                <div class="d-flex justify-content-center gap-2 pt-1">
                    <button type="button" class="btn btn-light px-4 py-2 fw-semibold text-secondary" data-bs-dismiss="modal" style="border-radius: 12px; font-size: 13.5px; min-width: 110px;">
                        Cancel
                    </button>
                    <form id="deleteServiceForm" action="" method="POST" class="m-0 p-0">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger px-4 py-2 fw-bold text-white shadow-sm" style="border-radius: 12px; background: #dc2626; border-color: #dc2626; font-size: 13.5px; min-width: 130px;">
                            <i class="fas fa-trash-alt me-1"></i> Yes, Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function confirmDeleteService(actionUrl, serviceTitle) {
    document.getElementById('deleteServiceForm').action = actionUrl;
    document.getElementById('deleteServiceTitle').textContent = `"${serviceTitle}"`;
    const modalEl = document.getElementById('deleteConfirmModal');
    const deleteModal = new bootstrap.Modal(modalEl);
    deleteModal.show();
}
</script>
@endsection
