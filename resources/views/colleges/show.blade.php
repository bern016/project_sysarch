@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Colleges</h1>

    <!-- Search Form -->
    <form action="{{ route('colleges.search') }}" method="GET" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search by College Name or Code" value="{{ request()->input('search') }}">
            <button class="btn btn-primary" type="submit">Search</button>
        </div>
    </form>

    <!-- College List -->
    <table class="table">
        <thead>
            <tr>
                <th>College Name</th>
                <th>College Code</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($colleges as $college)
                <tr>
                    <td>{{ $college->CollegeName }}</td>
                    <td>{{ $college->CollegeCode }}</td>
                    <td>{{ $college->IsActive ? 'Active' : 'Inactive' }}</td>
                    <td>
                        <a href="{{ route('colleges.show', $college) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('colleges.edit', $college) }}" class="btn btn-warning btn-sm">Edit</a>

                        <form action="{{ route('colleges.destroy', $college) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">No colleges found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="d-flex justify-content-between">
        <a href="{{ route('colleges.create') }}" class="btn btn-success">Add New College</a>
        {{ $colleges->links() }} 
    </div>
</div>
@endsection
