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
    $(document).on("click",".add-prods-cart", function(){
        console.log(123);
        const product_id = $(this).data('id');

        $.ajax({
               url: "{{ route('cart.add') }}",
               type: "POST",
               data: {
                "_token": "{{ csrf_token() }}",
                product_id: product_id
               } ,
               success: function (response) {

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
