<?php
include 'config.php';

// Thêm kiểm tra if ($_SERVER["REQUEST_METHOD"] === "POST") 
//để đảm bảo rằng code chỉ được thực thi khi dữ liệu được gửi lên từ biểu mẫu.
if ($_SERVER["REQUEST_METHOD"] === "POST") 
{
// Nhận dữ liệu từ biểu mẫu
$foodId = $_POST["fid"];
$foodName = $_POST["FOODNAME"];
$price = $_POST["PRICE"];
$quantity = $_POST["QUANTITY"];
$description = $_POST["FOODDESCRIPT"];

// Lấy tên ảnh cũ từ cơ sở dữ liệu
$query = "SELECT FOODIMAGE FROM FOOD WHERE FOODID = $foodId";
$result = mysqli_query($db, $query);
$row = mysqli_fetch_assoc($result);
$oldFoodImage = $row['FOODIMAGE'];

if (!empty($_FILES['FOODIMAGE']['name'])) {
    // Ảnh mới được tải lên
    $foodImage = basename($_FILES["FOODIMAGE"]["name"]);
    $targetDir = "images/"; // Đường dẫn tuyệt đối tới thư mục lưu trữ ảnh
    $targetFile = $targetDir . $foodImage;
    $tempFile = $_FILES['FOODIMAGE']['tmp_name'];
    $sizeFile = $_FILES['FOODIMAGE']['size'];

    // Kiểm tra nếu thư mục uploads không tồn tại, thì tạo mới
    if (!file_exists($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    // Di chuyển ảnh đã tải lên vào thư mục đích
    if (move_uploaded_file($tempFile, $targetFile)) {
        // Tải ảnh lên thành công

        // Xóa ảnh cũ nếu tồn tại
        if ($oldFoodImage && file_exists($targetDir . $oldFoodImage)) {
            unlink($targetDir . $oldFoodImage);
        }

        // Cập nhật thông tin món ăn với ảnh mới
        $updateFood = "UPDATE FOOD
                       SET FOODNAME = '$foodName', FOODIMAGE = '$foodImage', PRICE = '$price', 
                           QUANTITY = '$quantity', FOODDESCRIPT = '$description' 
                       WHERE FOODID = $foodId ";
                       
    } else {
        // Tải ảnh lên thất bại
        // Bạn có thể thêm xử lý lỗi phù hợp ở đây
        // Ví dụ, hiển thị thông báo lỗi và chuyển hướng trở lại biểu mẫu chỉnh sửa
        echo "Tải ảnh lên thất bại.";
        exit();
    }
}

else {
    // Không có ảnh mới được tải lên
    // Cập nhật thông tin món ăn mà không thay đổi ảnh
    $updateFood = "UPDATE FOOD
                   SET FOODNAME = '$foodName', PRICE = '$price', 
                       QUANTITY = '$quantity', FOODDESCRIPT = '$description' 
                   WHERE FOODID = $foodId ";
}
}

// Thực hiện truy vấn SQL
mysqli_query($db, $updateFood);

// Chuyển hướng về trang hiển thị
header("location:../Backend/display.php");
?>
