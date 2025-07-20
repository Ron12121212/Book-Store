<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"></head>
<body>

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

$username = $_POST['username'];
$email = $_POST['email'];
$phone = $_POST['phone'];

// Check unique fields
$check_sql = "SELECT userName, email, phone FROM user WHERE userName = '$username' OR email = '$email' OR phone = '$phone'";
$result = $conn->query($check_sql);

$error = "";
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        if ($row['userName'] === $username) $error .= "שם המשתמש כבר קיים\n";
        if ($row['email'] === $email) $error .= "האימייל כבר קיים\n";
        if ($row['phone'] === $phone) $error .= "מספר הטלפון כבר קיים\n";
 
        $safeError = json_encode($error);  // safely encodes as a JS string
        echo "<script>
            alert($safeError);
            window.history.back();
        </script>";
        exit();

    }
}

// Normal registration process
$country = ($_POST['country'] !== '') ? "'".$_POST['country']."'" : "NULL";
$website = $_POST['website'] !== '' ? "'".$_POST['website']."'" : "NULL";
$favnumber = $_POST['favnumber'] !== '' ? (int)$_POST['favnumber'] : "NULL";
$favcolor = $_POST['favcolor'] !== '' ? "'".$_POST['favcolor']."'" : "NULL";
$time = $_POST['time'] !== '' ? "'".$_POST['time']."'" : "NULL";
$pic = $_POST['pic'] !== '' ? "'".$_POST['pic']."'" : "NULL";
$about = $_POST['about'] !== '' ? "'".$_POST['about']."'" : "NULL";
$rating = $_POST['rating'] !== '' ? (int)$_POST['rating'] : "NULL";
date_default_timezone_set("Asia/Jerusalem");
$datetime = $datetime = date("Y-m-d H:i:s");

$sql="INSERT INTO user (fname, lname, dateOfBirth, userName, password, gender, email, phone, country, website, 
	favoriteNumber, favoriteColor, contactTime, profilePicture, about, rating, registrationDate) VALUES (
	'".$_POST["fname"]."','".$_POST["lname"]."','".$_POST["dob"]."','".$username."','".$_POST["password"].
	"','".$_POST["gender"]."','".$email."','".$phone."',".$country.",".$website.",".$favnumber.",".$favcolor.","
    .$time.",".$pic.",".$about.",".$rating.",'".$datetime."');";

$conn->query($sql);
$userID = $conn->insert_id;

// Create new shopping cart for the user
$sql2 = "INSERT INTO shopping_cart (userID) VALUES ('".$userID."');";
$conn->query($sql2);

$conn->close();

echo '<script>
        alert("ההרשמה בוצעה בהצלחה, הינך מועבר להתחברות");
        window.location.href = "../html/login.html";
    </script>';
exit();
?>

</body>
</html>
