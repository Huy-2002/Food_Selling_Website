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
                <h1> ĐƠN HÀNG THANH TOÁN BẰNG VNPAY </h1>
    <tr>
        <th>ID</th>
        <th>Amount</th>
        <th>Bank Code</th>
        <th>Bank Transaction No</th>
        <th>Cart Type</th>
        <th>Order Info</th>
        <th>Pay Date</th>
        <th>Tmn Code</th>
        <th>Transaction No</th>
    </tr>

            </thead>  

            <tbody>
                <?php
                include 'config.php';
                // Cau lenh
                $selectOrder = "SELECT * FROM vn_pay ORDER BY id_vnpay,vnp_amount, vnp_bankcode, vnp_banktranno, vnp_carttype, vnp_orderinfo, vnp_paydate, vnp_tmncode, vnp_transactionno";

                //Thuc hien truy van
                $sql = mysqli_query($db, $selectOrder);

                //Duyet qua va in ket qua
               while ($lay = mysqli_fetch_assoc($sql)) {
                ?>
                    <tr>

                        <td>
                            <?php echo $lay['id_vnpay']; ?>
                        </td>

                        <td>
                            <?php echo $lay['vnp_amount']; ?>
                        </td>

                        <td>
                        <?php echo $lay['vnp_bankcode']; ?>
                        </td>

                        <td>
                            <?php echo $lay['vnp_banktranno']; ?>
                        </td>

                        <td>
                            <?php echo $lay['vnp_carttype']; ?>
                        </td>

                        <td>
                            <?php echo $lay['vnp_orderinfo']; ?>
                        </td>

                        <td>
                            <?php echo $lay['vnp_paydate']; ?>
                        </td>

                        <td>
                            <?php echo $lay['vnp_tmncode']; ?>
                        </td>

                        <td>
                            <?php echo $lay['vnp_transactionno']; ?>
                        </td>
                <?php
                }
                ?>
            </tbody>
        </table>
        <a href="./history_bill.php" class="btn btn-primary">XEM ĐƠN HÀNG THANH TOÁN </a>
        <a href="./vnpay_deleteallbill.php" class="btn btn-primary">XOÁ TẤT CẢ ĐƠN HÀNG</a>
        <a href="./cart.php" class="btn btn-primary">TRỞ VỀ</a>
    </div>

    <?php
    require "footer.php";
    ?>
    
</body>

</html>