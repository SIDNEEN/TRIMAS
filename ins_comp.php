    <?php
	header('Content-type: application/json; charset=UTF-8');
	require_once 'conn_mysql.php';
    $response = array();
    
    $companyName =$_POST["companyName"];
    $companyAddress= $_POST["companyAddress"];
    $companyTambol= $_POST["district"];
    $companyAmpo= $_POST["amphoe"];
    $companyChangwat= $_POST["province"];
    $companyZipCode= $_POST["zipcode"];
    $companyPhonet= $_POST["companyPhonet"];
    $companyRating= $_POST["rating"];
    $companyNote= $_POST["note"];

    $sql ="INSERT INTO company(companyName,companyAddress,companyTambol,companyAmpo,companyChangwat,companyZipCode,companyPhonet,note,rating) 
    values('$companyName','$companyAddress','$companyTambol','$companyAmpo','$companyChangwat','$companyZipCode','$companyPhonet','$companyNote',$companyRating)";
    if(mysqli_query($conn,$sql)){
        
        
        // echo "<script>";
        // echo "swal('Success!', response.message, response.status).then(function () {";
        // echo 'header("location:mngdatacomp.php");
        // }
        // ); </script>';
       
        $response['status']  = 'success';
        $response['message'] = 'เพิ่มสถานประการเรียบร้อย ...';
    }else{
        $response['status']  = 'error';
		$response['message'] = 'Unable to insert data ...'.mysqli_error($conn);
    }
    mysqli_close($conn);
    echo json_encode($response);
    
    ?>
