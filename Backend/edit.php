<?php
session_start();
include 'config.php'; // Goi ra file ket noi database

//Lay du lieu
$id = $_GET["fid"];
// Xai get la do href="./edit.php?fid ben file display.php

// Lay mon an theo id 
$editFood = "SELECT * FROM FOOD WHERE FOODID = $id ";

// Thuc hien truy van
$conn = mysqli_query($db, $editFood);

// Duyet du lieu va lay ra
$take = mysqli_fetch_assoc($conn);

//Ngăn chặn người dùng lấy data thông qua method GET để vào trang admin mà ko cần đăng nhập.
if (isset($_SESSION['loginStatus']) == null) {
    header('location:../Frontend/login.html');
}
?>

<!-- Hien thi thong tin form chinh sua -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product</title>

    <!-- BOOSTRAP CDN 4 -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>

    <div class="container">
        <h1> CHỈNH SỬA MÓN ĂN </h1>
        <form action="../Backend/update.php" method="post" enctype="multipart/form-data">

            <!-- Hiển thị id trên thanh tìm kiếm -->
            <input type="hidden" name="fid" value="<?php echo $id ?>">

            <div class="form-group">
                <label for="FOODNAME"> TÊN MÓN ĂN </label>
                <input name="FOODNAME" id="FOODNAME" type="text" class="form-control" value="<?php echo $take['FOODNAME'] ?>">
            </div>


            <div class="form-group">
                <label for="FOODIMAGE"> HÌNH ẢNH MÓN ĂN </label>
                <input name="FOODIMAGE" id="FOODIMAGE" type="file" class="form-control" value="<?php echo $take['FOODIMAGE'] ?>">

            </div>

            <div class="form-group">
                <label for="PRICE"> GIÁ MÓN ĂN </label>
                <input name="PRICE" id="PRICE" type="text" class="form-control" value="<?php echo $take['PRICE'] ?>">
            </div>

            <div class="form-group">
                <label for="QUANTITY"> SỐ LƯỢNG MÓN ĂN </label>
                <input name="QUANTITY" id="QUANTITY" type="number" class="form-control" min='1' value="<?php echo $take['QUANTITY'] ?>">
            </div>

            <div class="form-group">
                <label for="FOODDESCRIPT"> MÔ TẢ MÓN ĂN </label>
                <input name="FOODDESCRIPT" id="FOODDESCRIPT" type="text" class="form-control" value="<?php echo $take['FOODDESCRIPT'] ?>">
            </div>

            <button class="btn btn-success" type="submit"> CHỈNH SỬA MÓN ĂN </button>

        </form>
    </div>

</body>

</html>

<!-- 
    Hướng dẫn liệt kê - thêm - sửa - xoá cơ bản CRUD với PHP MySQL
    https://www.youtube.com/watch?v=NyZx0B1-iZU&t=4240s

    Tạo Database và Thêm , Sửa , Xóa Sản Phẩm bằng PHP cơ bản
    https://www.youtube.com/watch?v=0y4FLXkW3uE&t=1321s
 -->