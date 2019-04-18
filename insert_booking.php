<?php
	session_start();
	$semesterID = $_SESSION['semesterID'];
	header('Content-type: application/json; charset=UTF-8');
	
	$response = array();
	
	if ($_POST['companyid']) {
		
		require_once 'conn_mysql.php';
		
		$companyid = $_POST['companyid'];
		$qouta = $_POST['qoutaArr'];
		$majorid = $_POST['majorid'];
		$totalcompany = sizeof($companyid);
		$sql = "";
		for($i=0;$i<$totalcompany;$i++) {

			$InsertCompanyid = $companyid[$i];
			$InsertQouta = $qouta[$i];

		
			$sql .= "INSERT INTO booking (companyID , setQuota,majorID,	semesterID) VALUES ($InsertCompanyid,$InsertQouta,$majorid,$semesterID);";
		
		}
		if ($conn->multi_query($sql) === TRUE) {
			$response['status']  = 'success';
            $response['message'] = 'เพิมข้อมูลเรียบร้อย ...';
		} else {
			$response['status']  = 'error';
			$response['message'] = "Error: " . $sql . "<br>" . $conn->error;
			// echo "Error: " . $sql . "<br>" . $conn->error;
		}


		echo json_encode($response);

    }
?>