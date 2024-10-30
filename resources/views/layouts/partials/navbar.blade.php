<div id="spinner"
    class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50 d-flex align-items-center justify-content-center">
    <div class="spinner-grow text-primary" role="status"></div>
</div>
<div class="container-fluid fixed-top">
    <div class="container topbar bg-primary d-none d-lg-block">
        <div class="d-flex justify-content-between">
            <div class="top-info ps-2">
                <small class="me-3"><i class="fas fa-map-marker-alt me-2 text-secondary"></i> <a href="#"
                        class="text-white">123 Street, New York</a></small>
                <small class="me-3"><i class="fas fa-envelope me-2 text-secondary"></i><a href="#"
                        class="text-white">Email@Example.com</a></small>
            </div>
            <div class="top-link pe-2">
                <a href="#" class="text-white"><small class="text-white mx-2">Privacy Policy</small>/</a>
                <a href="#" class="text-white"><small class="text-white mx-2">Terms of Use</small>/</a>
                <a href="#" class="text-white"><small class="text-white ms-2">Sales and Refunds</small></a>
            </div>
        </div>
    </div>
    <div class="container px-0">
        <nav class="navbar navbar-light bg-white navbar-expand-xl">
            <a href="http://fruitables.test/shop" class="navbar-brand">
                <h1 class="text-primary display-6">Fruitables</h1>
            </a>
            <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarCollapse">
                <span class="fa fa-bars text-primary"></span>
            </button>
            <div class="collapse navbar-collapse bg-white d-flex justify-content-between" id="navbarCollapse">
                <div class="navbar-nav mx-auto">
                    <a href="{{ route('dashboard.user') }}" class="nav-item nav-link active">Trang Chủ</a>
                    <a href="{{ route('about') }}" class="nav-item nav-link">Giới Thiệu</a>

                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Danh Mục</a>
                        <div class="dropdown-menu m-0 bg-secondary rounded-0">
                            @foreach ($categories as $category)
                                <a href="{{ route('category.products', $category->id) }}" class="dropdown-item d-flex align-items-center">
                                    <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}"
                                        class="me-2" style="width: 50px; height: 50px; object-fit: cover;">
                                    {{ $category->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                    <a href="{{ route('contact') }}" class="nav-item nav-link">Liên Hệ</a>
                </div>
                <div class="d-flex align-items-center">
                    <button class="btn-search btn border border-secondary btn-md-square rounded-circle bg-white me-4"
                        data-bs-toggle="modal" data-bs-target="#searchModal">
                        <i class="fas fa-search text-primary"></i>
                    </button>
                    <a href="{{ route('cart.show') }}" class="position-relative me-4 my-auto">
                        <i class="fa fa-shopping-bag fa-2x"></i>
                        <span id="count-cart"
                            class="position-absolute bg-secondary rounded-circle d-flex align-items-center justify-content-center text-dark px-1"
                            style="top: -5px; left: 15px; height: 20px; min-width: 20px;">{{ session()->get('cart.count', 0) }}</span>
                    </a>
                    <a href="{{ route('my-orders') }}" class="my-auto">
                        <i class="fas fa-user fa-2x"></i>
                    </a>
                    <form action="{{ route('logout') }}" method="POST" class="ms-3">
                        @csrf
                        <button type="submit" class="btn btn-link text-primary" style="text-decoration: none;">
                            <i class="fas fa-sign-out-alt"></i> Đăng xuất
                        </button>
                    </form>
                </div>
            </div>
        </nav>
    </div>
        </nav>
</div>
</div>
