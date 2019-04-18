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
    $companyNote= $_POST["note"];
    $stdID=$_POST['stdid'];

    $sql ="INSERT INTO company(companyName,companyAddress,companyTambol,companyAmpo,companyChangwat,companyZipCode,companyPhonet,note) 
    values('$companyName','$companyAddress','$companyTambol','$companyAmpo','$companyChangwat','$companyZipCode','$companyPhonet','$companyNote')";
    if(mysqli_query($conn,$sql)){
        $companyID = $conn->insert_id;
        $sql ="INSERT INTO booked 
        (bookingDate,bookingTime,stdID,companyID) 
        values( NOW(),NOW(),'$stdID',$companyID)";
        if(mysqli_query($conn,$sql)){
            $response['status']  = 'success';
            $response['message'] = 'เพิ่มสถานประการเรียบร้อย ...';
        }else{
            $response['status']  = 'error';
            $response['message'] = 'Unable to delete data ...';
        }
    }else{
        $response['status']  = 'error';
        $response['message'] = 'Unable to delete data ...';
    }
    mysqli_close($conn);
    echo json_encode($response);
    
    ?>
