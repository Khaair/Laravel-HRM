@extends('layout')

@section('content')
<div class="container mt-5">
    @if(isset($department))
        <h2 class="mb-4">Employees in Department: {{ $department->name }}</h2>
    @endif

    @foreach($employees as $employee)
                <ul>
                    <li>Name: {{ $employee->title }}</li>
                    <!-- Add more columns as needed -->
                </ul>
            @endforeach

    @if($employees->isEmpty())
        <div class="alert alert-warning" role="alert">
            No employees found in this department.
        </div>
    @endif
</div>
@endsection
