@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add New Course</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('courses.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Course Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Class Name</label>
            <input type="text" name="class_name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Short Description</label>
            <textarea name="short_desc" class="form-control" required></textarea>
        </div>

        <div class="mb-3">
            <label>Long Description</label>
            <textarea name="long_desc" class="form-control" rows="5" required></textarea>
        </div>

        <div class="mb-3">
            <label>Price</label>
            <input type="number" name="price" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Course Image</label>
            <input type="file" name="image" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Duration (in days)</label>
            <input type="number" name="duration" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Language</label>
            <input type="text" name="language" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Certifications</label>
            <input type="text" name="certifications" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Mode</label>
            <select name="mode" class="form-control" required>
                <option value="Online">Online</option>
                <option value="Offline">Offline</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Sort Order</label>
            <input type="number" name="sort_order" class="form-control" value="0" min="0">
        </div>
        <button type="submit" class="btn btn-primary">Add Course</button>
    </form>
</div>
@endsection
