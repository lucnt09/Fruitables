@extends('layouts.master')

@section('bestseller')
    <div class="text-center mx-auto mb-5" style="max-width: 700px;">
        <h1 class="display-4">Bestseller Products</h1>
    </div>
    <div class="row g-4">
        @foreach ($hots as $hot)
            <div class="col-lg-6 col-xl-4">
                <div class="p-4 rounded bg-light">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <img src="{{ asset('storage/' . $hot->image) }}" class="img-fluid rounded-circle"
                                style="width: 150px; height: 150px; object-fit: cover;" alt="{{ $hot->name }}">
                        </div>
                        <div class="col-6">
                            <a href="#" class="h5">{{ $hot->name }}</a>
                            <h4 class="mb-4 mt-2 text-muted fw-normal text-primary">{{ number_format($hot->price) }} VND
                            </h4>
                            <a href="javascript:void(0);" data-id="{{ $hot->id }}"
                                class="btn border border-secondary rounded-pill px-3 text-primary add-prods-cart">
                                <i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="modal fade" id="productDetailModal" tabindex="-1" aria-labelledby="productDetailLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="productDetailLabel">Product Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="product-detail-content">
                    <!-- Nội dung chi tiết sản phẩm sẽ được chèn vào đây -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('product')
    <div class="tab-class text-center">
        <div class="row g-4">
            <div class="col-lg-4 text-start">
                <h1>Our Organic Products</h1>
            </div>
            <div class="col-lg-8 text-end">
                <ul class="nav nav-pills d-inline-flex text-center mb-5">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="pills-all-tab" data-bs-toggle="pill" href="#tab-all" role="tab"
                            aria-controls="pills-all" aria-selected="true">Tất cả sản phẩm</a>
                    </li>
                    @foreach ($categories as $index => $category)
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="pills-{{ $category->slug }}-tab" data-bs-toggle="pill"
                                href="#tab-{{ $category->id }}" role="tab" aria-controls="pills-{{ $category->slug }}"
                                aria-selected="false">
                                {{ $category->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="tab-content">
            <!-- Tất cả sản phẩm -->
            <div id="tab-all" class="tab-pane fade show p-0 active">
                <div class="row g-4">
                    @foreach ($products as $product)
                        <div class="col-md-6 col-lg-4 col-xl-3">
                            <div class="rounded position-relative fruite-item" data-id="{{ $product->id }}">
                                <div class="fruite-img" style="height: 250px; overflow: hidden;">
                                    <a href="{{ route('product.show', $product->id) }}">
                                        <img src="{{ asset('storage/' . $product->image) }}"
                                            class="img-fluid w-100 h-100 rounded-top" style="object-fit: cover;"
                                            alt="{{ $product->name }}">
                                    </a>
                                </div>

                                <div class="text-white bg-secondary px-3 py-1 rounded position-absolute"
                                    style="top: 10px; left: 10px;">
                                    {{ $product->category->name }}
                                </div>

                                <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                    <h4>
                                        <a href="{{ route('product.show', $product->id) }}" class="text-dark">
                                            {{ $product->name }}
                                        </a>
                                    </h4>
                                    <p
                                        style="max-height: 70px; overflow: hidden; text-overflow: ellipsis;
                                           display: -webkit-box; -webkit-line-clamp: 4; -webkit-box-orient: vertical;">
                                        {{ $product->short_description }}
                                    </p>
                                    <div class="d-flex justify-content-between flex-lg-wrap">
                                        <p class="text-dark fs-5 fw-bold mb-0">
                                            ${{ number_format($product->price) }}
                                        </p>

                                        <a href="javascript:void(0);" data-id="{{ $product->id }}"
                                            class="btn border border-secondary rounded-pill px-3 text-primary add-prods-cart">
                                            <i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart
                                        </a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Tab từng danh mục -->
            @foreach ($categories as $category)
                <div id="tab-{{ $category->id }}" class="tab-pane fade p-0">
                    <div class="row g-4">
                        @foreach ($category->products as $product)
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="rounded position-relative fruite-item" data-id="{{ $product->id }}">
                                    <div class="fruite-img" style="height: 250px; overflow: hidden;">
                                        <a href="{{ route('product.show', $product->id) }}">
                                            <img src="{{ asset('storage/' . $product->image) }}"
                                                class="img-fluid w-100 h-100 rounded-top" style="object-fit: cover;"
                                                alt="{{ $product->name }}">
                                        </a>
                                    </div>

                                    <div class="text-white bg-secondary px-3 py-1 rounded position-absolute"
                                        style="top: 10px; left: 10px;">
                                        {{ $product->category->name }}
                                    </div>

                                    <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                        <h4>
                                            <a href="{{ route('product.show', $product->id) }}" class="text-dark">
                                                {{ $product->name }}
                                            </a>
                                        </h4>
                                        <p
                                            style="max-height: 70px; overflow: hidden; text-overflow: ellipsis;
                                           display: -webkit-box; -webkit-line-clamp: 4; -webkit-box-orient: vertical;">
                                            {{ $product->short_description }}
                                        </p>
                                        <div class="d-flex justify-content-between flex-lg-wrap">
                                            <p class="text-dark fs-5 fw-bold mb-0">
                                                ${{ number_format($product->price) }}
                                            </p>

                                            <a href="javascript:void(0);" data-id="{{ $product->id }}"
                                                class="btn border border-secondary rounded-pill px-3 text-primary add-prods-cart">
                                                <i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart
                                            </a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
