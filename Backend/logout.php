<?php
    session_start();
    session_destroy();
    header('location:../frontend/login.html');
?>

<!-- Huỷ session đã lưu trong display.php -->