@extends('layouts.master')

@section('bestseller')
    <div class="container mt-5">
        <h3 class="display-4 text-center">Giới Thiệu Về Chúng Tôi</h3>

        <div class="text-center mb-4 mt-3">
            <img src="{{ asset('user/img/hero-img-1.png') }}" alt="Giới thiệu về chúng tôi" class="img-fluid"
                style="max-width: 600px; border-radius: 10px;">
        </div>

        <p class="lead text-center">Chúng tôi là một công ty chuyên cung cấp sản phẩm và dịch vụ chất lượng cao, với mục tiêu
            mang lại sự hài lòng tối đa cho khách hàng.</p>

        <h2>Đội Ngũ Của Chúng Tôi</h2>
        <p>Chúng tôi có một đội ngũ chuyên gia giàu kinh nghiệm, đam mê và tận tâm với công việc. Mỗi thành viên trong đội
            ngũ đều cam kết làm việc chặt chẽ với khách hàng để hiểu rõ nhu cầu và mong muốn của họ.</p>

        <h2>Sứ Mệnh Của Chúng Tôi</h2>
        <p>Sứ mệnh của chúng tôi là cung cấp những sản phẩm và dịch vụ tốt nhất, đồng thời đảm bảo sự hài lòng của khách
            hàng thông qua chất lượng và dịch vụ hậu mãi tận tâm.</p>

        <h2>Giá Trị Cốt Lõi</h2>
        <ul>
            <li><strong>Chất lượng:</strong> Chúng tôi cam kết cung cấp sản phẩm và dịch vụ với chất lượng tốt nhất.</li>
            <li><strong>Đổi mới:</strong> Chúng tôi không ngừng tìm kiếm cách thức mới để cải tiến sản phẩm và dịch vụ.</li>
            <li><strong>Khách hàng:</strong> Sự hài lòng của khách hàng là ưu tiên hàng đầu của chúng tôi.</li>
        </ul>

        <h2>Liên Hệ Với Chúng Tôi</h2>
        <p>Nếu bạn có bất kỳ câu hỏi nào hoặc muốn biết thêm thông tin về sản phẩm và dịch vụ của chúng tôi, hãy liên hệ với
            chúng tôi qua trang <a href="{{ route('contact') }}">Liên Hệ</a>.</p>
    </div>
@endsection
