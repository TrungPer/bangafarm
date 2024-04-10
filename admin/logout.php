<!DOCTYPE html>

<html>

<head>
<link rel="icon" href="../images/logo2.png" type = "images/x-icon">
    <title>Đăng xuất tài khoản</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body{
            background: linear-gradient(to left, rgb(255, 121, 121), rgb(126, 214, 223));
        }
    .box-content {
        margin: 0 auto;
        width: 500px;
        text-align: center;
        padding: 10rem;
        width: 200px;
        border: 1px solid green;
        padding: 20px;
        margin: 0 auto;
        font-weight: 700px;
        border: 2px solid transparent;
        min-height: 200px;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 500px;
        padding: 30px;
        background: #f1f2f6;
        box-sizing: border-box;
        border-radius: 10px;
        box-shadow: 0 15px 50px rgba(0, 0, 0 0.2)

    }

    #user_logout form {
        width: 200px;
        margin: 40px auto;
        
    }

    #user_logout form input {
        margin: 5px 0;
        
    }
    </style>
</head>

<body>
    <?php
        session_start();
        unset($_SESSION['current_user']);
        ?>
    <div id="user_logout" class="box-content">
        <h2>Đăng xuất tài khoản thành công</h2>
        Đăng nhập lại
        <a href="./index.php">Tại đây</a>
    </div>
</body>

</html>