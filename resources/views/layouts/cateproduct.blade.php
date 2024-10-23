@extends('layouts.master')

@section('product')
    <div class="tab-class text-center">
        <div id="tab-1" class="tab-pane fade show p-0 active">
            <div class="row g-4">
                <div class="col-lg-12">
                    <h3>Sản phẩm trong danh mục: {{ $category->name }}</h3>
                    <div class="row g-4 mt-3">
                        @foreach ($products as $product)
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="rounded position-relative fruite-item">
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

                    <!-- Pagination -->
                    <div class="mt-4">
                        {{ $products->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
