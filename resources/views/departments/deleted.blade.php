@extends('layouts.app')

@section('title', 'Deleted Departments')

@section('content')
<div class="container mt-5">
    <h2>Deleted Departments</h2>
    <a href="{{ route('departments.index') }}" class="btn btn-secondary mb-3">Back to Department List</a>

    @if(isset($deletedDepartments) && $deletedDepartments->isNotEmpty())
        <table class="table table-bordered table-hover">
            <thead class="table-secondary">
                <tr>
                    <th>Department ID</th>
                    <th>College Name</th>
                    <th>Department Name</th>
                    <th>Department Code</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($deletedDepartments as $department)
                    <tr>
                        <td>{{ $department->DepartmentID }}</td>
                        <td>{{ $department->college->CollegeName ?? 'N/A' }}</td>
                        <td>{{ $department->DepartmentName }}</td>
                        <td>{{ $department->DepartmentCode }}</td>
                        <td>
                            <form action="{{ route('departments.restore', $department->DepartmentID) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-success btn-sm">Restore</button>
                            </form>
                            <form action="{{ route('departments.forceDelete', $department->DepartmentID) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Permanently delete?')">Force Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="text-muted">No deleted departments found.</p>
    @endif
</div>
@endsection