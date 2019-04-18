<?php
    /**
     * เปิดใช้งาน Session
     */
    session_start();
    if ($_SESSION['userID']=="") {
        header("Location: login.php");
    }
    require_once('conn_mysql.php');
    $sql = "SELECT * FROM `admin-data` WHERE `userID` = '".$_SESSION['userID']."'";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
      $row = $result->fetch_assoc();
      $adminID=$row["adminID"];
      $adminName=$row["adminFirstname"].' '.$row["adminLastname"];
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@7.29.1/dist/sweetalert2.min.css">
    <!-- <link rel="stylesheet" href="https://cdn.rawgit.com/mblode/marx/master/css/marx.min.css"> -->
    <link rel="stylesheet" href="css/parts-selector.css">

    <!-- Theme initialization -->
    <script> var themeSettings = (localStorage.getItem('themeSettings')) ? JSON.parse(localStorage.getItem('themeSettings')) : {};
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
                                                    <span class="accent">d</span> fd: <span class="accent">Fix page
                                                        load performance issue</span>. </p>
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
                            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button"
                                aria-haspopup="true" aria-expanded="false">
                                <div class="img" style="background-image: url('https://avatars3.githubusercontent.com/u/3959008?v=3&s=40')">
                                </div>
                                <span class="name"> <?php echo $adminName;?>  </span>
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
                                <a href="admin-dashboard.php">
                                    <i class="fa fa-home"></i> Dashboard </a>
                            </li>
                            <li class="active">
                                <a href="admin-newtrimas.php">
                                    <i class="fa fa-calendar"></i> เปิดภาคการศึกษาฝึกงาน </a>
                            </li>
                            <li>
                                <a href="admin-mngdatacomp.php">
                                    <i class="fa fa-database"></i> ฐานข้อมูลสถานประกอบการ </a>
                            </li>
                            <li>
                                <a href="">
                                    <i class="fa fa-th-large"></i> จัดการข้อมูล <i class="fa arrow"></i>
                                </a>
                                <ul class="sidebar-nav">
                                    <li>
                                        <a href="admin-mngdatastd.php"> ข้อมูลนักศึกษา </a>
                                    </li>
                                    <li>
                                        <a href="admin-boardinfo.php"> ข้อมูลคณะกรรมการ </a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="admin-qualify.php">
                                    <i class="fa fa-pencil-square-o"></i> ตรวจสอบคุณสมบัตินักศึกษา </a>
                            </li>
                            <li>
                                <a href="">
                                    <i class="fa fa-building-o"></i> จัดการสถานประกอบการ <i class="fa arrow"></i>
                                </a>
                                <ul class="sidebar-nav">
                                    <li>
                                        <a href="admin-compTable.php"> เปิดจองสถานประกอบการ </a>
                                    </li>
                                    <li>
                                        <a href="admin-bookingstudent.php"> การจองสถานประกอบการของนักศึกษา </a>
                                    </li>
                                    <li>
                                        <a href="admin-compTablecancel.php"> ยกเลิกการจองสถานประกอบการ </a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="admin-klankrong-waiting.php">
                                    <i class="fa fa-filter"></i> กลั่นกรองสถานประกอบการ </a>
                            </li>
                            <li>
                                <a href="admin-report.php">
                                    <i class="fa fa-print"></i> ออกรายงานผู้ผ่านการกลั่นกรอง </a>
                            </li>
                            <li>
                                <a href="admin-progress.php">
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
            <article class="content admin-newtrimas-page">
                <section class="section">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="admin-dashboard.php">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">เปิดรอบการเตรียมการฝึกงาน</li>
                    </ol>

                    <div class="text-center">
                        <h3>เปิดรอบการฝึกงาน</h3>
                        <br>
                        <form>
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-2 col-form-label">ปีการศึกษา</label>
                                <div class="col">
                                    <select class="form-control" id="semestar-year">
                                        <option value="2558">2558</option>
                                        <option value="2559">2559</option>
                                        <option value="2560" selected>2560</option>
                                        <option value="2561">2561</option>
                                        <option value="2562">2562</option>
                                        <option value="2563">2563</option>
                                        <option value="2564">2564</option>
                                    </select>
                                </div>
                                <label for="inputPassword" class="col-sm-2 col-form-label">ภาคการศึกษา</label>
                                <div class="col">
                                    <select class="form-control" id="semestar-term">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <button type="button" class="btn btn-success" id="open-semester">เปิด</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col text-center text-primary">
                        <p>ภาคการศึกษาปัจุบัน :
                            <?php
                        require_once 'conn_mysql.php';
                        $sql = "SELECT * FROM `semester` LEFT JOIN currentsemester ON semester.semesterID=currentsemester.semesterID WHERE currentsemester.id=1";
                        $result=mysqli_query($conn,$sql)or die("Query failed");
                        if(mysqli_num_rows($result)>0){
                        while($row=mysqli_fetch_assoc($result)){
                            echo $row["year"].'/'.$row["term"] ;
                            $_SESSION['semesterID'] = $row['semesterID'];
                        }
                        }else{
                        echo"something wrong";
                        }
                        mysqli_free_result($result);
                        mysqli_close($conn);
                        ?>
                        </p>
                        <?php
                        
                            $semester = $_SESSION['semesterID'];
                                // echo $semester;
                        ?>
                    </div>
                    <!--  -->
                    <div class="card xs-12 mx-auto card-primary">
                        <div class="card-header text-white">
                            <i class="fa fa-table"></i> &emsp;เลือกคณะกรรมการฝึกงานของปีการศึกษานี้
                        </div>
                        <div class="card-body">
                            <div class="parts-selector" id="parts-selector-1">
                                <div class="parts list">
                                    <h3 class="list-heading">รายชื่ออาจารย์ไม่ได้รับสิทธิ์</h3>
                                    <ul>
                                        <?php
                                include('conn_mysql.php');
                                $sql = "SELECT * FROM board_data WHERE boardID NOT IN (SELECT boardID FROM boardright WHERE semesterID = $semester) ";
                                $result= mysqli_query($conn,$sql) or die("Query failed");
                                if(mysqli_num_rows($result)>0){
                                    while($row=mysqli_fetch_assoc($result)){     
                                        echo '<li id="'.$row['boardID'].'">';
                                        echo $row['boardFirstname'].' &nbsp   '.$row['boardLastname'];
                                        echo  '</li>';
                                    }
                                }
                                // else{
                                //   echo"ไม่มีข้อมูล";
                                // }
                                mysqli_free_result($result);
                                mysqli_close($conn);
                                ?>
                                    </ul>
                                </div>
                                <div class="controls">
                                    <a class="moveto selected"><span class="icon"></span><span class="text">Add</span></a>
                                    <a class="moveto parts"><span class="icon"></span><span class="text">Remove</span></a>
                                </div>
                                <div class="selected list">
                                    <h3 class="list-heading">รายชื่ออาจารย์ที่เลือก</h3>
                                    <ul>
                                        <!-- SELECT * FROM boardright,board_data WHERE boardright.boardID=board_data.boardID AND boardright.semesterID=10 -->
                                        <?php
                                include('conn_mysql.php');
                                $sql = "SELECT * FROM boardright,board_data WHERE boardright.boardID=board_data.boardID AND boardright.semesterID= $semester";
                                $result= mysqli_query($conn,$sql) or die("Query failed");
                                if(mysqli_num_rows($result)>0){
                                    while($row=mysqli_fetch_assoc($result)){     
                                        echo '<li id="'.$row['boardID'].'">';
                                        echo $row['boardFirstname'].' &nbsp   '.$row['boardLastname'];
                                        echo  '</li>';
                                    }
                                }
                                mysqli_free_result($result);
                                mysqli_close($conn);
                                ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="button" class="btn btn-success" data-semesterid="<?php echo $semester;?>"
                                    id="save-board">บันทึก</button>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.29.1/dist/sweetalert2.min.js"></script>
    <script src="js/admin.js"></script>
    <script src="js/parts-selector.js"></script>
    <script>
      $(function () {
        $("#parts-selector-1").partsSelector();
      });
    </script>
</body>

</html>