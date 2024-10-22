@extends('layouts.master')

@section('cart')
<div class="container my-5">
    <h2 class="text-center">Danh Sách Đơn Hàng</h2>

    @if($orders->isEmpty())
        <p class="text-center">Bạn chưa có đơn hàng nào.</p>
    @else
        <div class="table-responsive mt-4">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Mã Đơn Hàng</th>
                        <th>Ngày Đặt Hàng</th>
                        <th>Tổng Tiền</th>
                        <th>Trạng Thái</th>
                        <th>Chi Tiết</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->created_at->format('d/m/Y') }}</td>
                        <td>{{ number_format($order->total) }} VNĐ</td>
                        <td>{{ $order->status }}</td>
                        <td>
                            <a href="{{ route('order.success', $order->id) }}" class="btn btn-primary">Xem Chi Tiết</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
