<?php
include 'config.php';

    // Xoa voucher

        $deleteBill = "DELETE FROM receipt";

        mysqli_query($db, $deleteBill);
        echo "<script>
        alert('XOÁ LỊCH SỬ ĐƠN HÀNG THÀNH CÔNG');
        window.location.href = '../Backend/history_bill.php';
        </script>";
?>