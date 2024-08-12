<?php

include 'config.php';

//  if (isset($_POST)) {
//      extract($_POST);

//  $sql = "INSERT INTO receipt
//          VALUE(null,'$gia','$kh','$sdt','$dc')";
//  mysqli_query($db,$sql);
//  header('location: thankpage.php');
//  }

if(isset($_POST['button']))
{   
    $price = $_POST['gia'];
    $user = $_POST['kh'];
    $phone = $_POST['sdt'];
    $address = $_POST['dc'];

   
    $addOrder = "INSERT INTO receipt(rc_price,rc_name,rc_phone,rc_address)
            VALUES('$price','$user','$phone','$address')";
     mysqli_query($db,$addOrder);
    
}

    header('location: thankpage.php');
?>
