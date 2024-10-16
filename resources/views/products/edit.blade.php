@extends('layout')

@section('content')
<div class="container">
    <div class="card mt-5">
        <div class="card-header">
            <h2 class="text-center">Edit Product</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                @csrf
                @method('PUT')

                <!-- Title Input -->
                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" name="title" class="form-control" id="title" value="{{ $product->title }}" placeholder="Enter product title" required>
                    <div class="invalid-feedback">
                        Please provide a product title.
                    </div>
                </div>

                <!-- Description Input -->
                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea name="description" class="form-control" id="description" rows="4" placeholder="Enter product description" required>{{ $product->description }}</textarea>
                    <div class="invalid-feedback">
                        Please provide a product description.
                    </div>
                </div>

                <!-- Product Image Input -->
                <div class="form-group">
                    <label for="productImage">Product Image (Optional):</label>
                    <input type="file" name="productImage" class="form-control-file" id="productImage">
                    <small class="form-text text-muted">Leave this empty if you don't want to update the image.</small>
                </div>

                <!-- Submit Button -->
                <div class="form-group">
                    <button type="submit" class="btn btn-success btn-block">Update Product</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Bootstrap validation script -->
<script>
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            var forms = document.getElementsByClassName('needs-validation');
            Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>
@endsection
