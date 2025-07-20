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


$authorsQuery = "SELECT DISTINCT auther FROM book LIMIT 3";
$authorsResult = $conn->query($authorsQuery);

$booksQuery = "SELECT title, auther, price, intro FROM book WHERE recommend = 1 LIMIT 5";
$booksResult = $conn->query($booksQuery);
?>

<!DOCTYPE html>
<html lang="he" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>מידע נוסף - MR Book</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/homePage.css" rel="stylesheet" />
    <link href="../css/header.css" rel="stylesheet" />
    <link href="../css/footer.css" rel="stylesheet" />
    <link href="../css/extraInfo.css" rel="stylesheet">
</head>
<body>
    <div id="header-placeholder"></div>

    <main class="extra-content">
        <h2>מידע נוסף על סופרים וספרים</h2>
        <p>כאן תמצאו מידע מעניין על סופרים אהובים, סקירות ספרים, טיפים לקריאה, וקישורים להעמקה.</p>

        <h3>סופרים מומלצים</h3>
        <ul>
            <?php while ($row = $authorsResult->fetch_assoc()): ?>
                <li><?= htmlspecialchars($row['auther']) ?></li>
            <?php endwhile; ?>
        </ul>

        <h3>ספרים מומלצים</h3>
        <table>
            <tr>
                <th>שם הספר</th>
                <th>סופר</th>
                <th>מחיר</th>
                <th>תקציר</th>
            </tr>
            <?php while ($book = $booksResult->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($book['title']) ?></td>
                <td><?= htmlspecialchars($book['auther']) ?></td>
                <td><?= $book['price'] ?> ₪</td>
                <td><?= htmlspecialchars($book['intro']) ?></td>
            </tr>
            <?php endwhile; ?>
        </table>

        <h3 id="reading-tips">טיפים לקריאה מהנה</h3>
        <ol>
            <li>בחר זמן קבוע ביום לקריאה</li>
            <li>מצא מקום שקט ונוח</li>
            <li>התאם את הספר למצב הרוח שלך</li>
        </ol>

        <h3>קישורים חיצוניים מומלצים</h3>
    <ul>
    <li><a href="https://he.wikipedia.org/wiki/סופר" target="_blank">מה זה סופר? - ויקיפדיה</a></li>
    <li><a href="https://www.goodreads.com/" target="_blank">ביקורות והמלצות על ספרים באתר Goodreads</a></li>
    <li><a href="https://www.healthline.com/health/benefits-of-reading-books" target="_blank">למה כדאי לקרוא ספרים? - מאמר מ־Healthline</a></li>
    </ul>

        <h3>סקירת וידאו</h3>
        <iframe width="100%" height="315" src="https://www.youtube.com/embed/AUw7laSlcbo"             
                title="YouTube video player" frameborder="0" allowfullscreen></iframe>
    </main>

    <footer></footer>

    <script src="../java_script/footer.js"></script>
    <script src="../php/header.php"></script
</body>
</html>

<?php $conn->close(); ?>
