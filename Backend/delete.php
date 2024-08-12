<?php

    include 'config.php'; // Goi file ket noi

    // Lay du lieu can xoa

        $data = $_GET['fid'];
        
    // Xai get la do href="./delete.php?fid ben file display.php

    //Thuc hien xoa
    $deleteFood = "DELETE FROM FOOD WHERE FOODID = $data ";

    // Truy van du lieu

    mysqli_query($db,$deleteFood);

    header('location:../Backend/display.php');
?>