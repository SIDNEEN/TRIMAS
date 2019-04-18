
<?php
	session_start();
	$semesterID = $_SESSION['semesterID'];
	header('Content-type: application/json; charset=UTF-8');
	
	$response = array();
	
	if ($_POST['delete']) {
		
		require_once 'conn_mysql.php';
		
		$pid = intval($_POST['delete']);
		$majorid = ($_POST['majorid']);
		$query = "DELETE FROM booking WHERE companyID=$pid AND 	majorID = $majorid AND semesterID = $semesterID";
		$stmt = $conn->prepare( $query );
		if ($stmt->execute()) {
			$response['status']  = 'success';
            $response['message'] = 'ลบข้อมูลเรียบร้อย ...';
		} else {
			$response['status']  = 'error';
			$response['message'] = 'Unable to delete data ...';
		}
		echo json_encode($response);
    }
?>