<?php
    /**
     * เปิดใช้งาน Session
     */
    session_start();
    if ($_SESSION['userID']=="") {
        header("Location: login.php");
    }
    require_once('conn_mysql.php');
    $sql = "SELECT * FROM `board_data` WHERE `userID` = '".$_SESSION['userID']."'";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
      $row = $result->fetch_assoc();
      $boarddID=$row["boardID"];
      $boardName=$row["boardFirstname"].' '.$row["boardLastname"];
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
                                    <span class="name"> <?php echo $boardName;?> </span>
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
                                    <a href="board-dashboard.php">
                                        <i class="fa fa-home"></i> Dashboard </a>
                                </li>
                                <li>
                                    <a href="board-mngdatacomp.php">
                                        <i class="fa fa-database"></i> ฐานข้อมูลสถานประกอบการ </a>
                                </li>
                                <li>
                                    <a href="">
                                        <i class="fa fa-th-large"></i> จัดการข้อมูล <i class="fa arrow"></i>
                                    </a>
                                    <ul class="sidebar-nav">
                                        <li>
                                            <a href="board-mngdatastd.php"> ข้อมูลนักศึกษา </a>
                                        </li>
                                        <li>
                                            <a href="board-boardinfo.php"> ข้อมูลคณะกรรมการ </a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="board-qualify.php">
                                        <i class="fa fa-pencil-square-o"></i> ตรวจสอบคุณสมบัตินักศึกษา </a>
                                </li>
                                <li>
                                    <a href="">
                                        <i class="fa fa-building-o"></i> จัดการสถานประกอบการ <i class="fa arrow"></i>
                                    </a>
                                    <ul class="sidebar-nav">
                                        <li>
                                            <a href="board-compTable.php"> เปิดจองสถานประกอบการ </a>
                                        </li>
                                        <li>
                                            <a href="board-bookingstudent.php"> การจองสถานประกอบการของนักศึกษา </a>
                                        </li>
                                        <li>
                                            <a href="board-compTablecancel.php"> ยกเลิกการจองสถานประกอบการ </a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="board-klankrong-waiting.php">
                                        <i class="fa fa-filter"></i> กลั่นกรองสถานประกอบการ </a>
                                </li>
                                <li>
                                    <a href="board-report.php">
                                        <i class="fa fa-print"></i> ออกรายงานผู้ผ่านการกลั่นกรอง </a>
                                </li>
                                <li class="active">
                                    <a href="board-progress.php">
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
                <article class="content board-qualify-page">
                    <section class="section"> 
                    <div class="breadcrumb">
                        <li class="breadcrumb-item">
                        <a href="board-dashboard.php">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">ความคืบหน้าการส่งเอกสาร</li>
                    </div>
              
                    <div class="card xs-12 mx-auto card-primary">
                        <div class="card-header text-white">
                        <i class="fa fa-table"></i><b> &nbsp;ตารางอัพเดตความคืบหน้าการส่งเอกสาร</b>
                        <span class="form-inline ml-auto">
                        <!-- ภาคการศึกษา
                            <select class="form-control xs-4" id="stdterm">
                            <option>2558/3</option>
                            <option>2559/3</option>
                            <option>2560/3</option>
                            </select> -->
                            สาขาวิชา&emsp;
                            <select class="form-control xs-4" id="stdmajor" onchange="show()">
                                <option value="ICM">ICM</option>
                                <option value="ECM">ECM</option>
                                <option value="all" selected="selected">ทั้งหมด</option>
                            </select>
                        </span>
                        </div>
                        <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm table-hover table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead class="thead-light" >
                                <tr class="text-center text-white">
                                <th>รหัสนักศึกษา</th>
                                <th>ชื่อ</th>
                                <th>สาขา</th>
                                <th>สถานประกอบการ</th>
                                <th>จังหวัด</th>
                                <th>ความคืบหน้า</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                    include('conn_mysql.php');
                                    $sql = "SELECT * FROM stdklankrong LEFT JOIN company on stdklankrong.companyID = company.companyID 
                                            LEFT JOIN student_data ON stdklankrong.stdID=student_data.stdID  
                                            WHERE  stdklankrong.approve='yes' AND student_data.semesterID = $semesterID";
                                    $result=mysqli_query($conn,$sql)or die("Query failed");
                                    if(mysqli_num_rows($result)>0){
                                        while($row=mysqli_fetch_assoc($result)){     
                                            // <td><a href="studentprofile.php?stdNumber='.$stdCode.'">'.$stdCode.' </a></td>                      
                                            echo '<tr class="major'.$row["majorID"].'">
                                            <td class="text-center">'.$row["stdNumber"].'</td>
                                            <td>'.$row["stdFirstname"].'  '.$row["stdLastname"].'</td>';
                                            if ($row["majorID"]==1) {
                                            echo '<td class="text-center">ICM</td>';
                                            }if ($row["majorID"]==2) {
                                            echo '<td class="text-center">ECM</td>';
                                            }
                                            echo '<td>'.$row["companyName"].'</td>';
                                            echo '<td>'.$row["companyChangwat"].'</td>';
                                            if ($row["progress"]=='none') {
                                                echo '<td style="background-color: #2196f3;color:white;" class="text-center" >ยังไม่ส่งหนังสือ';
                                            }elseif($row["progress"]=='send') {
                                                echo '<td style="background-color: #fe974b;color:white;" class="text-center" > รอการตอบรับ';
                                            }elseif($row["progress"]=='accept') {
                                                echo '<td style="background-color: #4bcf99;color:white;" class="text-center"> ตอบรับแล้ว';
                                            }elseif($row["progress"]=='reject') {
                                                echo '<td style="background-color: #FF4444;color:white;" class="text-center"> ตอบปฏิเสธ';
                                            }
                                            echo '</td>';
                                            echo'</tr>';
                                            
                                                
                                        }
                                    }else{
                                        echo"0 results";
                                    }
                                    print"</table>\n";
                                    echo"จำนวนข้อมูลทั้งหมด :",mysqli_num_rows($result),"รายการ<br>";
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
        <script src="js/stdprogress.js"></script>
        <script>
        function show() {
            var major = $('#stdmajor').val();
            console.log(major);
            if (major=="ICM") {
                $('.major2').hide();
                $('.major1').show();
            }if (major=="ECM") {
                $('.major1').hide();
                $('.major2').show();
            } if (major=="all") {
                $('.major1').show();
                $('.major2').show();
            }
        }
        </script>
    </body>
</html>