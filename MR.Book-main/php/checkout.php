<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../html/login.html");
    exit;
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
    $row['subtotal'] = $row['price'] * $row['quantity'];
    $total += $row['subtotal'];
    $books[] = $row;
}

$showShipping = false;
if (isset($_SESSION['order_amount']) && $total != $_SESSION['order_amount']) {
    $showShipping = true;
    $shippingCost = $_SESSION['order_amount'] - $total;
    $total = $_SESSION['order_amount'];
}
?>

<!DOCTYPE html>
<html lang="he" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>תשלום</title>
    <link rel="stylesheet" href="../css/cart.css">
    <link rel="stylesheet" href="../css/checkout.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/footer.css">
</head>
<body>
    <div id="header-placeholder"></div>

    <main class="cart-main">
        <h1 class="cart-title">עמוד תשלום</h1>

        <div class="cart-block">
        <?php if (empty($books)): ?>
            <p class="empty-text">אין ספרים בעגלה.</p>
        <?php else: ?>
            <ul style="list-style: none; text-align: center; padding: 0;">
                <?php foreach ($books as $book): ?>
                    <li><strong><?= htmlspecialchars($book['title']) ?></strong> (x<?= $book['quantity'] ?>) – <?= $book['subtotal'] ?> ₪</li>
                <?php endforeach; ?>

                <?php if (!empty($books) && $showShipping): ?>
                    <li><strong>משלוח</strong> – <?= $shippingCost ?> ₪</li>
                <?php endif; ?>
            </ul>
            <p style="text-align: center;"><strong>סה״כ לתשלום: <?= $total ?> ₪</strong></p>

            <form class="checkout-form" method="post" action="paymentComplete.php">
                <div>
                    <label>שם בעל הכרטיס:</label>
                    <input type="text" name="card_name" pattern="(?=.*[\p{L}])[ \p{L}]+" title="יש להזין אותיות בעברית או אנגלית בלבד, עם רווחים" required>
                </div>

                <div>
                    <label>מספר כרטיס:</label>
                    <input type="tel" name="card_number" pattern="\d{16}" maxlength="16" required>
                </div>

                <div>
                    <label>תוקף (MM/YY):</label>
                    <input type="text" name="expiry" placeholder="MM/YY" pattern="\d{2}/\d{2}" required>
                </div>

                <div>
                    <label>CVV:</label>
                    <input type="tel" name="cvv" pattern="\d{3}" maxlength="3" required>
                </div>

                <button type="submit">בצע תשלום</button>
            </form>
        <?php endif; ?>
        </div>
    </main>

    <footer></footer>

    <script src="../php/header.php"></script>
    <script src="../java_script/footer.js"></script>
    <script src="../java_script/checkout.js"></script>
</body>
</html>
