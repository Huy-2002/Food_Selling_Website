<?php
// Initialize session if not already started
session_start();
include './config.php';
require_once 'header.php';
?>

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
    <div class="container">

        <!-- Danh sách món ăn -->
        <table class="table">
            <thead>
                <tr>
                    <th>SỐ THỨ TỰ</th>
                    <th>TÊN MÓN ĂN</th>                  
                    <th>SỐ LƯỢNG</th>
                    <th>TỔNG CỘNG</th>
                </tr>
            </thead>
            <tbody>
                <?php
                //Duyet qua va in ket qua
                $index = 0;
                $i = 1;
                // Initialize discount and ensure it's numeric
                $discount = 0;
                if (isset($_SESSION['discount'])) {
                    $discount = $_SESSION['discount'];
                } else {
                    $_SESSION['discount'] = 0; // Set discount to 0 if it is not set or not numeric
                }
                foreach ($_SESSION['SHOPEE'] as $key => $val) {
                    // Calculate the total price for each product
                    $giaTong = (int)$val['quantity'] * (float)$val['price'];
                    $giaTong = $giaTong - $giaTong * $discount / 100;
                ?>
                    <tr>
                        <td> <?php echo $i++; ?> </td>
                        <td> <?php echo $val['foodname']; ?> </td>
                        <td>
                            <?php echo $val['quantity']; ?>
                        </td>

                        <td> <?= $giaTong; ?> </td>
                    </tr>
                <?php
                    $index++;
                }
                ?>
            </tbody>
        </table>

        <hr>
        <!-- JQUERY STEP -->
        <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-steps/1.1.0/jquery.steps.min.js"></script> -->
        <div class="wrapper">
            <form action="./checkout_handler.php" method="POST">
                <div id="wizard">
                    <!-- SECTION 1 -->
                    <h4></h4>
                    <section class=" d-flex gap-3 flex-column">
                        <div class="form-row"> <input type="text" class="form-control" placeholder="Tên khách hàng" name="kh"> </div>
                        <div class="form-row"> <input type="text" class="form-control" placeholder="Số điện thoại" name="sdt"> </div>
                        <div class="form-row"> <input type="text" class="form-control" placeholder="Địa chỉ" name="dc"> </div>
                        <div class="form-row"> <input type="text" class="form-control" name="gia" value="<?php echo $giaTong; ?>" readonly> </div>
                    </section>
                    <button class="btn btn-success mt-2 mx-2" style="float: right;" type="submit" name="button">Thanh toán</button>
                    <a href="../Backend/payment.php" class="btn btn-danger mt-2 mx-2" style="float: right;" type="submit" name="button">QUAY VỀ</a>
                </div>
            </form>
        </div>
    </div>

    <?php
            require_once 'footer.php'; 
    ?>
    
     <!-- Cản người dùng f12 để sửa dữ liệu -->
<script src="http://sibeeshpassion.com/content/scripts/jquery-1.11.1.min.js"></script>  

                    <script>  
            document.onkeypress = function (event) 
            {  
            event = (event || window.event);  
            if (event.keyCode == 123) // thông số ASCII
            {  
            return false;  
            }  
            }  
            document.onmousedown = function (event) {  
            event = (event || window.event);  
            if (event.keyCode == 123) {  
            return false;  
            }  
            }  
            document.onkeydown = function (event) {  
            event = (event || window.event);  
            if (event.keyCode == 123) {  
            return false;  
            }  
            // disable F12 key
        if(e.keyCode == 123) {
            return false;
        }
 
        // disable I key
        if(e.ctrlKey && e.shiftKey && e.keyCode == 73){
            return false;
        }
 
        // disable J key
        if(e.ctrlKey && e.shiftKey && e.keyCode == 74) {
            return false;
        }

        //disable k key
        if(e.ctrlKey && e.shiftKey && e.keyCode == 75) {
            return false;
        }
 
        // disable U key
        if(e.ctrlKey && e.keyCode == 85) {
            return false;
        }
        }  
                </script>  

</body>

</html>