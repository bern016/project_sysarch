@extends('layouts.app')

@section('content')
<div class="container">
    <h2>{{ $college->CollegeName }}</h2>
    <p><strong>Code:</strong> {{ $college->CollegeCode }}</p>
    <p><strong>Status:</strong> {{ $college->IsActive ? 'Active' : 'Inactive' }}</p>

    <h3>Departments</h3>
    <ul>
        @foreach ($college->departments as $department)
            <li>{{ $department->DepartmentName }} ({{ $department->DepartmentCode }})</li>
        @endforeach
    </ul>

    <a href="{{ route('colleges.index') }}" class="btn btn-primary">Back to Colleges</a>
</div>
@endsection
