<?php
	
	header('Content-type: application/json; charset=UTF-8');
	
	$response = array();
	
	if ($_POST['reason']) {
		
		require_once 'conn_mysql.php';
		$reason = $_POST['reason'];
		$stdID=$_POST['stdID'];
		$companyID=$_POST['companyID'];
		$bookedID = $_POST['bookedID'];
		$query ="INSERT INTO cancelbooking (stdID, bookedID,companyID, reason, date)
				VALUES ($stdID,$bookedID,$companyID,'$reason',NOW())";
		$stmt = $conn->prepare( $query );
		if ($stmt->execute()) {
			$response['status']  = 'success';
			$response['message'] = 'ส่งข้อมูลเรียบร้อยแล้ว ...';
		} else {
			$response['status']  = 'error';
			$response['message'] = 'Something was wrong ...';
		}	
		echo json_encode($response);
	}
	$conn->close();
?>
