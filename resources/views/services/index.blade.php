@extends('layouts.app')

@section('content')
<div class="container">
    <a href="{{ route('services.create') }}" class="btn btn-primary mb-3">Add Service</a>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>S.No</th>
                <th>Title</th>
                <th>Subtitle</th>
                <th>Images</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($services as $index => $service)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $service->title }}</td>
                    <td>{{ $service->subtitle }}</td>
                    <td>
                        @if($service->image)
                            <img src="{{ asset('storage/'.$service->image) }}" width="60" class="me-2 mb-2">
                        @endif

                       
                    </td>
                    <td>
                        <a href="{{ route('services.edit', $service->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('services.destroy', $service->id) }}" method="POST" style="display:inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No Services Found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
