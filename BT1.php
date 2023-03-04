<!DOCTYPE HTML>  
    <html>
        <head>
            <link rel="stylesheet" type="text/css" href="style/style.css">
        </head>
        
        <body>  
        <?php
        $userNameErr = $passwordErr ="";
        $userName = $passwordu =  "";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            //thiết lập thông báo lỗi của trường name;
            if (empty($_POST["name"])) {
                $userNameErr = "Tên đăng nhập trống.";
            } else {
                $userName = test_input($_POST["name"]);
            }

            if(empty($_POST["pass"])){
                $passwordErr = "Mật khẩu trống.";
            } else {
                $passwordu = test_input($_POST["pass"]);
            }
        }
        
        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
            }
        ?>
            
            <div class="container">
                <div class="center">
                    <h2>Form đăng nhập</h2>
                    <p><span class="error">* Các trường bắt buộc nhập thông tin.</span></p>
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
                        <span class="error">*</span>
                        Username: 
                        <br>
                        <input class="input" type="text" name="name">
                        <span class="error"> <?php echo $userNameErr;?></span>
                        <br><br>

                        <span class="error">*</span>
                        Password:
                        <br>
                        <input class="input" type="text" name="pass">
                        <span class="error"> <?php echo $passwordErr;?></span>
                        <br><br>
                        <input type="submit" value="Đăng nhập">
                    </form>
                    
                    <?php
                    $servername = "localhost";
                    $username = "admin"; // tên người dùng
                    $password = "Admin"; // mật khẩu
                    $dbname = "test"; // tên database
                    $conn = mysqli_connect($servername, $username, $password, $dbname);

                    $result = mysqli_query($conn, "SELECT * FROM user");        
                    if (mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_assoc($result);
                    }
                    mysqli_close($conn);

                    $count = 0;
                    foreach ($result as $item) {
                        if(strcmp($item["UserName"],$userName) == 0 && strcmp($item["Password"],$passwordu) == 0)
                        {
                            $count++;
                        }
                    }
                    if($count>0 ){
                        session_start();
                        $_SESSION['user'] = $userName;
                        $_SESSION['pass'] = $passwordu;
                        header("Location: index.php");
                    }else if($userName != null && $count=0){
                        echo "<script>alert('Sai tên đăng nhập hoặc mật khẩu')</script>";
                    }
                    ?>
                </div>
            </div>
    </body>
</html>