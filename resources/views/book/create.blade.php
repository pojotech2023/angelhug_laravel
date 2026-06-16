@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add New Book</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

<form action="{{ route('book.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="type" class="form-control" value="book">


        <div class="mb-3">
    <label>Book Title</label>
    <input type="text" name="title" class="form-control" required>
 </div>

        <div class="mb-3">
    <label>Author Name</label>
    <input type="text" name="author"  class="form-control"required>
 </div>

        <div class="mb-3">
    <label>Short Description</label>
    <textarea name="short_desc" class="form-control" required></textarea>
 </div>

        <div class="mb-3">
    <label>Long Description</label>
    <textarea name="long_desc" class="form-control"></textarea>

     </div>

        <div class="mb-3">
            <label>Book Cover Image</label>
    <input type="file" name="image" class="form-control" required>
 </div>

        <div class="mb-3">
    <label>Price</label>
    <input type="number" name="price" class="form-control" required>
</div>

        <div class="mb-3">
            <label>Sort Order</label>
            <input type="number" name="sort_order" class="form-control" value="0" min="0">
        </div>
        <button type="submit" class="btn btn-primary">Add Book</button>
    </form>
</div>
@endsection
