@extends('dashboard.admin.master')

@section('title')
    <h2>Chi Tiết Đơn Hàng #{{ $order->id }}</h2>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <h4>Thông Tin Khách Hàng</h4>
            <p><strong>Họ và tên:</strong> {{ $order->first_name }} {{ $order->last_name }}</p>
            <p><strong>Email:</strong> {{ $order->email }}</p>
            <p><strong>Điện thoại:</strong> {{ $order->mobile }}</p>
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

    <h4 class="mt-4">Chi Tiết Sản Phẩm</h4>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Hình ảnh</th>
                <th>Sản phẩm</th>
                <th>Số lượng</th>
                <th>Giá</th>
                <th>Tổng</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->orderItems as $item)
                <tr>
                    <td>
                        <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}"
                             style="width: 80px; height: 80px; object-fit: cover;">
                    </td>
                    <td>{{ $item->product->name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ number_format($item->price, 0, ',', '.') }} VND</td>
                    <td>{{ number_format($item->quantity * $item->price, 0, ',', '.') }} VND</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4" class="text-end"><strong>Tổng cộng:</strong></td>
                <td>{{ number_format($order->total, 0, ',', '.') }} VND</td>
            </tr>
        </tfoot>
    </table>
</div>
@endsection
