@extends('layouts.app')

@section('title', 'Department Details')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h2 class="mb-0">{{ $department->DepartmentName }}</h2>
            <span class="badge {{ $department->IsActive ? 'bg-success' : 'bg-danger' }}">
                {{ $department->IsActive ? 'Active' : 'Inactive' }}
            </span>
        </div>
        <div class="card-body">
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><strong>Department Code:</strong> {{ $department->DepartmentCode }}</li>
                <li class="list-group-item"><strong>College Name:</strong> {{ $department->college->CollegeName ?? 'N/A' }}</li>
            </ul>
        </div>
        <div class="card-footer d-flex justify-content-between">
            <a href="{{ route('departments.index') }}" class="btn btn-secondary">Back</a>
            <a href="{{ route('departments.edit', $department->DepartmentID) }}" class="btn btn-warning">Edit</a>
        </div>
    </div>
</div>
@endsection
