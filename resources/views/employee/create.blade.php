@extends('layout')

@section('content')
<div class="card">
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h1 class="mb-4">Create Employee</h1>
            <form action="{{ route('employees.store') }}" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                        placeholder="Enter employee name" value="{{ old('name') }}">
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="email">Email</label>

                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror"
                        placeholder="Enter email" value="{{ old('email') }}">

                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                    <!-- Product Image Input -->
                    <div class="form-group">
                    <label for="productImage">Product Image:</label>
                    <input type="file" name="productImage" class="form-control-file" id="productImage" required>
                    <div class="invalid-feedback">
                        Please upload a product image.
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label for="department_id">Department</label>
                    <select name="department_id" id="department_id"
                        class="form-control @error('department_id') is-invalid @enderror"
                        value="{{ old('department_id') }}">
                        <option value="" disabled selected>Select a department</option>
                        @foreach($departments as $department)
                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                        @endforeach
                    </select>

                    @error('department_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{ route('employees.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
</div>
@endsection
