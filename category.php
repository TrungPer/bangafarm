
<?php include 'header.php'; ?>

<?php
$param = "";
$sortParam = "";
$orderConditon = "";
//Tìm kiếm
$search = isset($_GET['name']) ? $_GET['name'] : "";
if ($search) {
    $where = "WHERE `name` LIKE '%" . $search . "%'";
    $param .= "name=" . $search . "&";
    $sortParam = "name=" . $search . "&";
}

//Sắp xếp
$orderField = isset($_GET['field']) ? $_GET['field'] : "";
$orderSort = isset($_GET['sort']) ? $_GET['sort'] : "";
if (!empty($orderField) && !empty($orderSort)) {
    $orderConditon = "ORDER BY `product`.`" . $orderField . "` " . $orderSort;
    $param .= "field=" . $orderField . "&sort=" . $orderSort . "&";
}

include './connect_db.php';
$item_per_page = !empty($_GET['per_page']) ? $_GET['per_page'] : 16; // phân trang
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
<section id="product-filter">
    <section class="container">
        <label>Farm</label>
        <section id="brand-filter" class="filter-column">
            <h2>Thương hiệu </h2>
            <section id="brand-list">
                <ul>
                    <li><a href="#">Gà</a></li>
                    <li><a href="#">Vịt</a></li>
                    <li><a href="#">Ngỗng </a></li>
                    <li><a href="#">Bò</a></li>
                    <li><a href="#">Trâu</a></li>
                    <li><a href="#">Dê</a></li>
                    <li><a href="#">Lừa</a></li>
                    <li><a href="#">Bò</a></li>
                    <li><a href="#">Hổ</a></li>
                    <li><a href="#">Ngựa</a></li>
                    <li><a href="#">Nai</a></li>
                    <li><a href="#">Hưu</a></li>
                    <li class="clear-both"></li>
                </ul>
            </section>
        </section>
        <section id="category-statistic" class="filter-column">
            <section class="category">
                <h3>Ngỗng</h3>
                <section class="category-image">
                    <img src="images/ngong.jpg" />
                </section>
                <section class="total-product">Tổng</section>
                <section class="number-product">357 sản phẩm</section>
                <img src="images/product-list-icon.png" />
            </section>
            <section class="category center-block">
                <h3>Gà</h3>
                <section class="category-image">
                    <img src="images/ga_trong_y_duoc.jpg" />
                </section>
                <section class="total-product">Tổng</section>
                <section class="number-product">125 sản phẩm</section>
                <img src="images/product-list-icon.png" />
            </section>
            <section class="category">
                <h3>Vịt</h3>
                <section class="category-image">
                    <img src="uploads/duck/vit.jpg" />
                </section>
                <section class="total-product">Tổng</section>
                <section class="number-product">251 sản phẩm</section>
                <img src="images/product-list-icon.png" />
            </section>
            <section class="clear-both"></section>
        </section>
        <section id="property-filter" class="filter-column">
            <img src="images/property-filter.jpg" />
        </section>
        <section class="clear-both"></section>
    </section>
</section>
<section id="hot-products">
    <section class="container">
        <section class="heading-title">
            <h2>Sản phẩm <span>hot</span></h2>
            <a href="index1.php" style="float:right; color:black"><img src="images/arrow.png" />Xem tất cả</a>
            <section class="clear-both"></section>
        </section>
     
        <section class="box-content">
            <?php
            $num = 1;
            while ($row = mysqli_fetch_array($products)) {
                ?>
                <section class="product-item <?php if ($num % 4 == 1) { ?> first-line <?php } ?> ">
                    <section class="brand-icon"><img width="50px" src="images/farm.png" /></section>
                    <section class="product-image"><a href="detail.php?id=<?= $row['id'] ?>"><img src="<?= $row['image'] ?>" title="<?= $row['name'] ?>" /></a></section>
                    <section class="product-name"><a href="detail.php?id=<?= $row['id'] ?>"><?= $row['name'] ?></a></section>
                    <section class="wrap-button">
                        <section class="left-buy-button"></section>
                        <section class="content-buy-button">
                            <?php if ($row['quantity'] > 0) { ?>
                                <section class="product-price"><?= number_format($row['price'], 0, ",", ".") ?> đ</section>
                                <form class="quick-buy-form" action="cart.php?action=add" method="POST">
                                    <input type="hidden" value="1" name="quantity[<?= $row['id'] ?>]" />
                                    <input type="submit" value="Mua ngay" />
                                </form>
                            <?php } else { ?>
                                <a href="#">Hết hàng</a>
                            <?php } ?>
                        </section>
                        <section class="right-buy-button"></section>
                        <section class="clear-both"></section>
                    </section>
                </section>
                <?php
                $num++;
            }
            ?>
            <section class="clear-both"></section>
        </section>
     
    </section>
</section>
<?php include("footer.php"); ?>

