<?php session_start();?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>SB Admin - Start Bootstrap Template</title>
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
  <style>
    body {
    margin: 0;
        /* The image used */
    background-image: url("img/jennifer3.jpg");

    /* Full height */
    height: 100%; 

    /* Center and scale the image nicely */
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    }
    .caption {
    position: absolute;
    top: 45%;
    left: 0;
    width: 100%;
}
  </style>
</head>

<body>
    <?php
    require_once('conn_mysql.php'); // ดึงไฟล์เชื่อมต่อ Database เข้ามาใช้งาน
    /**
     * ตรวจสอบเงื่อนไขที่ว่า ตัวแปร $_POST['submit'] ได้ถูกกำหนดขึ้นมาหรือไม่
     */
    if (isset($_POST['submit'])) { 
        /**
         * กำหนดตัวแปรเพื่อมารับค่า
         */
        $username =  $conn->real_escape_string($_POST['username']);
        $password = $conn->real_escape_string($_POST['password']);
        /**
         * สร้างตัวแปร $sql เพื่อเก็บคำสั่ง Sql
         * จากนั้นให้ใช้คำสั่ง $conn->query($sql) เพื่อที่จะประมาณผลการทำงานของคำสั่ง sql
         */
        $sql = "SELECT * FROM `member` WHERE `username` = '".$username."' AND `password` = '".$password."'";
        $result = $conn->query($sql);

        /**
         * ตรวจสอบการเข้าสู่ระบบ
         */
        if($result->num_rows > 0){
            /**
             * แสดงข้อมูลของ user 
             * เก็บข้อมูลเข้าสู่ session เพื่อนำไปใช้งาน 
             */
            $row = $result->fetch_assoc();
            $_SESSION['userID'] = $row['userID'];

            $query = "SELECT * FROM currentsemester WHERE id = 1";
            $rs = $conn->query($query);
                if($rs->num_rows > 0){
                    $rw = $rs->fetch_assoc();
                    $_SESSION['semesterID'] = $rw['semesterID'];
                    echo $_SESSION['semesterID'];
                }
            if ($row['status']=="admin") {
                header('location:admin-dashboard.php');
            }
            elseif ($row['status']=="board") {
                header('location:board-dashboard.php');
            }
            elseif ($row['status']=="std") {
                header('location:std-profile.php');
            }
            elseif ($row['status']=="staff") {
                header('location:staff-dashboard.php');
            }
            
            
        }else{
          echo 'รหัสผ่านไม่ถูกต้อง';
        } 
    }
?>
    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto mt-5">
                <div class="card">
                    <form action="" method="POST">           
                        <div class="card-header text-center">
                            กรุณาเข้าสู่ระบบ
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="username" class="col-sm-3 col-form-label">ชื่อผู้ใช้งาน</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="username" name="username" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-sm-3 col-form-label">รหัสผ่าน</label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>    
                            </div>
                        </div>
                        <div class="card-footer text-center">
                            <input type="submit" name="submit" class="btn btn-success" value="เข้าสู่ระบบ">
                            <a class="btn btn-primary" href="register.html">ลงทะเบียน</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


  <!-- <div class="col-sm-7 float-left">

    <img src="img/jennifer3.jpg" alt="" class="img-responsive">
    <div class="caption">
      <h1 class="text-center text-blue bg-white">TRIMAS ระบบบริหารข้อมูลนักศึกษาฝึกงาน <br>ICM และ ECM</h1>
    </div>
  </div> -->

  <!-- <form>
    <div class="card card-login col-sm-5 float-right">
      <div class="card-header">Login</div>
      <div class="card-body">

        <img src="img/logo.png" alt="">
        <div class="form-group">
          <label for="exampleInputEmail1">Email address</label>
          <input class="form-control" id="exampleInputEmail1" type="email" aria-describedby="emailHelp" placeholder="Enter email">
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Password</label>
          <input class="form-control" id="exampleInputPassword1" type="password" placeholder="Password">
        </div>
        <div class="form-group">
          <div class="form-check">
            <label class="form-check-label">
              <input class="form-check-input" type="checkbox"> Remember Password</label>
          </div>
        </div>
        <a class="btn btn-primary btn-block" href="indexkk.html">Login</a>




        <br>
        <div class="text-center">
          <h3 class="text-danger">กรณีเป็น</h3>

          <a href="indexkk.html">คณะกรรมการ</a>&nbsp;
          <a href="register.html">นักศึกษา</a>&nbsp;
          <a href="admin.html">Admin</a>&nbsp;
          <a href="indexkk">เจ้าหน้า</a>
        </div>
        <br>
      </div>
      <div class="card-footer">
        sdfsdfdfdf
      </div>
    </div>
  </form> -->

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
</body>

</html>