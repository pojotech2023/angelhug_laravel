@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
        <div>
            <h3 class="fw-bold mb-1" style="color: #048444;"><i class="fas fa-images me-2"></i> Banner Management</h3>
            <p class="text-muted small mb-0">Manage homepage hero slider images, titles, and call-to-action buttons.</p>
        </div>
        <a href="{{ route('admin.banners.create') }}" class="btn btn-primary fw-bold px-3 py-2 shadow-sm" style="background-color: #048444; border-color: #048444; border-radius: 8px;">
            <i class="fas fa-plus me-1"></i> Add New Banner
        </a>
    </div>

    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th style="width: 60px;">#</th>
                        <th style="width: 140px;">Banner Image</th>
                        <th>Title & Subtitle</th>
                        <th>Button Text & Link</th>
                        <th>Sort Order</th>
                        <th>Status</th>
                        <th style="width: 130px;" class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($banners as $index => $banner)
                        <tr>
                            <td>{{ $banners->firstItem() + $index }}</td>
                            <td>
                                <img src="{{ $banner->image_url }}" alt="Banner" 
                                     style="width: 120px; height: 60px; object-fit: cover; border-radius: 8px;" class="border">
                            </td>
                            <td>
                                <h6 class="fw-bold mb-1" style="color: #048444;">{{ $banner->title ?: 'No Title' }}</h6>
                                <p class="text-muted small mb-0">{{ Str::limit($banner->subtitle, 65) }}</p>
                            </td>
                            <td>
                                @if($banner->button_text)
                                    <div><span class="badge bg-light text-dark border">{{ $banner->button_text }}</span></div>
                                    <small class="text-muted">{{ $banner->button_link ?: route('booking.create') }}</small>
                                @else
                                    <span class="text-muted small">Default Button</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge bg-secondary">{{ $banner->sort_order }}</span>
                            </td>
                            <td>
                                @if($banner->is_active)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-secondary">Inactive</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <a href="{{ route('admin.banners.edit', $banner->id) }}" class="btn btn-sm btn-outline-warning me-1" title="Edit Banner">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="button" class="btn btn-sm btn-outline-danger" title="Delete Banner" onclick="confirmDeleteBanner('{{ route('admin.banners.destroy', $banner->id) }}', '{{ addslashes($banner->title) }}')">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <i class="fas fa-images fs-2 mb-2 d-block"></i>
                                No banners found. Click "Add New Banner" to add one to the homepage slider.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($banners->hasPages())
        <div class="p-3 border-top d-flex justify-content-center">
            {{ $banners->links('pagination::bootstrap-5') }}
        </div>
        @endif
    </div>
</div>

<!-- Centered Delete Confirmation Modal -->
<div class="modal fade" id="deleteBannerModal" tabindex="-1" aria-labelledby="deleteBannerModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 440px;">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 20px; overflow: hidden;">
            <div class="modal-body p-4 text-center">
                <div class="mx-auto d-flex align-items-center justify-content-center mb-3" 
                     style="width: 72px; height: 72px; border-radius: 50%; background: #fee2e2; color: #dc2626; box-shadow: 0 4px 15px rgba(220, 38, 38, 0.15);">
                    <i class="fas fa-trash-alt" style="font-size: 28px;"></i>
                </div>
                <h4 class="fw-bold text-dark mb-2" id="deleteBannerModalTitle" style="font-size: 20px; letter-spacing: -0.3px;">Delete Banner?</h4>
                <p class="text-muted small mb-2" style="font-size: 13.5px; line-height: 1.5;">
                    Are you sure you want to permanently delete <strong class="text-dark d-block mt-1" id="deleteBannerTitle" style="font-size: 14px;"></strong>
                </p>
                <div class="alert alert-danger py-2 px-3 small border-0 mb-4 d-inline-flex align-items-center gap-2" style="background: #fef2f2; border-radius: 10px; font-size: 12px; color: #b91c1c;">
                    <i class="fas fa-exclamation-triangle"></i> This action cannot be reversed.
                </div>
                <div class="d-flex justify-content-center gap-2 pt-1">
                    <button type="button" class="btn btn-light px-4 py-2 fw-semibold text-secondary" data-bs-dismiss="modal" style="border-radius: 12px; font-size: 13.5px; min-width: 110px;">
                        Cancel
                    </button>
                    <form id="deleteBannerForm" action="" method="POST" class="m-0 p-0">
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
function confirmDeleteBanner(actionUrl, bannerTitle) {
    document.getElementById('deleteBannerForm').action = actionUrl;
    document.getElementById('deleteBannerTitle').textContent = `"${bannerTitle}"`;
    const modalEl = document.getElementById('deleteBannerModal');
    const deleteModal = new bootstrap.Modal(modalEl);
    deleteModal.show();
}
</script>
@endsection
