<?php
    $servername = "sql206.byethost16.com";
    $username = "b16_38703978";
    $password = "t8gwx71y";
    $dbname = "b16_38703978_BookStore";

    $conn = new mysqli($servername, $username, $password, $dbname);
    $conn->set_charset("utf8");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deleteBookID'])) {
        $bookID = intval($_POST['deleteBookID']);
        $sql = "DELETE FROM book WHERE bookID = $bookID";
        if ($conn->query($sql)) {
            echo $conn->affected_rows > 0 ? "success" : "error";
        } else {
            echo "error";
        }
        exit;
    }

    $sql = "SELECT b.bookID, b.title, b.auther, b.price, b.language, b.stock, b.recommend, GROUP_CONCAT(bc.category SEPARATOR ', ') AS categories
        FROM book b LEFT JOIN book_categories bc ON b.bookID = bc.bookID GROUP BY b.bookID";
    $result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>הסרת ספר</title>
    <link href="../css/bookDelete.css" rel="stylesheet">
    <link href="../css/header.css" rel="stylesheet" />
    <link href="../css/footer.css" rel="stylesheet" />
    <script>
        function deleteBook() {
            const id = prompt("הכנס את מזהה הספר להסרה: ");
            if (id) {
                fetch('bookDelete.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: 'deleteBookID=' + encodeURIComponent(id)
                })
                .then(response => response.text())
                .then(result => {
                    if (result.trim() === "success") {
                        window.alert("הספר נמחק בהצלחה");
                        window.location.reload();
                    }
                });
            }
        }
    </script>
</head>
<body>
    <div id="header-placeholder"></div>

    <main>
        <div class="center">
            <button onclick="deleteBook()">מחק ספר לפי מספר מזהה</button>
        </div>

        <table>
            <thead>
                <tr>
                    <th>מספר מזהה</th>
                    <th>שם הספר</th>
                    <th>שם הכותב</th>
                    <th>מחיר</th>
                    <th>שפת הספר</th>
                    <th>מלאי</th>
                    <th>מומלץ?</th>
                    <th>משוייך לקטגוריות</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['bookID'] ?></td>
                    <td><?= $row['title'] ?></td>
                    <td><?= $row['auther'] ?></td>
                    <td><?= $row['price'] ?></td>
                    <td><?= $row['language'] === 'H' ? 'עברית' : 'אנגלית' ?></td>
                    <td><?= $row['stock'] ?></td>
                    <td><?= $row['recommend'] ? 'Yes' : 'No' ?></td>
                    <td><?= $row['categories'] ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <p class="category-info">
            * <strong>Category codes :</strong><br><br>
            SF = Science Fiction, 
            F = Fantasy, 
            R = Romance, 
            B = Biography, 
            Hi = History, 
            Hr = Horror, 
            M = Mystery, 
            T = Thriller, 
            A = Adventure, 
            K = Kids, 
            C = Classics
        </p>
    </main>

    <footer></footer>

    <script src="../java_script/footer.js"></script>
    <script src="../php/header.php"></script>
</body>
</html>
<?php $conn->close(); ?>
