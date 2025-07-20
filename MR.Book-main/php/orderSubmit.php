<html lang="he">
<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"></head>
<body>

<?php
session_start();
header("Content-Type: text/html; charset=utf-8");

$servername = "sql206.byethost16.com";
$username = "b16_38703978";
$password = "t8gwx71y";
$dbname = "b16_38703978_BookStore";

$conn = new mysqli($servername, $username, $password, $dbname);
$conn->set_charset("utf8mb4");
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

$_SESSION['order_amount'] = $_POST["amount"];

$sql = "INSERT INTO orders (userID, orderDate, amount, city, street, houseNumber, zipCode, shipping, paid) VALUES (
		".$_SESSION['user_id'].",'".$_POST["orderDate"]."',".$_SESSION['order_amount'].",'".$_POST["city"]."','".$_POST["street"].
		"','".$_POST["houseNumber"]."','".$_POST["zipCode"]."',".$_POST["shipping"].", 0 );";

$conn->query($sql);
$conn->close();

header("Location: ../php/checkout.php");
exit();
?>

</body>
</html>
