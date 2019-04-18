<?php
	header('Content-type: application/json; charset=UTF-8');
	require_once 'conn_mysql.php';
	$response = array();
	$stdID=$_POST['stdID'];
	$bookedID=$_POST['bookedID'];
	$companyID=$_POST['companyID'];
	$reason=$_POST['reason'];
	$aprrover=$_POST['aprrover'];
	if ($_POST['opration']=='approve') {
		// echo $_POST['reason'];
		$sql ="INSERT INTO canceldone(stdID,bookedID,companyID,reason,aprrover,datecancel,approve) 
				values($stdID,$bookedID,$companyID,'$reason','$aprrover',now(),'yes')";
		if(mysqli_query($conn,$sql)){
			$sql ="SELECT openBookingID	 FROM booked WHERE bookedID=".$bookedID;
			$result=mysqli_query($conn,$sql)or die("Query failed");
            if(mysqli_num_rows($result)>0){
				$row=mysqli_fetch_assoc($result);
				if (!empty($row["openBookingID"])) {
					$openBookingID = $row["openBookingID"];
					$sql ="SELECT reserved	 FROM booking WHERE openBookingID =".$openBookingID;
					$result=mysqli_query($conn,$sql)or die("Query failed");
					if(mysqli_num_rows($result)>0){
						$row=mysqli_fetch_assoc($result);
						$reserved = $row["reserved"]-1;
						$sql = "UPDATE booking SET reserved =$reserved WHERE openBookingID =".$openBookingID;
						if(mysqli_query($conn,$sql)){
							// $response['something']  = 'เปาะมึง';
							$response['something']  = '';
						}
				
					}else {
						$response['title']  = 'error';
						$response['status']  = 'error';
						$response['message'] = 'Something was wrong ...1';
					}	
				}
				$sql ="DELETE FROM booked WHERE bookedID=".$bookedID;
				if(mysqli_query($conn,$sql)){
					$sql ="DELETE FROM cancelbooking WHERE bookedID=".$bookedID;
					if(mysqli_query($conn,$sql)){
						$response['title']  = 'เรียบร้อย';
						$response['status']  = 'success';
						$response['message'] = 'คำขอถูกยกเลิกเรียบร้อยแล้ว ...';
					}else {
						$response['title']  = 'error';
						$response['status']  = 'error';
						$response['message'] = 'Something was wrong ...2';
					}	
				}else {
					$response['title']  = 'error';
					$response['status']  = 'error';
					$response['message'] = 'Something was wrong ...3';
				}	
				
			}else {
				$response['title']  = 'error';
				$response['status']  = 'error';
				$response['message'] = 'Something was wrong ...4';
			}	
		}else {
			$response['title']  = 'error';
			$response['status']  = 'error';
			$response['message'] = 'Something was wrong ...5'. $sql . "<br>" . $conn->error;
		}	
	
		
	}else {
		$sql ="INSERT INTO canceldone(stdID,bookedID,companyID,reason,aprrover,datecancel,approve) 
				values($stdID,$bookedID,$companyID,'$reason','$aprrover',now(),'no')";
		if(mysqli_query($conn,$sql)){
			$sql ="DELETE FROM cancelbooking WHERE bookedID=".$bookedID;
			if(mysqli_query($conn,$sql)){
				$response['title']  = 'เรียบร้อย';
				$response['status']  = 'success';
				$response['message'] = 'คำขอไม่ได้ถูกยกเลิก ...';
			}else {
				$response['title']  = 'error';
				$response['status']  = 'error';
				$response['message'] = 'Something was wrong ...6';
			}	
		}else {
			$response['title']  = 'error';
			$response['status']  = 'error';
			$response['message'] = 'Something was wrong ...7';
		}	
	}
	echo json_encode($response);
	$conn->close();
?>
