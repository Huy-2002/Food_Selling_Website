<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>update</title>

    <!-- BOOSTRAP CDN 4 -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</head>

<body>

    <div class="container">

        <h1> DANH SÁCH MÓN ĂN</h1>

        <div class="container mt-3 mb-5">

            <form action="../Backend/searchAdmin.php" method="post">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="TÌM KIẾM MÓN ĂN" name="search">
                    <div class="input-group-btn">
                        <button name="btn2" class="btn btn-default" type="submit">
                            <i class="glyphicon glyphicon-search"></i>
                        </button>
                    </div>
                </div>
            </form>

        </div>

        <!-- Danh sách món ăn -->
        <table class="table">
            <thead>
                <tr>
                    <th>SỐ THỨ TỰ</th>
                    <th>TÊN MÓN ĂN</th>
                    <th>HÌNH ẢNH</th>
                    <th>GIÁ</th>
                    <th>SỐ LƯỢNG</th>
                    <th>MÔ TẢ</th>
                    <th>ĐIỀU CHỈNH</th>
                </tr>
            </thead>
            <tbody>
                <?php

                session_start();
                include 'config.php';
                //Ngăn chặn người dùng lấy data thông qua method GET để vào trang admin mà ko cần đăng nhập.
//             if (isset($_SESSION['loginStatus']) == null) {
//                 header('location:../Frontend/login.html');
//                 }
                // Cau lenh
                $updateFood = "SELECT * FROM FOOD ORDER BY FOODNAME, FOODIMAGE, PRICE, QUANTITY,FOODDESCRIPT";
                //Thuc hien truy van
                $sql = mysqli_query($db, $updateFood);

                //Duyet qua va in ket qua
                while ($var = mysqli_fetch_assoc($sql)) {
                ?>
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

                        <!-- Button cập nhật -->
                        <td>
                            <div class="input-group">
                                <input type="number" class="form-control quantity-input" value="<?php echo $var['QUANTITY']; ?>" name="quantity" min="0" data-food-id="<?php echo $var['FOODID']; ?>">
                                <div class="input-group-btn">
                                    <button class="btn btn-primary btn-update-quantity" data-food-id="<?php echo $var['FOODID']; ?>">
                                        CẬP NHẬT
                                    </button>
                                </div>
                            </div>
                        </td>


                        <td>
                            <?php echo $var['FOODDESCRIPT']; ?>
                        </td>

                        <td>
                            <a href="./edit.php?fid=<?php echo $var['FOODID']; ?>;" class="btn btn-primary">CHỈNH SỬA</a>
                            <a onclick="return confirm('Bạn có muốn xóa món ăn này không');" href="./delete.php?fid=<?php echo $var['FOODID']; ?>" class="btn btn-danger">XOÁ</a>
                        </td>

                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
        <!-- BOOSTRAP 4 CDN -->
        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#myModal">
            THÊM MÓN ĂN
        </button>

        <a onclick="return confirm('Ban co muon xoa tat ca mon an nay khong');" href="./deleteall.php" class="btn btn-danger"> XOÁ TẤT CẢ MÓN ĂN</a>
        <a href="../Backend/voucher.php" class="btn btn-info"> TẠO MÃ GIẢM GIÁ </a>

        <!-- Kết nối đến file logout.php -->
        <a href="logout.php" class="btn btn-success"> ĐĂNG XUẤT </a>
        <!-- <a href="../Backend/cart.php" class="btn btn-success"> DI TOI GIO HANG </a> -->

    </div>

    <!-- The Modal -->
    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Modal Heading</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">

                    <form action="../Backend/add.php" method="post" enctype="multipart/form-data">

                        <div class="form-group">
                            <label for="FOODNAME"> TÊN MÓN ĂN </label>
                            <input name="FOODNAME" id="FOODNAME" type="text" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="FOODIMAGE"> HÌNH ẢNH MÓN ĂN </label>
                            <input name="FOODIMAGE" id="FOODIMAGE" type="file" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="PRICE"> GIÁ MÓN ĂN </label>
                            <input name="PRICE" id="PRICE" type="text" min=0 class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="QUANTITY"> SỐ LƯỢNG MÓN ĂN </label>
                            <input name="QUANTITY" id="QUANTITY" type="number" min=0 class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="FOODDESCRIPT"> MÔ TẢ MÓN ĂN </label>
                            <input name="FOODDESCRIPT" id="FOODDESCRIPT" type="text" class="form-control">
                        </div>

                        <button class="btn btn-success" type="submit" name="submit" value="cdb"> THÊM MÓN ĂN </button>

                    </form>
                </div>

            </div>

            <!-- Modal footer -->
            <!-- <div class="modal-footer">
        <button style="margin-bottom: 30px;" type="button" class="btn btn-danger" data-dismiss="modal">Dong</button>
      </div> -->

        </div>
    </div>

    <!-- Javascript điều chỉnh số lượng -->
    <script>
        $(document).ready(function() 
        {
            $(".btn-update-quantity").click(function() {
                var foodId = $(this).data("food-id");
                var newQuantity = parseInt($("input[data-food-id='" + foodId + "']").val()); //jquery

                if( newQuantity < 0)
                {
                    alert('Số lượng không hợp lệ');
                }
                else{

                    // Thực hiện yêu cầu AJAX để cập nhật số lượng vào cơ sở dữ liệu
                    $.ajax({
                    type: "POST",
                    url: "../Backend/updateQuantity.php",
                    data: {
                        foodId: foodId,
                        newQuantity: newQuantity
                    },

                    success: function(response) {
                        // Cập nhật giá trị số lượng trong ô bảng
                        $("td[data-food-id='" + foodId + "']").text(newQuantity);
                        
                    },
                    error: function() {
                        alert("Cập nhật số lượng thất bại");
                    }
                });
                }
            });
        });
    </script>

    </div>

</body>

</html>


<!-- 
    Hướng dẫn liệt kê - thêm - sửa - xoá cơ bản CRUD với PHP MySQL
    https://www.youtube.com/watch?v=NyZx0B1-iZU&t=4240s

    Tạo Database và Thêm , Sửa , Xóa Sản Phẩm bằng PHP cơ bản
    https://www.youtube.com/watch?v=0y4FLXkW3uE&t=1104s
 -->