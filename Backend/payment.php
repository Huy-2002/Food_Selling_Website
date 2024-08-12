<?php
// Initialize session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include './config.php';

// ... (rest of the code)

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="./fonts/fontawesome-free-6.4.0-web/css/all.min.css">

    <title>Payment Page</title>
</head>

<body>
    <!-- Include the common header section -->
    <?php require "header.php"; ?>


    <div class="container-fluid">
        <div class="col-md-6">
            <?php
            // Include necessary files and initialize discount
            include 'cart_session.php';
            include 'config.php';

            // Initialize discount and ensure it's numeric
            $discount = 0;
            if (isset($_SESSION['discount'])) {
                $discount = $_SESSION['discount'];
            } else {
                $_SESSION['discount'] = 0; // Set discount to 0 if it is not set or not numeric
            }

            // Display the payment page
            if (isset($_SESSION['SHOPEE']) && is_array($_SESSION['SHOPEE']) && !empty($_SESSION['SHOPEE'])) {
            ?>
                <!-- Display the cart table -->
                <table class="table table-bordered">
                    <thead>
                        <th> MÃ SẢN PHẨM </th>
                        <th> TÊN SẢN PHẨM </th>
                        <th> GIÁ TIỀN </th>
                        <th> SỐ LƯỢNG </th>
                        <th> THÀNH TIỀN </th>
                        <th> XOÁ SẢN PHẨM </th>
                    </thead>

                    <tbody>
                        <?php
                        $index = 0;
                        $i = 1;
                        foreach ($_SESSION['SHOPEE'] as $key => $val) {
                            // Calculate the total price for each product
                            $giaTong = (int)$val['quantity'] * (float)$val['price'];
                            //$giaTong = $giaTong - $giaTong * $discount/100;
                        ?>
                            <tr>
                                <td> <?php echo $i++; ?> </td>
                                <td> <?php echo $val['foodname']; ?> </td>
                                <td> <?php echo $val['price']; ?> </td>
                                <td>
                                    <!-- Quantity input field -->
                                    <input type="number" min="1" max="500" name="quantity[]" value="<?php echo $val['quantity']; ?>" onchange="updateQuantity(this, <?= $val['price']; ?>, <?= $index; ?>)" data-old-value="<?php echo $val['quantity']; ?>">
                                </td>

                                <td> <span id="subtotal_<?= $index; ?>"> <?= $giaTong; ?> </span> </td>
                                <td>
                                    <!-- Remove product link -->
                                    <a href="payment.php?cart_session=remove_items&index=<?= $key; ?>" class="btn btn-success"> XOÁ </a>
                                </td>
                            </tr>
                        <?php
                            $index++;
                        }
                        ?>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><b> TỔNG CỘNG </b></td>
                            <!-- Use number_format to ensure $_SESSION['totalAmount'] is properly formatted as a numeric value -->
                            <td id="totalAmount"> <?= $_SESSION['totalAmount']; ?> </td>
                        </tr>
                    </tbody>
                </table>

                <!-- Add the hidden input field for applying the voucher here -->
                <?php
                if (isset($_SESSION['discount_mess'])) {
                    echo ($_SESSION['discount_mess']);
                }

                ?>

                <form class="col-6 mt-3 mb-3 pr-3 d-flex" method="get">
                    <input name="coupon" id="" type="text" class="form-control" required>
                    <button value="add_vouchers" name="cart_session" class="btn btn-primary col-3 ms-3"> ÁP DỤNG </button>
                </form>
            <?php

            } else {
                // Display a message when the cart is empty
                echo "<h3>Giỏ hàng trống, vui lòng mua hàng để thêm vào giỏ hàng.</h3>";
            }
            ?>
        </div>
    </div>

    </div>
    </div>


    <!-- Payment methods form -->
    <div class="container-fluid">
        <form action="../Backend/thanhtoan.php" method="POST">
            <div class="col-md-4 mb-3 phuongthucthanhtoan">
                <h1> PHƯƠNG THỨC THANH TOÁN</h1>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="payment" id="exampleRadio1" value="tienmat"  required>
                    <label class="form-check-label" for="exampleRadios1">
                        TIỀN MẶT
                    </label>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="radio" name="payment" id="exampleRadio2" value="chuyenkhoan" required>
                    <label class="form-check-label" for="exampleRadios2">
                        CHUYỂN KHOẢN
                    </label>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="radio" name="payment" id="exampleRadio3" value="vnpay" required>
                    <img src="./images/vnpay.jpeg" width="50" height="32" alt="No image">
                    <label class="form-check-label" for="exampleRadios2">
                        THANH TOÁN BẰNG VNPAY
                    </label>
                </div>
                <input class="btn btn-success" value="THANH TOÁN NGAY" name="redirect" type="submit">
                <a href="./cart.php" class="btn btn-success">TRỞ VỀ TRANG SẢN PHẨM</a>
            </div>
        </form>
    </div>

    <!-- Javascript điều chỉnh số lượng -->
    <script>
        let tongCong = <?= $_SESSION['totalAmount']; ?>; // Initialize tongCong with the initial total amount
        var discount = <?php echo $discount;?>;

        function updateQuantity(input, price, index) 
        {
            const quantity = input.value;

            // Check if the quantity is a positive number
        if (quantity < 0 || quantity > 500) // Chặn người dùng nhập số âm
        {
            // Display a warning message or perform any other action you want
            alert('Số lượng không hợp lệ.');
            // Reset the input value to the previous valid value (stored in data-old-value attribute)
            input.value = input.dataset.oldValue;
            return;
        }
        

            const subtotalCell = document.getElementById('subtotal_' + index);
            const currentSubtotal = parseInt(subtotalCell.innerText);

            const newSubtotal = quantity * price;
            subtotalCell.innerText = newSubtotal;

            const oldQuantity = parseInt(input.dataset.oldValue);
            const quantityDifference = quantity - oldQuantity;
            tongCong += quantityDifference * price; // Update tongCong based on quantity change
            tongCong = tongCong - tongCong*discount/100;
            // Update the total amount display and round it to 2 decimal places
            //document.getElementById('totalAmount').innerText = tongCong.toFixed(2);
            document.getElementById('totalAmount').innerText = tongCong;
            input.dataset.oldValue = quantity;
        }
    </script>

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


<?php
    require "footer.php";
?>

</body>

</html>