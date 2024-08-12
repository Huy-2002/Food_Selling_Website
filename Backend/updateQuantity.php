<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $foodId = $_POST['foodId'];
    $newQuantity = $_POST['newQuantity'];

    // Cập nhật số lượng trong cơ sở dữ liệu
    $sql = "UPDATE FOOD SET QUANTITY = $newQuantity WHERE FOODID = $foodId";
    $result = mysqli_query($db, $sql);

    // Kiểm tra kết quả của truy vấn và thông báo thành công hoặc lỗi
    if ($result) {
        echo "success";
    } else {
        echo "error";
    }
}
?>
