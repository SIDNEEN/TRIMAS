    <?php
	header('Content-type: application/json; charset=UTF-8');
	require_once 'conn_mysql.php';
    $response = array();
    $semesterID = $_POST['semesterID'];
    $sql ="DELETE FROM boardright WHERE semesterID = $semesterID";
    if(mysqli_query($conn,$sql)){   //ถ้าลบได้
        if (!empty($_POST['boardID'])) {  //ถ้ามี bordID ส่งมา 
            $boardID =$_POST["boardID"];
            $totalboard = sizeof($boardID);
            $sqlinsert = "";
            for($i=0;$i<$totalboard;$i++) {
                $board = $boardID[$i];
                $sqlinsert .="INSERT INTO boardright (boardID,semesterID) VALUES ($board,$semesterID);";
            }
            if ($conn->multi_query($sqlinsert) === TRUE) { //insert ข้อมูลได้
                $response['title'] = 'เรียบร้อย..';
                $response['status']  = 'success';
                $response['message'] = 'เพิมข้อมูลเรียบร้อย ...';
            } else {
                $response['title'] = 'Oops...';
                $response['status']  = 'error';
                $response['message'] = "Error: " . $sql . "<br>" . $conn->error;
                // echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {  //ถ้าไม่มี bordID ส่งมา  เสร็จการทำงานเลย
            $response['title'] = 'เรียบร้อย..';
			$response['status']  = 'success';
            $response['message'] = 'เพิมข้อมูลเรียบร้อย ...';
        }
    }else {  //ถ้าลบไม่ได้
        $response['title'] = 'Oops...';
        $response['status']  = 'error';
        $response['message'] = "Error: " . $sql . "<br>" . $conn->error;
    }    

    mysqli_close($conn);
    echo json_encode($response);
    
    ?>
