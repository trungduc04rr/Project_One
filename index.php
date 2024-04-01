<?php
ob_start();
session_start();
require_once 'Model/pdo.php';
require_once 'Model/danhmuc.php';
require_once 'Model/sanpham.php';
require_once 'Model/Account.php';
require_once 'Model/Bienthe.php';
require_once 'Model/order.php';
require_once 'global.php';
require_once 'helper.php';
require_once 'views/header.php';
$listsp = load_sp_home();
$listdm = load_all_dm("");
$list_sp_aothun = load_sp_aothun();
$load_sp_khoac = load_sp_khoac();
$list_sp_aoho = load_sp_aoho();
$list_sp_aosw = load_sp_aosw();

if (isset($_GET['act'])) {
    $act = $_GET['act'];
    switch ($act) {
            //start tài khoản
        case 'dangky':
            $hovatenErr = "";
            $tendangnhapErr = "";
            $matkhauErr = "";
            $emailErr = "";
            $sdtErr = "";
            if (isset($_POST['dangky'])) {
                $hovaten = $_POST['hovaten'];
                $dkyemail = $_POST['dkyemail'];
                $dkyuser = $_POST['dkyuser'];
                $dkypass = $_POST['dkypass'];
                $dkysdt = $_POST['dkysdt'];
                $listtk = load_all_tk(0, "");
                $check = true;
                if (empty(trim($hovaten))) {
                    $hovatenErr = "Vui lòng không bỏ trống !";
                } else {
                    if (!preg_match("/^[a-zA-Z \p{L}\p{Mn}]{6,}$/u", $hovaten)) {
                        $check = false;
                        $hovatenErr = "Họ và tên tối thiểu 6 ký tự và không bao gồm chữ số!";
                    }
                }
                if (empty(trim($dkyuser))) {
                    $check = false;
                    $tendangnhapErr = "Vui lòng không bỏ trống !";
                } else {
                    if (!preg_match("/^\w{6,16}$/", $dkyuser)) {
                        $check = false;
                        $tendangnhapErr = "Tên đăng nhập tối thiểu 6 ký tự !";
                    }
                }
                if (empty(trim($dkypass))) {
                    $check = false;
                    $matkhauErr = "Vui lòng không bỏ trống !";
                } else {
                    if (!preg_match("/^(?=.*[0-9])(?=.*[A-Z])\w{8,18}$/", $dkypass)) {
                        $check = false;
                        $matkhauErr = "Mật khẩu tối thiểu 8 ký tự bao gồm ký tự số và ký tự in hoa !";
                    }
                }
                if (empty(trim($dkysdt))) {
                    $check = false;
                    $sdtErr = "Vui lòng không bỏ trống !";
                } else {
                    if (!preg_match("/^0[1-9]\d{8}$/", $dkysdt)) {
                        $check = false;
                        $sdtErr = "Số điện thoại không đúng định dạng !";
                    }
                }
                if (empty(trim($dkyemail))) {
                    $check = false;
                    $emailErr = "Vui lòng không bỏ trống !";
                } else {
                    if (!preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]+$/", $dkyemail)) {
                        $check = false;
                        $emailErr = "Email không đúng định dạng !";
                    }
                    else{
                        $listtk = load_all_tk("","");
                        foreach ($listtk as $tk) {
                            if($dkyemail==$tk['email']){$check=false; $emailErr="Email đã tồn tại !";}
                        }
                    }
                }
                if ($check) {
                    insert_tk($hovaten, $dkyuser, $dkypass, $dkyemail, $dkysdt, "", 'Kích Hoạt');
                    echo '<script>
                            alert("Bạn đã đăng ký tài khoản thành công !");
                            window.location.href="?act=dangnhap";
                        </script>';
                }
            }
            include_once 'views/taikhoan/dangky.php';
            break;
         
        case 'dangnhap':
            $tkErr = "";
            $tendangnhapErr = "";
            if (isset($_POST['dangnhap'])) {
                $user = $_POST['username'];
                $pass = $_POST['password'];
                $check = true;
                if (empty(trim($user))) {
                    $check = false;
                    $tendangnhapErr = "Vui lòng không để trống !";
                } else {
                    if (!preg_match("/^\w{6,16}$/", $user)) {
                        $check = false;
                        $tendangnhapErr = "Tên đăng nhập tối thiểu 6 ký tự !";
                    }
                }
                if (empty(trim($pass))) {
                    $check = false;
                    $tkErr = "Vui lòng không để trống !";
                } else {
                    if (!preg_match("/^(?=.*[0-9])(?=.*[A-Z])\w{8,18}$/", $pass)) {
                        $check = false;
                        $tkErr = "Mật khẩu tối thiểu 8 ký tự bao gồm ký tự số và ký tự in hoa !";
                    }
                }
                if ($check) {
                    $checkuser = check_user($user, $pass);
                    if (is_array($checkuser)) {
                        if ($checkuser['matkhau'] != $pass || $checkuser['tendangnhap'] != $user) {
                            $tkErr = "Sai mật khẩu hoặc tên đăng nhập. Vui lòng kiểm tra lại !";
                        } else {
                            $_SESSION['user'] = $checkuser;
                            header("location: ?act=trangchu");
                        }
                    } else {
                        $tkErr = "Tài khoản không tồn tại. Vui lòng kiểm tra lại hoặc đăng ký !";
                    }
                }
            }

            include_once 'views/taikhoan/dangnhap.php';
            break;
            //case dang xuat
        case 'dangxuat':
            session_unset();
            header('location: ?act=trangchu');
            break;
        case 'thongtintk':
            if (isset($_SESSION['user'])) {
                $tendangnhapErr = "";
                $emailErr = "";
                $sodienthoaiErr = "";
                $hovatenErr = "";
                $diachiErr = "";
                if (isset($_POST['luu'])) {
                    $id = $_POST['id'];
                    $tendangnhap = $_POST['tendangnhap'];
                    $matkhau = $_POST['matkhau'];
                    $hovaten = $_POST['hovaten'];
                    $sodienthoai = $_POST['sodienthoai'];
                    $email = $_POST['email'];
                    $diachi = $_POST['diachi'];
                    $role = $_POST['role'];
                    $check = true;
                    if (empty(trim($hovaten))) {
                        $hovatenErr = "Vui lòng không để trống";
                    } else {
                        if (!preg_match("/^[a-zA-Z \p{L}\p{Mn}]{6,}$/u", $hovaten)) {
                            $check = false;
                            $hovatenErr = "Họ và tên tối thiểu 6 ký tự và không bao gồm chữ số!";
                        }
                    }
                    if (empty(trim($tendangnhap))) {
                        $check = false;
                        $tendangnhapErr = "Vui lòng không bỏ trống !";
                    } else {
                        if (!preg_match("/^\w{6,16}$/", $tendangnhap)) {
                            $check = false;
                            $tendangnhapErr = "Tên đăng nhập tối thiểu 6 ký tự !";
                        }
                    }
                    if (empty($sodienthoai)) $sodienthoai = "";
                    else {
                        if (!preg_match("/^0[1-9]\d{8}$/", $sodienthoai)) {
                            $check = false;
                            $sodienthoaiErr = "Số điện thoại không đúng định dạng !";
                        }
                    }
                    if (empty(trim($email))) {
                        $check = false;
                        $emailErr = "Vui lòng không bỏ trống !";
                    } else {
                        if (!preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]+$/", $email)) {
                            $check = false;
                            $emailErr = "Email không đúng định dạng !";
                        }
                    }
                    if (empty(trim($diachi))) {
                        $diachiErr = "";
                    } else {
                        if (!preg_match("/^[a-zA-Z0-9  ,\p{L}\p{Mn}]{25,}$/u", $diachi)) {
                            $check = false;
                            $diachiErr = "Kiểm tra lại địa chỉ !";
                        }
                    }
                    if ($check) {
                        update_tk($id, $hovaten, $tendangnhap, $matkhau, $email, $sodienthoai, $diachi, $role);
                        $_SESSION['user'] = check_user($tendangnhap, $matkhau);
                        echo '<script>
                            alert("Bạn đã sửa tài khoản thành công !");
                            window.location.href="?act=thongtintk";
                        </script>';
                    }
                }
            } else {
                header("location: ?act=trangchu");
            }
            include_once 'views/taikhoan/thongtintk.php';
            break;
        case 'doimatkhau':
            if (isset($_SESSION['user'])) {
                $matkhaucuErr = "";
                $matkhaumoiErr = "";
                $nhaplaimatkhaumoiErr = "";
                if (isset($_POST['doimatkhau'])) {
                    $matkhaucu = $_POST['matkhaucu'];
                    $matkhaumoi = $_POST['matkhaumoi'];
                    $nhaplaimatkhaumoi = $_POST['nhaplaimatkhaumoi'];
                    $check = true;
                    if (empty(trim($matkhaucu))) {
                        $check = false;
                        $matkhaucuErr = "Vui lòng không bỏ trống !";
                    }
                    $tk = load_one_tk($_SESSION['user']['id']);
                    if ($tk) {
                        if ($matkhaucu !== $tk['matkhau']) {
                            $check = false;
                            $matkhaucuErr = "Mật khẩu không chính xác !";
                        }
                    }
                    if (empty(trim($matkhaumoi))) {
                        $check = false;
                        $matkhaumoiErr = "Vui lòng không bỏ trống !";
                    } else {
                        if (!preg_match("/^(?=.*[0-9])(?=.*[A-Z])\w{8,18}$/", $matkhaumoi)) {
                            $check = false;
                            $matkhaumoiErr = "Mật khẩu tối thiểu 8 ký tự bao gồm ký tự số và ký tự in hoa !";
                        }
                    }
                    if ($nhaplaimatkhaumoi !== $matkhaumoi) {
                        $check = false;
                        $nhaplaimatkhaumoiErr = "Mật khẩu nhập lại không trùng khớp !";
                    }
                    if ($check) {
                        if ($tk) {
                            update_mk($matkhaumoi, $tk['id']);
                            $nhaplaimatkhaumoiErr = "Chúc mừng bạn đã đổi mật khẩu thành công !";
                        }
                    }
                }
            } else {
                header("location: ?act=trangchu");
            }
            include_once 'views/taikhoan/doimatkhau.php';
            break;
        case 'quenmatkhau':
            $thongbao = "";
            $tendangnhapErr = "";
            $emailErr = "";
            if (isset($_SESSION['user'])) {
                if (isset($_POST['quenmatkhau'])) {
                    $email = $_POST['email'];
                    $tendangnhap = $_POST['tendangnhap'];
                    $tk = load_one_tk($_SESSION['user']['id']);
                    if ($email === $tk['email'] && ($tendangnhap === $tk['tendangnhap'])) {
                        $thongbao = "Mật khẩu của bạn là: " . $tk['matkhau'];
                    } else {
                        $thongbao = "thông tin không chính xác !";
                    }
                }
            } else {
                if (isset($_POST['quenmatkhau'])) {
                    $emailcheck = $_POST['email'];
                    $tendangnhapcheck = $_POST['tendangnhap'];
                    $check = true;
                    if (empty(trim($emailcheck))) {
                        $check = false;
                        $emailErr = "Vui lòng không để trống !";
                    }
                    if (empty(trim($tendangnhapcheck))) {
                        $check = false;
                        $tendangnhapErr = "Vui lòng không để trống !";
                    }
                    $tk = quenmatkhau($emailcheck, $tendangnhapcheck);
                    if ($tk) {
                        $thongbao = "Mật khẩu của bạn là: " . $tk['matkhau'];
                    } else {
                        $thongbao = "thông tin không chính xác !";
                    }
                }
            }
            include_once 'views/taikhoan/quenmatkhau.php';
            break;
            //end tài khoản    
        case 'list_cart_user':
            // if (isset($_GET['id']) && ($_GET['id'] > 0)) {
            // }
            $list_cart_user = list_cart_user();
            $sum_cart_user = sum_cart_user();
            include_once 'views/cart/cart.php';
            break;
        case 'sanpham_ct':
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $id = $_GET['id'];
                $pro_ct = load_onespct($id);
                $list_bt = loadAll_bt($id);
                include "views/product_ct/sanpham_ct.php";
            } else {
                include "views/home.php";
            }
            break;

        case 'products':
            if (isset($_POST['submittimkiem'])) $kyw = $_POST['timkiem'];
            else $kyw = "";
            if (isset($_POST['submitlocgia'])) {
                $giadau = $_POST['giaspdau'];
                $giacuoi = $_POST['giaspcuoi'];
            } else {
                $giadau = 0;
                $giacuoi = 0;
            }
            if (isset($_GET['page']) && ($_GET['page'] != "")) $page = $_GET['page'];
            else $page = 1;
            $tongsp = dem_sp();
            $load_all_sp = load_all_sphome(0, $kyw, $giadau, $giacuoi, $page);
            $listdm = load_all_dm("");
            // $load_all_sp = load_all_sp($kyw, $page);
            include_once 'views/products/products.php';
            break;

        case 'spdanhmuc':
            if (isset($_GET['id']) && ($_GET['id'] != "")) {
                if (isset($_POST['submittimkiem'])) $kyw = $_POST['timkiem'];
                else $kyw = "";
                if (isset($_POST['submitlocgia'])) {
                    $giadau = $_POST['giaspdau'];
                    $giacuoi = $_POST['giaspcuoi'];
                } else {
                    $giadau = 0;
                    $giacuoi = 0;
                }
                $list_sp_dm = load_all_spdm($_GET['id'], $kyw, $giadau, $giacuoi, 1);
                $sp = load_one_spdm($_GET['id']);
            }
            include "views/products/spdanhmuc.php";
            break;

        default:
            include "views/home.php";
            break;
    }
} else {
    include "views/home.php";
}
include "views/footer.php";
