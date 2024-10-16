@extends('layout')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-12">

            <div class="d-flex justify-content-between">
                <h1 class="mb-4">Blogs</h1>
                <a href="{{ route('blogs.create') }}" class="btn btn-primary mb-4">Create</a>
            </div>
            @if($blogs->count())
            <ul class="list-group">
                @foreach($blogs as $blog)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="mb-1">{{ $blog->title }}</h5>
                        <small class="text-muted">{{ $blog->category->name }}</small>
                    </div>
                    <div>
                        <a href="{{ route('blogs.show', $blog->id) }}" class="btn btn-sm btn-info">View</a>
                        <a href="{{ route('blogs.edit', $blog->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </div>
                </li>
                @endforeach
            </ul>
            @else
            <p>No blogs available.</p>
            @endif
        </div>
    </div>
</div>
@endsection