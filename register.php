<?php  
include('conn_mysql.php');
$username =$_POST["username"];
$firstName= $_POST["firstName"];
$lastName= $_POST["lastName"];
$password= sha1($_POST["password"]);
$status = $_POST["status"];

$sqlCheckMember = "SELECT * FROM member WHERE username ='$username'";
$result = $conn->query($sqlCheckMember);
if($result->num_rows > 0){
    echo "<script> \r\n";
    echo "alert('มีชื่อผู้ใช้นี้เเล้ว'); \r\n";
    echo  "</script> ";
    header('Refresh:0; url=register.html');
}else {
    $sql ="INSERT INTO member (username,password,status) values('$username','$password','$status')";
    if(mysqli_query($conn,$sql)){
        $userid = mysqli_insert_id($conn);
        // echo "insert to data member complete<br><br>";

        if($status=="std"){
            $major= $_POST["major"];
            $email= $_POST["email"];
            $phone= $_POST["phone"];
            $facebook= $_POST["facebook"];
            $sql1 ="INSERT INTO student_data (userID,stdNumber,stdFirstname,stdLastname,stdEmail,stdPhone,stdFacebook,majorID,semesterID,stdRegisdate) 
                    values($userid,'$username','$firstName','$lastName','$email','$phone','$facebook','$major',(SELECT semesterID FROM currentsemester WHERE id=1 ),now())";      
            if (mysqli_query($conn,$sql1)){
                $stdid = mysqli_insert_id($conn);
                // echo "insert data to  std complete";
                $sql2 ="INSERT INTO studentcomgpa (stdID) 
                        values($stdid)";
                mysqli_query($conn,$sql2);
                echo '<script> alert("สมัครสมาชิกสำเร็จ")</script>';
                header('Refresh:0; url=login.php');
            }else{
                echo "someting wrong in NSERT INTO student_data";
                echo mysqli_error($conn);
            }
                    
            
        }
        elseif ($status=="board") {
            $sql1 ="INSERT INTO board_data (userID,boardFirstname,boardLastname,boardRegisdate) 
                    values($userid,'$firstName','$lastName',now())";
            mysqli_query($conn,$sql1);
            // echo "insert data to kk complete";
            echo '<script> alert("เพิ่มข้อมูลกรรมการแล้ว")</script>';
            header('Refresh:0; url=login.php');
            
        }
    }else{
        echo "$sql<br>";
        echo "Error insert record :" .mysqli_error($conn);
    }
}


mysqli_close($conn);

?>