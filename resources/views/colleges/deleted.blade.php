@extends('layouts.app')

@section('title', 'Deleted Colleges')

@section('content')
<div class="container mt-5">
    <h2>Deleted Colleges</h2>
    <a href="{{ route('colleges.index') }}" class="btn btn-secondary mb-3">Back to College List</a>

    @if($deletedColleges->isNotEmpty()) 
        <table class="table table-bordered table-hover">
            <thead class="table-secondary">
                <tr>
                    <th>College ID</th>
                    <th>College Name</th>
                    <th>College Code</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($deletedColleges as $college)
                    <tr>
                        <td>{{ $college->CollegeID }}</td>
                        <td>{{ $college->CollegeName }}</td>
                        <td>{{ $college->CollegeCode }}</td>
                        <td>
                           
                            <form action="{{ route('colleges.restore', $college->CollegeID) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-success btn-sm">Restore</button>
                            </form>

                          
                            <form action="{{ route('colleges.forceDelete', $college->CollegeID) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Permanently delete this college? This action cannot be undone!')">
                                    Force Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="text-muted">No deleted colleges found.</p>
    @endif
</div>
@endsection
