<?php
include 'config.php';

    // Xoa voucher

        $deleteOrdervnpay = "DELETE FROM vn_pay";
        mysqli_query($db, $deleteOrdervnpay);
        echo "
        <script>
        alert('XOÁ LỊCH SỬ ĐƠN HÀNG VNPAY THÀNH CÔNG');
        window.location.href='../Backend/vnpay_thanhtoanhistory.php';
        </script>";

?>