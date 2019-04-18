
<?php
header("content-type:text/javascript;charset=utf-8");
$smesterID=$_POST['smesterID']; 
$majorID=$_POST['majorID'];
if ($majorID=='all') {
    $major = '';
    $student_datamajor ='';
}else {
    $major =' AND majorID ='.$majorID;
    $student_datamajor =' AND student_data.majorID ='.$majorID;
} 
// echo  $student_datamajor;

include('conn_mysql.php');
$sql="SELECT COUNT(*) AS totalwaiting FROM `stdklankrong` WHERE  approve = 'waiting' AND semesterID=$smesterID $major";
$result=mysqli_query($conn,$sql)or die(mysqli_error($conn));
    if(mysqli_num_rows($result)>0){
        while($row=mysqli_fetch_assoc($result)){
            $totalwaiting=$row["totalwaiting"];
        }
    }else {
        $totalwaiting=0;
    }
$sql="SELECT COUNT(*) AS notpass FROM `stdklankrong` WHERE  approve = 'no' AND semesterID=$smesterID $major";
$result=mysqli_query($conn,$sql)or die(mysqli_error($conn));
    if(mysqli_num_rows($result)>0){
        while($row=mysqli_fetch_assoc($result)){
            $notpass=$row["notpass"];
        }
    }else {
        $notpass=0;
    }
$sql="SELECT COUNT(*) AS kkyes FROM `stdklankrong` WHERE  approve = 'yes' AND semesterID=$smesterID  $major";
$result=mysqli_query($conn,$sql)or die(mysqli_error($conn));
    if(mysqli_num_rows($result)>0){
        while($row=mysqli_fetch_assoc($result)){
            $kkyes=$row["kkyes"];
        }
    }else {
        $kkyes=0;
    }    
$sql="SELECT COUNT(*) AS comgpanone FROM studentcomgpa LEFT JOIN student_data ON studentcomgpa.stdID = student_data.stdID WHERE  studentcomgpa.result='none' AND student_data.semesterID=$smesterID".$student_datamajor;
$result=mysqli_query($conn,$sql)or die(mysqli_error($conn));
    if(mysqli_num_rows($result)>0){
        while($row=mysqli_fetch_assoc($result)){
            $comgpanone=$row["comgpanone"];
        }
    }else {
        $comgpanone=0;
    } 
$sql="SELECT COUNT(*) AS comgpapass FROM studentcomgpa LEFT JOIN student_data ON studentcomgpa.stdID = student_data.stdID WHERE  studentcomgpa.result='pass' AND student_data.semesterID=$smesterID".$student_datamajor;
$result=mysqli_query($conn,$sql)or die(mysqli_error($conn));
    if(mysqli_num_rows($result)>0){
        while($row=mysqli_fetch_assoc($result)){
            $comgpapass=$row["comgpapass"];
        }
    }else {
        $comgpapass=0;
    } 
$sql="SELECT COUNT(*) AS wassend FROM `stdklankrong` WHERE  progress = 'send' AND semesterID=$smesterID  $major";
$result=mysqli_query($conn,$sql)or die(mysqli_error($conn));
    if(mysqli_num_rows($result)>0){
        while($row=mysqli_fetch_assoc($result)){
            $send=$row["wassend"];
        }
    }else {
        $send=0;
    }
$sql="SELECT COUNT(*) AS accept FROM `stdklankrong` WHERE  progress = 'accept' AND semesterID=$smesterID $major";
$result=mysqli_query($conn,$sql)or die(mysqli_error($conn));
    if(mysqli_num_rows($result)>0){
        while($row=mysqli_fetch_assoc($result)){
            $accept=$row["accept"];
        }
    }else {
        $accept=0;
    }
    $sql="SELECT COUNT(*) AS reject  FROM `stdklankrong` WHERE  progress = 'reject' AND semesterID=$smesterID $major";
    $result=mysqli_query($conn,$sql)or die(mysqli_error($conn));
    if(mysqli_num_rows($result)>0){
        while($row=mysqli_fetch_assoc($result)){
            $reject = $row["reject"];
        }
    }else {
        $reject=0;
    }       
echo  '['.$totalwaiting.','.$notpass.','.$kkyes.','.$comgpanone.','.$comgpapass.','.$send.','.$reject.','.$accept.']';

?>