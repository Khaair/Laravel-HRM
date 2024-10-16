@extends('layout')

@section('content')
<div class="card pb-5">
    <div class="container mt-5">
        <h1 class="mb-4">Record Attendance</h1>
        <form action="{{ route('attendances.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="employee_id" class="form-label">Employee</label>
                <select name="employee_id" id="employee_id" class="form-select" required>
                    <option value="" disabled selected>Select an Employee</option>
                    @foreach($employees as $employee)
                    <option value="{{ $employee->id }}">{{ $employee->title }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="date" class="form-label">Date</label>
                <input type="date" name="date" id="date" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-select" required>
                    <option value="present">Present</option>
                    <option value="absent">Absent</option>
                    <option value="leave">Leave</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
@endsection


