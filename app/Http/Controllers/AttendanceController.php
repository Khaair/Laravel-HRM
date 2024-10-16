<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{

    public function index(Request $request)
    {
        // Fetch month from the request (default to the current month if none is selected)
        $month = $request->input('month', now()->format('Y-m'));


        // Fetch attendance records filtered by the selected month
        $attendanceRecords = Attendance::whereYear('date', '=', date('Y', strtotime($month)))
            ->whereMonth('date', '=', date('m', strtotime($month)))
            ->with('employee')
            ->get();

            

        return view('attendances.index', compact('attendanceRecords', 'month'));
    }

    public function create()
    {
        // Fetch all employees to display in the form
        $employees = Employee::all();

        return view('attendances.create', compact('employees'));
    }

    public function store(Request $request)
    {
        // Validate incoming data
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'date' => 'required|date',
            'status' => 'required|in:present,absent,leave',
        ]);

     

        // Create a new attendance record
        Attendance::create($request->all());

        return redirect()->route('attendances.index')->with('success', 'Attendance recorded successfully.');
    }
}
