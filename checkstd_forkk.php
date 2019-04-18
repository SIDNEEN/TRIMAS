<?php
header("content-type:text/javascript;charset=utf-8");
$companyid=$_POST['companyid'];   
$stdid=$_POST['stdid']; 
include('conn_mysql.php');
$sql="SELECT * FROM student_data,booked WHERE booked.companyID = $companyid AND booked.stdID = student_data.stdID AND student_data.majorID =(SELECT majorID FROM student_data WHERE student_data.stdID=$stdid)";
$result=mysqli_query($conn,$sql)or die(mysqli_error($conn));
$resultArray = array();
	while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
	{
		array_push($resultArray,$row);
	}
	mysqli_close($conn);


echo json_encode( $resultArray, JSON_UNESCAPED_UNICODE );

?>
