<div id="ajax-cart">
    <div class="container">
        <h1>Giỏ hàng</h1>
        <?php
        session_start();
        include './connect_db.php';
        if (!empty($_SESSION["cart"])) {
            $products = mysqli_query($con, "SELECT * FROM `product` WHERE `id` IN (" . implode(",", array_keys($_SESSION["cart"])) . ")");
        }
        ?>
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
                            <td class="product-quantity"><input type="text" value="<?= $_SESSION["cart"][$row['id']] ?>" name="quantity[<?= $row['id'] ?>]" /></td>
                            <td class="total-money"><?= number_format($row['price'] * $_SESSION["cart"][$row['id']], 0, ",", ".") ?></td>
                            <td class="product-delete"><a href="cart.php?action=delete&id=<?= $row['id'] ?>">Xóa</a></td>
                        </tr>
                        <?php
                        $total += $row['price'] * $_SESSION["cart"][$row['id']];
                        $num++;
                    }
                    ?>
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
                <input type="submit" name="update_click" value="Cập nhật" />
            </div>
            <hr>
            
        </form>

    </div>
</div>