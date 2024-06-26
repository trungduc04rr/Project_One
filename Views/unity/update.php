<style>
    .child {
        width: 250px;
        margin: 10px;
        padding: 15px;
        cursor: pointer;
    }

    .child a {
        margin-left: 10px;
        text-decoration: none;
        color: #080808;
        font-size: 1em;
        font-weight: bold;
    }

    .child a:hover {
        color: rgb(38, 0, 253);
    }

    .child li {
        list-style: none;
        display: inline-block;
    }

    .child .active {
        color: rgb(255, 21, 0);
    }

    .product_rights {
        float: left;
        border-radius: 10px;
        width: 300px;
        margin-left: 35px;
        box-shadow: 0 1px 2px 0 rgba(60, 64, 67, .1), 0 2px 6px 2px rgba(60, 64, 67, .15);
    }

    .image_user img {
        width: 70px;
        margin-top: 10px;
        text-align: center;
    }

    .product_rightst {
        text-align: center;
        padding: 5px 15px;
        border-radius: 10px;
        margin-left: 35px;
        box-shadow: 0 1px 2px 0 rgba(60, 64, 67, .1), 0 2px 6px 2px rgba(60, 64, 67, .15);
    }

    .product_rightst label {
        text-align: start;
    }
</style>
<section style="padding:30px;">
    <div class="row">
        <div class="col-5">
            <div class="product_rights">
                <div class="child">
                    <i class="fa-solid fa-house-chimney"></i>
                    <li><a href="?act=account">Trang Chủ</a></li>
                </div>
                <?php
                if ($role == 'Admin') {
                ?>
                    <div class="child">
                        <i class="fa-solid fa-screwdriver-wrench"></i>
                        <li><a href="Admin/index.php">Vào Trang Quản Trị</a></li>
                    </div>
                <?php } else ?>
                <div class="child">
                    <i class="fa-solid fa-cart-arrow-down"></i>
                    <li><a href="?act=user_order&id=<?= $id ?>">Đơn Hàng</a></li>
                </div>
                <!-- <div class="child">
                    <i class="fa-solid fa-paper-plane"></i>
                    <li>
                        <a href="index.php?action=check_in">Check In</a>
                    </li>
                </div> -->
                <div class="child">
                    <i class="fa-solid fa-user-shield"></i>
                    <li> <a href="?act=your">Tài khoản của bạn</a></li>
                </div>
                <div class="child">
                    <i class="fa-solid fa-recycle"></i>
                    <li> <a href="?act=update_user" class="active">Cập Nhật Thông Tin</a></li>
                </div>
            </div>
        </div>
        <div class="col-5">
            <div class="product_rightst">
                <div class="conts">
                    <div class="image_user">
                        <img src="https://account.cellphones.com.vn/_nuxt/img/Shipper_CPS3.77d4065.png" alt="">
                    </div>
                    <?php
                    if (isset($_SESSION['user'])) {
                        extract($_SESSION['user']);
                    ?>
                        <h3> <?= $tendangnhap ?></h3>
                    <?php
                    } else {
                    ?>
                        <h4>Xin Chào</h4>
                    <?php }
                    ?>
                </div>
                <form action="?act=update_user" method="post">
                    <div class="smember_info">
                        <div class="form-group text-start">
                            <div class="group">
                                <label>Email</label>
                            </div>
                            <input class="form-control" name="email" type="text" value="<?= $email ?>">
                        </div>
                        <div class="form-group text-start mt-2">
                            <div class="group">
                                <label>Địa chỉ</label>
                            </div>
                            <input class="form-control" name="diachi" type="text" value="<?= $diachi ?>">
                        </div>
                        <div class="form-group text-start mt-2">
                            <div class="group">
                                <label>Số điện thoại</label>
                            </div>
                            <input class="form-control" name="sodienthoai" type="text" value="<?= $sodienthoai ?>">
                        </div>
                        <div class="form-group text-start mt-2">
                            <div class="group">
                                <label>Full_Name</label>
                            </div>
                            <input class="form-control" name="hovaten" type="text" value="<?= $hovaten ?>">
                        </div>
                        <div class="form-group text-start mt-2">
                            <div class="group">
                                <label>Tài khoản</label>
                            </div>
                            <input class="form-control" name="tendangnhap" type="text" value="<?= $tendangnhap ?>">
                        </div>
                        <div class="form-group text-start mt-2 mb-2">
                            <div class="group">
                                <label>Mật khẩu</label>
                            </div>
                            <input class="form-control" name="matkhau" type="text" value="<?= $matkhau ?>">
                        </div>
                        <div class="form-group mt-2 mb-2">
                            <input type="hidden" name="id" value="<?= $id ?>">
                            <input class="btn btn-info rounded p-2 w-100" type="submit" name="capnhat" value="Cập Nhật">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
</section>