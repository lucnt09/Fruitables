@extends('layouts.master')

@section('checkout')
    <div class="container py-5 mt-5">
        <h2>Chi tiết đơn hàng #{{ $order->id }}</h2>

        <div class="row mt-4">
            <div class="col-md-6">
                <h4>Thông tin khách hàng</h4>
                <p><strong>Họ và tên:</strong> {{ $order->first_name }} {{ $order->last_name }}</p>
                <p><strong>Mobile:</strong> {{ $order->mobile }}</p>
                <p><strong>Email:</strong> {{ $order->email }}</p>
                <p><strong>Địa chỉ:</strong> {{ $order->address }}, {{ $order->city }}</p>
                <p><strong>Ghi chú:</strong> {{ $order->notes ?? 'Không có ghi chú' }}</p>
            </div>
            <div class="col-md-6">
                <h4>Trạng thái đơn hàng</h4>
                <p>{{ ucfirst($order->status) }}</p>

                <h4>Phương thức thanh toán</h4>
                <p>{{ $order->payment_method == 'Paypal' ? 'Paypal' : 'Thanh toán khi nhận hàng' }}</p>
            </div>
        </div>

        <h4 class="mt-3">Chi tiết sản phẩm</h4>
        <table class="table table-bordered mt-2">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Sản phẩm</th>
                    <th>Hình ảnh</th>
                    <th>Số lượng</th>
                    <th>Giá</th>
                    <th>Tổng</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->orderItems as $item)
                    <tr>
                        <td>{{ $item->product->id }}</td>
                        <td>{{ $item->product->name }}</td>
                        <td class="d-flex justify-content-center">
                            <img src="{{ asset('storage/' . $item->product->image) }}" class="img-fluid me-5 rounded-circle"
                                style="width: 120px; height: 120px;" alt="">
                        </td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ number_format($item->price) }}$</td>
                        <td>{{ number_format($item->quantity * $item->price) }}$</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" class="text-end">Tổng cộng:</td>
                    <td>{{ number_format($order->total) }}$</td>
                </tr>
            </tfoot>
        </table>
    </div>
@endsection
