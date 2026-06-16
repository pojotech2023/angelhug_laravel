@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{ route('services.update', $service->id) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        <input type="text" name="title" value="{{ $service->title }}" class="form-control mb-2">
        <input type="text" name="subtitle" value="{{ $service->subtitle }}" class="form-control mb-2">
        <textarea name="description" class="form-control mb-2">{{ $service->description }}</textarea>
        <input type="date" name="date" value="{{ $service->date }}" class="form-control mb-2">

        <label>Single Image:</label>
           @if($service->image)
                            <img src="{{ asset('storage/'.$service->image) }}" width="60" class="me-2 mb-2">
                        @endif

        <input type="file" name="image" class="form-control mb-2">

       
        <input type="hidden" name="images[]" multiple class="form-control mb-2">

        <button class="btn btn-success">Update</button>
    </form>
</div>
@endsection
