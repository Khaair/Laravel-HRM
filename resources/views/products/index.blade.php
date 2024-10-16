@extends('layout')

@section('content')
<div class="container">
    <h1 class="my-4">Products</h1>
    
    <table class="table table-bordered table-hover">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Image</th>
                <th scope="col">Title</th>
                <th scope="col">Description</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <!-- Image -->
                <td>
                    <img src="{{ asset('storage/' . $product->productImage) }}" alt="{{ $product->title }}" width="100" class="img-fluid">
                </td>

                <!-- Title -->
                <td>{{ $product->title }}</td>

                <!-- Description -->
                <td>{{ $product->description }}</td>

                <!-- Action Buttons -->
                <td>
                    <a href="{{ route('products.show', $product->id) }}" class="btn btn-info btn-sm">View</a>
                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm">Edit</a>

                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
