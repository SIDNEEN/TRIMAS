    <?php
	header('Content-type: application/json; charset=UTF-8');
	require_once 'conn_mysql.php';
    $response = array();
    
    $year =$_POST["year"];
    $term= $_POST["term"];
    $sql ="INSERT INTO semester (year,term,dateOpen) values('$year','$term',now())";
    if(mysqli_query($conn,$sql)){
        $last_id = mysqli_insert_id($conn);
        $sql =" UPDATE currentsemester SET semesterID = $last_id WHERE id=1";
        if(mysqli_query($conn,$sql)){
            $response['status']  = 'success';
            $response['message'] = 'เพิ่มสถานประการเรียบร้อย ...';
        }else{
            $response['status']  = 'error';
            $response['message'] = 'Unable to insert data ...';
        }
    }else {
        $response['status']  = 'error';
        $response['message'] = 'Unable to insert data ...';
    }
    mysqli_close($conn);
    echo json_encode($response);
    
    ?>
