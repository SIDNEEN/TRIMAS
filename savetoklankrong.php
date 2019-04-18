<?php
    session_start();
    $majorID =$_SESSION['majorID'];
    $semesterID = $_SESSION['semesterID'];
    require_once('conn_mysql.php');
    $companyID =    $_POST["companyID"];
    $stdID =    $_POST["stdID"];
    $bossname=    $_POST["bossname"];
    $position =    $_POST["position"];
    $description =    $_POST["description"];
    $compnumber =    $_POST["compnumber"];
    $faxnumber =    $_POST["faxnumber"];
    $website =    $_POST["website"];
    $department =   $_POST["department"];
    $workdetail =    $_POST["workdetail"];
    $pesoncont  =  $_POST["pesoncont"];
    $telephone =    $_POST["telephone"];
    $totalstd = sizeof($stdID);
    $sql = "";
    for($i=0;$i<$totalstd;$i++) {
        $stdid = $stdID[$i];
        $sql  .=   "INSERT INTO stdklankrong (stdID, companyID, bossname, position, description, compnumber, faxnumber, website, department, workdetail, pesoncont, telephone,majorID,semesterID) 
        VALUES ( $stdid, $companyID, ' $bossname', '$position', '$description', '$compnumber', '$faxnumber', '$website', '$department', '$workdetail', '$pesoncont', '$telephone',$majorID,$semesterID);";
    }
	if ($conn->multi_query($sql) === TRUE) {
        $response['status']  = 'success';
        $response['message'] = 'เพิมข้อมูลเรียบร้อย ...';
        header('Location: std-klankrong-info.php');
    } else {
        $response['status']  = 'error';
        $response['message'] = "Error: " . $sql . "<br>" . $conn->error;
        echo "Error: " . $sql . "<br>" . $conn->error;
    }


	mysqli_close($conn);
?>
