<?php
require('conn_mysql.php');



if (isset($_POST['submitEditModal'])){
    $stdNumber = $_REQUEST['stdNumber'];
    $stdFirstname = $_REQUEST['stdFirstname'];
    $stdLastname = $_REQUEST['stdLastname'];
    $stdEmail = $_REQUEST["stdEmail"];
    $stdPhone = $_REQUEST["stdPhone"];
    $stdFacebook = $_REQUEST["stdFacebook"];
    $majorID = $_REQUEST["majorID"];
    $gender = $_REQUEST["gender"];
    $stdID = $_REQUEST["stdID"];
    // $pagefrom=$_REQUEST['stdNumber'];
    if (isset($_FILES['fileUpload'])){
        $temp = explode('.',$_FILES['fileUpload']['name']);
        $new_name = round(microtime(true)) . '.' . end($temp);
        $stdPhoto = $new_name;
        /**
         * ตรวจสอบเงื่อนไขที่ว่า สามารถย้ายไฟล์รูปภาพเข้าสู่ storage ของเราได้หรือไม่
         */
        if(move_uploaded_file($_FILES['fileUpload']['tmp_name'], 'img/' .$new_name)){
            echo '<script> alert("upload pic ok")</script>';
            $sql = "UPDATE student_data  set stdPhoto=? where stdID = ?;";
            /* Prepare statement */
            $stmt = $conn->prepare($sql);
            if($stmt === false) {
                trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->errno . ' ' . $conn->error, E_USER_ERROR);
            }
    
            /* Bind parameters. Types: s = string, i = integer, d = double,  b = blob */
            $stmt->bind_param("si", $stdPhoto,$stdID);
    
            /* Execute statement */
            if($stmt->execute()){
                echo " picture updated!";
            } else {
                echo "  picture update Error : ",$conn->error;
            }
        }else {
            echo "wrong upload";
        }
    }
    
    /* Performing SQL query */
        $sql = "UPDATE student_data  set stdNumber = ?,	stdFirstname = ? ,stdLastname= ? ,stdEmail= ? ,stdPhone= ?,stdFacebook= ? ,majorID=? ,gender=? where stdID = ?;";
        /* Prepare statement */
        $stmt = $conn->prepare($sql);
        if($stmt === false) {
            trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->errno . ' ' . $conn->error, E_USER_ERROR);
        }

        /* Bind parameters. Types: s = string, i = integer, d = double,  b = blob */
        $stmt->bind_param("ssssssisi", $stdNumber,$stdFirstname,$stdLastname,$stdEmail,$stdPhone,$stdFacebook,$majorID,$gender,$stdID);

        /* Execute statement */
        if($stmt->execute()){
            echo " record updated!";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        } else {
            echo " Error : ",$conn->error;
        }
        $stmt->close();
        $conn->close();
    
}else if (isset($_POST['editgpa'])){
    $stdID = $_REQUEST["stdID"];
    $gpa = $_REQUEST["gpa"];
    if (isset($_FILES['filegpa'])){
        $temp = explode('.',$_FILES['filegpa']['name']);
        $new_name = $stdID.'gpa.' . end($temp);
        $stdgpa = $new_name;
        /**
         * ตรวจสอบเงื่อนไขที่ว่า สามารถย้ายไฟล์เข้าสู่ storage ของเราได้หรือไม่
         */
        if(move_uploaded_file($_FILES['filegpa']['tmp_name'], 'studentcomgpa/' .$new_name)){
            echo '<script> alert("upload file ok")</script>';
            $sql = "UPDATE studentcomgpa  set gpafile='$stdgpa' where stdID = ".$stdID ;
            $result = $conn->query($sql);
            if($result){
                echo 'complete';
                
            }else{
                echo 'file update Error : '. $sql . "<br>" . $conn->error;
            }
            
        }else {
            echo "wrong upload".$conn->error;
        }
    }   
    $sql = "UPDATE studentcomgpa SET gpa ='".$gpa."' WHERE stdID = ".$stdID ;
    $result = $conn->query($sql);
    if($result){
        echo 'complete';
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        
    }else{
        echo 'no';
    }
}else if (isset($_POST['editcomtest'])){
    $stdID = $_REQUEST["stdID"];
    $comtest = $_REQUEST["comtest"];
    if (isset($_FILES['filecomtest'])){
        $temp = explode('.',$_FILES['filecomtest']['name']);
        $new_name = $stdID.'filecomtest.' . end($temp);
        $stdcomtest = $new_name;
        /**
         * ตรวจสอบเงื่อนไขที่ว่า สามารถย้ายไฟล์เข้าสู่ storage ของเราได้หรือไม่
         */
        if(move_uploaded_file($_FILES['filecomtest']['tmp_name'], 'studentcomgpa/' .$new_name)){
            echo '<script> alert("upload file ok")</script>';
            $sql = "UPDATE studentcomgpa  set comtestfile='$stdcomtest' where stdID = ".$stdID ;
            $result = $conn->query($sql);
            if($result){
                echo 'complete';
                
            }else{
                echo 'file update Error : '. $sql . "<br>" . $conn->error;
            }
            
        }else {
            echo "wrong upload".$conn->error;
        }
    }       
    $sql = 'UPDATE studentcomgpa SET comtest ="'.$comtest.'" WHERE stdID = '.$stdID ;
    $result = $conn->query($sql);
    if($result){
        echo 'complete';
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        
    }else{
        echo 'no '.$comtest;
    }
}  

// Close the prepared statement.


?>
