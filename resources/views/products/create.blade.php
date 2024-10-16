@extends('layout')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h2 class="text-center">Add New Product</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                @csrf

                <!-- Title Input -->
                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" name="title" class="form-control" id="title" placeholder="Enter product title" required>
                    <div class="invalid-feedback">
                        Please provide a product title.
                    </div>
                </div>

                <!-- Description Input -->
                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea name="description" class="form-control" id="description" rows="4" placeholder="Enter product description" required></textarea>
                    <div class="invalid-feedback">
                        Please provide a product description.
                    </div>
                </div>

                <!-- Product Image Input -->
                <div class="form-group">
                    <label for="productImage">Product Image:</label>
                    <input type="file" name="productImage" class="form-control-file" id="productImage" required>
                    <div class="invalid-feedback">
                        Please upload a product image.
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">Add Product</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Bootstrap validation script -->
<script>
    // Bootstrap form validation
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
