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

$search = $_GET['search'];

$sql = "SELECT * FROM book WHERE title LIKE '%$search%'";
$result = $conn->query($sql);

function trim_intro($intro, $maxLength = 100) {
    $intro = strip_tags($intro);
    return mb_strlen($intro, 'UTF-8') > $maxLength
        ? mb_substr($intro, 0, $maxLength, 'UTF-8') . '...'
        : $intro;
}
?>

<!DOCTYPE html>
<html dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>תוצאות חיפוש</title>
    <link rel="stylesheet" href="../css/homePage.css">
    <link rel="stylesheet" href="../css/books.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/footer.css">
</head>
<body>
    <div id="header-placeholder"></div>

    <main>
        <section>
            <h2 class="section-title">תוצאות חיפוש עבור "<?php echo $search; ?>"</h2>

            <div class="books-row">
                <?php
                if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<div class='book'>
                            <img src='" . htmlspecialchars($row["picture"]) . "' alt='Book Cover'>
                            <div class='book-details'>
                                <h3>" . htmlspecialchars($row["title"]) . "</h3>
                                <p>מאת: " . htmlspecialchars($row["auther"]) . "</p>
                                <p>" . trim_intro($row["intro"]) . "</p>
                                <p><strong>" . $row["price"] . " ₪</strong></p>
                                <div class='book-actions'>
                                    <a href='bookDetails.php?id=" . $row["bookID"] . "'>
                                        <button type='button'>פרטים נוספים</button>
                                    </a>
                                    <form class='add-to-cart-form' data-book-id='" . $row["bookID"] . "'>
                                        <button type='button'>🛒</button>
                                    </form>
                                </div>
                            </div>
                        </div>";
                    }
                } else {
                    echo "<p>לא נמצאו ספרים התואמים לחיפוש \"" . htmlspecialchars($bookName) . "\"</p>";
                }
                ?>
            </div>
        </section>
    </main>

    <footer></footer>

    <script src="../java_script/footer.js"></script>
    <script src="../php/header.php"></script>
</body>
</html>

<?php
$conn->close();
?>