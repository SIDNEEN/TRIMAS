<?php
    /**
     * เปิดใช้งาน Session
     */
    session_start();
    if ($_SESSION['userID']=="") {
        header("Location: login.php");
    }
    require_once('conn_mysql.php');
    $sql = "SELECT * FROM `staff-data` WHERE `userID` = '".$_SESSION['userID']."'";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
      $row = $result->fetch_assoc();
      $staffID=$row["staffID"];
      $staffName=$row["staffFirstname"].' '.$row["staffLastname"];
    }
    $semesterID = $_SESSION['semesterID'];
?>
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
        <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
        <!-- Theme initialization -->
        <script> var themeSettings =  (localStorage.getItem('themeSettings')) ? JSON.parse(localStorage.getItem('themeSettings')) : {};
			var themeName = themeSettings.themeName || '';

			if (themeName) {
				document.write('<link rel="stylesheet" id="theme-style" href="css/app-' + themeName + '.css">');
			}
			else {
				document.write('<link rel="stylesheet" id="theme-style" href="css/app.css">');
			}
		</script>
    </head>
    <body>
        <div class="main-wrapper">
            <div class="app" id="app">
                <header class="header">
                    <div class="header-block header-block-collapse d-lg-none d-xl-none">
                        <button class="collapse-btn" id="sidebar-collapse-btn">
                            <i class="fa fa-bars"></i>
                        </button>
                    </div>
                    <div class="header-block header-block-title">
                        <h4><b>ระบบบริหารข้อมูลการฝึกงาน</b></h4>
                    </div>
                    <div class="header-block header-block-nav">
                        <ul class="nav-profile">
                            <li class="notifications new">
                                <a href="" data-toggle="dropdown">
                                    <i class="fa fa-bell-o"></i>
                                    <sup>
                                        <span class="counter">8</span>
                                    </sup>
                                </a>
                                <div class="dropdown-menu notifications-dropdown-menu">
                                    <ul class="notifications-container">
                                        <li>
                                            <a href="" class="notification-item">
                                                <div class="img-col">
                                                    <div class="img" style="background-image: url('assets/faces/3.jpg')"></div>
                                                </div>
                                                <div class="body-col">
                                                    <p>
                                                        <span class="accent">d</span> fd: <span class="accent">Fix page load performance issue</span>. </p>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                    <footer>
                                        <ul>
                                            <li>
                                                <a href=""> View All </a>
                                            </li>
                                        </ul>
                                    </footer>
                                </div>
                            </li>
                            <li class="profile dropdown">
                                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                    <div class="img" style="background-image: url('https://avatars3.githubusercontent.com/u/3959008?v=3&s=40')">
                                    </div>
                                    <span class="name"> <?php echo $staffName;?> </span>
                                </a>
                                <div class="dropdown-menu profile-dropdown-menu" aria-labelledby="dropdownMenu1">
                                    <a class="dropdown-item" href="#">
                                        <i class="fa fa-user icon"></i> Profile </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                        <i class="fa fa-power-off icon"></i> Logout </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </header>
                <aside class="sidebar">
                    <div class="sidebar-container">
                        <div class="sidebar-header">
                            <div class="brand">
                                <div class="logo">
                                    <div class="img-col">
                                        <img src="assets/psu-01.png" alt="psu brand">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <nav class="menu">
                            <ul class="sidebar-menu metismenu" id="sidebar-menu">
                                <li>
                                    <a href="staff-dashboard.php">
                                        <i class="fa fa-home"></i> Dashboard </a>
                                </li>
                                <li>
                                    <a href="staff-mngdatacomp.php">
                                        <i class="fa fa-database"></i> ฐานข้อมูลสถานประกอบการ </a>
                                </li>
                                <li>
                                    <a href="">
                                        <i class="fa fa-th-large"></i> จัดการข้อมูล <i class="fa arrow"></i>
                                    </a>
                                    <ul class="sidebar-nav">
                                        <li>
                                            <a href="staff-mngdatastd.php"> ข้อมูลนักศึกษา </a>
                                        </li>
                                        <li>
                                            <a href="staff-boardinfo.php"> ข้อมูลคณะกรรมการ </a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="staff-qualify.php">
                                        <i class="fa fa-pencil-square-o"></i> ตรวจสอบคุณสมบัตินักศึกษา </a>
                                </li>
                                <li class="active open">
                                    <a href="">
                                        <i class="fa fa-building-o"></i> จัดการสถานประกอบการ <i class="fa arrow"></i>
                                    </a>
                                    <ul class="sidebar-nav">
                                        <li>
                                            <a href="staff-compTable.php"> เปิดจองสถานประกอบการ </a>
                                        </li>
                                        <li class="active">
                                            <a href="staff-bookingstudent.php"> การจองสถานประกอบการของนักศึกษา </a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="staff-klankrong-waiting.php">
                                        <i class="fa fa-filter"></i> กลั่นกรองสถานประกอบการ </a>
                                </li>
                                <li>
                                    <a href="staff-report.php">
                                        <i class="fa fa-print"></i> ออกรายงานผู้ผ่านการกลั่นกรอง </a>
                                </li>
                                <li>
                                    <a href="staff-progress.php">
                                        <i class="fa fa-tasks"></i> ความคืบหน้าการส่งเอกสาร </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <footer class="sidebar-footer">
                        <ul class="sidebar-menu metismenu" id="customize-menu">
                            <li>
                                <ul>
                                    <li class="customize">
                                        <div class="customize-item">
                                            <div class="row customize-header">
                                                <div class="col-4">
                                                </div>
                                                <div class="col-4">
                                                    <label class="title">fixed</label>
                                                </div>
                                                <div class="col-4">
                                                    <label class="title">static</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-4">
                                                    <label class="title">Sidebar:</label>
                                                </div>
                                                <div class="col-4">
                                                    <label>
                                                        <input class="radio" type="radio" name="sidebarPosition" value="sidebar-fixed">
                                                        <span></span>
                                                    </label>
                                                </div>
                                                <div class="col-4">
                                                    <label>
                                                        <input class="radio" type="radio" name="sidebarPosition" value="">
                                                        <span></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-4">
                                                    <label class="title">Header:</label>
                                                </div>
                                                <div class="col-4">
                                                    <label>
                                                        <input class="radio" type="radio" name="headerPosition" value="header-fixed">
                                                        <span></span>
                                                    </label>
                                                </div>
                                                <div class="col-4">
                                                    <label>
                                                        <input class="radio" type="radio" name="headerPosition" value="">
                                                        <span></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-4">
                                                    <label class="title">Footer:</label>
                                                </div>
                                                <div class="col-4">
                                                    <label>
                                                        <input class="radio" type="radio" name="footerPosition" value="footer-fixed">
                                                        <span></span>
                                                    </label>
                                                </div>
                                                <div class="col-4">
                                                    <label>
                                                        <input class="radio" type="radio" name="footerPosition" value="">
                                                        <span></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="customize-item">
                                            <ul class="customize-colors">
                                                <li>
                                                    <span class="color-item color-red" data-theme="red"></span>
                                                </li>
                                                <li>
                                                    <span class="color-item color-orange" data-theme="orange"></span>
                                                </li>
                                                <li>
                                                    <span class="color-item color-green active" data-theme=""></span>
                                                </li>
                                                <li>
                                                    <span class="color-item color-seagreen" data-theme="seagreen"></span>
                                                </li>
                                                <li>
                                                    <span class="color-item color-blue" data-theme="blue"></span>
                                                </li>
                                                <li>
                                                    <span class="color-item color-purple" data-theme="purple"></span>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                                <a href="">
                                    <i class="fa fa-cog"></i> Customize </a>
                            </li>
                        </ul>
                    </footer>
                </aside>
                <div class="sidebar-overlay" id="sidebar-overlay"></div>
                <div class="sidebar-mobile-menu-handle" id="sidebar-mobile-menu-handle"></div>
                <div class="mobile-menu-handle"></div>
                <article class="content staff-bookingstudent-page">
                    <section class="section"> 
                        <!-- Breadcrumbs-->
                        <div class="breadcrumb">
                            <li class="breadcrumb-item">
                            <a href="#">สถานประกอบการ</a>
                            </li>
                            <li class="breadcrumb-item active">ข้อมูลการจองสถานประกอบการของนักศึกษา</li>
                        </div>
                        <!-- Icon Cards-->

                        <!-- Area Chart Example-->
                        <div class="card xs-12 mx-auto">
                            <div class="header-block" style="margin:15px 30px">
                                
                                <form>
                                    <div class="form-group row">
                                        <div class="col-sm-6 form-inline">
                                            <label for="inputPassword" class="col-form-label col-4">ภาคการศึกษา</label>
                                            <select class="form-control   col-6" id="stdterm" onchange="show()">
                                                <?php
                                                    include('conn_mysql.php');
                                                    $sql="SELECT*FROM semester";
                                                    $result=mysqli_query($conn,$sql)or die("Query failed");
                                                    if(mysqli_num_rows($result)>0){
                                                        while($row=mysqli_fetch_assoc($result)){
                                                            echo '<option value="'.$row["semesterID"].'"' ;
                                                            if ($row["semesterID"]==$semesterID) {
                                                                echo 'selected="selected"';
                                                            }
                                                            echo '>'.$row["year"].'/'.$row["term"].'</option>';
                                                        }
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <label for="inputPassword" class="col-sm-2 col-form-label text-right">สาขาวิชา</label>
                                        <div class="col-sm-4">
                                            <select class="form-control" id="stdmajor" onchange="show()">
                                                <option value="ICM">ICM</option>
                                                <option value="ECM">ECM</option>
                                                <option value="all" selected="selected">ทั้งหมด</option>
                                            </select>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>รหัสนักศึกษา</th>
                                                <th>ชื่อ-สกุล</th>
                                                <th>สาขาวิชา</th>
                                                <th>สถานประกอบการที่จอง</th>
                                                <th>จังหวัด</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>รหัสนักศึกษา</th>
                                                <th>ชื่อ-สกุล</th>
                                                <th>สาขาวิชา</th>
                                                <th>สถานประกอบการที่จอง</th>
                                                <th>จังหวัด</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                        
                                        <?php
                                            require_once('conn_mysql.php');
                                            $sql = "SELECT stdNumber,stdFirstname,stdLastname,student_data.majorID,companyName,companyChangwat,major,majorName,student_data.semesterID FROM student_data LEFT JOIN booked ON student_data.stdID = booked.stdID LEFT JOIN company ON company.companyID = booked.companyID   LEFT JOIN major ON student_data.majorID=major.majorID";
                                            $result=mysqli_query($conn,$sql)or die("Query failed");
                                            if(mysqli_num_rows($result)>0){
                                                while($row=mysqli_fetch_assoc($result)){
                                                    echo '<tr class="major'.$row["majorID"].' sms'.$row["semesterID"].'">';
                                                    echo"<td>".$row["stdNumber"]."</td>";
                                                    echo"<td>".$row["stdFirstname"]." ".$row["stdLastname"]."</td>";
                                                    echo"<td>".$row["majorName"]."</td>";
                                                    if ($row["companyName"]==null) {
                                                        $companyName="ไม่มีข้อมูล";
                                                    }else {
                                                        $companyName=$row["companyName"];
                                                    }
                                                    echo"<td>".$companyName."</td>";
                                                    if ($row["companyChangwat"]==null) {
                                                        $companyChangwat="ไม่มีข้อมูล";
                                                    }else {
                                                        $companyChangwat=$row["companyChangwat"];
                                                    }
                                                    echo"<td>".$companyChangwat."</td>";
                                                    print"\t</tr>";

                                                }
                                            }else{
                                                echo"0 results";
                                            }
                                            print"</table>";
                                            echo"จำนวนข้อมูลทั้งหมด :".mysqli_num_rows($result)."รายการ<br>";
                                            mysqli_free_result($result);
                                            mysqli_close($conn);
                                        ?>
                                        
                                        
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
                        </div>
                    </section>
                </article>
                <footer class="footer">
                    <div class="footer-block buttons">
                        <div class="footer-copyright"> Copyright <i class="fa fa-copyright"></i> ICM PROJECT PSU TRANG 2018 </div>
                    </div>
                    <div class="footer-block author">
                        <ul>
                            <li> created by <a href="https://www.facebook.com/kode.namzz" target="_blank"><em class="fa fa-facebook-square"></em>&nbsp;kode_namzz</a>
                            </li>
                            <li>
                                <a href="https://www.facebook.com/profile.php?id=100006953267476" target="_blank"><em class="fa fa-facebook-square"></em>&nbsp;ameera</a>
                            </li>
                            <li>
                                <a href="https://www.facebook.com/supattra.sulakakorn" target="_blank"><em class="fa fa-facebook-square"></em>&nbsp;supattra</a>
                            </li>
                        </ul>
                    </div>
                </footer>
                <!-- Logout Modal-->
                <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="logoutModalLabel">Ready to Leave?</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                            <a class="btn btn-primary" href="logout.php">Logout</a>
                        </div>
                        </div>
                    </div>
                </div>
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
        <script src="js/application.js"></script>
        <script src="vendor/datatables/jquery.dataTables.js"></script>
        <script src="vendor/datatables/dataTables.bootstrap4.js"></script>
        <script src="js/datatables.js"></script>
        <script>
            // $( "buttons" ).removeClass( "btn-secondary" ).addClass( "btn-primary" );
            function show() {
                var semester = $('#stdterm').val();
                var major = $('#stdmajor').val();
                console.log(semester);
                console.log(major);
                <?php
                    include('conn_mysql.php');
                    $sql="SELECT*FROM semester";
                    $result=mysqli_query($conn,$sql)or die("Query failed");
                    if(mysqli_num_rows($result)>0){
                        while($row=mysqli_fetch_assoc($result)){
                            $nowsms=$row["semesterID"];
                            echo "if (semester=='".$row['semesterID']."'&& major=='ICM'){\r\n";
                            $sql2="SELECT*FROM semester";
                            $result2=mysqli_query($conn,$sql2)or die("Query failed");
                            if(mysqli_num_rows($result2)>0){
                                while($row2=mysqli_fetch_assoc($result2)){
                                    if($row2["semesterID"]==$nowsms){
                                        echo "$('.sms".$row2["semesterID"].", .major1').show();\r\n";
                                    }else{
                                        echo "$('.sms".$row2["semesterID"].",.major2').hide();\r\n";
                                    }
                                }
                            }
                            echo '}';
                            echo "if (semester=='".$row['semesterID']."'&& major=='ECM'){\r\n";
                                $sql2="SELECT*FROM semester";
                                $result2=mysqli_query($conn,$sql2)or die("Query failed");
                                if(mysqli_num_rows($result2)>0){
                                    while($row2=mysqli_fetch_assoc($result2)){
                                        if($row2["semesterID"]==$nowsms){
                                            echo "$('.sms".$row2["semesterID"].", .major2').show();\r\n";
                                        }else{
                                            echo "$('.sms".$row2["semesterID"].",.major1').hide();\r\n";
                                        }
                                    }
                                }
                            echo '}'; 
                            echo "if (semester=='".$row['semesterID']."'&& major=='all'){\r\n";
                                $sql2="SELECT*FROM semester";
                                $result2=mysqli_query($conn,$sql2)or die("Query failed");
                                if(mysqli_num_rows($result2)>0){
                                    while($row2=mysqli_fetch_assoc($result2)){
                                        if($row2["semesterID"]==$nowsms){
                                            echo "$('.sms".$row2["semesterID"].", .major2,.major1').show();\r\n";
                                        }else{
                                            echo "$('.sms".$row2["semesterID"]."').hide();\r\n";
                                        }
                                    }
                                }
                            echo '}';               
                        }
                    }
                    
                ?>

            }
        </script>
    </body>
</html>