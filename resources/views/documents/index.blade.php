@extends('layouts.app')

@section('content')

<div class="container">
  <div class="d-flex justify-content-end mb-3">
    <a href="{{ route('documents.create') }}" class="btn btn-success">Add New</a>
</div>


    <table class="table table-bordered">
        <tr>
            <th>S.No</th>
            <th>Page</th>
            <th>File</th>
            <th>Action</th>
        </tr>

        @foreach ($documents as $item)
        <tr>
            <td>{{$loop->iteration }}</td>
            <td>{{ $item->type }}</td>
            <td>
                @if($item->file)
                    <a href="{{ asset('uploads/documents/'.$item->file) }}" target="_blank">View</a>
                @endif
            </td>
            <td>
                <a href="{{ route('documents.edit',$item->id) }}" class="btn btn-warning btn-sm">Edit</a>

                <form action="{{ route('documents.destroy',$item->id) }}" method="POST" style="display:inline-block">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach

    </table>
</div>

@endsection
