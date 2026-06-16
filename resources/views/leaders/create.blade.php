@extends('layouts.app')

@section('content')

<div class="container">


   <h3>Add Leader</h3>

<form action="{{ route('leaders.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <label>Type</label>
    <select name="type" class="form-control">
        <option value="people">People</option>
        <option value="board_of_director">Board of Directors</option>
    </select>

    <label>Name</label>
    <input type="text" name="name" class="form-control">

    <label>Designation</label>
    <input type="text" name="designation" class="form-control">

    <label>Description</label>
    <textarea name="description" class="form-control" rows="4"></textarea>

    <label>Image</label>
    <input type="file" name="image" class="form-control">

    <button type="submit" class="btn btn-primary mt-3">Submit</button>
</form>

</div>

<!-- Summernote -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

<script>
    $('.summernote').summernote({
        height: 200
    });
</script>

@endsection
