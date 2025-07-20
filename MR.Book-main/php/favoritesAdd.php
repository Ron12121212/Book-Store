<?php
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    echo "<script>
            alert('חובה להתחבר על מנת להוסיף למועדפים');
            window.location.href = '../html/login.html';
        </script>";
    exit();
}

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
$userID = $_SESSION['user_id'];

$checkSql = "SELECT * FROM favorites WHERE userID =" . $userID . " AND bookID =" . $bookID;
$result = $conn->query($checkSql);

if ($result->num_rows == 0) {
    $insertSql = "INSERT INTO favorites (userID, bookID) VALUES (" . $userID . ", " . $bookID . ");";
    $conn->query($insertSql);
}
$conn->close();

// Redirect back to the referring page if possible
if (!empty($_SERVER['HTTP_REFERER'])) {
    header("Location: " . $_SERVER['HTTP_REFERER']);
} else {
    header("Location: ../php/favorites.php");
}
exit();
?>
