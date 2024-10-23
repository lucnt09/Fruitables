@extends('layouts.master')

@section('product')
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-6">
                <!-- Hiển thị hình ảnh sản phẩm -->
                <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid rounded" width="700px" height="700px"
                    alt="{{ $product->name }}">
            </div>
            <div class="col-lg-6">
                <h1>{{ $product->name }}</h1>
                <h2 class="text-primary">{{ number_format($product->price) }} VND</h2>
                <p><strong>Category: </strong>{{ $product->category->name }}</p>
                <a href="javascript:void(0);" data-id="{{ $product->id }}" class="btn btn-primary add-prods-cart text-light">
                    Add to Cart
                </a>

                <p class="mt-3">{{ $product->short_description }}</p>
                <p class="mt-3">{{ $product->long_description }}</p>
            </div>
        </div>

        <!-- Phần sản phẩm liên quan -->
        <div class="mt-5">
            <h3>Sản phẩm liên quan</h3>
            <div class="row mt-3">
                @foreach ($relatedProducts as $relatedProduct)
                    <div class="col-lg-3 col-md-4 col-sm-6 d-flex">
                        <div class="card mb-4 w-100 d-flex flex-column">
                            <img src="{{ asset('storage/' . $relatedProduct->image) }}" class="card-img-top img-fluid"
                                alt="{{ $relatedProduct->name }}">
                            <div class="p-4 border border-secondary border-top-0 rounded-bottom d-flex flex-column flex-grow-1">
                                <h4 class="flex-grow-0 text-truncate">
                                    <!-- Link đến trang chi tiết sản phẩm -->
                                    <a href="{{ route('product.show', $relatedProduct->id) }}" class="text-dark text-decoration-none">
                                        {{ $relatedProduct->name }}
                                    </a>
                                </h4>
                                <p class="description flex-grow-1 mb-3"
                                    style="max-height: 90px; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical;">
                                    {{ $relatedProduct->short_description }}
                                </p>
                                <div class="mt-auto d-flex justify-content-between align-items-center">
                                    <p class="text-dark fs-5 fw-bold mb-0">{{ number_format($relatedProduct->price) }} VND</p>
                                    <a href="javascript:void(0);" data-id="{{ $relatedProduct->id }}"
                                        class="btn btn-outline-primary rounded-pill px-3 add-prods-cart">
                                        <i class="fa fa-shopping-bag me-2"></i> Add to cart
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
