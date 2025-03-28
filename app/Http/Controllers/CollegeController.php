<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\College;
use Illuminate\Validation\Rule;

class CollegeController extends Controller {
  
    public function index() {
        $colleges = College::with('departments')->get(); 
        return view('colleges.index', compact('colleges'));
    }

    public function show($id) {
        $college = College::with('departments')->findOrFail($id);
        return view('colleges.show', compact('college'));
    }

    public function create() {
        return view('colleges.create');
    }


    public function destroy($id) {
        $college = College::findOrFail($id);
        $college->delete();
        return redirect()->route('colleges.index')->with('success', 'College deleted successfully.');
    }

    public function edit($id) {
        $college = College::findOrFail($id);
        return view('colleges.edit', compact('college'));
    }
    

    
    public function deleted() {
        $deletedColleges = College::onlyTrashed()->get();
        return view('colleges.deleted', compact('deletedColleges'));
    }

    public function restore($id) {
        $college = College::onlyTrashed()->findOrFail($id);
        $college->restore();
        return redirect()->route('colleges.deleted')->with('success', 'College restored successfully.');
    }

    public function forceDelete($id) {
        $college = College::onlyTrashed()->findOrFail($id);
        $college->forceDelete();
        return redirect()->route('colleges.deleted')->with('success', 'College permanently deleted.');
    }

    public function store(Request $request) {
       
        $request->validate([
            'CollegeName' => 'required|string|max:255',
            'CollegeCode' => 'required|string|max:50|unique:colleges,CollegeCode',
        ]);
    
        College::create([
            'CollegeName' => $request->CollegeName,
            'CollegeCode' => $request->CollegeCode,
        ]);
    
       
        return redirect()->route('colleges.index')->with('success', 'College added successfully.');
    }
    
    public function update(Request $request, $id) {
        // Validate the request to ensure the CollegeCode is unique except for the current record
        $request->validate([
            'CollegeName' => 'required|string|max:255',
            'CollegeCode' => 'required|string|max:10|unique:colleges,CollegeCode,' . $id . ',CollegeID',  // Ignore the current CollegeID
        ], [
            'CollegeCode.unique' => 'The CollegeCode is already taken by another college. Please choose a different one.'
        ]);
        
        $college = College::findOrFail($id);
        
        // Update the college with the new data
        $college->update([
            'CollegeName' => $request->CollegeName,
            'CollegeCode' => $request->CollegeCode,
        ]);
        
        return redirect()->route('colleges.index')->with('success', 'College updated successfully');
    }
}