<?php session_start(); ?>
<?php
include "connect_db.php";
global $conn;
// $result = mysqli_query($con, "SELECT *  FROM  member WHERE id = 6");

?>
<!DOCTYPE html>

<html>

<head>
<link rel="icon" href="images/logo2.png" type = "images/x-icon">
    <title>Giỏ hàng</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.min.css">
</head>
<style>
    body{
        margin: 20px;
    padding: 60px;
    font-family: 'Conv_Roboto-Regular';
    font-size: 20px;
    background: #f2f2f2;
    }
    #cart-form{
        width: 100%;
    }
    
    #menu .containers{
     top: 20px;
     left: 0;
    position: fixed;
    width: 100%;
}

.containers{
    width: 1200px;
    margin: 0 auto;
    border: 1px solid #fff;
    padding: 15px;
}

#menu ul{
    height: 71px;
    background: url(../images/menu-bg.jpg) repeat-x;
    border: 1px solid #c8d9c8;
    /* z-index: 11; */
}

#menu ul li{
    padding: 0 15px;
    list-style: none;
    float: left;
    margin: 15px 20px;
    line-height: 41px;
    border-left: 1cappx solid #cfc8bc;
}

#menu ul li a{
    font-family: 'fonts/OpenSansCondensed-Bold';
    font-size: 24px;
}

#he{
    float: right;
    padding: 100px;
}
.containers a::after {
    content: "";
    position: absolute;
    height:2px;
    width: 0;
    bottom: 0;
    left: 0;
    background-color: #ccc;
    transition: all 0.2s ease;

}

.containers a {
    position: relative;
    padding-bottom: 0.6rem;
    color: #ccc;

}
</style>

<body>
    
<section id="menu">
    
                <section class="containers">
                <ul>
              <a href="category.php">  <img style="float: left;" width="90px" src="images/logofarm1.png" alt=""></a>
                        <li><a  class="ri-home-3-line" href="category.php">  Trang chủ</a></li>
                        <li><a class="ri-archive-2-line" href="index1.php"> Sản phẩm</a></li>
                        <li><a class="ri-shopping-cart-line" href="cart.php"  style="color:aqua"> Giỏ hàng</a></li>
                        <li><a class="ri-team-line" href="#"> Chúng tôi</a></li>
                         <li><a  class="ri-customer-service-2-line"  href="lienhe.php"> Liên hệ</a></li>    
                         <?php
             
                $username = $_SESSION['user_name'];
                ?>
                <span style="float:right; padding:26px 60px 0 0">Xin chào! <?php echo  "$username"; ?></span>
                
                        <li class="clear-both"></li>
                    </ul>
                    </section>
 </section>
            
    <?php
        include './connect_db.php';
        require_once("./mail/senmail.php");
        if (!isset($_SESSION["cart"])) {
            $_SESSION["cart"] = array();
        }
        $GLOBALS['changed_cart'] = false;
        $error = false;
        $success = false;
        if (isset($_GET['action'])) {

            function update_cart($con, $add = false) {
                foreach ($_POST['quantity'] as $id => $quantity) {
                    if ($quantity == 0) {
                        unset($_SESSION["cart"][$id]);
                    } else {
                        if (!isset($_SESSION["cart"][$id])) {
                            $_SESSION["cart"][$id] = 0;
                        }
                        if ($add) {
                            $_SESSION["cart"][$id] += $quantity;
                        } else {
                            $_SESSION["cart"][$id] = $quantity;
                        }
                  
                        $addProduct = mysqli_query($con, "SELECT `quantity` FROM `product` WHERE `id` = " . $id);
                        $addProduct = mysqli_fetch_assoc($addProduct);
                        if ($_SESSION["cart"][$id] > $addProduct['quantity']) {
                            $_SESSION["cart"][$id] = $addProduct['quantity'];
                            $GLOBALS['changed_cart'] = true;
                        }
                    }
                }
            }
            switch ($_GET['action']) {
                case "add":
                    update_cart($con, true);
                    if ($GLOBALS['changed_cart'] == false) {
                        header('Location: ./cart.php');
                    }
                    break;
                case "delete":
                    if (isset($_GET['id'])) {
                        unset($_SESSION["cart"][$_GET['id']]);
                    }
                    header('Location: ./cart.php');
                    break;
                case "submit":
                    if (isset($_POST['update_click'])) { 
                        update_cart($con);
                        header('Location: ./cart.php'); 
                       
                    } elseif ($_POST['order_click']) { 
                     
                        if (empty($_POST['name'])) {
                            $error = "<br>Bạn chưa nhập tên của người nhận";
                        } elseif (empty($_POST['phone'])) {
                            $error = "<br>Bạn chưa nhập số điện thoại người nhận";
                        } elseif (empty($_POST['address'])) {
                            $error = "<br>Bạn chưa nhập địa chỉ người nhận";
                        } elseif (empty($_POST['quantity'])) {
                            $error = "Giỏ hàng rỗng";
                        }elseif (empty($_POST['demand'])) {
                            $error = "Bạn chưa nhập nhu cầu";
                        }
                        elseif (empty($_POST['abate'])) {
                            $error = "Bạn chưa chọn phương thức thanh toán";
                        }
                        elseif (empty( number_format($_POST['total']))) {
                            $error = "Bạn chưa chọn phương thức thanh toán";
                        }
                        function randommadonhang($length = 6) {
                            $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                            $charactersLength = strlen($characters);
                            $randomString = '';
                            for ($i = 0; $i < $length; $i++) {
                                $randomString .= $characters[rand(0, $charactersLength - 1)];
                            }
                            return $randomString;
                        }
                        $madonhang = randommadonhang();

                        if ($error == false && !empty($_POST['quantity'])) { 
                            $products = mysqli_query($con, "SELECT * FROM `product` WHERE `id` IN (" . implode(",", array_keys($_POST['quantity'])) . ")");
                            $total = 0;
                            $orderProducts = array();
                            while ($row = mysqli_fetch_array($products)) {
                                $orderProducts[] = $row;
                                if ($_POST['quantity'][$row['id']] > $row['quantity']) {
                                    $_POST['quantity'][$row['id']] = $row['quantity'];
                                    $GLOBALS['changed_cart'] = true;
                                } else {
                                    $total += $row['price'] * $_POST['quantity'][$row['id']];
                                   
                                }
                            }
                            if ($GLOBALS['changed_cart'] == false) {
                            
                           $insertOrder = mysqli_query($con,"INSERT INTO `orders` (`id`, `name`, `phone`, `address`, `note`, `total`, `created_time`, `last_updated`, `demand`, `abate`,`email`,`madonhang`)
                            VALUES (NULL, '" . $_POST['name'] ."', '" . $_POST['phone'] ."', '" . $_POST['address'] ."', '". $_POST['note'] ."', '".$total."', '" . time() ."', '" . time() ."', '". $_POST['demand'] ."', '". $_POST['abate'] ."','". $_POST['email'] ."','$madonhang');");
                           $orderID = $con->insert_id;
                           $insertString = "";
                           foreach ($orderProducts as $key => $product) {
                            
                               $insertString .= "(NULL, '" . $orderID . "', '" . $product['id'] . "', '" . $_POST['quantity'][$product['id']] . "', '" . $product['price'] . "', '" . time() . "', '" . time() . "')";
                               if ($key != count($orderProducts) - 1) {
                                $insertString .= ",";
                            }
                            }
                           $insertOrder = mysqli_query($con, "INSERT INTO `order_detail` (`id`, `order_id`, `product_id`, `quantity`, `price`, `created_time`, `last_updated`) VALUES " . $insertString . ";");
                          
                           $noidung ='';
                       
                           $hehe = $_POST['abate'];
                           $sum = $_POST['total'];
        
                           if ($insertOrder) {
                               if ( $hehe == 'Chuyển khoản ngân hàng') {
                                   $noidung .= "<h2 style='text-align: center; font-size: 25px;  font-family: Arial, sans-serif; color: #333333; margin-bottom: 20px;'>Thông tin thanh toán chuyển khoản ngân hàng</h2>
                                   <ul style='border: 1px solid #e2e2e2; padding: 20px; background-color: #f9f9f9; margin: 10px; list-style-type: none; font-family: Arial, sans-serif;'>
                                   <li><strong>Số tài khoản: </strong> 101890343333</li>
                                   <li><strong>Tên ngân hàng: </strong> VietinBank</li>
                                   <li><strong>Chủ tài khoản: </strong> Nguyễn Văn Tèo</li>
                                   <li><strong>Nội dung chuyển khoản: </strong> <b> " . $madonhang . "</b> <i> "  .  $_POST['name'] . "</i> "  .  $_POST['email'] . " </li>
                                   <li><strong>Số tiền cần thanh toán: </strong> " . number_format($sum) . " VNĐ</li>
                                   </ul>";
                               }
                               
                               $tieude = "Thông báo đặt hàng thành công";
                               $noidung_befo = "<h1 style='text-align: center; font-size: 25px; font-family: Arial, sans-serif; color: #333333; margin-bottom: 20px;'>Thông tin đơn hàng</h1>";
                               $noidung_affter = "<ul style='border: 1px solid #e2e2e2; padding: 20px; background-color: #f9f9f9; margin: 10px; list-style-type: none; font-family: Arial, sans-serif;'>
                               <li><strong>Mã đơn hàng: </strong>".$madonhang."</li>
                               <li><strong>Tên người nhận: </strong>".$_POST['name']."</li>
                               <li><strong>Địa chỉ: </strong>".$_POST['address']."</li>
                               <li><strong>Số điện thoại: </strong>".$_POST['phone']."</li>
                               <li><strong>Giá: </strong>".number_format($sum). " VNĐ </li>
                               <li><strong>Ngày đặt: </strong>".date('d/m/Y H:i',$_POST['created_time'])."</li>
                               <li><strong>Phương thức thanh toán: </strong>".$_POST['abate']."</li>
                               <li><strong>Tình trạng: Chờ xác nhận</strong></li>
                               <li><strong> <i>
                               <b>Thank you: </b>
                               Cảm ơn bạn đã chọn Farm trong vô vàn sự
                               lựa chọn ngoài kia. Mong rằng sản phẩm của Farm sẽ
                               làm bạn hài lòng.</i>
                               </strong></li>
                            
                               </ul>";
                                
                               $tieude = "Đặt hàng website banga.com thành công!";
                               $noidung .= $noidung_befo . $noidung_affter;
                               $maildathang =  $_POST['email'];
                               $mail = new Mailer();
                               $mail->dathangmail($tieude, $noidung, $maildathang);
                           }



                          
                           $success = '<script language="javascript">
                           alert("Đặt hàng thành công!"); 
                      window.location="index1.php";</script>';
                      
                           unset($_SESSION['cart']);
                        }
                        }
                    }
                }
                
        }
        if (!empty($_SESSION["cart"])) {
            $products = mysqli_query($con, "SELECT * FROM `product` WHERE `id` IN (" . implode(",", array_keys($_SESSION["cart"])) . ")");
        }

        ?>
    <div class="container">
        <?php if (!empty($error)) { ?>
        <div id="notify-msg">
            <?= $error ?>. <a href="javascript:history.back()">Quay lại</a>
        </div>
        <?php } elseif (!empty($success)) { ?>
        <div id="notify-msg">
            <?= $success ?>. <a href="index1.php">Tiếp tục mua hàng</a>
        </div>
        <?php } else { ?>
        
        <?php if ($GLOBALS['changed_cart']) { ?>
                    <h3>Số lượng sản phẩm trong giỏ hàng đã thay đổi, do lượng sản phẩm tồn kho không đủ. Vui lòng <a href="cart.php">tải lại</a> giỏ hàng</h3>
                <?php } else { ?>
        <form id="cart-form" action="cart.php?action=submit" method="POST">
            <table>
                <tr>
                    <th class="product-number">STT</th>
                    <th class="product-name">Tên sản phẩm</th>
                    <th class="product-img">Ảnh sản phẩm</th>
                    <th class="product-price">Đơn giá</th>
                    <th class="product-quantity">Số lượng</th>
                    <th class="total-money">Thành tiền</th>
                    <th class="product-delete">Xóa</th>
                </tr>
                <?php
                        if (!empty($products)) {
                            $total = 0;
                            $num = 1;
                            while ($row = mysqli_fetch_array($products)) {
                                ?>
                <tr>
                    <td class="product-number"><?= $num++; ?></td>
                    <td class="product-name"><?= $row['name'] ?></td>
                    <td class="product-img"><img src="<?= $row['image'] ?>" /></td>
                    <td class="product-price"><?= number_format($row['price'], 0, ",", ".") ?></td>
                    <td class="product-quantity"><input type="text" value="<?= $_SESSION["cart"][$row['id']] ?>"
                            name="quantity[<?= $row['id'] ?>]" /></td>
                    <td class="total-money">
                        <?= number_format($row['price'] * $_SESSION["cart"][$row['id']], 0, ",", ".") ?></td>
                    <td class="product-delete"><a href="cart.php?action=delete&id=<?= $row['id'] ?>">Xóa</a></td>
                </tr>
                <?php
                                $total += $row['price'] * $_SESSION["cart"][$row['id']];
                                $num++;
                            }
                            ?>
                            <input type="hidden" name="total" value="<?php echo $total;?>">
                <tr id="row-total">
                    <td class="product-number">&nbsp;</td>
                    <td class="product-name">Tổng tiền</td>
                    <td class="product-img">&nbsp;</td>
                    <td class="product-price">&nbsp;</td>
                    <td class="product-quantity">&nbsp;</td>
                    <td class="total-money"><?= number_format($total, 0, ",", ".") ?></td>
                    <td class="product-delete">Xóa</td>
                </tr>
                <?php
                        }
                        ?>
            </table>
            <div id="form-button">
                <input type="submit" name="update_click" value="Cập nhật sản phẩm" />
                
            </div>
            <hr>
            <div ><label>Người nhận: </label ><input  type="text" placeholder="Họ tên" name="name" /></div>
            <div ><label > Điện thoại: </label></i><input type="text" placeholder="Số điện thoại" name="phone" /></div>
            <div ><label> Địa chỉ: </label><input type="text"  placeholder="Địa chỉ giao hàng" name="address" /></div>
            <div ><label>Email: </label ><input  type="email" placeholder="Email" name="email" /></div>
            <div>  
                <label>Nhu cầu: </label>
                
                <select style="height: 30px;padding: 0 40px 0 40px" name="demand"> 
                    <option value="Phương thức thanh toán">Chọn nhu cầu</option>
                    <option value="Làm sẵn">Làm sẵn</option>
                    <option value="Nguyên con">Nguyên con</option>
                 
                </select>
            </div>
            <div><label>Ghi chú: </label><textarea name="note" cols="50" rows="7"></textarea></div><br>
            <div class="g-recaptcha" data-sitekey="6LdX_tQoAAAAABNme4Wf7lBSGWU359ALDpEkXPRl" style="margin:10px;"></div> 
     

            <h3>Phương thức thanh toán</h2>
                <div class="thanhtoan" >
    <input type="radio" id="cod" name="abate" value="Thanh toán khi nhận hàng" >
    <span for="cod" >Thanh toán khi nhận hàng(COD)</span><br>
    <img src="img/shipcode.png" width="150" height="150" ><br><br>

    <input type="radio" id="bank" name="abate" value="Chuyển khoản ngân hàng">
    <span for="bank">Chuyển khoản ngân hàng</span><br><br>
    <img src="img/ckbank.jpg" width="150" height="150">

</div>

            <input type="submit" name="order_click" value="Xác nhận đặt hàng" />
         
        </form>
        <?php } ?>
        <?php } 
       ?>

     
          <?php
          // gửi telegram
    require 'connect_db.php';
    function sendMessTelegram($my_text){
    $token_telegram = '6365376034:AAFLEOTDWsHeY9W4GT3QWn25oFn7Z4gamac'; 
    $chat_id_telegram = '-4089033584'; 
    if($token_telegram != '' && $chat_id_telegram != ''){
        $url = "https://api.telegram.org/bot$token_telegram/sendMessage?chat_id=$chat_id_telegram&text=" . urlencode($my_text);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);

        if($output === false) {
            return false; 
        }

        curl_close($ch);
        return $output;
     }
    return true; 
}

if(isset($_POST['order_click'])){
        $my_text = "Mã đơn hàng: " . $madonhang . "\n" . "Tên khách hàng: " . $_POST['name'] . "\n" . "Email đặt hàng: " . $_POST['email'] . "\n". 
        "Số điện thoại: " . $_POST['phone'] . "\n" . "Địa chỉ: "  . $_POST['address'] . "\n" . "Note: " .
         $_POST['note'] . "\n" . "Yêu cầu: " . $_POST['demand'] . "\n". "Tổng tiền: " . number_format($_POST['total']) . 
         " VNĐ" . "\n" . "Loại thanh toán: " . $_POST['abate'] ."\n". "Tình trạng: Chờ xác nhận đơn hàng" ;  //loại thông báo gửi về
        $madonhang = isset($row['madonhang']) ? $row['madonhang'] : '';
        $name = isset($row['name']) ? $row['name'] : '';
        $phone = isset($row['phone']) ? $row['phone'] : '';
        $address = isset($row['address']) ? $row['address'] : '';
        $note = isset($row['note']) ? $row['note'] : '';
        $tongtien = isset($row['total']) ? $row['total'] : '';
        $demand = isset($row['demand']) ? $row['demand'] : '';
        $abate = isset($row['abate']) ? $row['abate'] : '';
        sendMessTelegram($my_text);

    }

   
    
    ?>

    
    </div>

</body>

</html>
