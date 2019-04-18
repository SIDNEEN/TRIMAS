<?php
	header('Content-type: application/json; charset=UTF-8');
	require_once 'conn_mysql.php';
    $response = array();
    $comgpaid= $_POST["comgpaid"];
    $result= $_POST["result"];
    $sql ="UPDATE studentcomgpa  set result='$result' where comgpaid = ".$comgpaid ;
    if(mysqli_query($conn,$sql)){ 
        $response['status']  = 'success';
        $response['message'] = 'เพิ่มสถานประการเรียบร้อย ...';
    }else{
        $response['status']  = 'error';
		$response['message'] = 'Unable to delete data ...';
    }
    mysqli_close($conn);
    echo json_encode($response);
    
    ?>