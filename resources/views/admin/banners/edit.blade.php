@extends('layouts.app')

@section('content')
<div class="container-fluid" style="max-width: 850px;">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1" style="color: #048444;"><i class="fas fa-edit me-2"></i> Edit Homepage Banner</h3>
            <p class="text-muted small mb-0">Update banner image, title, and buttons.</p>
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
        <form action="{{ route('admin.banners.update', $banner->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row g-3">
                <div class="col-md-12">
                    <label class="form-label fw-bold">Current Banner Image</label>
                    <div class="mb-2">
                        <img src="{{ $banner->image_url }}" alt="Banner" style="max-height: 140px; width: auto; object-fit: cover; border-radius: 8px;" class="border">
                    </div>
                    <label class="form-label fw-bold">Replace Banner Image (Optional)</label>
                    <input type="file" name="image" accept="image/*" class="form-control">
                </div>

                <div class="col-md-12">
                    <label class="form-label fw-bold">Banner Title</label>
                    <input type="text" name="title" value="{{ old('title', $banner->title) }}" class="form-control">
                </div>

                <div class="col-md-12">
                    <label class="form-label fw-bold">Subtitle / Description</label>
                    <textarea name="subtitle" rows="3" class="form-control">{{ old('subtitle', $banner->subtitle) }}</textarea>
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-bold">Button Text</label>
                    <input type="text" name="button_text" value="{{ old('button_text', $banner->button_text) }}" class="form-control">
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-bold">Button Link URL</label>
                    <input type="text" name="button_link" value="{{ old('button_link', $banner->button_link) }}" class="form-control">
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-bold">Sort Order</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', $banner->sort_order) }}" min="0" class="form-control">
                </div>

                <div class="col-md-6 pt-md-4">
                    <div class="form-check form-switch mt-2">
                        <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" {{ $banner->is_active ? 'checked' : '' }}>
                        <label class="form-check-label fw-bold" for="is_active">Active (Visible in homepage slider)</label>
                    </div>
                </div>

                <div class="col-md-12 pt-3 border-top mt-4">
                    <button type="submit" class="btn btn-primary fw-bold px-4 py-2" style="background-color: #048444; border-color: #048444; border-radius: 8px;">
                        <i class="fas fa-save me-1"></i> Update Banner
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
