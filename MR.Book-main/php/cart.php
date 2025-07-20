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

if (!isset($_SESSION['user_id'])) {
    header("Location: ../html/login.html");
    exit;
}

$userID = $_SESSION['user_id'];
$books = [];
$total = 0;

$sql = "SELECT b.bookID, b.title, b.price, ci.quantity
        FROM cart_items ci
        JOIN book b ON ci.bookID = b.bookID
        WHERE ci.userID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userID);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    $row['total_price'] = $row['quantity'] * $row['price'];
    $books[] = $row;
    $total += $row['total_price'];
}
$_SESSION['order_amount'] = $total;
?>

<!DOCTYPE html>
<html lang="he" dir="rtl">
<head>
    <meta charset="UTF-8" />
    <title>עגלת קניות</title>
    <link rel="stylesheet" href="../css/cart.css" />
    <link rel="stylesheet" href="../css/header.css" />
    <link rel="stylesheet" href="../css/footer.css" />
</head>
<body>
    <div id="header-placeholder"></div>

    <main class="cart-main">
        <h1 class="cart-title">🛒 עגלת הקניות שלך</h1>

        <?php if (empty($books)): ?>
        <div class="cart-block">
            <p class="empty-text">העגלה שלך ריקה.</p>
        </div>
        <?php else: ?>
        <div class="cart-block">
            <div class="cart-items">
                <?php foreach ($books as $book): ?>
                <div class="cart-item">
                    <strong><?= htmlspecialchars($book['title']) ?></strong><br />
                    כמות: <?= $book['quantity'] ?><br />
                    מחיר ליחידה: <?= $book['price'] ?> ₪<br />
                    מחיר כולל: <?= $book['total_price'] ?> ₪

                    <form method="POST" action="../php/updateCart.php" style="display:inline;">
                        <input type="hidden" name="bookID" value="<?= $book['bookID'] ?>">
                        <input type="hidden" name="action" value="increase">
                        <button type="submit">➕</button>
                    </form>

                    <form method="POST" action="../php/updateCart.php" style="display:inline;">
                        <input type="hidden" name="bookID" value="<?= $book['bookID'] ?>">
                        <input type="hidden" name="action" value="decrease">
                        <button type="submit">➖</button>
                    </form>

                    <form method="POST" action="../php/updateCart.php" style="display:inline;">
                        <input type="hidden" name="bookID" value="<?= $book['bookID'] ?>">
                        <input type="hidden" name="action" value="remove_all">
                        <button type="submit">🗑</button>
                    </form>
                </div>
                <?php endforeach; ?>
            </div>

            <div id="cart-summary">
                סה״כ לתשלום: <?= $total ?> ₪

                <form action="../php/orderForm.php" method="post" style="margin-top: 10px;">
                    <button type="submit">מעבר לתשלום</button>
                </form>

                <form action="../php/updateCart.php" method="post" style="margin-top: 10px;">
                    <input type="hidden" name="action" value="clear_cart">
                    <button type="submit" id="clear-cart">רוקן עגלה</button>
                </form>
            </div>
        </div>
        <?php endif; ?>
    </main>

    <footer></footer>

    <script src="../php/header.php"></script>
    <script src="../java_script/footer.js"></script>
</body>
</html>
