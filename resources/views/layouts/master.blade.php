<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.partials.head')
</head>

<body>


    <!-- Navbar start -->
    @include('layouts.partials.navbar')
    <!-- Navbar End -->

    @if (!isset($hideBanner) || !$hideBanner)
        <!-- Modal Search Start -->
        @include('layouts.partials.search')
        <!-- Modal Search End -->


        <!-- Hero Start -->
        @include('layouts.partials.hero')
        <!-- Hero End -->
    @endif

    <!-- Bestsaler Product Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            @yield('bestseller')
            @yield('cart')
            @yield('checkout')
        </div>
    </div>
    <!-- Bestsaler Product End -->


    <!-- Fruits Shop Start-->
    <div class="container-fluid fruite py-5">
        <div class="container py-5">
            @yield('product')
        </div>
    </div>
    <!-- Fruits Shop End-->

    <!-- Featurs Section Start -->
    @include('layouts.partials.featurs')
    <!-- Featurs Section End -->

    <!-- Footer Start -->
    @include('layouts.partials.footer')
    <!-- Footer End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-primary border-3 border-primary rounded-circle back-to-top"><i
            class="fa fa-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    @include('layouts.partials.js')
</body>

</html>
