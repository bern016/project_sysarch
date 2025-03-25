<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\College;

class DepartmentController extends Controller {
    public function index() {
        $departments = Department::with('college')->get(); 
        $deletedDepartments = Department::onlyTrashed()->get();
        return view('departments.index', compact('departments', 'deletedDepartments'));
    }
    

    public function create() {
        $colleges = College::all();
        return view('departments.create', compact('colleges'));
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
