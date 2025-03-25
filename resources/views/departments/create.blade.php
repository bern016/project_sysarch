@extends('layouts.app')

@section('title', 'Create Department')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h2 class="mb-0">Create Department</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('departments.store') }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label class="form-label">College:</label>
                    <select name="CollegeID" class="form-select" required>
                        @foreach($colleges as $college)
                            <option value="{{ $college->CollegeID }}">{{ $college->CollegeName }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Department Name:</label>
                    <input type="text" name="DepartmentName" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Department Code:</label>
                    <input type="text" name="DepartmentCode" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Active:</label>
                    <select name="IsActive" class="form-select" required>
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-success">Create</button>
                    <a href="{{ route('departments.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
