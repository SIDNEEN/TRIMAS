<?php
header("content-type:text/javascript;charset=utf-8");
$bookingid=$_POST['bookingid'];   
include('conn_mysql.php');
$sql = "SELECT student_data.stdFirstname,student_data.stdLastname,student_data.stdNumber,booked.bookingDate,booked.companyID FROM student_data LEFT JOIN booked 
		ON student_data.stdID = booked.stdID LEFT JOIN booking 
		ON booked.openBookingID=booking.openBookingID WHERE booking.openBookingID = $bookingid";
$result=mysqli_query($conn,$sql)or die(mysqli_error($conn));
$resultArray = array();
	while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
	{
		array_push($resultArray,$row);
	}
	mysqli_close($conn);


echo json_encode( $resultArray, JSON_UNESCAPED_UNICODE );

?>
