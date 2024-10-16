@extends('layout')

@section('content')
<div class="card pb-5">
<div class="container mt-5">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h1 class="mb-4">Create Category</h1>
            <form action="{{ route('categories.store') }}" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <label for="name">Category Name</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Enter category name" required>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{ route('categories.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
</div>
@endsection
