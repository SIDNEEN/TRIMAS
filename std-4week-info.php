<?php
session_start();
if ($_SESSION['userID']=="") {
    header("Location: login.php");
}
include('conn_mysql.php');

$sql = "SELECT * FROM student_data,major  WHERE userID = ".$_SESSION['userID']." AND student_data.majorID = major.majorID";
        $result = $conn->query($sql);
        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            $stdID=$row['stdID'];
            $stdphoto=$row['stdPhoto'];
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
        <style>
            .content-klankrong {
                overflow-x: hidden;
                background: white;
                min-height: calc(100vh - 56px);
                padding-top: 1rem;
            }
            footer.klankrong-footer {
                position: absolute;
                right: 0;
                bottom: 0;
                width: 100%;
                height: 56px;
                background-color: #e9ecef;
                line-height: 55px;
            }
            nav a{
                color:white;
            }
            .topic{
                background-color: #707070;
                color: white;
                padding: 10px;
                font-weight: bold;
            }
            table tbody th{
                text-align: right;
            }
            table td, table th{
                padding-top:3px !important;
                padding-bottom :3px !important;
                font-size : 15px !important;
            }
            td{
                padding-left: 20px !important;
            }

        </style>
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
                                    <a href="">
                                        <i class="fa fa-address-card"></i> ก่อนฝึกงาน <i class="fa arrow"></i>
                                    </a>
                                    <ul class="sidebar-nav">
                                    <li >
                                    <a href="std-profile.php">
                                        <i class="fa fa-user active"></i> Profile </a>
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
                                    <li>
                                    <a href="std-checkklankrong.php">
                                        <i class="fa fa-pencil-square-o"></i> กลั่นกรองสถานประกอบการ </a>
                                </li>
                                <li>
                                    <a href="std-progress.php">
                                        <i class="fa fa-check"></i> การตอบรับสถานประกอบการ </a>
                                </li>
                                </li>
                                    </ul>
                                </li>
                                <li class="active open">
                                    <a href="">
                                        <i class="fa fa-share-square-o"></i> ระหว่างฝึกงาน <i class="fa arrow"></i>
                                    </a>
                                    <ul class="sidebar-nav">
                                    <li>
                                    <a href="std-address.php">
                                        <i class="fa fa-map-marker"></i> ข้อมูลที่พักของนักศึกษา </a>
                                </li>
                                <li class="active">
                                    <a href="std-4week.php">
                                        <i class="fa fa-newspaper-o"></i> ข้อมูล4สัปดาห์เเรก </a>
                                </li>
                            </ul>
                            <li>
                                    <a href="">
                                        <i class="fa fa-tasks"></i> หลังฝึกงาน <i class="fa arrow"></i>
                                    </a>
                                    <ul class="sidebar-nav">
                                    <li class="active">
                                    <a href="std-pramern.php">
                                     <i class="fa fa-dot-circle-o"></i> เเบบประเมินการฝึกงาน</a>
                                </li>
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
                <article class="content std-klankrong-info-page">
                    <section class="section">
                         <!-- Breadcrumbs-->

                        <h3 class="text-center">เเบบสรุปข้อมูล 4 สัปดาห์เเรก </h3><br>
                       
                        <div class="detail row">
                            <div class="col-lg-12 fist-student">
                                <div class="topic">ข้อมูลนักศึกษา</div>
                                <table class="table">
                                    <tbody>
                                    <tr>
                                        <th scope="row" style="width:50%">รหัสนักศึกษา :</th>
                                        <td><?php echo $row['stdNumber'];?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">ชื่อ-สกุล :</th>
                                        <td><?php echo $row['stdFirstname'].'  '.$row['stdLastname'];?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">เบอร์โทร :</th>
                                        <td><?php echo $row['stdPhone'];?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">E-mail Address :</th>
                                        <td><?php echo $row['stdEmail'];?></td>
                                    </tr>
                                    </tbody>
                                </table>
                                    <?php
                                        $sql = "SELECT * FROM company,stdklankrong WHERE company.companyID = stdklankrong.companyID  and stdklankrong.stdID = $stdID ORDER BY klankrongID DESC" ;
                                        $result = $conn->query($sql);
                                        if($result->num_rows > 0){
                                            $row2 = $result->fetch_assoc(); 
                                            $companyid = $row2['companyID'];
                                    ?>                          
                                <div class="topic">ข้อมูลสถานประกอบการ</div>
                                <div class="detail">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <th scope="row" style="width:50%">ชื่อสถานประกอบการ :</th>
                                                <td><?php echo $row2['companyName'];?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">ชื่อผู้บริหาร :</th>
                                                <td><?php echo $row2['bossname'];?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">ตำแหน่ง :</th>
                                                <td><?php echo $row2['position'];?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">ลักษณะการประกอบการขององค์กร:</th>
                                                <td><?php echo $row2['description'];?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">ที่อยู่ :</th>
                                                <td>เลขที่ <?php echo $row2['companyAddress'];?><br><b>แขวง/ตำบล </b><?php echo $row2['companyTambol'];?> <b>อำเภอ/เขต </b><?php echo $row2['companyAmpo'];?> <b>จังหวัด </b><?php echo $row2['companyChangwat'];?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">รหัสไปรษณีย์ :</th>
                                                <td><?php echo $row2['companyZipCode'];?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">เบอร์โทรศัพท์ :</th>
                                                <td><?php echo $row2['compnumber'];?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">เบอร์โทรสาร :</th>
                                                <td><?php echo $row2['faxnumber'];?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Website/E-mail Address :</th>
                                                <td><?php echo $row2['website'];?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="topic">ข้อมูลการฝึกงาน</div>
                                <div class="detail">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <th scope="row" style="width:50%">หน้าที่ที่ได้รับมอบหมาย:</th>
                                                <td><?php echo $row2['department'];?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row"> ปัญหา อุปสรรคที่เกิดขึ้น เเละวิธีเเก้ปัญหา:</th>
                                                <td><?php echo $row2['workdetail'];?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">ประสบการณ์ที่ได้รับ:</th>
                                                <td><?php echo $row2['pesoncont'];?></td>
                                            </tr>
                                        </tbody>
                                    <?php
                                        }
                                    }
                                    ?>
                                    </table>
                                   
                                
                                    <?php
                                    $sql = "SELECT approve FROM stdklankrong WHERE stdID=$stdID ORDER BY klankrongID DESC LIMIT 1";
                                    $resulte = $conn->query($sql);
                                    ?>
                                </div>
                                
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