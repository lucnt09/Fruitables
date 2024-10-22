<ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion text-light" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard.admin.master') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3"> Admin </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">




    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Quản Lý Users</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('users.index') }}">Danh Sách</a>
                <a class="collapse-item" href="#">Thêm Mới</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCategory"
            aria-expanded="true" aria-controls="collapseCategory">
            <i class="fas fa-fw fa-folder"></i>
            <span>Quản Lý Danh Mục</span>
        </a>
        <div id="collapseCategory" class="collapse" aria-labelledby="headingCategory" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('categories.index') }}">Danh Sách</a>
                <a class="collapse-item" href="{{ route('categories.create') }}">Thêm Mới</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePost"
            aria-expanded="true" aria-controls="collapsePost">
            <i class="fas fa-fw fa-edit"></i>
            <span>Quản Lý Sản Phẩm</span>
        </a>
        <div id="collapsePost" class="collapse" aria-labelledby="headingPost" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('products.index') }}">Danh Sách</a>
                <a class="collapse-item" href="{{ route('products.create') }}">Thêm Mới</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOrders"
            aria-expanded="true" aria-controls="collapseOrders">
            <i class="fas fa-fw fa-edit"></i>
            <span>Quản Lý Đơn Hàng</span>
        </a>
        <div id="collapseOrders" class="collapse" aria-labelledby="headingOrder" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('orders.index') }}">Danh Sách</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <a class="btn btn-primay text-light" href="{{ route('dashboard.user') }}">Xem Website</a>

    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

    <!-- Sidebar Message -->

</ul>
