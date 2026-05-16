@extends('admin.layout.app')

@section('title', 'Add Product')

@section('content')

<style>
    .product-card {
        border: none;
        border-radius: 20px;
        overflow: hidden;
        background: #fff;
    }

    .form-control,
    .form-select {
        height: 50px;
        border-radius: 12px;
        border: 1px solid #e5e7eb;
        box-shadow: none !important;
    }

    textarea.form-control {
        height: auto;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #0d6efd;
    }

    .upload-box {
        border: 2px dashed #d1d5db;
        border-radius: 16px;
        padding: 25px;
        text-align: center;
        background: #f9fafb;
        transition: 0.3s;
    }

    .upload-box:hover {
        border-color: #0d6efd;
        background: #f3f7ff;
    }

    .preview-img {
        width: 90px;
        height: 90px;
        object-fit: cover;
        border-radius: 12px;
        margin: 8px;
        border: 1px solid #ddd;
    }

    .save-btn {
        height: 52px;
        border-radius: 14px;
        font-size: 16px;
    }

</style>

<div class="row justify-content-center">
    <div class="col-lg-11">

        <div class="d-flex align-items-center gap-3 mb-4">
            <a href="{{ route('products.index') }}" class="btn btn-light rounded-circle shadow-sm">
                <i class="fas fa-arrow-left text-muted"></i>
            </a>

            <div>
                <h3 class="fw-bold mb-0">Add New Product</h3>
                <small class="text-muted">
                    Create grocery product with multiple images
                </small>
            </div>
        </div>

        <div class="card shadow-sm product-card">
            <div class="card-body p-4 p-lg-5">

                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">

                    @csrf

                    <div class="row g-4">

                        <!-- LEFT -->
                        <div class="col-md-6">

                            <div class="mb-3">
                                <label class="form-label fw-semibold">
                                    Product Name
                                </label>

                                <input type="text" name="name" class="form-control" placeholder="e.g. Fresh Mango" required>
                            </div>

                            <div id="weight-price-wrapper">

                                <div class="row mb-3 weight-price-item">

                                    <div class="col-md-5">
                                        <input type="text" name="weight[]" class="form-control" placeholder="e.g. 500g" required>
                                    </div>

                                    <div class="col-md-5">
                                        <input type="text" name="price[]" class="form-control" placeholder="e.g. 50" required>
                                    </div>

                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-danger remove-row">
                                            Remove
                                        </button>
                                    </div>

                                </div>

                            </div>

                            <button type="button" class="btn btn-primary" id="add-more">
                                Add More
                            </button>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">
                                    Category
                                </label>

                                <select name="category_id" class="form-select" required>

                                    <option value="">
                                        Select Category
                                    </option>

                                    @foreach($categories as $category)

                                    <option value="{{ $category->id }}">
                                        {{ $category->name }}
                                    </option>

                                    @endforeach

                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">
                                    Delivery Time
                                </label>

                                <input type="text" name="delivery_time" class="form-control" placeholder="e.g. 30-45 mins">
                            </div>

                        </div>

                        <!-- RIGHT -->
                        <div class="col-md-6">

                            <div class="mb-3">
                                <label class="form-label fw-semibold">
                                    Shelf Life
                                </label>

                                <input type="text" name="shelf_life" class="form-control" placeholder="e.g. 2 Days">
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">
                                    Stock Status
                                </label>

                                <input type="text" name="stock_status" class="form-control" placeholder="e.g. In Stock">
                            </div>

                            <!-- MULTIPLE IMAGE -->
                            <div class="mb-3">

                                <label class="form-label fw-semibold">
                                    Product Images
                                </label>

                                <div class="upload-box">

                                    <i class="fas fa-cloud-upload-alt fa-2x text-primary mb-3"></i>

                                    <p class="text-muted mb-2">
                                        Select Multiple Product Images
                                    </p>

                                    <input type="file" name="image[]" id="imageInput" class="form-control" accept="image/*" multiple>

                                </div>

                                <!-- IMAGE PREVIEW -->
                                <div id="preview" class="mt-3 d-flex flex-wrap"></div>

                            </div>

                        </div>

                        <!-- FULL WIDTH -->
                        <div class="col-12">

                            <div class="mb-3">
                                <label class="form-label fw-semibold">
                                    Nutrition Info
                                </label>

                                <textarea name="nutrition" class="form-control" rows="3" placeholder="Enter nutrition details..."></textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">
                                    Storage Tips
                                </label>

                                <textarea name="storage_tips" class="form-control" rows="3" placeholder="How to store this product..."></textarea>
                            </div>

                        </div>

                    </div>

                    <div class="mt-4">

                        <button type="submit" class="btn btn-primary w-100 save-btn fw-bold shadow-sm">

                            <i class="fas fa-save me-2"></i>

                            Save Product

                        </button>

                    </div>

                </form>

            </div>
        </div>
    </div>
</div>

<script>
    const imageInput = document.getElementById('imageInput');

    const preview = document.getElementById('preview');

    imageInput.addEventListener('change', function() {

        preview.innerHTML = '';

        Array.from(this.files).forEach(file => {

            const reader = new FileReader();

            reader.onload = function(e) {

                const img = document.createElement('img');

                img.src = e.target.result;

                img.classList.add('preview-img');

                preview.appendChild(img);
            }

            reader.readAsDataURL(file);

        });

    });

    document.getElementById('add-more').addEventListener('click', function() {

        let wrapper = document.getElementById('weight-price-wrapper');

        let html = `
        <div class="row mb-3 weight-price-item">

            <div class="col-md-5">
                <input type="text"
                    name="weight[]"
                    class="form-control"
                    placeholder="e.g. 1kg"
                    required>
            </div>

            <div class="col-md-5">
                <input type="text"
                    name="price[]"
                    class="form-control"
                    placeholder="e.g. 100"
                    required>
            </div>

            <div class="col-md-2">
                <button type="button"
                        class="btn btn-danger remove-row">
                    Remove
                </button>
            </div>

        </div>
    `;

        wrapper.insertAdjacentHTML('beforeend', html);
    });

    document.addEventListener('click', function(e) {

        if (e.target.classList.contains('remove-row')) {

            e.target.closest('.weight-price-item').remove();
        }
    });

</script>

@endsection
