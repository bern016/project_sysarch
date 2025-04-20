<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\College;

class DepartmentController extends Controller {
    public function index(Request $request)
{
    $keyword = $request->input('keyword', '');  // Default to an empty string if no keyword
    $isActive = $request->input('IsActive', ''); // Default to an empty string if no status filter

    // Query for departments with the optional filters
    $query = Department::with('college');

    // If there's a keyword, filter by department name or code
    if ($keyword) {
        $query->where(function ($q) use ($keyword) {
            $q->where('DepartmentName', 'like', "%{$keyword}%")
              ->orWhere('DepartmentCode', 'like', "%{$keyword}%");
        });
    }

    // If there's a status filter (active or inactive), apply it
    if ($isActive !== '') {
        $query->where('IsActive', $isActive);
    }

    // Fetch the filtered departments
    $departments = $query->get();

    // Return the view with departments, keyword, and status filter values
    return view('departments.index', compact('departments', 'keyword', 'isActive'));
}
   
    public function create() {
        $colleges = College::all();
        return view('departments.create', compact('colleges'));
    }    

    public function search(Request $request)
{
    $keyword = $request->input('keyword');
    $isActive = $request->input('IsActive');

    $query = Department::with('college');

    if ($keyword) {
        $query->where(function ($q) use ($keyword) {
            $q->where('DepartmentName', 'like', "%{$keyword}%")
              ->orWhere('DepartmentCode', 'like', "%{$keyword}%");
        });
    }

    if ($isActive !== null && $isActive !== '') {
        $query->where('IsActive', $isActive);
    }

    $departments = $query->get();

    return view('departments.search', compact('departments', 'keyword', 'isActive'));
}

    public function store(Request $request) {
        $request->validate([
            'CollegeID' => 'required|exists:colleges,CollegeID',
            'DepartmentName' => 'required|string|max:255',
            'DepartmentCode' => 'required|string|max:50|unique:departments,DepartmentCode',
            'IsActive' => 'required|in:0,1', 
        ]);

        Department::create($request->all());

        return redirect()->route('departments.index')->with('success', 'Department added successfully.');
    }

    public function edit(Department $department) {
        $colleges = College::all();
        return view('departments.edit', compact('department', 'colleges'));
    }

    public function update(Request $request, Department $department) {
        $request->validate([
            'CollegeID' => 'required|exists:colleges,CollegeID',
            'DepartmentName' => 'required|string|max:255',
            'DepartmentCode' => 'required|string|max:50|unique:departments,DepartmentCode,' . $department->DepartmentID . ',DepartmentID',
            'IsActive' => 'required|in:0,1',
        ]);

        $department->update($request->all());

        return redirect()->route('departments.index')->with('success', 'Department updated successfully.');
    }

    public function destroy(Department $department) {
        $department->delete();
        return redirect()->route('departments.index')->with('success', 'Department deleted successfully.');
    }

    public function trashed() {
        $departments = Department::onlyTrashed()->get();
        return view('departments.trashed', compact('departments'));
    }
    
    
public function restore($id) {
    $department = Department::onlyTrashed()->findOrFail($id);
    $department->restore();
    return redirect()->route('departments.deleted')->with('success', 'Department restored successfully.');
}

public function forceDelete($id) {
    $department = Department::onlyTrashed()->findOrFail($id);
    $department->forceDelete();
    return redirect()->route('departments.deleted')->with('success', 'Department permanently deleted.');
}

    public function show(Department $department) {
    return view('departments.show', compact('department'));
}


public function deleted()
{
    $deletedDepartments = Department::onlyTrashed()->with('college')->get();
    
    return view('departments.deleted', compact('deletedDepartments'));
}
    
}
