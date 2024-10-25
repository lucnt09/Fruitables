<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Libraries JavaScript -->
<script src="{{ asset('user/lib/easing/easing.min.js') }}"></script>
<script src="{{ asset('user/lib/waypoints/waypoints.min.js') }}"></script>
<script src="{{ asset('user/lib/lightbox/js/lightbox.min.js') }}"></script>
<script src="{{ asset('user/lib/owlcarousel/owl.carousel.min.js') }}"></script>

<!-- Template JavaScript -->
<script src="{{ asset('user/js/main.js') }}"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script>
    $(document).on("click", ".add-prods-cart", function() {
        console.log(123);
        const product_id = $(this).data('id');

        $.ajax({
            url: "{{ route('cart.add') }}",
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                product_id: product_id
            },
            success: function(response) {

                $("#count-cart").html(response.count);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    });

    $(document).ready(function() {
        // Thêm sản phẩm vào giỏ
        $(document).on('click', '.btn-increase', function() {
            const productId = $(this).data('id');

            $.ajax({
                url: '/cart/add',
                type: 'POST',
                data: {
                    "_token": $('meta[name="csrf-token"]').attr('content'),
                    "product_id": productId
                },
                success: function(response) {
                    location.reload(); // Tải lại trang để cập nhật giỏ hàng
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        });

        // Giảm sản phẩm trong giỏ
        $(document).on('click', '.btn-decrease', function() {
            const productId = $(this).data('id');

            $.ajax({
                url: '/cart/decrease/' + productId,
                type: 'POST',
                data: {
                    "_token": $('meta[name="csrf-token"]').attr('content'),
                    "product_id": productId
                },
                success: function(response) {
                    location.reload(); // Tải lại trang để cập nhật giỏ hàng
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        });
    });
</script>
<script>

    $(document).ready(function() {
        var hoverTimeout; // Biến lưu trữ timeout để quản lý thời gian

        // Khi di chuột vào sản phẩm
        $('.fruite-item').on('mouseenter', function() {
            var productId = $(this).data('id'); //Lấy ID sản phẩm
            var that = this; // Lưu tham chiếu tới sản phẩm hiện tại

            // Thiết lập timeout 5 giây
            hoverTimeout = setTimeout(function() {
                // Giả sử bạn có một route trả về chi tiết sản phẩm dưới dạng HTML
                $.ajax({
                    url: '/api/products/' + productId, // Đường dẫn tới route chi tiết sản phẩm
                    method: 'GET',
                    success: function(response) {
                        console.log(response);
                        var imagePath = response.image ? '/storage/' + response.image : '/storage/products/default.jpg';
                        $('#product-detail-content').html(`
        <div class="row">
            <div class="col-lg-6">
                <img src="${imagePath}" class="img-fluid rounded" width="700px" height="700px" alt="${response.name}">
            </div>
            <div class="col-lg-6">
                <h1>${response.name}</h1>
                <h2 class="text-primary">${response.price} VND</h2>
                <p><strong>Category: </strong>${response.category ? response.category.name : 'Chưa có danh mục'}</p>
                <a href="javascript:void(0);" data-id="${response.id}" class="btn btn-primary add-prods-cart text-light">
                    Add to Cart
                </a>
                <p class="mt-3">${response.short_description}</p>
            </div>
        </div>
    `);
                    }
                });

                // Hiển thị modal
                $('#productDetailModal').modal('show');
            }, 4000); // Đợi 5 giây (5000ms)
        });

        // Khi di chuột ra khỏi sản phẩm hoặc modal
        $('.fruite-item').on('mouseleave', function() {
            clearTimeout(hoverTimeout); // Hủy bỏ timeout nếu người dùng di chuột ra trước 5 giây
            $('#productDetailModal').modal('hide'); // Đảm bảo modal được ẩn đi
        });
    });
</script>
