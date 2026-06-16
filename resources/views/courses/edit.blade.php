@extends('layouts.app')

@section('content')
    <h2>Edit Course</h2>

    <form action="{{ route('courses.update', $course->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Course Title</label>
            <input type="text" name="title" class="form-control" value="{{ $course->title }}" required>
        </div>

        <div class="mb-3">
            <label>Class Name</label>
            <input type="text" name="class_name" class="form-control" value="{{ $course->class_name }}" required>
        </div>

        <div class="mb-3">
            <label>Short Description</label>
            <textarea name="short_desc" class="form-control">{{ $course->short_desc }}</textarea>
        </div>

        <div class="mb-3">
            <label>Long Description</label>
            <textarea name="long_desc" class="form-control" rows="5">{{ $course->long_desc }}</textarea>
        </div>

        <div class="mb-3">
            <label>Price</label>
            <input type="number" name="price" class="form-control" value="{{ $course->price }}" required>
        </div>

        <div class="mb-3">
            <label>Duration (in days)</label>
            <input type="number" name="duration" class="form-control" value="{{ $course->duration }}" required>
        </div>

        <div class="mb-3">
            <label>Language</label>
            <input type="text" name="language" class="form-control" value="{{ $course->language }}" required>
        </div>

        <div class="mb-3">
            <label>Certifications</label>
            <input type="text" name="certifications" class="form-control" value="{{ $course->certifications }}" required>
        </div>

        <div class="mb-3">
            <label>Mode</label>
            <select name="mode" class="form-control" required>
                <option value="Online" {{ $course->mode == 'Online' ? 'selected' : '' }}>Online</option>
                <option value="Offline" {{ $course->mode == 'Offline' ? 'selected' : '' }}>Offline</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Sort Order</label>
            <input type="number" name="sort_order" class="form-control" value="{{ $course->sort_order ?? 0 }}" min="0">
        </div>

        <div class="mb-3">
            <label>Current Image</label><br>
            <img src="{{ asset($course->image) }}" width="150" class="mb-2"><br>
            <input type="file" name="image" class="form-control">
            <small>Leave empty to keep old image</small>
        </div>

        <button type="submit" class="btn btn-success">Update Course</button>
    </form>
</div>
@endsection
