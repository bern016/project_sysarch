<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\College;

class CollegeController extends Controller {

    public function index() {
        $colleges = College::with('departments')->paginate(10); 
        return view('colleges.index', compact('colleges'));
    }

    public function show(College $college) {
        return view('colleges.show', compact('college'));
    }

    public function create() {
        return view('colleges.create');
    }

    public function store(Request $request) {
        $request->validate([
            'CollegeName' => 'required|string|max:255',
            'CollegeCode' => 'required|string|max:50|unique:colleges,CollegeCode',
        ]);

        College::create($request->only(['CollegeName', 'CollegeCode']));

        return redirect()->route('colleges.index')->with('success', 'College added successfully.');
    }

    public function edit(College $college) {
        return view('colleges.edit', compact('college'));
    }

    public function update(Request $request, College $college) {
        $request->validate([
            'CollegeName' => 'required|string|max:255',
            'CollegeCode' => 'required|string|max:10',
        ]);

        $college->update($request->only(['CollegeName', 'CollegeCode']));

        return redirect()->route('colleges.index')->with('success', 'College updated successfully.');
    }

    public function destroy(College $college) {
        $college->delete();
        return redirect()->route('colleges.index')->with('success', 'College deleted successfully.');
    }

    public function deleted() {
        $deletedColleges = College::onlyTrashed()->paginate(10);
        return view('colleges.deleted', compact('deletedColleges'));
    }

    public function restore($college) {
        $college = College::onlyTrashed()->findOrFail($college);
        $college->restore();
        return redirect()->route('colleges.deleted')->with('success', 'College restored successfully.');
    }

    public function forceDelete($college) {
        $college = College::onlyTrashed()->findOrFail($college);
        $college->forceDelete();
        return redirect()->route('colleges.deleted')->with('success', 'College permanently deleted.');
    }

    public function search(Request $request) {
        $searchQuery = $request->input('search');

        $colleges = College::with('departments')
            ->where('CollegeName', 'like', '%' . $searchQuery . '%')
            ->orWhere('CollegeCode', 'like', '%' . $searchQuery . '%')
            ->paginate(10); 

        return view('colleges.index', compact('colleges'));
    }
}
