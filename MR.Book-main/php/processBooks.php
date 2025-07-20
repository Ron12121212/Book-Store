<!DOCTYPE html>
<html dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>מחירי ספרים</title>
    <link href="../css/processBooks.css" rel="stylesheet" />
    <link href="../css/header.css" rel="stylesheet" />
    <link href="../css/footer.css" rel="stylesheet" />
</head>
<body>
    <div id="header-placeholder"></div>
    
    <div class="results-container">
    <h1>מחירי הספרים לפי חישוב</h1>

    <?php
    function formatBookRow($title, $price, $qty, $total) {
        return "<tr>
                    <td>" . htmlspecialchars($title) . "</td>
                    <td>" . number_format($price, 2) . "</td>
                    <td>" . intval($qty) . "</td>
                    <td>" . number_format($total, 2) . "</td>
                </tr>";
    }

    $titles = $_POST['titles'] ?? [];
    $prices = $_POST['prices'] ?? [];
    $quantities = $_POST['quantities'] ?? [];

    $totalSum = 0;

    if (count($titles) > 0):
    ?>
        <table>
        <tr>
            <th>שם הספר</th>
            <th>מחיר</th>
            <th>כמות</th>
            <th>מחיר משוקלל</th>
        </tr>
        <?php
        for ($i = 0; $i < count($titles); $i++) {
            $title = $titles[$i];
            $price = floatval($prices[$i]);
            $qty = intval($quantities[$i]);
            $bookTotal = $price * $qty;
            $totalSum += $bookTotal;
            echo formatBookRow($title, $price, $qty, $bookTotal);
        }
        ?>
        <tr class="total-row">
            <td colspan="3">סה"כ</td>
            <td><?= number_format($totalSum, 2) ?></td>
        </tr>
        </table>
    <?php else: ?>
        <p>לא התקבלו ספרים</p>
    <?php endif; ?>
    </div>

    <footer></footer>

    <script src="../java_script/footer.js"></script>
    <script src="header.php"></script>
</body>
</html>
