<?php
// function insert_user($Username, $Password, $Email, $FullName)
// {
//     $sql = "INSERT INTO users (User, Password, Email, FullName) 
//     VALUES ('$Username','$Password','$Email','$FullName')";
//     pdo_execute($sql);
// }

// function check_user($User, $Password)
// {
//     $sql = "SELECT * FROM users WHERE User='" . $User . "' AND Password='" . $Password . "' AND Status = 1";
//     $User = pdo_query_one($sql);
//     return $User;
// }

function  update_user($id, $User, $Email, $Password, $Tel, $FullName)
{
    $sql = "UPDATE users SET User = '" . $User . "', Password ='" . $Password . "', Email ='" . $Email . "', Tel ='" . $Tel . "',FullName ='" . $FullName . "' WHERE User_ID=" . $id;
    pdo_execute($sql);
}

function loadAll_account()
{
    $sql = "SELECT * FROM taikhoan ORDER BY id DESC";
    $list_account = pdo_query($sql);
    return $list_account;
}

function delete_account($id)
{
    $sql = "DELETE FROM taikhoan WHERE id=" . $id;
    pdo_execute($sql);
}

function update_account($id, $hovaten, $tendangnhap, $matkhau, $email, $role, $trangthai)
{
    $sql = "UPDATE taikhoan SET id = '".$id."', hovaten = '" . $hovaten . "', tendangnhap = '" . $tendangnhap . "', matkhau = '" . $matkhau . "', email = '" . $email . "', role = '" . $role. "', trangthai = '" . $trangthai. "'
       WHERE id=". $id;
    pdo_execute($sql);
}

function loadOne_account()
{
    $sql = "SELECT * FROM taikhoan WHERE id=" . $_GET['id'];
    $update_account = pdo_query_one($sql);
    return $update_account;
}

function check_Pass($Email)
{
    $sql = "SELECT * FROM users WHERE Email='" . $Email . "'";
    $Check_pass = pdo_query_one($sql);
    return $Check_pass;
}
function check_user($tendangnhap,$password)
{
    $sql= "SELECT * FROM taikhoan WHERE tendangnhap='$tendangnhap' AND  matkhau='$password' AND trangthai= 'Kích Hoạt' ";
    $checkuser=pdo_query_one($sql);
    return $checkuser;
}
function load_all_tk($vaitro,$kyw){
    $query="SELECT * FROM taikhoan WHERE 1";
    if ($kyw != "") {
        $query .= " AND (hovaten LIKE '%" . $kyw . "%' OR email LIKE '%" . $kyw . "%' OR sodienthoai LIKE '%" . $kyw . "%')";
    }
    if($vaitro==1){
        $query .=" AND role='$vaitro' AND trangthai= 'Kích Hoạt'";
    }else if($vaitro==0){
        $query .=" AND role='$vaitro' AND trangthai= 'Kích Hoạt'";
    }
    $query .=" ORDER BY id asc";
    return pdo_query($query);
}
function insert_tk($hovaten,$tendangnhap,$matkhau,$email,$sodienthoai,$diachi,$role){
    $query="INSERT INTO `taikhoan`(`hovaten`, `tendangnhap`, `matkhau`, `email`, `sodienthoai`, `diachi`, `role`) 
    VALUES ('$hovaten','$tendangnhap','$matkhau','$email','$sodienthoai','$diachi','$role')";
    pdo_execute($query);
}