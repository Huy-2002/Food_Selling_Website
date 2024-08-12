<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="./fonts/fontawesome-free-6.4.0-web/css/all.min.css">
    <title>Document</title>
</head>

<body>

<?php
    require "header.php";

?>

    <div class="container">

        <!-- Danh sách món ăn -->
        <table class="table">
            <thead>
                <h1> ĐƠN HÀNG THANH TOÁN </h1>
                <tr>
                    <th>THỨ TỰ ĐƠN HÀNG</th>
                    <th>TÊN KHÁCH HÀNG</th>                  
                    <th>SỐ ĐIỆN THOẠI</th>
                    <th>ĐỊA CHỈ</th>
                    <th> GIÁ </th>
                </tr>
            </thead>  

            <tbody>
                <?php
                include 'config.php';
                // Cau lenh
                $selectOrder = "SELECT * FROM receipt ORDER BY rc_id,rc_price,rc_name,rc_phone,rc_address";

                //Thuc hien truy van
                $sql = mysqli_query($db, $selectOrder);

                //Duyet qua va in ket qua
                while ($var = mysqli_fetch_assoc($sql)) {
                ?>
                    <tr>

                        <td>
                            <?php echo $var['rc_id']; ?>
                        </td>

                        <td>
                            <?php echo $var['rc_name']; ?>
                        </td>

                        <td>
                        <?php echo $var['rc_phone']; ?>
                        </td>
                        

                        <td>
                            <?php echo $var['rc_address']; ?>
                        </td>

                        <td>
                            <?php echo $var['rc_price']; ?>
                        </td>
                <?php
                }
                ?>
            </tbody>
        </table>
        <a href="./vnpay_thanhtoanhistory.php" class="btn btn-primary">XEM ĐƠN HÀNG THANH TOÁN BẰNG VNPAY</a>
        <a href="./deleteallbill.php" class="btn btn-primary">XOÁ TẤT CẢ ĐƠN HÀNG</a>
        <a href="./cart.php" class="btn btn-primary">TRỞ VỀ</a>
    </div>

    <?php
    require "footer.php";
    ?>
    
</body>

</html>