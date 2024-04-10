<?php
   require'connect_db.php';
   if(isset($_POST['dangky'])){
    $username =$_POST['username'];
    $email =$_POST['email'];
    $password =$_POST['password'];
    $phone =$_POST['phone'];

    $sql = "SELECT * FROM member WHERE email = '$email'";
$result = mysqli_query($con, $sql);
if (mysqli_num_rows($result) > 0)
{
echo '<script language="javascript">
        alert("Bị trùng tên vui lòng chọn email đăng nhập khác!"); 
         window.location="login.php";</script>';
die ();
}
     elseif(!empty($email)&&!empty($phone)){
    $sql = "INSERT INTO `member`(`username`,`email`,`password`,`phone`) 
     VALUES('$username','$email','$password','$phone')";

         $_SESSION['email']  =$_POST['email'];
         
            if($con->query($sql)===TRUE){
                echo '<script language="javascript">
                    alert("Đăng ký thành công!"); 
               window.location="login.php";</script>';
            }else{
            echo "Lỗ!i";
            }
    }
    }
?>