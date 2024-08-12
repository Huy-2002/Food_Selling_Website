<?php
// Initialize session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include './config.php';

// Check if 'cart_session' parameter exists
if (!empty($_GET['cart_session']))
    $cart_session = $_GET['cart_session'];
else
    $cart_session = '';

// Add items to the cart (cart.php)
if ($cart_session == 'add_items') {
    $id = $_GET['foodid'];
    $foodName = $_GET['foodname'];
    $price = $_GET['price'];
    $quantity = $_GET['quantity'];

    $food_arr = array(
        'foodid' => $id,
        'foodname' => $foodName,
        'price' => $price,
        'quantity' => $quantity
    );

    if (!empty($_SESSION['SHOPEE'])) {
        $product_ids = array_column($_SESSION['SHOPEE'], 'foodid');
        if (in_array($id, $product_ids)) {

            foreach ($_SESSION['SHOPEE'] as $key => $val) {
                if ($_SESSION['SHOPEE'][$key]['foodid'] == $id) {
                    $_SESSION['SHOPEE'][$key]['quantity'] = $_SESSION['SHOPEE'][$key]['quantity'] + $quantity;  // Combine Session quantity
                }
            }
        } else {
            $_SESSION['SHOPEE'][] = $food_arr;
        }
    } else {
        $_SESSION['SHOPEE'][] = $food_arr;
    }

    header('location:../Backend/payment.php');
}

// Remove items from the cart (payment.php)
if ($cart_session == 'remove_items') {
    $index = $_GET['index'];
    if (isset($_SESSION['SHOPEE'])) {
        unset($_SESSION['SHOPEE'][$index]);
    }
}

// Initialize discount
$discount = 0;
if (isset($_SESSION['SHOPEE']) && is_array($_SESSION['SHOPEE']) && !empty($_SESSION['SHOPEE'])) {
    $discount = $_SESSION['discount'];
} else {
    $_SESSION['discount'] = 0;
}


// Calculate initial total amount
$tongCong = 0;
if (isset($_SESSION['SHOPEE']) && is_array($_SESSION['SHOPEE']) && !empty($_SESSION['SHOPEE'])) {
    foreach ($_SESSION['SHOPEE'] as $key => $val) {
        $giaTong = (int)$val['quantity'] * (float)$val['price'];

        $tongCong += $giaTong;
    }
}


$tongCong = $tongCong - ($tongCong * $discount / 100);


// Update the total amount in session for use in payment.php
$_SESSION['totalAmount'] = $tongCong;

// Lay voucher
if ($cart_session == 'add_vouchers') {
    $voucher = $_GET['coupon'];

    $result = mysqli_query($db, "SELECT * FROM `coupon` WHERE `coupon_code` = '$voucher' && `status` = 'Valid'")->fetch_assoc();
    if (isset($result)) {
        extract($result);
        $_SESSION['discount'] = $discount;
        $_SESSION['discount_mess'] = "DÙNG MÃ " . $coupon_code . " GIẢM " . $discount . "% THÀNH CÔNG";
    } else {
        $_SESSION['discount'] = 0;
        $_SESSION['discount_mess'] = "MÃ GIẢM GIÁ KHÔNG TỒN TẠI";
    }


    header('location:../Backend/payment.php');
}
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