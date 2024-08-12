<?php
session_start();

include 'config.php';


$username = trim($_POST['username']);
$password = trim($_POST['password']);
$password = md5($password);
// Truy vấn cơ sở dữ liệu (Kiểm tra xem dữ liệu có được lưu trong bảng hay không)

$sql =
    "
        select * 
        from USER 
        Where TK = '$username' and MK = '$password'
    ";

// Thực thi truy vấn
$rs = mysqli_query($db, $sql);

// Kiểm tra sự tồn tại của tài khoản
if (mysqli_num_rows($rs) > 0) {
    extract($rs->fetch_assoc());

    if ($role == 0) {
        // Tạo session login để gọi lại bên edit.php và logout.php
        $_SESSION['loginStatus'] = $username;
        header('location:../Backend/display.php');
    } 
    else {
        echo "<script>alert('ĐĂNG NHẬP THẤT BẠI'): window.location.href='../Frontend/login.html';</script>";
    }

    if ($role == 1) {
        header('location:../Backend/cart.php');
    } else {
        echo "<script>alert('ĐĂNG NHẬP THẤT BẠI'); window.location.href='../Frontend/login.html';</script>";
    }
} else {
    // $message = "Tên đăng nhập không đúng";
    // echo "<script type='text/javascript'>alert('$message');</script>";
    // header('location:../Frontend/login.html');
    echo "
        <script>
        alert
        ('TÊN ĐĂNG NHẬP KHÔNG TỒN TẠI');
        window.location.href='../Frontend/login.html';
        </script>";
}

?>

<!-- 
    Xây dựng chức năng đăng nhập với PHP - MySQL
    https://www.youtube.com/watch?v=00r2fqYpiHA&t=508s

    Hướng dẫn xây dựng chức năng đăng ký, đăng nhập với PHP và MySQL (phần 1)
    https://www.youtube.com/watch?v=5YeAZw6uE-I 
-->