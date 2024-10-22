@extends('dashboard.admin.master')

@section('title')
    <h1>Danh Sách Đơn Hàng</h1>
@endsection

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Danh Sách Đơn Hàng</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">List</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    @if (session('success'))
                        <div class="alert alert-success mt-3">
                            {{ session('success') }}
                        </div>
                    @endif

                    <table class="table table-bordered mt-3">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tên Khách Hàng</th>
                                <th>Email</th>
                                <th>Số Điện Thoại</th>
                                <th>Tổng Tiền</th>
                                <th>Trạng Thái</th>
                                <th>Hành Động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->first_name }} {{ $order->last_name }}</td>
                                    <td>{{ $order->email }}</td>
                                    <td>{{ $order->mobile }}</td>
                                    <td>{{ number_format($order->total, 0, ',', '.') }} VND</td>
                                    <td>
                                        <form action="{{ route('orders.updateStatus', $order->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PUT')
                                            <select name="status" class="form-control" onchange="this.form.submit()">
                                                <option value="Chờ xác nhận" {{ $order->status == 'Chờ xác nhận' ? 'selected' : '' }}>Chờ xác nhận</option>
                                                <option value="Đang giao" {{ $order->status == 'Đang giao' ? 'selected' : '' }}>Đang giao</option>
                                                <option value="Đã giao" {{ $order->status == 'Đã giao' ? 'selected' : '' }}>Đã giao</option>
                                                <option value="Đã hủy" {{ $order->status == 'Đã hủy' ? 'selected' : '' }}>Đã hủy</option>
                                            </select>
                                        </form>
                                    </td>
                                    <td>
                                        <a href="{{ route('orders.show', $order->id) }}" class="btn btn-info">Xem</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection
