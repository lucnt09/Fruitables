@extends('layouts.master')

@section('checkout')
    <div class="container-fluid py-5">
        <div class="container py-5">
            @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

            <h1 class="mb-4">Billing details</h1>
            <form action="{{ route('checkout') }}" method="POST">
                @csrf
                <div class="row g-5">
                    <div class="col-md-12 col-lg-6 col-xl-7">
                        <div class="row">
                            <div class="col-md-12 col-lg-6">
                                <div class="form-item w-100">
                                    <label class="form-label my-3">First Name<sup>*</sup></label>
                                    <input type="text" name="first_name" class="form-control"
                                        value="{{ old('first_name') }}">
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-6">
                                <div class="form-item w-100">
                                    <label class="form-label my-3">Last Name<sup>*</sup></label>
                                    <input type="text" name="last_name" class="form-control"
                                        value="{{ old('last_name') }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">Mobile<sup>*</sup></label>
                            <input type="tel" name="mobile" class="form-control" value="{{ old('mobile') }}">
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">Email Address<sup>*</sup></label>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">Address <sup>*</sup></label>
                            <input type="text" name="address" class="form-control" value="{{ old('address') }}"
                                placeholder="House Number Street Name">
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">City<sup>*</sup></label>
                            <input type="text" name="city" class="form-control" value="{{ old('city') }}">
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">Notes</label>
                            <textarea name="notes" class="form-control" spellcheck="false" cols="30" rows="7"
                                placeholder="Order Notes (Optional)">{{ old('notes') }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-6 col-xl-5">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Product</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cart as $productId => $item)
                                        @if (is_int($productId) && is_array($item) && isset($item['id']))
                                            <tr>
                                                <th scope="row">
                                                    <div class="d-flex align-items-center mt-2">
                                                        <img src="{{ asset('storage/' . $item['image']) }}"
                                                            class="img-fluid rounded-circle"
                                                            style="width: 90px; height: 90px;" alt="">
                                                    </div>
                                                </th>
                                                <td class="py-5">{{ $item['name'] ?? 'N/A' }}</td>
                                                <td class="py-5">{{ number_format($item['price'] ?? 0) }}$</td>
                                                <td class="py-5">{{ $item['quantity'] ?? 0 }}</td>
                                                <td class="py-5">
                                                    {{ number_format(($item['price'] ?? 0) * ($item['quantity'] ?? 1)) }}$
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                    <tr>
                                        <th scope="row"></th>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <p class="mb-0 text-dark py-3">Tổng tiền: </p>
                                        </td>
                                        <td>
                                            <p class="mb-0 text-dark py-3">{{ number_format($total) }}$</p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="row g-4 text-center align-items-center justify-content-center border-bottom py-3">
                            <div class="col-12">
                                <div class="form-check text-start my-3">
                                    <input type="radio" class="form-check-input bg-primary border-0" id="Cash On Delivery"
                                        name="paymentMethod" value="Delivery"
                                        {{ old('paymentMethod') == 'Delivery' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="Cash On Delivery">Thanh toán khi nhận hàng</label>
                                </div>
                            </div>
                        </div>
                        <div class="row g-4 text-center align-items-center justify-content-center border-bottom py-3">
                            <div class="col-12">
                                <div class="form-check text-start my-3">
                                    <input type="radio" class="form-check-input bg-primary border-0" id="Paypal-1"
                                        name="paymentMethod" value="Paypal"
                                        {{ old('paymentMethod') == 'Paypal' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="Paypal-1">Paypal</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn border-secondary mt-3 btn-warning py-3 px-4 text-uppercase w-100 text-light">Place Order</button>
            </form>
        </div>
    </div>
@endsection
