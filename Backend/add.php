<?php

include 'config.php'; // goi file ket noi db
// if (isset($_POST["btn"]) 
// && $_POST["FOODNAME"] != ''
// && $_POST["FOODIMAGE"] != ''
// && $_POST["PRICE"] != ''
// && $_POST["QUANTITY"] != ''
// && $_POST["FOODDESCRIPT"] != '')

// {


// Nhan du lieu tu form
$foodName = $_POST["FOODNAME"];
$foodImage = basename($_FILES["FOODIMAGE"]["name"]);
// "FOODIMAGE" là tên cột trong cơ sở dữ liệu MySQL hoặc phpMyAdmin của bạn. 
//Nó được sử dụng để lưu đường dẫn của hình ảnh món ăn trong cơ sở dữ liệu sau khi tệp đã được tải lên từ người dùng và lưu trữ trên máy chủ.

$price = $_POST["PRICE"];
$quantity = $_POST["QUANTITY"];
$description = $_POST["FOODDESCRIPT"];

// Them mon an
if ($price < 0 || $quantity < 0) {
    echo "
        <script>
        alert
        ('GIÁ TRỊ MÓN ĂN NHẬP VÀO KHÔNG ĐÚNG')
        window.location.href='../Backend/display.php';
        </script>";
} 
else 
{
    $target_dir = "images/";
    $target_file = $target_dir . basename($_FILES["FOODIMAGE"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
}

    // Check if image file is an actual image or fake image
if (isset($_POST["submit"])) {

    // Kiểm tra ảnh có hợp lệ hay không
    $check = getimagesize($_FILES["FOODIMAGE"]["tmp_name"]);
    if ($check !== false) {
        // echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        // echo "File is not an image.";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        echo "<script>
                alert('YÊU CẦU CHỌN HÌNH MÓN ĂN.');
                window.location.href='../Backend/display.php';
            </script>";
        // if everything is ok, try to upload file
    } 
    else {
        //Kiểm tra nếu ảnh cũ đã tồn tại
        if (file_exists($target_file)) {
            echo "<script>
                     alert('HÌNH ĐÃ TỒN TẠI.');
                     window.location.href='../Backend/display.php';
                 </script>";
            $uploadOk = 0;
        } 
        else {

            // Đưa ảnh lên PHPMYADMIN
            if (move_uploaded_file($_FILES["FOODIMAGE"]["tmp_name"], $target_file)) {
                echo "<script>alert('Tải ảnh " . htmlspecialchars(basename($_FILES["FOODIMAGE"]["name"])) . " lên thành công.')<script>";
                $addFood = "INSERT INTO FOOD(FOODNAME, FOODIMAGE, PRICE, QUANTITY, FOODDESCRIPT)
                VALUES ('$foodName','$foodImage','$price','$quantity','$description') ";
                // Thuc hien truy van vao localhost phpmyadmin
                $rs = mysqli_query($db, $addFood);
                header("location:../Backend/display.php");
            } else {
                echo "<script>alert('Có lỗi khi tải ảnh.')</script>";
            }

        }

    }

}

?>


<!--
    Hướng dẫn liệt kê - thêm - sửa - xoá cơ bản CRUD với PHP MySQL
     https://www.youtube.com/watch?v=NyZx0B1-iZU&t=4240s
     
    Lập trình PHP - Hướng dẫn bật tính năng Designer trên PHPMyAdmin của Wamp
    https://www.youtube.com/watch?v=z7riYWIifks
-->