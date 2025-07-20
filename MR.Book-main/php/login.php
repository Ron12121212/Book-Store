<?php
$servername = "sql206.byethost16.com";
$username = "b16_38703978";
$password = "t8gwx71y";
$dbname = "b16_38703978_BookStore";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

$user = $_POST["username"];

$sql = "SELECT userID, fname FROM user WHERE userName='" . $user . "' AND password='" . $_POST["password"] . "'";

if ($user == "admin") {
    $sql = "SELECT userID, fname FROM admin WHERE userName='" . $user . "' AND password='" . $_POST["password"] . "'";
}

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    
    session_start();
    $_SESSION['logged_in'] = true;
    $_SESSION['user_id'] = $row["userID"];
    $_SESSION['user_name'] = $row["fname"];

    header("Location: ../");
    exit();
} else {
    echo "<script>
            alert('משתמש לא נמצא במערכת. אנא נסה שוב');
            window.location.href = '../html/login.html';
          </script>";
    exit();
}

$conn->close();
?>
