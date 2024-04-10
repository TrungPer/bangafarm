<!DOCTYPE html>
<html>
    <head>
    <link rel="icon" href="../images/logo2.png" type = "images/x-icon">
        <title>Trang quản trị</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="../css/admin_style.css" >
        <script src="../resources/ckeditor/ckeditor.js"></script>
    </head>
    <body>
        <?php
        session_start();
        include '../connect_db.php';
        include '../function.php';
      
             $user = $_SESSION['current_user'];
            if (!empty($user)) {
            ?>
            <div id="admin-heading-panel">
                <div class="container">
                    <div class="left-panel">
                    Xin chào <span><?= $user['fullname'] ?></span>
                    </div>
                    <div class="right-panel">
                        <img height="24" src="../images/home.png" />
                        <a href="../index.php">Trang chủ</a>
                        <img height="24" src="../images/logout.png" />
                        <a href="logout.php">Đăng xuất</a>
                    </div>
                </div>
            </div>
            <div id="content-wrapper">
                <div class="container">
                    <div class="left-menu">
                        <div class="menu-heading"> <a href="dashboard.php" style="color: black;"> Menu</a></div>
                        <div class="menu-items">
                            <ul> 

                                <li><a href="dashboard.php">Thông tin</a></li>
                                <li><a href="../about.php">Tin nhắn</a></li>
                                <?php if (checkPrivilege('menu_listing.php')) { ?>
                                    <li><a href="menu_listing.php">Danh mục</a></li>
                                <?php } ?>

                                <?php if (checkPrivilege('product_listing.php')) { ?>
                                    <li><a href="product_listing.php">Sản phẩm</a></li>
                                <?php } ?>

                                <?php if (checkPrivilege('order_listing.php')) { ?>
                                    <li><a href="order_listing.php">Đơn hàng</a></li>
                                <?php } ?>

                                <?php if (checkPrivilege('member_listing.php')) { ?>
                                    <li><a href="member_listing.php">Quản lý thành viên</a></li>
                                <?php } ?>

                                <?php if (checkPrivilege('user_listing.php')) { ?>
                                    <li><a href="user_listing.php">Quản lý nhân viên</a></li>
                                <?php } ?>
                                <?php if (checkPrivilege('sum.php')) { ?>
                                    <li><a href="sum.php">Tổng doanh thu</a></li>
                                <?php } ?>
                               
                            </ul>
                        </div>
                    </div>
                <?php } ?>

    