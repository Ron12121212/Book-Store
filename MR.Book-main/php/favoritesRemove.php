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

$bookID = $_GET['book'];

$sql = "DELETE FROM favorites WHERE userID = " . $_SESSION['user_id'] . " AND bookID = " . $bookID . ";";

$conn->query($sql);
$conn->close();

header("Location: favorites.php");
exit();
?>
