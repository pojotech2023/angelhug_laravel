@extends('layouts.app')

@section('content')
<style>
    .course-page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 16px;
        margin-bottom: 18px;
    }

    .add-course-btn {
        background: linear-gradient(135deg, #048444 0%, #156d97 100%);
        border: 0;
        color: #fff !important;
        border-radius: 12px;
        padding: 10px 18px;
        font-weight: 700;
        box-shadow: 0 12px 24px rgba(11, 79, 116, 0.18);
    }

    .add-course-btn:hover {
        color: #fff !important;
        filter: brightness(1.03);
    }

    .course-actions {
        display: flex;
        align-items: center;
        gap: 8px;
        white-space: nowrap;
    }

	    .course-actions form {
	        margin: 0;
	    }

	    .pagination-wrap {
	        display: flex;
	        justify-content: center;
	        margin-top: 20px;
	    }

	</style>

<div class="container">
    <div class="course-page-header">
        <h2 class="mb-0">Courses List</h2>
        <a href="{{ route('courses.create') }}" class="btn add-course-btn">Add Course</a>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Image</th>
                <th>Title</th>
                <th>Class</th>
                <th>Price</th>
                <th>Short Description</th>
                <th>Sort Order</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
            @foreach($courses as $course)
            <tr>
                <td><img src="{{ asset($course->image) }}" width="80"></td>
                <td>{{ $course->title }}</td>
                <td>{{ $course->class_name }}</td>
                <td>₹{{ $course->price }}</td>
                <td>{{ $course->short_desc }}</td>
                <td>{{ $course->sort_order }}</td>
                <td>
                    <div class="course-actions">
                    <a href="{{ route('courses.edit', $course->id) }}" class="btn btn-sm btn-warning">Edit</a>

                    <form action="{{ route('courses.destroy', $course->id) }}" method="POST" style="display:inline-block">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Delete course?')" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                    </div>
                </td>

            </tr>
            @endforeach
        </tbody>
	    </table>
	    <div class="pagination-wrap">
	        {{ $courses->links() }}
	    </div>
	</div>
	@endsection
