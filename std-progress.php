<?php
    /**
     * เปิดใช้งาน Session
     */
    session_start();
    if ($_SESSION['userID']=="") {
        header("Location: login.php");
    }
    require_once('conn_mysql.php');
    $sql = "SELECT * FROM `student_data` WHERE `userID` = '".$_SESSION['userID']."'";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
      $row = $result->fetch_assoc();
      $stdID=$row["stdID"];
      $stdphoto=$row['stdPhoto'];
    }
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
                                    <div class="img" style="background-image: url('img/<?php echo $row['stdPhoto'];?>')">
                                    </div>
                                    <span class="name"><?php echo $row['stdFirstname'].' '.$row['stdLastname'];?></span>
                                </a>
                                <div class="dropdown-menu profile-dropdown-menu" aria-labelledby="dropdownMenu1">
                                    <a class="dropdown-item" href="std-profile.php">
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
                                    <a href="std-profile.php">
                                        <i class="fa fa-user"></i> Profile </a>
                                </li>
                                <li>
                                    <a href="">
                                        <i class="fa fa-building-o"></i> สถานประกอบการ <i class="fa arrow"></i>
                                    </a>
                                    <ul class="sidebar-nav">
                                        <li>
                                            <a href="std-compforstd.php"> จองสถานประกอบการ </a>
                                        </li>
                                        <li>
                                            <a href="std-ownComp.php"> สถานประกอบการที่หาเอง </a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="std-checkklankrong.php">
                                        <i class="fa fa-pencil-square-o"></i> กลั่นกรองสถานประกอบการ </a>
                                </li>
                                <li class="active">
                                    <a href="std-progress.php">
                                        <i class="fa fa-check"></i> การตอบรับสถานประกอบการ </a>
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
                <article class="content std-progress-page">
                    <section class="section">
                        <div class="card card-primary">
                            <div class="card-header">
                                <div class="header-block text-white">
                                    ติดตามความคืบหน้าของการส่งหนังสือขอความอนุเคราะห์
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="progress"style="height: 50px;">
                                <?php
                                // echo $stdID  ;
                                    include('conn_mysql.php');
                                    $sql = "SELECT progress FROM stdklankrong WHERE approve = 'yes' AND stdID = $stdID " ;
                                    $result = $conn->query($sql);
                                    $cardfootertext='';
                                    if($result->num_rows > 0){
                                        $row = $result->fetch_assoc();
                                        if ($row['progress']=='none') {
                                            $cardfootertext='<b class="text-info">รอการส่งหนังสือไปยังสถานประกอบการ</b>';
                                            echo '<div class="progress-bar bg-primary progress-bar-striped progress-bar-animated" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">รอการส่งหนังสือไปยังสถานประกอบการ</div>';
                                        }elseif ($row['progress']=='send') {
                                            $cardfootertext='<b class="text-info">ส่งหนังสือไปยังสถานประกอบการแล้ว รอการตอบรับจากสถานประกอบการ</b>';
                                            echo '<div class="progress-bar bg-success progress-bar-striped progress-bar-animated" role="progressbar" style="width: 33%" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100">ส่งหนังสือไปยังสถานประกอบการแล้ว</div>';
                                            echo '<div class="progress-bar bg-success progress-bar-striped progress-bar-animated" role="progressbar" style="width: 33%" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100">รอการตอบรับจากสถานประกอบการ</div>';
                                        }elseif ($row['progress']=='accept') {
                                            $cardfootertext='<b class="text-success">สถานประกอบการตอบรับแล้ว</b>';
                                            echo '<div class="progress-bar bg-success progress-bar-striped progress-bar-animated" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">ส่งหนังสือไปยังสถานประกอบการแล้ว</div>';
                                            echo '<div class="progress-bar bg-success progress-bar-striped progress-bar-animated" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">สถานประกอบการตอบรับแล้ว</div>';
                                        }elseif ($row['progress']=='reject') {
                                            $cardfootertext='<b class="text-danger">สถานประกอบการตอบปฏิเสธ กรุณาติดต่ออาจารย์ที่เกี่ยวข้อง หรือ ยกเลิกการจองเพื่อจองสถานประกอบการอื่น</b>';
                                            echo '<div class="progress-bar bg-danger progress-bar-striped progress-bar-animated" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">ส่งหนังสือไปยังสถานประกอบการแล้ว</div>';
                                            echo '<div class="progress-bar bg-danger progress-bar-striped progress-bar-animated" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">!!! สถานประกอบการตอบปฏิเสธ กรุณาติดต่ออาจารย์ที่เกี่ยวข้อง</div>';
                                        }
                                        
                                        
                                    }else {
                                        $cardfootertext='<b class="text-danger">การกลั่นกรองยังไม่ถูกอนุมัติ หรือยังไม่ส่งกลั่นกรอง กรุณาดำเนินการให้เรียบก่อน ถึงจะออกหนังสือได้</b>';
                                        echo '<div class="progress-bar bg-danger progress-bar-striped progress-bar-animated" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100">การกลั่นกรองยังไม่ถูกอนุมัติ หรือยังไม่ส่งกลั่นกรอง</div>';
                                    }
                                ?>
                                    <!-- <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 15%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 15%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                    <div class="progress-bar bg-success progress-bar-striped progress-bar-animated" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                                    <div class="progress-bar bg-info progress-bar-striped progress-bar-animated" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                    <div class="progress-bar bg-info progress-bar-striped progress-bar-animated" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div> -->
                                </div>
                            </div>
                            <div class="card-footer">
                                <?php
                                    echo $cardfootertext;
                                ?>
                            </div>
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
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.Logout Modal-->
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
    </body>
</html>