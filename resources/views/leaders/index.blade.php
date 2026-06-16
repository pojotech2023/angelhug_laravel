@extends('layouts.app')

@section('content')

<div class="container">
     <div class="d-flex justify-content-end mb-3">
    <a href="{{ route('leaders.create') }}" class="btn btn-success mb-3">Add New</a>
</div>
    <table class="table table-bordered">
        <tr>
            <th>S.No</th>
            <th>Page</th>
            <th>File</th>
            <th>Action</th>
        </tr>

        @foreach ($leaders as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td> @if($item->type == 'board_of_director')
        Board of Directors
    @elseif($item->type == 'people')
        People
    @else
        {{ ucfirst($item->type) }}
    @endif</td>
            <td>
                @if($item->image)
                    <img src="{{ asset('storage/'.$item->image) }}" style="height:100px;width:100px">
                @endif
            </td>
            <td>
                <a href="{{ route('leaders.edit',$item->id) }}" class="btn btn-warning btn-sm">Edit</a>

                <form action="{{ route('leaders.destroy',$item->id) }}" method="POST" style="display:inline-block">
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
