<!DOCTYPE HTML>  
<html>
    <head>
        <title>Trang chủ</title> 
    </head>
    <body>
        <h2>Đăng nhập thành công</h2>
        <?php
        session_start();
        $user = $_SESSION['user'];
        $password = $_SESSION['pass'];
        
        echo "Tên đăng nhâp: $user <br>";
        echo "mật khẩu: $password";
        ?>
    </body>
</html>