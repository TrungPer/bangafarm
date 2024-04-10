<?php
session_start();
include "connect_db.php";
$result = mysqli_query($con, "SELECT *  FROM  `member` ");
global $conn;


?>
<!DOCTYPE html>

<html>
    <head>
    <link rel="icon" href="images/logo2.png" type = "images/x-icon">
        <title>Trang chủ</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/carouseller.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.min.css">
        <link rel="stylesheet" type="text/css" href="css/fonts.css">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/category.css">
    </head>
    <body>
        <header>
        <div id="header-top">
        <?php
               $username = $_SESSION['user_name'];
              
                echo "Xin chào! ".$username;
              
               ?>
                    <span><img src="images/phone.png" />1900 6868</span>
                    <span><img src="images/email.png" />farm@yahoo.com</span>
                </div>
            <section class="container">
                <div id="header-bottom">
                    <section id="header-left">
                    <a href="category.php"> <img  width="150px" src="images/logofarm1.png" /></a>
                    </section>
                    <section id="header-right">
                        <section id="header-link">
                            <a id="cart-link" href="cart.php"><img src="images/cart.png" /></a>
                    
                            <a id="login-link" href="index.php">Đăng xuất</a>
                            
                    
                        </section>
                    </section>
                    <section class="clear-both"></section>
                </div>
            </section>
            <section id="menu">
                <section class="container">
                    <ul>
                        <li><a class="ri-home-3-line" href="category.php" style="color:aqua"> Trang chủ</a></li>
                         <li><a  class="ri-archive-2-line" href="index1.php"> Sản phẩm</a></li>
                        <li><a class="ri-shopping-cart-line" href="cart.php"> Giỏ hàng</a></li>
                        <li><a class="ri-team-line" href="#"> Chúng tôi</a></li>
                        <li><a  class="ri-customer-service-2-line"  href="lienhe.php"> Liên hệ</a></li>
                        <li class="clear-both"></li>
                    </ul>
                    <form id="product-search" action="#" method="GET">
                        <input type="submit" value="">
                        <input type="text" name="text_search" placeholder="Tìm kiếm" />
                    </form>
                </section>
            </section>
        </header>