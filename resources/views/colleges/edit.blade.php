@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit College</h2>
    <form action="{{ route('colleges.update', ['college' => $college->CollegeID]) }}" method="POST">

        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">College Name</label>
            <input type="text" name="CollegeName" class="form-control" value="{{ $college->CollegeName }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">College Code</label>
            <input type="text" name="CollegeCode" class="form-control" value="{{ $college->CollegeCode }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
