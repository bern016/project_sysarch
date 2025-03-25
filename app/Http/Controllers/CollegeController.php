<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\College;

class CollegeController extends Controller {
  
    public function index() {
        $colleges = College::with('departments')->get(); 
        return view('colleges.index', compact('colleges'));
    }

    public function show($id) {
        $college = College::with('departments')->findOrFail($id);//error($id)
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
      
        $request->validate([
            'CollegeName' => 'required|string|max:255',
            'CollegeCode' => 'required|string|max:10',
        ]);
    
        $college = College::findOrFail($id);
    
        $college->update([
            'CollegeName' => $request->CollegeName,
            'CollegeCode' => $request->CollegeCode,
        ]);
    
        return redirect()->route('colleges.index')->with('success', 'College updated successfully');
    }
}
