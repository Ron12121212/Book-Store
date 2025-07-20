<!DOCTYPE html>
<html dir="rtl">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>מועדפים</title>
    <link href="../css/favorites.css" rel="stylesheet" />
    <link href="../css/header.css" rel="stylesheet" />
    <link href="../css/footer.css" rel="stylesheet" />
</head>
<body>
    <?php 
    session_start(); 

    if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
        echo "<script>
                alert('חובה להתחבר על מנת לצפות במועדפים');
                window.location.href = '../html/login.html';
            </script>";
        exit();
    }
    ?>

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

    $userID = $_SESSION['user_id'];

    $sql_favorites = "SELECT bookID FROM favorites WHERE userID = " . $userID;
	$favorites = $conn->query($sql_favorites);

    echo "<main>";
    echo "<section><h1 class='section-title'>ספרים אהובים</h1><div class='books-row'>";

    if ($favorites->num_rows > 0) {
		while($fav = $favorites->fetch_assoc()) {
			$sql_books = "SELECT bookID, title, auther, intro, picture FROM book WHERE bookID = " . $fav["bookID"];
            $books = $conn->query($sql_books);
            
            if ($books->num_rows > 0) {
                while($row = $books->fetch_assoc()) {
                    echo "<div class='book'><img src=" . $row["picture"] . " alt='Cover Image'><div class='book-details'>
                    <h3>" . $row["title"] . "</h3><p>מאת: " . $row["auther"] . "</p><p>" . $row["intro"] . "</p>
                    <div class='book-actions'>
                    <button onclick=\"window.location.href='../php/bookDetails.php?id=" . $row["bookID"] . "'\">פרטים נוספים</button>
                    <a href='favoritesRemove.php?book=" . $row["bookID"] . "' title='הסר ממועדפים'><img src='../images/remove_from_favorites_icon.png' id='removeF'></a>
                    <form method='post' action='../php/addToCart.php' class='addC'>
                            <input type='hidden' name='bookID' value='" . $row["bookID"] . "'>
                            <button type='submit' class='addC' title='הוסף לעגלה'><img src='../images/add_to_cart_icon.png' class='addC'></button>
                    </form>
                    </div></div></div>";
                }
            }
		}
	}

    echo "</div></section>";
	echo "</main>";
	
	$conn->close();
	?>

    <footer></footer>

    <script src="../java_script/footer.js"></script>
    <script src="../php/header.php"></script>
	
</body>
</html>
