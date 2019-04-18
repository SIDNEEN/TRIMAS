<?php session_start();?>
<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title> Trimas PSU TRANG </title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" href="psuicon.png">
        <!-- Place favicon.ico in the root directory -->
        <link rel="stylesheet" href="css/vendor.css">
        <link rel="stylesheet" href="css/animate.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@7.29.1/dist/sweetalert2.min.css">
        <!-- Theme initialization -->
        <script> var themeSettings =  (localStorage.getItem('themeSettings')) ? JSON.parse(localStorage.getItem('themeSettings')) : {};
			var themeName = themeSettings.themeName || '';

			if (themeName) {
				document.write('<link rel="stylesheet" id="theme-style" href="css/app-' + themeName + '.css">');
			}
			else {
				document.write('<link rel="stylesheet" id="theme-style" href="css/app-blue.css">');
			}
        </script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.29.1/dist/sweetalert2.min.js"></script>
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
                    // echo"rrrrr";
                    echo "<script> \r\n";
                    echo "swal('ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง','กรุณากรอกข้อมูลใหม่อีกครั้ง','error'); \r\n";
                    echo  "</script> ";
                  
                } 
            }
        ?>
        <div class="auth">
            <div class="auth-container">
                <div class="card">
                    <header class="auth-header">
                        <h1 class="auth-title">
                            <div class="logo">
                                <div class="img-col">
                                    <img class="loginlogo" src="assets/psulogo.png" alt="psu brand">
                                </div>
                                <b>ระบบบริหารข้อมูลการฝึกงาน</b>
                            </div>
                        </h1>
                    </header>
                    <div class="auth-content">
                        <!-- <p class="text-center">ระบบบริหารข้อมูลการฝึกงาน</p> -->
                        <form id="login-form" action="" method="POST">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control underlined" name="username" id="username" placeholder="ชื่อผู้ใช้" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control underlined" name="password" id="password" placeholder="รหัสผ่าน" required>
                            </div>
                            <!-- <div class="form-group">
                                <label for="remember">
                                    <input class="checkbox" id="remember" type="checkbox">
                                    <span>Remember me</span>
                                </label>
                                <a href="reset.html" class="forgot-btn pull-right">Forgot password?</a>
                            </div> -->
                            <div class="form-group">
                                <button type="submit" name="submit" class="btn btn-block btn-info">เข้าสู่ระบบ</button>
                            </div>
                            <div class="form-group">
                                <p class="text-muted text-center">ยังไม่ลงทะเบียน? </p>
                                <a href="register.html" type="button" class="btn btn-block btn-success">ลงทะเบียน</a>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- <div class="text-center">
                    <a href="index.html" class="btn btn-secondary btn-sm">
                        <i class="fa fa-arrow-left"></i> Back to dashboard </a>
                </div> -->
            </div>
        </div>
        <!-- Reference block for JS -->
        <div class="ref" id="ref">
            <div class="color-primary"></div>
            <div class="chart">
                <div class="color-primary"></div>
                <div class="color-secondary"></div>
            </div>
        </div>
        <script src="js/vendor.js"></script>
        <script src="js/app.js"></script>
    </body>
</html>