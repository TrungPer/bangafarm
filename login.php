<?php
session_start();
include "connect_db.php";
global $conn;
?>

<!DOCTYPE html>
<html lang="en">

<head>

<!-- <link rel="icon" href="images/logo2.png" type = "images/x-icon"> -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập tài khoản</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="style1.css">
    
    <style>
   
    </style>
</head>

<body>
    <div class="form">
       
        <div class="container" id="container">
        <div class="form-container sign-up">
            <form method="post" action="" >
                <h1>Create Account</h1>
                <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                </div>
                <span>hoặc sử dụng mật khẩu và email để đăng ký</span>
                <input type="text" placeholder="Name" name="username" value="" required>
                <input type="text" placeholder="Phone"  name="phone" >
                <input type="email" placeholder="Email"name="email" value="" required />
                <input type="password" placeholder="Password"  name="password" value="" required />
                <input type="text" placeholder="City"  name="city" >
                
                <input style=" background-color: #512da8; color: #fff;cursor: pointer; width: 50%;" type="submit" name="dangky" value="Đăng ký"/>

        <?php 
        require 'xuly.php';?>
            </form>
        </div>

        <div class="form-container sign-in">
            <?php
          
             if($_POST){
     
                 $user_name=$_POST['user_name'];
                 $user_pass=$_POST['user_pass'];
                 $result=mysqli_query($con,"SELECT * from member where email='$user_name' and password='$user_pass'");
                 $row=mysqli_fetch_assoc($result);
 
                 $username = $_POST['user_name'];
                 $_SESSION['user_name'] = $username;
                     if($row){
                         header("Location:index1.php");
                     }else{
                         echo '<p style="color:red; margin: 10px;">Tên đăng nhập hoặc mật khẩu không đúng!</p>';
                     }
                 }
        
            ?>
            <form action="login.php" method="post">
                <h1>Sign In</h1>
                
                <div class="social-buttons">
                    <a  href="#" class="facebook">
                        <i  class='bx bxl-facebook-circle'></i>
                    </a>
                    <a href="#" class="twitter">
                        <i class='bx bxl-twitter' ></i>
                    </a>
                    <a href="#" class="github">
                        <i class='bx bxl-github' ></i>
                    </a>
                </div>
               
                <span>hoặc sử dụng mật khẩu và email để đăng nhập </span>
                <input type="email" placeholder="Email" name="user_name" required>
                <input type="password" placeholder="Password" name="user_pass" required>
                <input   type="checkbox" id="rememberMe" checked> Nhớ mật khẩu
                <a href="#">Forget Your Password?</a>
                <input style=" background-color: #512da8; color: #fff;cursor: pointer; width: 50%;" type="submit" value="Đăng nhập" />
            </form>

        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Welcome Back!</h1>
                    <p>Bạn đã có tài khoản, đăng nhập để sử dụng tính năng của trang web</p>
                    <button class="hidden" id="login" >Đăng nhập</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Hello, Friend!</h1>
                    <p>Đăng ký tài khoản để sử dụng tất cả tính năng của trang web</p>
                    <button class="hidden" id="register">Đăng ký</button>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script src="js/script.js"></script>
    </div>
</body>

</html>