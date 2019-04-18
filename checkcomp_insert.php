<?php
header("content-type:text/javascript;charset=utf-8");
$tambol=$_POST['tambol'];   
$ampo=$_POST['ampo']; 
$changwat=$_POST['changwat']; 
include('conn_mysql.php');
$sql="SELECT*FROM company WHERE companyTambol ='$tambol' and companyAmpo ='$ampo' and companyChangwat='$changwat'";
$result=mysqli_query($conn,$sql)or die(mysqli_error($conn));
$resultArray = array();
	while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
	{
		array_push($resultArray,$row);
	}
	mysqli_close($conn);


echo json_encode( $resultArray, JSON_UNESCAPED_UNICODE );

?>
