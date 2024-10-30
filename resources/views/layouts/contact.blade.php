@extends('layouts.master')

@section('bestseller')
    <div class="mt-5">
        <div class="text-center mx-auto mb-5" style="max-width: 700px;">
            <h1 class="display-4">Liên Hệ Chúng Tôi</h1>
            <p class="lead">Chúng tôi luôn sẵn sàng lắng nghe ý kiến và phản hồi từ bạn!</p>
        </div>

        <div class="container">
            <form action="#">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Họ và Tên</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label">Tin Nhắn</label>
                    <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Gửi</button>
            </form>

            <h2 class="mt-5">Thông Tin Liên Hệ</h2>
            <p><strong>Địa chỉ:</strong> Số 123, Đường ABC, Thành phố XYZ</p>
            <p><strong>Điện thoại:</strong> (012) 345-6789</p>
            <p><strong>Email:</strong> contact@yourdomain.com</p>
        </div>

    </div>
@endsection
