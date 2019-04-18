<?php
header("content-type:text/javascript;charset=utf-8");
$id=$_POST['id'];   
include('conn_mysql.php');
$sql="SELECT*FROM company WHERE companyID=$id";
$result=mysqli_query($conn,$sql)or die("Query failed");
$row=mysqli_fetch_array($result);
echo json_encode( $row, JSON_UNESCAPED_UNICODE );
mysqli_close($conn);
?>

