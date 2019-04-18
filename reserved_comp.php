<?php
	
	header('Content-type: application/json; charset=UTF-8');
	
	$response = array();
	
	if ($_POST['companyID']) {
		
		require_once 'conn_mysql.php';
		$cid = $_POST['companyID'];
		$openbookingid = $_POST['openbookingid'];
		$stdID=$_POST['stdid'];

		$sql = "SELECT * FROM booking  WHERE openBookingID = $openbookingid";
		$result = $conn->query($sql);
		if($result->num_rows > 0){
			$row = $result->fetch_assoc();
			if($row["reserved"] < $row["setQuota"]){ //ตรวจสอบว่า ว่าง ไหม
				$query = "UPDATE booking
				  SET reserved = reserved+1
				  WHERE openBookingID = $openbookingid";
				$query1= "INSERT INTO booked 
						(bookingDate,bookingTime,openBookingID,stdID,companyID) 
						values( NOW(),NOW(),'$openbookingid','$stdID',$cid)";
				$stmt = $conn->prepare( $query );
				if ($stmt->execute()) {
					$stmt = $conn->prepare( $query1 );
					if ($stmt->execute()) {
						$response['status']  = 'success';
						$response['title']  = 'ทำรายการเรียบร้อย';
						$response['message'] = 'จองสถานประการเรียบร้อยแล้ว ...';
					} else {
						$response['statustitle']  = 'error';
						$response['title']  = 'เกิดข้อผิดพลาด';
						$response['message'] = 'Something was wrong ...';
					}	  
				} else {
					$response['statustitle']  = 'error';
					$response['title']  = 'เกิดข้อผิดพลาด';
					$response['message'] = 'Something was wrong ...';
				}

			}else {
				$response['status']  = 'error';
				$response['title']  = 'สถานประการนี้เต็มแล้ว';
				$response['message'] = 'กรุณาตรวจสอบและทำรายการใหม่อีกครั้ง ...';
			}
		}else {
			$response['statustitle']  = 'error';
			$response['title']  = 'เกิดข้อผิดพลาด';
			$response['message'] = 'Something was wrong ...';
		}


			
		echo json_encode($response);
	}
	$conn->close();
?>
