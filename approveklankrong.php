<?php
	session_start();
	$semesterID = $_SESSION['semesterID'];
	header('Content-type: application/json; charset=UTF-8');
	
	$response = array();
	
	if ($_POST['klankrongid']) {
		
		require_once 'conn_mysql.php';
		$updpgr='';
		$klankrongid = $_POST['klankrongid'];
		if ($_POST['approvement']==1) {
			$approvement = 'yes';
		}elseif ($_POST['approvement']==0) {
			$approvement = 'no';
			$updpgr=", progress='none' ";
		}
		$totalklankrongid = sizeof($klankrongid); //ก่อนหน้านี้ส่งเป็นหลายคน จึงต้องตรวจสอบว่ากี่คน
		$sql = "";								//ตอนนี้ ส่งกลั่นกรองเป็นรายคน แต่สามารถใช้งานได้เหมือนกัน sizeof($klankrongid)=1
		for($i=0;$i<$totalklankrongid;$i++) {
			$whereklankrongid = $klankrongid[$i];
			$sql .= "UPDATE stdklankrong SET approve ='$approvement' $updpgr WHERE klankrongID=$whereklankrongid;";
		
		}
		if ($conn->multi_query($sql) === TRUE) {
			$response['title']  = 'success';
			$response['status']  = 'success';
            $response['message'] = 'เพิมข้อมูลเรียบร้อย ...';
		} else {
			$response['title']  = 'error';
			$response['status']  = 'error';
			$response['message'] = "Error: " . $sql . "<br>" . $conn->error;
			// echo "Error: " . $sql . "<br>" . $conn->error;
		}


		echo json_encode($response);
    }
?>