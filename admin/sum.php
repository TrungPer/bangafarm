<?php
include '../connect_db.php';
$result = mysqli_query($con, "SELECT COUNT(id),SUM(price) FROM order_detail;");
include 'header.php';
global $conn;

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="icon" href="../images/logo2.png" type="images/x-icon">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/admin_style.css">
  <title>Tổng doanh thu</title>
</head>

<body>

  <div class="main-content">
  <div class="listing-items">
    <?php
    

    $item_per_page = (!empty($_GET['per_page'])) ? $_GET['per_page'] : 10; // phân trang
    $current_page = (!empty($_GET['page'])) ? $_GET['page'] : 1;
    $offset = ($current_page - 1) * $item_per_page;
    if(!empty($where)){
      $totalRecords = mysqli_query($con, "SELECT * FROM `order_detail` where (".$where.")");
    }else{
      $totalRecords = mysqli_query($con, "SELECT * FROM `order_detail`");
    }
    $totalRecords = $totalRecords->num_rows;
    $totalPages = ceil($totalRecords / $item_per_page);
    if(!empty($where)){
      $sum = mysqli_query($con, "SELECT * FROM `order_detail` where (".$where.") ORDER BY `id` DESC LIMIT " . $item_per_page . " OFFSET " . $offset);
    }else{
      $sum = mysqli_query($con, "SELECT * FROM `order_detail` ORDER BY `id` DESC LIMIT " . $item_per_page . " OFFSET " . $offset);
    }
    mysqli_close($con);
    while ($row = mysqli_fetch_array($result)) {
    ?>

      <h1>
        Tổng sản phẩm: <?php echo $row['COUNT(id)'] . " sản  phẩm" ?><br>
        
        Tổng doanh thu: <?php echo  number_format($row['SUM(price)'], 0, ",", "."). " VNĐ" ?>
      </h1>
    <?php
    }
    ?>

<div class="total-items">
            <span>Có tất cả <strong><?=$totalRecords?></strong> sản phẩm trên
                <strong><?=$totalPages?></strong> trang</span>
        </div>
    <ul>
      <li class="listing-item-heading">
        <div class="listing-prop listing-id">Id</div>
        <div class="listing-prop listing-name"> Id đơn hàng</div>
        <div class="listing-prop listing-address">Id sản phẩm</div>

        <div class="listing-prop listing-address">
          Số lượng
        </div>


        <div class="listing-prop listing-button">
          Giá
        </div>


        <div class="listing-prop listing-time">Ngày cập nhật</div>
        <div class="clear-both"></div>
  </li>

      <tbody>

        <?php
      
        while ($row = mysqli_fetch_assoc($sum)) :

        ?>
<li>
          <div class="listing-prop listing-id"><?= $row['id'] ?></div>
          <div class="listing-prop listing-name"><?= $row['order_id'] ?></div>
          <div class="listing-prop listing-address"><?= $row['product_id'] ?></div>
          <div class="listing-prop listing-phone"><?= $row['quantity'] ?></div>
          <div class="listing-prop listing-button"><?= $row['price'] ?></div>
          <div class="listing-prop listing-time"><?= date('d/m/Y H:i', $row['last_updated']) ?></div>
          <div class="clear-both"></div>
          </li>
        <?php endwhile; ?>
      </tbody>


    </ul>
    <?php
			include './pagination.php';
			?>
       <div class="clear-both"></div>
  </div>
  </div>


</body>

</html>

<?php

include './footer.php';
?>