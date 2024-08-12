<?php 
        session_start();
        session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" /> 
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="./fonts/fontawesome-free-6.4.0-web/css/all.min.css">

    <title>Thank Page</title>
</head> 
<style> 
body{
    margin: 0;
    font-family:"Segoe UI","Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: #212529;
    text-align: left; 
    background-color: #e9ecef;

}  
div{
    text-align: center; 
    border-radius: .3rem;
}

.content{
    margin: 300px 0 380px 0;
}

a{
    padding: .25rem .5rem;
    font-size: .875rem;
    line-height: 1.5;
    border-radius: 10px; 
    /* color: #fff;
    background-color: #151528;  */
    display: inline-block;
    font-weight: 400;
    text-align: center; 
    text-decoration: none;
}
h1{
    font-size: 4.5rem;
    font-weight: 300;
    line-height: 1.2;
}
.mesg{
    margin: 1rem;
}
</style>

<body>  
<?php 
        require_once 'header.php';
?>

    <div class="content">
        <h1> CẢM ƠN BẠN ĐÃ ĐẶT HÀNG </h1>
        <p class="mesg">
            <strong> CHÚNG TÔI SẼ LIÊN HỆ BẠN TRONG THỜI GIAN SỚM NHẤT  </strong> 
        </p>
        <hr> 
        <p class="btn btn-primary">
            <a href="./cart.php" style="color: white;"> TRỞ VỀ TRANG MUA HÀNG </a>
        </p>
    </div>

    <?php
        require_once 'footer.php';
    ?>

    <?php
        include 'config.php';

        // Xử lý thanh toán VNPAY và lưu vào cơ sở dữ liệu
        if (isset($_GET['vnp_Amount'])) {
            $vnp_Amount = $_GET['vnp_Amount'];
            $vnp_BankCode = $_GET['vnp_BankCode'];
            $vnp_BankTranNo = $_GET['vnp_BankTranNo'];
            $vnp_OrderInfo = $_GET['vnp_OrderInfo'];
            $vnp_PayDate = $_GET['vnp_PayDate'];
            $vnp_TmnCode = $_GET['vnp_TmnCode'];
            $vnp_TransactionNo = $_GET['vnp_TransactionNo'];
            $vnp_CardType = $_GET['vnp_CardType'];

            // Trích xuất dữ liệu từ thông tin thanh toán VNPAY và chạy truy vấn SQL để lưu vào cơ sở dữ liệu
            $sql = "INSERT INTO vn_pay (vnp_amount, vnp_bankcode, vnp_banktranno, vnp_carttype, vnp_orderinfo, vnp_paydate, vnp_tmncode, vnp_transactionno) 
                    VALUES ('$vnp_Amount', '$vnp_BankCode', '$vnp_BankTranNo', '$vnp_OrderInfo', '$vnp_PayDate', '$vnp_TmnCode', '$vnp_TransactionNo', '$vnp_CardType')";

            mysqli_query($db, $sql);
        }
    ?>


  </body>
</html>
