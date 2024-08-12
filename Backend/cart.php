
<?php 
            
            session_start();
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="./fonts/fontawesome-free-6.4.0-web/css/all.min.css">
    
    <!-- Add these lines in the head section of your HTML -->
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

   


    

    <title>Cart Example</title>
</head>

<body>

<?php
    require "header.php";

?>

    <!-- Tim kiem -->
    <div class="container">
        <!-- <h1>Thanh tim kiem </h1> -->
        <form action="../Backend/search.php" method="post">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="TÌM KIẾM MÓN ĂN" name="search">
                <div class="input-group-btn">
                    <button name="btn" class="btn border border-black btn-default" type="submit">
                        <i class="glyphicon glyphicon-search"></i>
                    </button>
                </div>
            </div>
        </form>
        <!-- <a href="../Backend/display.php" class="btn btn-success"> DANH SACH SAN PHAM </a> -->
    </div>

    <!-- SAN PHAM -->
    <div class="container mt-3">
        <div class="row d-flex justify-content-center">

            <?php
            include 'config.php';

            unset($_SESSION['discount']);
            unset($_SESSION['discount_mess']);
            
            $sql = "SELECT * FROM FOOD";
            $query = mysqli_query($db, $sql);
            while ($row = mysqli_fetch_assoc($query)) {
            ?>
                <div class="col-md-3 ml-3 mb-3 border rounded border-success">

                    <div class="col">
                        <div class="product-detail mt-3 row">
                            <div class="product-image">
                                <img style="width:100%; height: 150px;" src="images/<?php echo $row['FOODIMAGE']; ?>" alt="No image" class="picture">
                            </div>
                        </div>

                        <div class="other-detail text-center mt-3 row">

                            <div class="product-name">
                                <h2 class="name"> <?php echo $row['FOODNAME']; ?> </h2>
                            </div>

                            <div class="product-price">
                                <h4 class="price"> GIÁ TIỀN: <?php echo $row['PRICE']; ?> </h4>
                            </div>

                            <a onclick="return alert('THÊM VÀO GIỎ HÀNG THÀNH CÔNG');" href="./payment.php?cart_session=add_items&foodid=<?php echo $row['FOODID']; ?>
                                                                                                &foodname=<?php echo $row['FOODNAME']; ?>
                                                                                                &price=<?php echo $row['PRICE']; ?>
                                                                                                &quantity=1" class="btn btn-success btn-sm mb-5 px-4">THÊM VÀO GIỎ HÀNG
                            </a>

                        </div>
                    </div>
                </div>
            <?php
            }
            ?>

        </div>

        <!-- <div class="col-md-6 mt-3">
                <a href="./display.php" class="btn btn-success"> BACK LAI DISPLAY</a>
        </div> -->
            
           <!-- <a href="../Frontend/login.html" class="btn btn-success"> ĐĂNG XUẤT </a>  -->
      
    </div>

            <?php 
            require "footer.php";
            ?>
</body>

</html>




<!-- 
    Create a simple Shopping cart in PHP MYSQL
    https://www.youtube.com/watch?v=B_Ck1JN-J_M
 -->