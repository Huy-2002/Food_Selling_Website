<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>update</title>

     <!-- BOOSTRAP CDN 4 -->
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

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

if(isset($_POST['btn']) && $_POST['search'] != '') // Kiem tra nguoi dung co nhap mon an va bam vao icon tim kiem
{
    $contend = $_POST['search'];

    $sql = "SELECT * FROM FOOD WHERE FOODNAME LIKE '%$contend%'";
    $query = mysqli_query($db,$sql);

    if ($var = mysqli_fetch_assoc($query)) // Duyet qua tung mon an
    {
        ?>
       <div class="col-md-2 m-3 border border-success">
    <div class="col">
        <div class="product-detail mt-3 row justify-content-center">
            <div class="product-image">
                <!-- Bọc hình ảnh trong một container mới -->
                <div class="image-container">
                    <img style="width:100%; height: 150px;" src="images/<?php echo $var['FOODIMAGE']; ?>" alt="No image" class="picture">
                </div>
            </div>
        </div>

        <div class="other-detail text-center mt-3 row justify-content-center">
            <div class="product-name">
                <h2 class="name"> <?php echo $var['FOODNAME']; ?> </h2>
            </div>

            <div class="product-price">
                <h4 class="price"> Gia tien: <?php echo $var['PRICE']; ?> </h4>
            </div>

            <!-- Bọc thẻ <a> trong một container mới -->
            <div class="button-container">
                <a onclick="return alert('Thêm vào giỏ hàng thành công');" href="./payment.php?cart_session=add_items&foodid=<?php echo $var['FOODID']; ?>&foodname=<?php echo $var['FOODNAME']; ?>&
                                                                price=<?php echo $var['PRICE']; ?>&quantity=<?php echo $var['QUANTITY']; ?>" class="btn btn-success d-block text-center">THÊM VÀO GIỎ HÀNG</a>
            </div>
        </div>
    </div>
</div>



        <?php
    }

    else{

    $message = "Món ăn không tồn tại";
    echo 
    "
    <script type='text/javascript'>
                alert('$message');
                window.location.href='../Backend/cart.php';
    </script>
    ";}

}
else{

    echo 
    "
    <script type='text/javascript'>
                alert('NHẬP MÓN ĐI Ạ');
                window.location.href='../Backend/cart.php';
    </script>
    ";}


?>

<div class="col-md-2 m-3 border-success">
    <a href="../Backend/cart.php" class="btn btn-success"> TRỞ VỀ TRANG HIỂN THỊ SẢN PHẨM </a>
</div>

</body>
</html>

