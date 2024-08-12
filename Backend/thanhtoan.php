<?php
session_start(); 
include 'config.php';
require_once './vnpay_config.php';

// Tính tổng tiền trong VNPAY
$tongTien = 0;
$discount = 0;

if (isset($_SESSION['SHOPEE'])) {
    foreach ($_SESSION['SHOPEE'] as $key => $val) {
        // Tính giá tiền tổng cho mỗi sản phẩm
        $giaTong = (int)$val['quantity'] * (float)$val['price'];
        $giaTong = $giaTong - $giaTong * $discount / 100;
        // Cộng dồn tổng tiền cho tất cả sản phẩm
        $tongTien += $giaTong;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') //Kiểm tra phương thức có được gán method là POST hay không
{
    $cart_payment = $_POST['payment']; //Gán vào $_POST['payment'] vào biến $cart_payment

    //Hàm tạo ngẫu nhiên mã đơn hàng
    $code_order = rand(0,9999); 
   
    if (isset($_POST['payment'])) //Kiểm tra biến $_POST['payment'] có tồn tại hay không
    {
        if ($cart_payment == 'tienmat' || $cart_payment == 'chuyenkhoan') 
        {
            header('location:cart_save.php');
        }
        // thanh toán VNPAY
        else if ($cart_payment == 'vnpay') 
        {
            $vnp_TxnRef =  $code_order; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
            $vnp_OrderInfo = 'Thanh toán đơn hàng';
            $vnp_OrderType = 'billpayment';
            $vnp_Amount = $tongTien * 100; // Convert to VND (cents) lúc giao dịch
            $vnp_Locale = 'vn';
            $vnp_BankCode = 'NCB';
            $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
            //Add Params of 2.0.1 Version
            $vnp_ExpireDate = $expire;

            // Validate the transaction amount within the range of 5,000 to 1,000,000,000 VND
            $minAmount = 5000;
            $maxAmount = 1000000000;
            if ($vnp_Amount < $minAmount || $vnp_Amount > $maxAmount) {
                // Modify this part according to your application's error handling mechanism.
                die("Transaction amount is not within the allowed range.");
            }

            $inputData = array(
                "vnp_Version" => "2.1.0",
                "vnp_TmnCode" => $vnp_TmnCode,
                "vnp_Amount" => $vnp_Amount,
                "vnp_Command" => "pay",
                "vnp_CreateDate" => date('YmdHis'),
                "vnp_CurrCode" => "VND",
                "vnp_IpAddr" => $vnp_IpAddr,
                "vnp_Locale" => $vnp_Locale,
                "vnp_OrderInfo" => $vnp_OrderInfo,
                "vnp_OrderType" => $vnp_OrderType,
                "vnp_ReturnUrl" => $vnp_Returnurl,
                "vnp_TxnRef" => $vnp_TxnRef,
                "vnp_ExpireDate" => $vnp_ExpireDate
            );

            if (isset($vnp_BankCode) && $vnp_BankCode != "") {
                $inputData['vnp_BankCode'] = $vnp_BankCode;
            }

            ksort($inputData);
            $query = "";
            $i = 0;
            $hashdata = "";
            foreach ($inputData as $key => $value) {
                if ($i == 1) {
                    $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
                } else {
                    $hashdata .= urlencode($key) . "=" . urlencode($value);
                    $i = 1;
                }
                $query .= urlencode($key) . "=" . urlencode($value) . '&';
            }

            $vnp_Url = $vnp_Url . "?" . $query;
            if (isset($vnp_HashSecret)) {
                $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
                $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
            }

            $returnData = array('code' => '00', 'message' => 'success', 'data' => $vnp_Url);
            if (isset($_POST['redirect'])) 
            { 
                header('Location: ' . $vnp_Url);
                die();
            } 
            else 
            {
                echo json_encode($returnData);
            }
        }
    }
}
?>
