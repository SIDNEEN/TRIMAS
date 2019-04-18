<?php
	session_start();
	$semesterID = $_SESSION['semesterID'];
    header("content-type:text/javascript;charset=utf-8");
    $majorid=$_POST['majorid'];   
    include('conn_mysql.php');
    $sql="SELECT * FROM company WHERE companyID NOT IN (SELECT companyID FROM booking WHERE majorID = $majorid 
        AND semesterID = $semesterID) ORDER BY rating DESC";
    $result=mysqli_query($conn,$sql)or die("Query failed");
    $resultArray = array();
	while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
	{
		array_push($resultArray,$row);
	}
	mysqli_close($conn);


echo json_encode( $resultArray, JSON_UNESCAPED_UNICODE );
?>

