@extends('layouts.app')
@section('content')
<div class="container mt-5">
    <h2>Create College</h2>
    <form action="{{ route('colleges.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">College Name</label>
            <input type="text" name="CollegeName" class="form-control w-50" required>
        </div>
        <div class="mb-3">
            <label class="form-label">College Code</label>
            <input type="text" name="CollegeCode" class="form-control w-50" required>
        </div>
        <button type="submit" class="btn btn-success">Save</button>
    </form>
</div>
@endsection
