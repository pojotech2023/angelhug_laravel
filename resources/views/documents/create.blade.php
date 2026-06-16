@extends('layouts.app')

@section('content')

<div class="container">
    <h3>Add Notification</h3>

    <form action="{{ route('documents.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <label>Type</label>
        <select name="type" class="form-control" required>
            <option value="">-- Select --</option>
            <option value="career">Career</option>
            <option value="ranklist">Rank List</option>
            <option value="tender">Tenders</option>
        </select>

        <label class="mt-3">Description</label>
        <textarea class="summernote" name="description" required></textarea>

        <label class="mt-3">File Attachment</label>
        <input type="file" name="file" class="form-control">
        <label class="mt-3">Button Name</label>
         <input type="text" name="button_name" class="form-control" required>

         
        <button class="btn btn-primary mt-3">Submit</button>
    </form>
</div>

<!-- Summernote -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.summernote').summernote({
                height:100
                
				
            });
        });
    </script>

@endsection
