<?php 
session_start();
?>
<!DOCTYPE html>

<html>

<head>
<link rel="icon" href="../images/logo2.png" type = "images/x-icon">
    <title>Đăng nhập admin</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style1.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body{
            background: linear-gradient(to left, rgb(255, 121, 121), rgb(246, 229, 141), rgb(126, 214, 223));
        }
    .box-content {
        margin: 0 auto;
        width: 800px;
        border: 1px solid #ccc;
        text-align: center;
        padding: 20px;
    }

    #user_login form {
        width: 200px;
        margin: 40px auto;
    }

    #user_login form input {
        margin: 5px 0;
    }


    .form {
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

    .form input {
        width: 100%;
        padding: 10px 0;
        border-radius: 5px;
    }
    </style>
</head>

<body>
    <?php
 
        include '../connect_db.php';
        $error = false;
        if (isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['password']) && !empty($_POST['password'])) {
            $result = mysqli_query($con, "Select `id`,`username`,`fullname` from `user` WHERE 
            (`username` ='" . $_POST['username'] . "' AND `password` =('" . $_POST['password'] . "'))");
            if (!$result) {
                $error = mysqli_error($con);
            } else {
              
                $user = mysqli_fetch_assoc($result);  
                echo '<p style="color:red; margin: 10px;">Tên đăng nhập hoặc mật khẩu không đúng!</p>';
               $userPrivileges = mysqli_query($con, "SELECT * FROM `user_privilege` INNER JOIN `privilege` ON user_privilege.privilege_id = privilege.id WHERE user_privilege.user_id = ".$user['id']);
               $userPrivileges = mysqli_fetch_all($userPrivileges, MYSQLI_ASSOC);
                if(!empty($userPrivileges)){
                    $user['privileges'] = array();
                    foreach($userPrivileges as $privilege){
                        $user['privileges'][] = $privilege['url_match'];
                    }
                }
                $_SESSION['current_user'] = $user;
                header('Location: dashboard.php');
            }
            mysqli_close($con);
            if ($error !== false || $result->num_rows == 0) {
                ?>
    <div style="color: red; text-align:center;" id="login-notify" class="form">
        <h2>Thông báo</h2>
        <h3><?= !empty($error) ? $error : "Thông tin đăng nhập không chính xác" ?></h3>
        <a href="./index.php">Quay lại</a>
    </div>
    <?php
                exit;
            }
            ?>
    <?php } ?>
    <?php if (empty($_SESSION['current_user'])) { ?>
    <div id="" class="form">
        <h1>Đăng nhập tài khoản</h1>
        <form action="./index.php" method="Post" autocomplete="off">
            <label>Username</label></br>
            <input type="text" name="username" value="" /><br />
            <label>Password</label></br>
            <input type="password" name="password" value="" /></br>
            <br>
            <input type="submit" value="Đăng nhập" />
        </form>
    </div>
    <?php
        } else {
            $currentUser = $_SESSION['current_user'];
            ?>
    <div style=" line-height: 40px;" id="login-notify" class="form">
    </div>

    <?php } ?>
</body>

</html>