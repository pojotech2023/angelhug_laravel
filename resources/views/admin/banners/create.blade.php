@extends('layouts.app')

@section('content')
<div class="container-fluid" style="max-width: 850px;">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1" style="color: #048444;"><i class="fas fa-plus-circle me-2"></i> Add Homepage Banner</h3>
            <p class="text-muted small mb-0">Upload a hero slider banner image with custom title and link.</p>
        </div>
        <a href="{{ route('admin.banners.index') }}" class="btn btn-outline-secondary fw-bold">
            <i class="fas fa-arrow-left me-1"></i> Back to Banners
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
        <form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row g-3">
                <div class="col-md-12">
                    <label class="form-label fw-bold">Banner Image <span class="text-danger">*</span></label>
                    <input type="file" name="image" accept="image/*" class="form-control" required>
                    <small class="text-muted">Recommended: High-resolution landscape image (1920x800px or 1600x700px)</small>
                </div>

                <div class="col-md-12">
                    <label class="form-label fw-bold">Banner Title</label>
                    <input type="text" name="title" value="{{ old('title') }}" placeholder="e.g. Compassionate Healthcare & In-Home Nursing Support" class="form-control">
                </div>

                <div class="col-md-12">
                    <label class="form-label fw-bold">Subtitle / Description</label>
                    <textarea name="subtitle" rows="3" placeholder="Short description displayed on top of the slide..." class="form-control">{{ old('subtitle') }}</textarea>
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-bold">Button Text</label>
                    <input type="text" name="button_text" value="{{ old('button_text', 'Book Service Now') }}" placeholder="e.g. Book Service Now" class="form-control">
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-bold">Button Link URL</label>
                    <input type="text" name="button_link" value="{{ old('button_link', '/booking') }}" placeholder="e.g. /booking or /service" class="form-control">
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-bold">Sort Order</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', 1) }}" min="0" class="form-control">
                    <small class="text-muted">Lower numbers appear first in the slider sequence</small>
                </div>

                <div class="col-md-6 pt-md-4">
                    <div class="form-check form-switch mt-2">
                        <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" checked>
                        <label class="form-check-label fw-bold" for="is_active">Active (Visible in homepage slider)</label>
                    </div>
                </div>

                <div class="col-md-12 pt-3 border-top mt-4">
                    <button type="submit" class="btn btn-primary fw-bold px-4 py-2" style="background-color: #048444; border-color: #048444; border-radius: 8px;">
                        <i class="fas fa-save me-1"></i> Save Banner
                    </button>
                    <a href="{{ route('admin.banners.index') }}" class="btn btn-outline-secondary px-4 py-2 ms-2">
                        Cancel
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
