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

$title = $_POST["title"];
$auther = $_POST["auther"];
$recommend = isset($_POST['recommend']) ? $_POST['recommend'] : 0;
$categories = isset($_POST['categories']) ? $_POST['categories'] : [];

$sql="INSERT INTO book (title, auther, price, intro, picture, `language`, stock, recommend) VALUES (
	'".$title."','".$auther."',".$_POST["price"].",'".$_POST["intro"]."','".$_POST["picture"].
	"','".$_POST["language"]."',".$_POST["stock"].",".$recommend.");";

if (!$conn->query($sql)) {
    die("Error inserting book: " . $conn->error);
}

$bookID = $conn->insert_id;

foreach ($categories as $cat) {
    $cat = $conn->real_escape_string($cat);
    $sql2 = "INSERT INTO book_categories (bookID, category) VALUES ($bookID, '$cat')";
    if (!$conn->query($sql2)) {
        die("Error inserting category '$cat': " . $conn->error);
    }
}

$conn->close();

echo "<script>
		alert('הספר - " . $title . " הוכנס בהצלחה למערכת');
		window.location.href = '../';
	  </script>";
exit();
?>
