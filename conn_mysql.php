
<?php
//ส่วนของการติดต่อฐานข้อมูล
$host = "localhost";
$user = "root";
$password = "";
$dbname = "databasecom";

// open the connection
$conn = new mysqli($host, $user, $password, $dbname);
mysqli_set_charset($conn, "utf8");

// Check connection
if ($conn->connect_errno) {
    echo "Failed to connect to MySQL: (" . $conn ->connect_errno . ") " . $conn ->connect_error;
}
?>

