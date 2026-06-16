@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Book</h2>

    <form action="{{ route('book.update') }}" method="POST" enctype="multipart/form-data">
    @csrf

<input type="hidden" name="id" value="{{ $book->id }}">

        <div class="mb-3">
    <label>Title</label>
    <input type="text" name="title" class="form-control" value="{{ $book->title }}" required>
</div>

      
    <label>Author</label>
    <input type="text" name="author" class="form-control" value="{{ $book->author }}" required>


    <label>Short Description</label>
    <textarea name="short_desc" class="form-control" required>{{ $book->short_desc }}</textarea>


      
    <label>Long Description</label>
    <textarea name="long_desc" class="form-control">{{ $book->long_desc }}</textarea>


    <label>Price</label>
    <input type="text" name="price" value="{{ $book->price }}" class="form-control" required>

    <div class="mb-3">
        <label>Sort Order</label>
        <input type="number" name="sort_order" class="form-control" value="{{ $book->sort_order ?? 0 }}" min="0">
    </div>

    <div class="mb-3">
        <label>Current Image</label><br>
        <img src="{{ asset($book->image) }}" width="120"><br>
        <input type="file" name="image" class="form-control">
    </div>

    <button type="submit" class="btn btn-primary">Update</button>

</form>
</div>
@endsection
