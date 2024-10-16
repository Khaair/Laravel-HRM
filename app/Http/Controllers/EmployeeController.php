<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->input('search');
    
        $employees = Employee::with('department')
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', '%' . $search . '%');
            })
            ->paginate(5); // Adjust the number 10 to the number of items per page you want
    
        return view('employee.index', compact('employees', 'search'));
    }

    public function create()
    {
        $departments = Department::all();
        return view('employee.create', compact('departments'));
    }

   

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'productImage' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Validation for image file
            'department_id' => 'required',
        ], [
            'name.required' => 'Name is required',
            'email.required' => 'Email is required',
            'productImage.required' => 'Image is required',
            'department_id.required' => 'Department is required',

        ]);

        $productImage = $request->file('productImage');
        $imagePath = $productImage->store('product_images', 'public'); // Store image in 'public/storage/product_images'
        
        Employee::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'department_id' => $request->input('department_id'),
            'productImage' => $imagePath,
        ]);
     
        return redirect()->route('employees.index');
    }

   

    public function employeesByDepartment($departmentId)
    {
        $department = Department::with('employees')->find($departmentId);

        if (!$department) {
            return redirect()->route('employees.index')->with('error', 'Department not found');
        }

        $employees = $department->employees;

        return view('employee.employees-by-department', compact('employees', 'department'));
    }

    public function destroy(Employee $Employee)
    {
        $Employee->delete();

        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully.');
    }

    // Other CRUD methods...
}
