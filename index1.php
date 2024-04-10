
<?php
// session_start();
include "connect_db.php";
global $conn;
// $result = mysqli_query($con, "SELECT *  FROM  `member` WHERE `id`= 6 " );

?>
<!DOCTYPE html>

<html>

<head>
<link rel="icon" href="images/logo2.png" type = "images/x-icon">
    <title> Danh sách sản phẩm</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/cart.css">
    <link rel="stylesheet" href="libs/fancybox/jquery.fancybox.min.css" />
    <link rel="stylesheet" href="style.css" />
    <style>
    body {
        font-family: arial;
    }

    .container {
        width: 1300px;
        margin: 0 auto;
        z-index: 11;
    }

    h1 {
        text-align: center;
    }

    .product-items {
        padding: 5px 0 10px 0;
        position: absolute;
       
        
    }

    .product-price {
        color: red;
        font-weight: bold;
    }

    .clear-both {
        clear: both;
    }

    .buy-button input[type="submit"]{
        text-align: right;
        margin-top: 10px;
        border: 3px solid #f2262c;
        cursor: pointer;
        border-radius: 50px;
        background-color: #f2262c;
        padding: 5px 10px 5px 10px;
        color: #fff;
        font-family: 'family';
    }

    #product-search {
        margin: 0 40px;
        padding-bottom: 20px;
        border-bottom: 1px solid #ccc;
        float: left;
    }

    #sort-box {
        float: right;
        margin-right: 45px;
        line-height: 24px;
        height: 24px;
    }

    .product-item:hover{
    border: 5px solid #fe3026;
}

    </style>
</head>

<body>
<section id="menu">
                <section class="containers">
                <ul>
                    <a href="category.php"><img style="float: left;" width="90px" src="images/logofarm1.png" alt=""></a>
                        <li><a  class="ri-home-3-line" href="category.php">  Trang chủ</a></li>
                        <li><a class="ri-archive-2-line" href="index1.php" style="color:aqua"> Sản phẩm</a></li>
                        <li><a class="ri-shopping-cart-line" href="cart.php"> Giỏ hàng</a></li>
                        <li><a class="ri-team-line" href="#"> Chúng tôi</a></li>
                        <li><a  class="ri-customer-service-2-line"  href="lienhe.php"> Liên hệ</a></li>
                        <a style="float: right; margin:10px;" href="cart.php"><img width="50px" src="images/cart-icon.png" alt=""></a>
                        <?php
             
            //  $username = $_SESSION['user_name'];
                ?>
                <span style="float:right; padding:26px 60px 0 0">Xin chào! </span> 
                
                        <li class="clear-both"></li>
                
                    </ul>
                </section>
            <?php
    $param = "";
    $sortParam = "";
    $orderConditon = "";
    //Tìm kiếm
    $search = isset($_GET['name']) ? $_GET['name'] : "";
    if ($search) {
    $where = "WHERE `name` LIKE '%" . $search . "%'";
    $param .= "name=".$search."&";
    $sortParam = "name=".$search."&";
    }

    //Sắp xếp
    $orderField = isset($_GET['field']) ? $_GET['field'] : "";
    $orderSort = isset($_GET['sort']) ? $_GET['sort'] : "";
    if(!empty($orderField)
    && !empty($orderSort)){
    $orderConditon = "ORDER BY `product`.`".$orderField."` ".$orderSort;
    $param .= "field=".$orderField."&sort=".$orderSort."&";
    }

    include './connect_db.php';
    $item_per_page = !empty($_GET['per_page']) ? $_GET['per_page'] : 8; //phân trang
    $current_page = !empty($_GET['page']) ? $_GET['page'] : 1; 
    $offset = ($current_page - 1) * $item_per_page;
    if ($search) {
        $products = mysqli_query($con, "SELECT * FROM `product` WHERE `name` LIKE '%" . $search . "%' " . $orderConditon . "  LIMIT " . $item_per_page . " OFFSET " . $offset);
        $totalRecords = mysqli_query($con, "SELECT * FROM `product` WHERE `name` LIKE '%" . $search . "%'");
    } else {
        $products = mysqli_query($con, "SELECT * FROM `product` " . $orderConditon . " LIMIT " . $item_per_page . " OFFSET " . $offset);
        $totalRecords = mysqli_query($con, "SELECT * FROM `product`");
    }
    $totalRecords = $totalRecords->num_rows;
    $totalPages = ceil($totalRecords / $item_per_page);
    ?>
    
    <div id="filter-box" style = "padding:70px">
        <form id="product-search" method="GET">          
           
            <label>Tìm kiếm sản phẩm</label>
            <input type="text" value="<?=isset($_GET['name']) ? $_GET['name'] : ""?>" name="name" />
            <input type="submit" value="Tìm kiếm" /> 
        </form>
      

        <select id="sort-box"
            onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
            
            <option value="">Sắp xếp giá</option>
            <option <?php if(isset($_GET['sort']) && $_GET['sort'] == "desc") { ?> selected <?php } ?>
                value="?<?=$sortParam?>field=price&sort=desc">Cao đến thấp</option>
            <option <?php if(isset($_GET['sort']) && $_GET['sort'] == "asc") { ?> selected <?php } ?>
                value="?<?=$sortParam?>field=price&sort=asc">Thấp đến cao</option>
        </select>
        <div style="clear: both;"></div>
    </div>

    <div class="product-items">
        <?php
                while ($row = mysqli_fetch_array($products)) {
                    ?>
        <div class="product-item">
            <div class="product-img">
                <a href="detail.php?id=<?= $row['id'] ?>"><img width="300px" src="<?= $row['image'] ?>"
                        title="<?= $row['name'] ?>" /></a>
            </div>
            <strong><a href="detail.php?id=<?= $row['id'] ?>"><?= $row['name'] ?></a></strong><br />
            <label>Giá: </label><span class="product-price"><?= number_format($row['price'], 0, ",", ".") ?>
                đ</span><br />
            <p><?= $row['content'] ?></p>
            <div class="buy-button">
                <?php if ($row['quantity'] > 0) { ?>
                <form class="quick-buy-form" action="cart.php?action=add" method="POST">
                    <input type="hidden" value="1" name="quantity[<?= $row['id'] ?>]" />
                    <input type="submit" value="Mua ngay" />
                </form>
                <?php } else { ?>
                <strong>Hết hàng</strong>
                <?php } ?>
            </div>
        </div>
        <?php } ?>
        <div class=" clear-both">
        </div>
        <?php
                include './pagination.php';
                ?>
        <div class="clear-both"></div>
    </div>
</body>

</html>