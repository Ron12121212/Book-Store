<!DOCTYPE html>
<html dir="rtl">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>MR Book - Home</title>
    <link href="css/header.css" rel="stylesheet" />
    <link href="css/footer.css" rel="stylesheet" />
    <link href="css/homePage.css" rel="stylesheet" />
</head>
<body>
    <?php session_start(); ?>

    <div id="header-placeholder"></div>

	<?php
	$servername = "sql206.byethost16.com";
	$username = "b16_38703978";
	$password = "t8gwx71y";
	$dbname = "b16_38703978_BookStore";

	$conn = new mysqli($servername, $username, $password, $dbname);
    $conn->set_charset("utf8mb4");
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

    function trim_intro($text, $limit = 100) {
        if (strlen($text) <= $limit) return $text;
        $trimmed = substr($text, 0, $limit);
        $lastSpace = strrpos($trimmed, ' ');
        if ($lastSpace !== false) {
            $trimmed = substr($trimmed, 0, $lastSpace);
        }
        return $trimmed . "...";
    }

	$sql_bestSellers = "SELECT bookID, title, auther, intro, picture FROM book ORDER BY purchaseNum DESC LIMIT 4";
	$bestSellers = $conn->query($sql_bestSellers);
	$sql_recommended = "SELECT bookID, title, auther, intro, picture FROM book WHERE recommend=1 ORDER BY RAND() LIMIT 4";
	$recommended = $conn->query($sql_recommended);

	echo "<main>";
    echo "<section><h2 class='section-title'>ספרים רבי מכר</h2><div class='books-row'>";
	if ($bestSellers->num_rows > 0) {
		while($row = $bestSellers->fetch_assoc()) {
			echo "<div class='book'>
                <img src='" . $row["picture"] . "' alt='Cover Image'>
                <div class='book-details'>
                    <h3>" . $row["title"] . "</h3>
                    <p>מאת: " . $row["auther"] . "</p>
                    <p>" . trim_intro($row["intro"]) . "</p>
                    <div class='book-actions'>
                        <button onclick=\"window.location.href='../php/bookDetails.php?id=" . $row["bookID"] . "'\">פרטים נוספים</button>
                        <form method='post' action='../php/addToCart.php'>
                            <input type='hidden' name='bookID' value='" . $row["bookID"] . "'>
                            <button type='submit' title='הוסף לעגלה'><img src='../images/add_to_cart_icon.png'></button>
                        </form>
                        <a href='../php/favoritesAdd.php?book=" . $row["bookID"] . "' title='הוסף למועדפים'><img src='../images/add_to_favorites_icon.png' class='addF'></a>
                    </div>
                </div>
            </div>";
		}
	}
    echo "</div></section>";

    echo "<section><h2 class='section-title'>ספרים מומלצים</h2><div class='books-row'>";
	if ($recommended->num_rows > 0) {
        while($row = $recommended->fetch_assoc()) {
            echo "<div class='book'>
                <img src='" . $row["picture"] . "' alt='Cover Image'>
                <div class='book-details'>
                    <h3>" . $row["title"] . "</h3>
                    <p>מאת: " . $row["auther"] . "</p>
                    <p>" . trim_intro($row["intro"]) . "</p>
                    <div class='book-actions'>
                        <button onclick=\"window.location.href='../php/bookDetails.php?id=" . $row["bookID"] . "'\">פרטים נוספים</button>
                        <form method='post' action='../php/addToCart.php'>
                            <input type='hidden' name='bookID' value='" . $row["bookID"] . "'>
                            <button type='submit' title='הוסף לעגלה'><img src='../images/add_to_cart_icon.png'></button>
                        </form>
                        <a href='../php/favoritesAdd.php?book=" . $row["bookID"] . "' title='הוסף למועדפים'><img src='../images/add_to_favorites_icon.png' class='addF'></a>
                    </div>
                </div>
            </div>";
        }
    }
    echo "</div></section>";
	echo "</main>";
	
	$conn->close();
	?>

    <footer></footer>

    <script src="java_script/footer.js"></script>
    <script src="php/header.php"></script>
	
</body>
</html>
