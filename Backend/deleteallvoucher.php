<?php
include 'config.php';

    // Xoa voucher

        $deleteVoucher = "DELETE FROM coupon";

        mysqli_query($db, $deleteVoucher);
        echo "<script>alert('XOA MA GIAM GIA THANH CONG')</script>";
        header('location:../Backend/voucher.php');

?>