<?php
session_start();

$servername = "sql206.byethost16.com";
$username = "b16_38703978";
$password = "t8gwx71y";
$dbname = "b16_38703978_BookStore";

$conn = new mysqli($servername, $username, $password, $dbname);
$conn->set_charset("utf8mb4");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!isset($_SESSION['user_id'])) {
    echo "<script>
            alert('עליך להיות מחובר כדי להוסיף לעגלה');
            window.location.href = '../html/login.html';
        </script>";
    exit;
}

$userID = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['bookID'])) {
    $bookID = intval($_POST['bookID']);

    $checkSql = "SELECT quantity FROM cart_items WHERE userID = ? AND bookID = ?";
    $stmt = $conn->prepare($checkSql);
    $stmt->bind_param("ii", $userID, $bookID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        $newQty = $row['quantity'] + 1;
        $updateSql = "UPDATE cart_items SET quantity = ? WHERE userID = ? AND bookID = ?";
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->bind_param("iii", $newQty, $userID, $bookID);
        $updateStmt->execute();
    } else {
        $insertSql = "INSERT INTO cart_items (userID, bookID, quantity) VALUES (?, ?, 1)";
        $insertStmt = $conn->prepare($insertSql);
        $insertStmt->bind_param("ii", $userID, $bookID);
        $insertStmt->execute();
    }

    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit;
} else {
    echo "Invalid request.";
}
?>
