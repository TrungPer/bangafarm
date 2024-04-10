<?php
$host = "localhost";
$user = "root";
$password = "";
$db = "cuahang";
$con = mysqli_connect($host, $user, $password, $db);
if (mysqli_connect_errno()){
    echo "Connection Fail: ".mysqli_connect_errno();exit;
}