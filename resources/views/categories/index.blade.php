@extends('layout')

@section('content')
<div class="card pb-5">
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="d-flex justify-content-between">
            <h1 class="mb-4">Categories</h1>
            <a href="{{ route('categories.create') }}" class="btn btn-primary mb-4">Create</a>
                </div>
            @if($categories->count())
                <ul class="list-group">
                    @foreach($categories as $category)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ $category->name }}
                            <div>
                                <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @else
                <p>No categories available.</p>
            @endif
        </div>
    </div>
</div>
</div>
@endsection
