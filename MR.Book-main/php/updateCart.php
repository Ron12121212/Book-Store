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
    header("Location: ../html/login.html");
    exit;
}

$userID = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $action = $_POST['action'];

    // פעולות לפי סוג
    switch ($action) {
        case 'increase':
            if (isset($_POST['bookID'])) {
                $bookID = intval($_POST['bookID']);
                $sql = "UPDATE cart_items SET quantity = quantity + 1 WHERE userID = ? AND bookID = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ii", $userID, $bookID);
                $stmt->execute();
            }
            break;

        case 'decrease':
            if (isset($_POST['bookID'])) {
                $bookID = intval($_POST['bookID']);

                // בדיקה כמה יש עכשיו
                $checkSql = "SELECT quantity FROM cart_items WHERE userID = ? AND bookID = ?";
                $stmt = $conn->prepare($checkSql);
                $stmt->bind_param("ii", $userID, $bookID);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($row = $result->fetch_assoc()) {
                    $currentQty = $row['quantity'];
                    if ($currentQty > 1) {
                        $updateSql = "UPDATE cart_items SET quantity = quantity - 1 WHERE userID = ? AND bookID = ?";
                        $updateStmt = $conn->prepare($updateSql);
                        $updateStmt->bind_param("ii", $userID, $bookID);
                        $updateStmt->execute();
                    } else {
                        $deleteSql = "DELETE FROM cart_items WHERE userID = ? AND bookID = ?";
                        $deleteStmt = $conn->prepare($deleteSql);
                        $deleteStmt->bind_param("ii", $userID, $bookID);
                        $deleteStmt->execute();
                    }
                }
            }
            break;

        case 'remove_all':
            if (isset($_POST['bookID'])) {
                $bookID = intval($_POST['bookID']);
                $deleteSql = "DELETE FROM cart_items WHERE userID = ? AND bookID = ?";
                $stmt = $conn->prepare($deleteSql);
                $stmt->bind_param("ii", $userID, $bookID);
                $stmt->execute();
            }
            break;

        case 'clear_cart':
            $clearSql = "DELETE FROM cart_items WHERE userID = ?";
            $stmt = $conn->prepare($clearSql);
            $stmt->bind_param("i", $userID);
            $stmt->execute();
            break;

        default:
            // פעולה לא מוכרת – לא עושים כלום
            break;
    }

    // חזרה לעגלת הקניות
    header("Location: cart.php");
    exit;
} else {
    echo "Invalid request.";
}
?>
