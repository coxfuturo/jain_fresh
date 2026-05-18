@extends('admin.layout.app')

@section('title', 'Edit Product')

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

    .btn-add-more {
        background: #f0f7ff;
        color: #0d6efd;
        border: 1px dashed #0d6efd;
        border-radius: 12px;
        padding: 12px;
        font-weight: 600;
        transition: 0.3s;
        width: 100%;
        margin-bottom: 20px;
    }

    .btn-add-more:hover {
        background: #0d6efd;
        color: #fff;
    }

    .remove-row {
        height: 50px;
        width: 100%;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #fff5f5;
        color: #ff5630;
        border: 1px solid #ffe2e2;
        transition: 0.3s;
    }

    .remove-row:hover {
        background: #ff5630;
        color: #fff;
    }

</style>

<div class="row justify-content-center">

    <div class="col-lg-11">

        <div class="d-flex align-items-center gap-3 mb-4">

            <a href="{{ route('products.index') }}" class="btn btn-light rounded-circle shadow-sm">

                <i class="fas fa-arrow-left text-muted"></i>

            </a>

            <div>

                <h3 class="fw-bold mb-0">
                    Edit Product
                </h3>

                <small class="text-muted">
                    {{ $product->name }}
                </small>

            </div>

        </div>

        <div class="card shadow-sm product-card">

            <div class="card-body p-4 p-lg-5">

                <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">

                    @csrf
                    @method('PUT')

                    <div class="row g-4">

                        <!-- LEFT -->
                        <div class="col-md-6">

                            <div class="mb-3">

                                <label class="form-label fw-semibold">
                                    Product Name
                                </label>

                                <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>

                            </div>

                            <div id="weight-price-wrapper">

                                <label class="form-label fw-semibold">
                                    Weight / Price Info
                                </label>

                                @if(is_array($product->weight))

                                @foreach($product->weight as $item)

                                <div class="row mb-3 weight-price-item">

                                    <div class="col-md-5">
                                        <input type="text" name="weight[]" class="form-control" value="{{ $item['weight'] ?? '' }}" placeholder="e.g. 500g" required>
                                    </div>

                                    <div class="col-md-5">
                                        <input type="text" name="price[]" class="form-control" value="{{ $item['price'] ?? '' }}" placeholder="e.g. 50" required>
                                    </div>

                                    <div class="col-md-2">
                                        <button type="button" class="btn remove-row" title="Remove">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </div>

                                </div>

                                @endforeach

                                @endif

                            </div>

                            <div class="mt-2 mb-4">
                                <button type="button" class="btn btn-add-more w-100" id="add-more">
                                    <i class="fas fa-plus-circle me-2"></i> Add More Weight/Price Variant
                                </button>
                            </div>

                            <div class="mb-3">

                                <label class="form-label fw-semibold">
                                    Category
                                </label>

                                <select name="category_id" class="form-select" required>

                                    @foreach($categories as $category)

                                    <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>

                                        {{ $category->name }}

                                    </option>

                                    @endforeach

                                </select>

                            </div>

                            <div class="mb-3">

                                <label class="form-label fw-semibold">
                                    Stock Status
                                </label>

                                <input type="text" name="stock_status" class="form-control" value="{{ $product->stock_status }}">

                            </div>

                        </div>

                        <!-- RIGHT -->
                        <div class="col-md-6">

                            <div class="mb-3">

                                <label class="form-label fw-semibold">
                                    Product Images
                                </label>

                                <div class="upload-box">

                                    <i class="fas fa-cloud-upload-alt fa-2x text-primary mb-3"></i>

                                    <p class="text-muted">
                                        Select Multiple Images
                                    </p>

                                    <input type="file" name="image[]" id="imageInput" class="form-control" accept="image/*" multiple>

                                </div>

                            </div>

                            <!-- OLD IMAGES -->
                            <div class="mb-3">

                                <label class="form-label fw-semibold">
                                    Current Images
                                </label>

                                <div class="d-flex flex-wrap">

                                    @if(!empty($product->image))

                                    @php

                                    $images = is_array($product->image)
                                    ? $product->image
                                    : json_decode($product->image, true);

                                    @endphp

                                    @foreach($images as $image)

                                    <img src="{{ asset('storage/'.$image) }}" class="preview-img">

                                    @endforeach

                                    @else

                                    <img src="https://ui-avatars.com/api/?name={{ $product->name }}" class="preview-img">

                                    @endif

                                </div>

                            </div>

                            <!-- NEW PREVIEW -->
                            <div id="preview" class="d-flex flex-wrap">
                            </div>

                            <div class="mb-3 mt-3">

                                <label class="form-label fw-semibold">
                                    Status
                                </label>

                                <select name="status" class="form-select">

                                    <option value="1" {{ $product->status == 1 ? 'selected' : '' }}>

                                        Active

                                    </option>

                                    <option value="0" {{ $product->status == 0 ? 'selected' : '' }}>

                                        Inactive

                                    </option>

                                </select>

                            </div>

                        </div>

                        <!-- FULL WIDTH -->
                        <div class="col-12">

                            <div class="mb-3">

                                <label class="form-label fw-semibold">
                                    Nutrition Info
                                </label>

                                <textarea name="nutrition" class="form-control" rows="3">{{ $product->nutrition }}</textarea>

                            </div>

                            <div class="mb-3">

                                <label class="form-label fw-semibold">
                                    Storage Tips
                                </label>

                                <textarea name="storage_tips" class="form-control" rows="3">{{ $product->storage_tips }}</textarea>

                            </div>

                        </div>

                    </div>

                    <div class="mt-4">

                        <button type="submit" class="btn btn-primary w-100 save-btn fw-bold shadow-sm">

                            <i class="fas fa-save me-2"></i>

                            Update Product

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
                        class="btn remove-row" title="Remove">
                    <i class="fas fa-trash-alt"></i>
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
