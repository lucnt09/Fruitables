@extends('layouts.master')

@section('cart')
    <div class="container-fluid py-5">
        <div class="container py-5">
            <h3 class="text" style="color: rgba(115, 203, 33, 0.844)">My Cart</h3>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Products</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total</th>
                            <th scope="col">Handle</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $total = 0; @endphp
                        @foreach ($products as $productId => $item)
                            @php
                                $itemTotal = $item['price'] * $item['quantity'];
                                $total += $itemTotal;
                            @endphp
                            <tr>
                                <th scope="row">
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset('storage/' . $item['image']) }}"
                                            class="img-fluid me-5 rounded-circle" style="width: 80px; height: 80px;"
                                            alt="">

                                    </div>
                                </th>
                                <td>
                                    <p class="mb-0 mt-4">{{ $item['name'] }}</p>
                                </td>
                                <td>
                                    <p class="mb-0 mt-4">{{ number_format($item['price'], 2) }} $</p>
                                </td>
                                <td>
                                    <div class="product-quantity d-flex align-items-center mt-4">
                                        {{-- Form giảm số lượng bằng AJAX --}}
                                        <button type="button"
                                            class="btn btn-sm btn-outline-secondary border-0 rounded-circle btn-decrease"
                                            data-id="{{ $productId }}">
                                            <i class="fa fa-minus"></i>
                                        </button>

                                        {{-- Hiển thị số lượng sản phẩm --}}
                                        <input type="number"
                                            class="form-control form-control-sm text-center mx-1 border-0 bg-light"
                                            name="quantity" value="{{ $item['quantity'] }}" min="1" readonly
                                            style="width: 50px;">

                                        {{-- Form tăng số lượng bằng AJAX --}}
                                        <button type="button"
                                            class="btn btn-sm btn-outline-secondary border-0 rounded-circle btn-increase"
                                            data-id="{{ $productId }}">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </td>
                                <td>
                                    <p class="mb-0 mt-4">{{ number_format($itemTotal) }} $</p>
                                </td>
                                <td>
                                    <form action="{{ route('cart.remove', $item['id']) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger mt-3" type="submit">Xóa</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="row g-4 justify-content-end">
                <div class="col-8"></div>
                <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4">
                    <div class="bg-light rounded">
                        <div class="p-4">
                            <h1 class="display-6 mb-4">Cart <span class="fw-normal">Total</span></h1>
                            <div class="d-flex justify-content-between mb-4">
                                <h5 class="mb-0 me-4">Subtotal:</h5>
                                <p class="mb-0">{{ number_format($total) }} $</p>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h5 class="mb-0 me-4">Shipping</h5>
                                <div class="">
                                    <p class="mb-0">Flat rate: $0</p>
                                </div>
                            </div>
                        </div>
                        <div class="py-4 mb-4 border-top border-bottom d-flex justify-content-between">
                            <h5 class="mb-0 ps-4 me-4">Total</h5>
                            <p class="mb-0 pe-4">{{ number_format($total) }} $</p>
                        </div>
                        <a href="{{ route('checkout.index') }}" class="btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4">
                            Proceed Checkout
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
