<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;


class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::all();
        return view('department.index', compact('departments'));
    }

    public function create()
    {
        return view('department.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ], [
            'name.required' => 'Name is required',
        ]);
    
        Department::create($request->all());
        return redirect()->route('departments.index');
    }


    public function destroy(Department $Department)
    {
        $Department->delete();

        return redirect()->route('departments.index')->with('success', 'Department deleted successfully.');
    }

    // Other CRUD methods...
}