<?php
session_start();
if ($_SESSION['userID']=="") {
    header("Location: login.php");
}
include('conn_mysql.php');

$sql = "SELECT * FROM student_data,major  WHERE userID = ".$_SESSION['userID']." AND student_data.majorID = major.majorID";
        $result = $conn->query($sql);
        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            $stdID=$row['stdID'];
        }
        $sql = "SELECT * FROM stdklankrong  WHERE stdID = ".$stdID;
        $result = $conn->query($sql);
        if($result->num_rows > 0){
            header("Location: std-klankrong-info.php");
        }else {
            header("Location: std-klankrong.php");
        }
 ?>

