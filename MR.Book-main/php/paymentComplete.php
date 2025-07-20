<?php
session_start();

$servername = "sql206.byethost16.com";
$username = "b16_38703978";
$password = "t8gwx71y";
$dbname = "b16_38703978_BookStore";

$conn = new mysqli($servername, $username, $password, $dbname);
$conn->set_charset("utf8");
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

$user_id = $_SESSION['user_id'];

$order_sql = "SELECT orderID FROM orders WHERE userID = $user_id AND paid = 0 LIMIT 1";
$order_result = $conn->query($order_sql);

if ($order_row = $order_result->fetch_assoc()) {

    $update_orders_sql = "UPDATE orders SET paid = 1 WHERE orderID = " . $order_row['orderID'];
    $conn->query($update_orders_sql);

    $cart_sql = "SELECT c.bookID, c.quantity, b.price FROM cart_items c JOIN book b ON c.bookID = b.bookID WHERE c.userID = $user_id";
    $cart_result = $conn->query($cart_sql);

    while ($row = $cart_result->fetch_assoc()) {
        $order_items_sql = "INSERT INTO order_items (orderID, bookID, quantity, pricePerUnit) VALUES 
        (" . $order_row['orderID'] . ", " . $row['bookID'] . ", " . $row['quantity'] . ", " . $row['price'] . ")";
        $conn->query($order_items_sql);
    }
}

$delete_cart_sql = "DELETE FROM cart_items WHERE userID = $user_id";
$conn->query($delete_cart_sql);

$total = $_SESSION['order_amount'];
$_SESSION['order_amount'] = 0;
?>

<!DOCTYPE html>
<html lang="he" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>תשלום הושלם</title>
    <link href="../css/header.css" rel="stylesheet" />
    <link href="../css/footer.css" rel="stylesheet" />
    <link href="../css/paymentComplete.css" rel="stylesheet" />
</head>
<body>
    <div id="header-placeholder"></div>

    <div class="confirmation">
        <h2> התשלום הושלם בהצלחה</h2>
        <p>התשלום שלך בסך <?= $total ?> ₪ התקבל.</p>
        <a href="../">חזרה לעמוד הבית</a>
    </div>

    <footer></footer>

    <script src="../java_script/footer.js"></script>
    <script src="../php/header.php"></script>
</body>
</html>
