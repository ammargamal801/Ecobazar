<?php
require_once("../../../Backend/Authentication/config.php");
$conn = getConnection();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['order_id']) && isset($_POST['status'])) {
    $orderId = $_POST['order_id'];
    $status = $_POST['status'];


    $updateSql = "UPDATE orders SET status = '$status' WHERE id = $orderId";

    if ($conn->query($updateSql) === TRUE) {
        header("Location: admin-page.php");
        exit();
    } else {
        echo "Error updating order status.";
    }
}
?>


