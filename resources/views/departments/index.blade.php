@extends('layouts.app')

@section('title', 'Departments')

@section('content')
<div class="container mt-5">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Department List</h2>
        <div>
            <a href="{{ route('departments.create') }}" class="btn btn-info text-white">Add Department</a>
            <a href="{{ route('departments.deleted') }}" class="btn btn-danger">View Deleted Departments</a>      
        </div>
    </div>
    


    <div class="card">
        <div class="card-body">
            @if($departments->count() > 0)
                <table class="table table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Department ID</th>
                            <th>College Name</th>
                            <th>Department Name</th>
                            <th>Department Code</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($departments as $department)
                            <tr>
                                <td>{{ $department->DepartmentID }}</td>
                                <td>{{ $department->college->CollegeName ?? 'N/A' }}</td>
                                <td>{{ $department->DepartmentName }}</td>
                                <td>{{ $department->DepartmentCode }}</td>
                                <td>
                                    <span class="badge {{ $department->IsActive ? 'bg-success' : 'bg-danger' }}">
                                        {{ $department->IsActive ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('departments.edit', $department->DepartmentID) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('departments.destroy', $department->DepartmentID) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-center">No departments found.</p>
            @endif
        </div>
    </div>
</div>
@endsection
