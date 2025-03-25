@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>College List</h2>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif


    <div class="mb-3 d-flex gap-2">
        <a href="{{ route('colleges.create') }}" class="btn btn-info text-white">Add College</a>
        <a href="{{ route('colleges.deleted') }}" class="btn btn-secondary">View Deleted Colleges</a>
    </div>
    

    @if($colleges->count() > 0)
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>College Name</th>
                    <th>College Code</th>
                    <th>Active</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($colleges as $college)
                <tr class="{{ $college->deleted_at ? 'table-danger' : '' }}">
                    <td>{{ $college->CollegeID }}</td>
                    <td>{{ $college->CollegeName }}</td>
                    <td>{{ $college->CollegeCode }}</td>
                    <td>{{ $college->IsActive ? 'Yes' : 'No' }}</td>
                    <td>
                        <a href="{{ route('colleges.show', $college->CollegeID) }}" class="btn btn-info btn-sm">View Departments</a>
                        <a href="{{ route('colleges.edit', $college->CollegeID) }}" class="btn btn-warning btn-sm">Edit</a>

                        <form action="{{ route('colleges.destroy', $college->CollegeID) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this college?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="text-muted">No colleges found.</p>
    @endif
</div>
@endsection
