<?php
session_start();
include './connect_db.php';
switch ($_GET['action']) {
    case "add":
        $result = update_cart(true);
        echo json_encode(array(
            // 'status'=>$result,
            'message'=>"Thêm sản phẩm thành công"
        ));
        break;
    default:
        break;
}

function update_cart($add = false) {
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

        }
    }
    return true;
}
