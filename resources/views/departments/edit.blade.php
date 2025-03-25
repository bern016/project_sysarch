@extends('layouts.app')

@section('title', 'Edit Department')

@section('content')
    <div class="card">
        <div class="card-header bg-warning text-dark">Edit Department</div>
        <div class="card-body">
            <form action="{{ route('departments.update', $department->DepartmentID) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">College</label>
                    <select name="CollegeID" class="form-select" required>
                        @foreach($colleges as $college)
                            <option value="{{ $college->CollegeID }}" {{ $department->CollegeID == $college->CollegeID ? 'selected' : '' }}>
                                {{ $college->CollegeName }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Department Name</label>
                    <input type="text" name="DepartmentName" class="form-control" value="{{ $department->DepartmentName }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Department Code</label>
                    <input type="text" name="DepartmentCode" class="form-control" value="{{ $department->DepartmentCode }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Active</label>
                    <select name="IsActive" class="form-select">
                        <option value="1" {{ $department->IsActive ? 'selected' : '' }}>Yes</option>
                        <option value="0" {{ !$department->IsActive ? 'selected' : '' }}>No</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('departments.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
@endsection
