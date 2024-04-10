<!DOCTYPE html>
<html>

<head>
<link rel="icon" href="../images/logo2.png" type = "images/x-icon">
    <title>Chi tiết đơn hàng</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/admin_style.css">
    <script src="../resources/ckeditor/ckeditor.js"></script>
</head>

<body>
    <?php
        session_start();
        if (!empty($_SESSION['current_user'])) {
            include '../connect_db.php';
            $orders = mysqli_query($con, "SELECT orders.madonhang,orders.email,orders.name, orders.address, orders.phone, orders.note,orders.demand,orders.abate, order_detail.*, product.name as product_name 
FROM orders
INNER JOIN order_detail ON Orders.id = order_detail.order_id
INNER JOIN product ON product.id = order_detail.product_id
WHERE orders.id = " . $_GET['id']);
            $orders = mysqli_fetch_all($orders, MYSQLI_ASSOC);
        }
        ?>
    <div id="order-detail-wrapper">
        <div id="order-detail">
            <h1>Chi tiết đơn hàng</h1>
            <label>Mã đơn hàng: </label><span> <?= $orders[0]['madonhang'] ?></span><br />
            <label>Người nhận: </label><span> <?= $orders[0]['name'] ?></span><br />
            <label>Điện thoại: </label><span> <?= $orders[0]['phone'] ?></span><br />
            <label>Địa chỉ: </label><span> <?= $orders[0]['address'] ?></span><br />
            <label>Email: </label><span> <?= $orders[0]['email'] ?></span><br />
            <label>Phương thức thanh toán: </label><?= $orders[0]['abate'] ?><br>
            <label>Ngày đặt: </label><span> <?= date('d/m/Y H:i', $orders[0]['created_time'])?></span><br />
            <hr />
            <h3>Danh sách sản phẩm</h3>
            <ul>
                <?php
                    $totalQuantity = 0;
                    $totalMoney = 0;
                    foreach ($orders as $row) {
                        ?>
                <li>

                    <span class="item-name"><?= $row['product_name'] ?></span>
                    <span class="item-quantity"> - SL: <?= $row['quantity'] ?> sản phẩm</span>
                    <br>

                </li>
                <?php
                        $totalMoney += ($row['price'] * $row['quantity']);
                        $totalQuantity += $row['quantity'];
                    }
                    ?>
            </ul>
            <hr />
            <p><label>Yêu cầu: </label><?= $row['demand'] ?></p>
            <label>Tổng SL:</label> <?= $totalQuantity ?> - <label>Tổng tiền:</label>
            <?= number_format($totalMoney, 0, ",", ".") ?> đ
            <p><label>Ghi chú: </label><?= $orders[0]['note'] ?></p>

            <p><i>
                    <b>Thank you: </b>
                    Cảm ơn bạn đã chọn Farm trong vô vàn sự
                    lựa chọn ngoài kia. Mong rằng sản phẩm của Farm sẽ
                    làm bạn hài lòng.</i>
            </p>
            <button>
                In
            </button>
        </div>
    </div>
</body>

</html>