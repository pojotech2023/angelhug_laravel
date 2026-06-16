@extends('layouts.app')

@section('content')

<div class="container">
    <h3>Edit Notification</h3>

    <form action="{{ route('documents.update', $document->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Dropdown -->
        <label>Type</label>
        <select name="type" class="form-control" required>
            <option value="">-- Select --</option>
            <option value="career"   {{ $document->type == 'career' ? 'selected' : '' }}>Career</option>
            <option value="ranklist" {{ $document->type == 'ranklist' ? 'selected' : '' }}>Rank List</option>
            <option value="tender"   {{ $document->type == 'tender' ? 'selected' : '' }}>Tender</option>
        </select>

        <!-- Description -->
        <label class="mt-3">Description</label>
       
            <textarea name="description" id="summernote" class="summernote" rows="1" >   {!! $document->description !!}</textarea>
    
        </textarea>

        <!-- File -->
        <label class="mt-3">File Attachment</label>
        <input type="file" name="file" class="form-control">

        @if($document->file)
            <p class="mt-2">
                <strong>Current File:</strong>
                <a href="{{ asset('uploads/documents/'.$document->file) }}" target="_blank">
                    View File
                </a>
            </p>
        @endif

        <!-- Button Name -->
        <label class="mt-3">Button Name</label>
        <input type="text" class="form-control" name="button_name" value="{{ $document->button_name }}" required>

        <!-- Submit -->
        <button class="btn btn-primary mt-3">Update</button>
    </form>
</div>

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
