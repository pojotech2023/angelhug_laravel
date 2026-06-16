@extends('layouts.app')

@section('content')

<div class="container">
    

   <h3>Edit Leader</h3>

<form action="{{ route('leaders.update', $leader->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <label>Type</label>
    <select name="type" class="form-control">
        <option value="people" {{ $leader->type=='people'?'selected':'' }}>People</option>
        <option value="board_of_director" {{ $leader->type=='board_of_director'?'selected':'' }}>Board of Directors</option>
    </select>

    <label>Name</label>
    <input type="text" name="name" value="{{ $leader->name }}" class="form-control">

    <label>Designation</label>
    <input type="text" name="designation" value="{{ $leader->designation }}" class="form-control">

    <label>Description</label>
    <textarea name="description" class="form-control" rows="4">{{ $leader->description }}</textarea>

    <label>Image</label>
    <input type="file" name="image" class="form-control">

    @if($leader->image)
        <img src="{{ asset('storage/'.$leader->image) }}" width="100" class="mt-2">
    @endif
</br>

    <button type="submit" class="btn btn-primary mt-3" stlye="float:right">Update</button>
</form>
</div>

 
@endsection
