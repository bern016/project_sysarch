@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit College</h2>
       
    <form action="{{ route('colleges.update', ['college' => $college->CollegeID]) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
            <label class="form-label">College Name</label>
            <input type="text" name="CollegeName" class="form-control" value="{{ old('CollegeName', $college->CollegeName) }}" required>
        </div>
        
        <div class="mb-3">
            <label class="form-label">College Code</label>
            <input type="text" name="CollegeCode" class="form-control" value="{{ old('CollegeCode', $college->CollegeCode) }}" required>
            
       
            @if ($errors->has('CollegeCode'))
            <div class="alert alert-danger mt-2">
                <strong>{{ $errors->first('CollegeCode') }}</strong>
            </div>
        @endif
    </div>


   
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection