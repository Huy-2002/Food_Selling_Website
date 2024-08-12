<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>update</title>

     <!-- BOOSTRAP CDN 4 -->
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- jQuery library -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>




<?php

include 'config.php';

if(isset($_POST['btn2']) && $_POST['search'] != '') // Kiem tra nguoi dung co nhap mon an va bam vao icon tim kiem
{
    $contend = $_POST['search'];

    $sql = "SELECT * FROM FOOD WHERE FOODNAME LIKE '%$contend%'";
    $query = mysqli_query($db,$sql);

    if ($var = mysqli_fetch_assoc($query)) // Duyet qua tung mon an
    {
        ?>
       <table class="table">
            <thead>
                <tr>
                    <th>SỐ THỨ TỰ</th>
                    <th>TÊN MÓN ĂN</th>
                    <th>HÌNH ẢNH</th>
                    <th>GIÁ</th>
                    <th>SỐ LƯỢNG</th>
                    <th>MÔ TẢ</th>
                </tr>
            </thead>
            <tbody>

            <tr>
                        <td>
                            <?php echo $var['FOODID']; ?>
                        </td>

                        <td>
                            <?php echo $var['FOODNAME']; ?>
                        </td>

                        <td>
                            <img style="width: 100px;" src="images/<?php echo $var['FOODIMAGE']; ?>">
                        </td>

                        <td>
                            <?php echo $var['PRICE']; ?>
                        </td>

                        <td>
                            <?php echo $var['QUANTITY']; ?>
                        </td>

                        <td>
                            <?php echo $var['FOODDESCRIPT']; ?>
                        </td>
                    </tr>
               
            </tbody>
        </table>



        <?php
    }

    else{

    $message = "Món ăn không tồn tại";
    echo 
    "
    <script type='text/javascript'>
                alert('$message');
                window.location.href='../Backend/display.php';
    </script>
    ";}

}
else{

    echo 
    "
    <script type='text/javascript'>
                alert('NHẬP MÓN ĂN ĐI Ạ');
                window.location.href='../Backend/display.php';
    </script>
    ";}


?>

<div class="col-md-2 m-3 border-success">
    <a href="../Backend/display.php" class="btn btn-success"> TRỞ VỀ TRANG HIỂN THỊ SẢN PHẨM </a>
</div>

</body>
</html>

