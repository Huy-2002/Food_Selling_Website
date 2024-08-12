<?php 

    include 'config.php'; // Goi file ket noi

    if(isset($_POST['btn']) 
    && $_POST["name"] !=''  
    && $_POST["date"] !='' 
    && $_POST["phonenum"] !=''
    && $_POST["username"] !='' 
    && $_POST["password"] !='' 
    && $_POST["repassword"] !='' 
    ) // Nguoi dung co nhap du thong tin va bam submit hay khong

    {
        // Goi ra cac ten bien tu file html
        $name = trim($_POST["name"]);
        $date = trim($_POST["date"]);
        $phonenum = trim($_POST["phonenum"]);
        $username = trim($_POST["username"]);
        $password = trim($_POST["password"]);
        $repassword = trim($_POST["repassword"]);
        $password = md5($password);
        $repassword = md5($repassword);
        
        // Kiem tra nguoi dung nhap ten dang nhap co ton tai hay khong
        $sql =  "SELECT * FROM USER WHERE TK= '$username'";

        //Thuc hien truy van
        $connect = mysqli_query($db,$sql);

        // Kiem tra tai khoan co trung va nhap co dung mat khau hay khong
        if(mysqli_num_rows($connect) > 0)
        {
            echo "<script>alert('TÊN TÀI KHOẢN ĐÃ TỒN TẠI'); window.location.href='../Frontend/register.html';</script>";
        }

        else if($password != $repassword)
        {
            echo "<script>alert('MẬT KHẨU KHÔNG TRÙNG'); window.location.href='../Frontend/register.html';</script>";
        }

        // Tao tai khoan
        if($username == 'admin')
        {   // Thuc hien them tai khoan vao database neu tk chua duoc tao
            $sql = "INSERT INTO USER (USERNAME,DOB,PHONENUM,TK,MK,REPASS,`role`)
            VALUES('$name', '$date', '$phonenum', '$username', '$password', '$repassword',0)";
            mysqli_query($db,$sql);
            
            header("location:../Frontend/login.html");
        }
        else if($username == 'user')
        {
            $sql = "INSERT INTO USER (USERNAME,DOB,PHONENUM,TK,MK,REPASS,`role`)
            VALUES('$name', '$date', '$phonenum', '$username', '$password', '$repassword',1)";
            mysqli_query($db,$sql);
            
            header("location:../Frontend/login.html");
        }

        else{
            $sql = "INSERT INTO USER (USERNAME,DOB,PHONENUM,TK,MK,REPASS,`role`)
               VALUES('$name', '$date', '$phonenum', '$username', '$password', '$repassword',1)";
               mysqli_query($db,$sql);
               header('location:../Frontend/login.html');
        }
    }
?>

<!-- 
    Hướng dẫn xây dựng chức năng đăng ký, đăng nhập với PHP và MySQL (phần 1)
    https://www.youtube.com/watch?v=5YeAZw6uE-I 

    // unique để cột phụ ko có data giống nhau.
    ALTER TABLE USER
    MODIFY TK VARCHAR(60) UNIQUE;
    KT repass bang regex
-->



<!-- // $host = "localhost";

    // $username = "root";
    // $password = "";
    // $re_password = "";
    // $dbname = "Demo";
    // $db = new mysqli($host,$username,$password,$re_password,$dbname);
    
    //  if(isset($_POST['btn']))
    // {
        
    //        $username = $_POST['username'];
    //        $password = $_POST['password'];
    //        $re_password = $_POST['re_pass'];
       

    //        if(!empty($username) && !empty($password) && !empty($re_password))
    //        {    
    //             print_r($_POST);

    //              // Truy vấn cơ sở dữ liệu
    //              $sql = "INSERT INTO `USER` (`username`,`password`, `re_password`) 
    //              VALUES(`$username`, `$password`, `$re_password`)";

    //             if($db->query(($sql)) === TRUE)
    //             {
    //                 echo "Luu du lieu thanh cong";
    //             } 
    //             else
    //             {
    //                 echo "Ban can nhap day du thong tin";
                
    //             }
    //         }

    //         else{
    //             echo "Ban can nhap day du thong tin";
    //         }
    // } -->