<?php
ob_start();
session_start();
include "../view/header.php";
if(isset($_GET['act'])&&($_GET['act']!="")){
    $act=$_GET['act'];
    switch ($act) {
        /* Tai khoan */
        case 'dangky':
            include "../view/taikhoan/dangky.php";
            break;
        case 'dangnhap':
            include "../view/taikhoan/dangnhap.php";
            break;
        /* End tai khoan */
        case 'giohang':
            include "../view/cart/giohang.php";
            break;
        /* END GIO HANG */
        case 'sanpham':
            include "../view/sanpham/sanpham.php";
            break;
        case 'spdanhmuc':
            include "../view/sanpham/spdanhmuc.php";
            break;
        case 'chitietsp':
            include "../view/sanpham/chitietsp.php";
            break;
        case "chuyenkhoanvnp":
            header("location: ../assets/vnpay_php/vnpay_pay.php");
            break;
        case "chitiethuydon":
            include "../view/tintuc/lienhe.php";
            break;
        default:
        include "../view/home.php";
            break;
    }
}else{
    include "../view/home.php";
}

include "../view/footer.php";
?>