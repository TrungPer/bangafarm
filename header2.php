<?php
session_start();
include "connect_db.php";
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
               echo "Xin chào! $username ";
               ?>
                    <span><img src="images/phone.png" />1900 6868</span>
                    <span><img src="images/email.png" />farm@yahoo.com</span>
                </div>
                
         
        </header>