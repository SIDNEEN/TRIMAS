<?php
	session_start();
	$semesterID = $_SESSION['semesterID'];
	header('Content-type: application/json; charset=UTF-8');
	
	$response = array();
	
	if ($_POST['klankrongid']) {
		
		require_once 'conn_mysql.php';
		
		$klankrongid = $_POST['klankrongid'];
		$progress = $_POST['progress'];
		$sql = "UPDATE stdklankrong SET progress ='$progress' WHERE klankrongID=$klankrongid";
		if (mysqli_query($conn,$sql) === TRUE) {
			$response['title']  = 'success';
			$response['status']  = 'success';
            $response['message'] = 'อัพเดตข้อมูลเรียบร้อย ...';
		} else {
			$response['title']  = 'error';
			$response['status']  = 'error';
			$response['message'] = "Error: " . $sql . "<br>" . $conn->error;
			// echo "Error: " . $sql . "<br>" . $conn->error;
		}


		echo json_encode($response);
    }
?>