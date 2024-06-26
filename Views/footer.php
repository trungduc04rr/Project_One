    <!-- Start footer -->
    <footer class="cs_footer cs_style_1 cs_primary_bg">
        <div class="cs_height_130 cs_height_lg_80"></div>
        <div class="container">
            <div class="cs_footer_main">
                <div class="row">
                    <div class="col-xxl-3 col-lg-3">
                        <div class="cs_footer_widget cs_text_widget">
                            <img src="assets/client/img/logo.svg" alt="Logo">
                            <p>Khám phá những niềm vui bất tận điểm đến Thương mại điện tử duy nhất của bạn.</p>
                            <img src="assets/client/img/payment_method_1.png" alt="Payment">
                        </div>
                    </div>
                    <div class="col-xxl-7 offset-xxl-2 offset-lg-1 col-lg-8">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="cs_footer_widget cs_menu_widget">
                                    <h3 class="cs_footer_widget_title cs_fs_21 cs_semibold">Làm quen</h3>
                                    <ul>
                                        <li><a href="about.html">Về chúng tôi</a></li>
                                        <li><a href="shop.html">Sản phẩm</a></li>
                                        <li><a href="blog_details.html">Nhấn</a></li>
                                        <li><a href="blog.html">Blog</a></li>
                                        <li><a href="contact.html">Liên hệ chúng tôi</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="cs_footer_widget cs_menu_widget">
                                    <h3 class="cs_footer_widget_title cs_fs_21 cs_semibold">Dịch vụ khách hàng</h3>
                                    <ul>
                                        <li><a href="#">Trung tâm trợ giúp</a></li>
                                        <li><a href="#">Vận chuyển & Giao hàng</a></li>
                                        <li><a href="#">Trao đổi & Trả lại</a></li>
                                        <li><a href="#">Phương thức thanh toán</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="cs_footer_widget cs_menu_widget">
                                    <h3 class="cs_footer_widget_title cs_fs_21 cs_semibold">Liên hệ Thông tin</h3>
                                    <ul class="cs_contact_info">
                                        <li>Gọi : +84123456789</li>
                                        <li>Email : <a href="https://static.laralink.com/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="127b7c747d52617366667b6b73613c717d7f">[fashion@gmail.com]</a></li>
                                        <li>Thứ Hai – Thứ Sáu: 11 giờ sáng – 9 giờ tối</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="cs_footer_bottom">
                <div>
                    <p class="cs_copywrite_text mb-0">Copyright & 2024, All rights reserved.</p>
                </div>
                <div>
                    <ul class="cs_footer_menu_widget_2">
                        <li><a href="#">Chính sách bảo mật</a></li>
                        <li><a href="#">Điều khoản của chúng tôie</a></li>
                        <li><a href="#">Hợp pháp</a></li>
                    </ul>
                </div>
                <div>
                    <div class="cs_social_links">
                        <a href="https://www.instagram.com/" target="_blank"><i class="fa-brands fa-instagram"></i></a>
                        <a href="https://www.facebook.com/" target="_blank"><i class="fa-brands fa-facebook"></i></a>
                        <a href="https://twitter.com/" target="_blank"><i class="fa-brands fa-x-twitter"></i></a>
                        <a href="https://www.youtube.com/" target="_blank"><i class="fa-brands fa-youtube"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- End footer -->
    <!-- Start scroll up button -->
    <df-messenger intent="WELCOME" chat-title="Chat với Support" agent-id="43911016-6190-4d15-8c93-35ce28710a81" language-code="vi"></df-messenger>
    <div style="margin-right: 6px; margin-bottom: 70px;" class="cs_scrollup_btn" id="cs_scroll_btn">
        <i class="fa-solid fa-arrow-up"></i>
    </div>
    <!-- End scroll up button -->
    <!-- All script files -->
    <script data-cfasync="false" src="../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="assets/client/js/jquery-3.6.0.min.js"></script>
    <script src="assets/client/js/jquery.slick.min.js"></script>
    <script src="assets/client/js/isotope.pkg.min.js"></script>
    <script src="assets/client/js/jquery-ui.min.js"></script>
    <script src="assets/client/js/animated-headline.js"></script>
    <script src="assets/client/js/main.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $(".add-to-cart").click(function() {
                var product_id = $(this).data("product-id"); // Lấy product_id từ thuộc tính data của nút
                var idtaikhoan = $(this).data("user-id");
                var id_bienthe = 3;
                var size = $('input[name="size_' + product_id + '"]:checked').val();
                var color = $('input[name="color_' + product_id + '"]:checked').val();
                var soluong = parseInt($(".cs_quantity_input").text());
                var thanhtien = $(this).data("price-sp");
                $.ajax({
                    type: "POST",
                    url: "Model/cart.php",
                    data: {
                        product_id: product_id,
                        idtaikhoan: idtaikhoan,
                        id_bienthe: id_bienthe,
                        size: size,
                        color: color,
                        soluong: soluong,
                        thanhtien: thanhtien
                    },
                    success: function(response) {
                        $("#cart-message").html(response); // Hiển thị thông báo từ máy chủ
                        updateCartCount(); // Cập nhật số lượng sản phẩm trong biểu tượng giỏ hàng
                    },
                });
            });

            // Hàm cập nhật số lượng sản phẩm trong biểu tượng giỏ hàng
            // function updateCartCount() {
            //     $.ajax({
            //         type: "GET",
            //         url: "get_cart_count.php",
            //         success: function(response) {
            //             $("#cart-count").text(response); // Cập nhật số lượng sản phẩm trong biểu tượng giỏ hàng
            //         },
            //     });
            // }

            // Gọi hàm cập nhật số lượng sản phẩm trong biểu tượng giỏ hàng khi trang được tải
            updateCartCount();
        });
    </script>
    <script>
        $(document).ready(function() {
    // Lắng nghe sự kiện khi số lượng thay đổi
    $('.cs_quantity_btn').on('click', function() {
        var $button = $(this);
        var $row = $button.closest('tr');

        // Lấy ID của sản phẩm
        var productId = $row.attr('data-product-id');

        // Lấy giá tiền của sản phẩm
        var pricePerItem = parseFloat($row.find('.unit-price').text().replace(' VNĐ', '').replace(/\./g, '').replace(',', '.'));

        // Lấy số lượng hiện tại
        var oldValue = parseInt($row.find('.cs_quantity_input').text());

        
        // Cập nhật số lượng mới
        $row.find('.cs_quantity_input').text(newValue);

        // Tính giá tiền mới dựa trên số lượng mới
        var newPrice = pricePerItem * newValue;

        // Cập nhật giá tiền mới vào cột Tổng
        $row.find('.total-price').text(newPrice.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' }));

        // Lưu số lượng mới vào localStorage
        localStorage.setItem('quantity_' + productId, newValue);

        // Cập nhật tổng giá trị của tất cả các sản phẩm
        updateTotalAmount();
        
    });

    // Hàm cập nhật tổng giá trị của tất cả các sản phẩm
    function updateTotalAmount() {
        var totalAmount = 0;
        $('.total-price').each(function() {
            var price = parseFloat($(this).text().replace(' VNĐ', '').replace(/\./g, '').replace(',', '.'));
            totalAmount += price;
        });

        // Hiển thị tổng giá trị mới
        $('.total-amount').text(totalAmount.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' }));
    }

    
    // Cập nhật tổng giá trị của tất cả các sản phẩm sau khi tải lại trang
    updateTotalAmount();
});


    </script>
   <script>
    // ajax bình luận
    function binhluanjs(id,hovaten){
            console.log("Bắt đầu hàm binhluanjs");
            var noidung=$("#noidung").val();
            if(noidung=="") $("#binhluanErr").text("Vui lòng nhập nội dung trước khi gửi!");
            else{
                var ngaybinhluan=$("#ngaybinhluan").val();
                $.ajax({
                    type: 'POST',
                    url: 'index.php?act=sanpham_ct&id=' + id,
                    data: {
                        noidung: noidung
                    },
                    success: function(response) {
                        var soluongcu = parseInt($("#countbl").text());
                        var soluongmoi = soluongcu + 1;
                        $("#countbl").text(soluongmoi);
                        $('#loadbinhluan').append('<div id="loadbinhluan"><ul class="cs_client_review_list cs_mp0"><li><div class="cs_client_review"><div class="cs_review_media"><div class="cs_review_media_thumb"><img src="assets/client/img/grid.png" alt="Avatar"></div><div class="cs_review_media_right"><div class="cs_rating_container"><div class="cs_rating cs_size_sm" data-rating="5"><div class="cs_rating_percentage"></div></div></div><p class="mb-0 cs_primary_color cs_semibold">' + hovaten + '</p></div><p class="cs_review_posted_by">' + ngaybinhluan + '</p></div><p class="cs_review_text">' + noidung + '</p></div></li></ul></div>');
                        $('#noidung').val('');
                        $("#binhluanErr").text("");
                    },
                    error: function(error) {
                        console.error('Lỗi: ', error);
                        alert('Có lỗi xảy ra khi gửi bình luận');
                    }
                });
    }
}
   </script>
    <script src="https://www.gstatic.com/dialogflow-console/fast/messenger/bootstrap.js?v=1"></script>
    </body>

    </html>