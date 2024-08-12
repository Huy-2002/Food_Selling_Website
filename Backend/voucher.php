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
        <?php
            include 'config.php';
        
        // Lưu voucher
        if(ISSET($_POST['save'])){
		$coupon_code = $_POST['coupon'];
		$discount = $_POST['discount'];
		$status = "Valid";
		$query = mysqli_query($db, "SELECT * FROM `coupon` WHERE `coupon_code` = '$coupon_code'");
		$row = mysqli_num_rows($query);
 
		if($row > 0){
			echo "<script>alert('MA GIAM GIA DA TON TAI')</script>";
			header('Location:../Backend/voucher.php');
		}else{
			mysqli_query($db, "INSERT INTO `coupon` VALUES(null, '$coupon_code', '$discount', '$status')");
			echo "<script>alert('TẠO MÃ GIẢM GIÁ THÀNH CÔNG')</script>";
		}
	}
        ?>


    <div class="container">
        <h1> TẠO MÃ GIẢM GIÁ </h1>
        <form action="../Backend/voucher.php" method="post">

            <div class="form-group">
                <label for="FOODNAME"> TÊN MÃ GIẢM GIÁ </label>
                <input name="coupon" id="" type="text" class="form-control">
            </div>

            <div class="form-group">
                <label for="FOODNAME"> MÃ GIẢM GIÁ </label>
                <input name="discount" id="" type="text" class="form-control">
            </div>

            <button name="save" class="btn btn-success" type="submit"> TẠO MÃ GIẢM GIÁ </button>
            <a onclick="return confirm('BẠN CÓ MUỐN XOÁ TẤT CẢ MÃ GIẢM GIÁ KHÔNG?');" href="./deleteallvoucher.php?voucherid=<?php //echo $voucher['coupon_id']; ?>" class="btn btn-danger">XOÁ TẤT CẢ MÃ GIẢM GIÁ</a>
            <a href="./display.php" class="btn btn-success"> ĐÓNG </a>

        </form>



    </div>

</body>

</html>