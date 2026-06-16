@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{ route('services.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="text" name="title" placeholder="Title" class="form-control mb-2">
        <input type="text" name="subtitle" placeholder="Subtitle" class="form-control mb-2">
        <textarea name="description" placeholder="Description" class="form-control mb-2"></textarea>
        <input type="date" name="date" class="form-control mb-2">
        <label>Single Image:</label>
        <input type="file" name="image" class="form-control mb-2">
        
        <input type="hidden" name="images[]" multiple class="form-control mb-2">

        <button class="btn btn-success">Save</button>
    </form>
</div>
@endsection
