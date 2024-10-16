@extends('layout')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h1 class="mb-4">Create Blog</h1>
            <form action="{{ route('blogs.store') }}" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" class="form-control" placeholder="Enter blog title" required>
                </div>

                <div class="form-group mb-3">
                    <label for="content">Content</label>
                    <textarea name="content" id="content" class="form-control" rows="5" placeholder="Enter blog content" required></textarea>
                </div>

                <div class="form-group mb-4">
                    <label for="category_id">Category</label>
                    <select name="category_id" id="category_id" class="form-control" required>
                        <option value="" disabled selected>Select a category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{ route('blogs.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
