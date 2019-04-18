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
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@7.29.1/dist/sweetalert2.min.css">
        <!-- Font Icon -->
        <link rel="stylesheet" href="css/material-design-iconic-font.min.css">
        <link rel="stylesheet" href="vendor/nouislider/nouislider.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
 
<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
 
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

        <!-- Main css -->
        <link rel="stylesheet" href="css/stdklankrongstyle.css">
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
                                    <a href="">
                                        <i class="fa fa-address-card"></i> ก่อนฝึกงาน <i class="fa arrow"></i>
                                    </a>
                                    <ul class="sidebar-nav">
                                    <li>
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
                                <li>
                                    <a href="">
                                        <i class="fa fa-share-square-o"></i> ระหว่างฝึกงาน <i class="fa arrow"></i>
                                    </a>
                                    <ul class="sidebar-nav">
                                    <li>
                                    <a href="std-4week.php">
                                        <i class="fa fa-map-marker"></i> ข้อมูลที่พักของนักศึกษา </a>
                                </li>
                                <li>
                                    <a href="std-4week.php">
                                        <i class="fa fa-newspaper-o"></i> ข้อมูล4สัปดาห์เเรก </a>
                                </li>
                            </ul>
                            <li  class="active open">
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
                <article class="std-klankrong-page">
                    <section class="section">
                    <?php 
                        require_once('conn_mysql.php');
                        $sql = "SELECT * FROM student_data,major WHERE userID = ".$_SESSION['userID']." AND student_data.majorID = major.majorID";
                            $result = $conn->query($sql);
                            if($result->num_rows > 0){
                                $row = $result->fetch_assoc();
                    ?>
                        <div class="main">
                        
                            <div class="klankron-container">
                                <div class="kk-header"><h3 class="kk-text"><b>เเบบประเมินความคิดเห็นนักศึกษาฝึกงาน</b></h3></div>
                                    <form method="POST" id="signup-form" class="signup-form" action="savetoklankrong.php">
                                        <div>
                                            <h3>ข้อมูลนักศึกษา</h3>
                                            <fieldset>
                                                <h4>ข้อมูลนักศึกษา</h4>
                                                <p class="desc">Please enter your infomation and proceed to next step
                                                    account</p>
                                                <div class="fieldset-content">
                                                    <div class="form-row">
                                                        <div class="form-flex">
                                                            <div class="form-group">
                                                                <label for="studcode" class="form-label">รหัสนักศึกษา</label>
                                                                <input type="hidden" name="stdID[]" value="<?php echo $row['stdID'] ;?>">
                                                                <input type="text" name="studcode" id="studcode" value="<?php echo $row['stdNumber'];?>" readonly/>

                                                            </div>
                                                            <div class="form-group">
                                                                <label for="studname" class="form-label">ชื่อ-สกุล</label>
                                                                <input type="text" name="studname" id="studname" value="<?php echo $row['stdFirstname']."  ". $row['stdLastname'];?>" readonly/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="major" class="form-label">สาขาวิชา</label>
                                                        <input type="major" name="major" id="major" value="<?php echo $row['majorName'];?>" readonly/>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="form-flex">
                                                            <div class="form-group">
                                                                <label for="studcode" class="form-label">ชื่อสถานที่ฝึกงาน</label>
                                                                <input type="hidden" name="stdID[]" value="<?php echo $row['stdID'] ;?>">
                                                                <input type="text" name="studcode" id="studcode"/>

                                                            </div>
                                                            <div class="form-group">
                                                                <label for="studname" class="form-label">เเผนก/หน่วยงาน</label>
                                                                <input type="text" name="studpnek" id="studpnek"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="stdaddress" class="form-label">ที่อยู่</label>
                                                        <input type="text" name="stdaddress" id="stdaddress"/>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="stdphone" class="form-label">ดำเนินธุรกิจประเภท</label>
                                                        <input type="text" name="stdprapet" id="stdprapet"/>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="form-flex">
                                                            <div class="form-group">
                                                                <label for="studcode" class="form-label">ฝึกงานตั้งเเต่วันที่</label>
                                                                <input type="text" name="studay1" id="studday1"/>

                                                            </div>
                                                            <div class="form-group">
                                                                <label for="studname" class="form-label">ถึงวันที่</label>
                                                                <input type="text" name="studday2" id="studay2"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php
                                                        $sql = "SELECT * FROM company,booking,booked WHERE company.companyID=booking.companyID and booked.openBookingID=booking.openBookingID and booked.stdID=".$row['stdID'];
                                                        $result = $conn->query($sql);
                                                            if($result->num_rows > 0){
                                                                $display='';
                                                                $br = "";
                                                                $decs ="" ;
                                                                $row2 = $result->fetch_assoc(); 
                                                    ?>
                                                    <!-- <button type="button" class="btn-add" company-id="<?php //echo $row2['companyID'];?>" std-id="<?php// echo $row['stdID'] ;?>">เพิ่มผู้ร่วมสถานประกอบการเดียวกัน</button> -->
                                                </div>
                                                <!-- <div class="fieldset-content" id="otherperson"></div> -->
                                                
                                            </fieldset>

                                            <h3>ประเมิน</h3>
                                            <fieldset>
                
                                            
  <div class="row">
    <div class="col-md-12">
      <h3 align="center"> ตัวอย่างฟอร์มแบบสอบถามออนไลน์ devbanban.com </h3>
      <form id="formq" name="formq" method="post" action="q_db.php">
        <table width="100%" border="1" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td width="75%" rowspan="2" align="center"><strong>หัวข้อการประเมิน</strong></td>
            <td colspan="5" align="center"><strong>ระดับความคิดเห็น</strong></td>
          </tr>
          <tr>
            <td width="5%" align="center"><strong>5</strong></td>
            <td width="5%" align="center"><strong>4</strong></td>
            <td width="5%" align="center"><strong>3</strong></td>
            <td width="5%" align="center"><strong>2</strong></td>
            <td width="5%" align="center"><strong>1</strong></td>
          </tr>
          <tr>
            <td height="30" colspan="6" bgcolor="#F4F4F4"><strong>1.ก่อนฝึกงาน</strong></td>
          </tr>
          <tr>
            <td height="30">&nbsp; 1.1 ความคาดหวังของนักศึกษาต่อโอกาสที่จะได้ฝึกงานตรงสาขาวิชา</td>
            <td height="30" align="center"><input type="radio" name="a1"  value="5" required="required" /></td>
            <td height="30" align="center"><input type="radio" name="a1"  value="4" /></td>
            <td height="30" align="center"><input type="radio" name="a1"  value="3" /></td>
            <td height="30" align="center"><input type="radio" name="a1"  value="2" /></td>
            <td height="30" align="center"><input type="radio" name="a1"  value="1" /></td>
          </tr>
          <tr>
            <td height="30">&nbsp; 1.2 การเตรียมความพร้อมให้เเก่ตนเองของนักศึกษาในทุกด้าน ก่อนฝึกงาน</td>
            <td width="5%" height="30" align="center"><input type="radio" name="a2"  value="5" required="required" /></td>
            <td width="5%" height="30" align="center"><input type="radio" name="a2"  value="4"/></td>
            <td width="5%" height="30" align="center"><input type="radio" name="a2"  value="3"/></td>
            <td width="5%" height="30" align="center"><input type="radio" name="a2"  value="2"/></td>
            <td width="5%" height="30" align="center"><input type="radio" name="a2"  value="1"/></td>
          </tr>
          <tr>
            <td height="30">&nbsp; 1.3การเตรียมความพร้อมของวิทยาลัย ให้เเก่นักศึกษาก่อนฝึกงาน</td>
            <td width="5%" height="30" align="center"><input type="radio" name="a3"  value="5" required="required" /></td>
            <td width="5%" height="30" align="center"><input type="radio" name="a3"  value="4"/></td>
            <td width="5%" height="30" align="center"><input type="radio" name="a3"  value="3"/></td>
            <td width="5%" height="30" align="center"><input type="radio" name="a3"  value="2"/></td>
            <td width="5%" height="30" align="center"><input type="radio" name="a3"  value="1"/></td>
          </tr>
          <tr>
            <td height="30" colspan="6" bgcolor="#F4F4F4"><strong>2. ระหว่างฝึกงาน</strong></td>
          </tr>
          <tr>
            <td height="30">&nbsp; 2.1 นักศึกษาได้ปฎิบัติงานตรงกับสาขาวิชา</td>
            <td height="30" align="center"><input type="radio" name="b1"  value="5" required="required" /></td>
            <td height="30" align="center"><input type="radio" name="b1"  value="4"/></td>
            <td height="30" align="center"><input type="radio" name="b1"  value="3"/></td>
            <td height="30" align="center"><input type="radio" name="b1"  value="2"/></td>
            <td height="30" align="center"><input type="radio" name="b1"  value="1"/></td>
          </tr>
          <tr>
            <td height="30">&nbsp; 2.2 การตอนรับนักศึกษาในวันเเรกของการฝึกงาน</td>
            <td height="30" align="center"><input type="radio" name="b2"  value="5" required="required" /></td>
            <td height="30" align="center"><input type="radio" name="b2"  value="4"/></td>
            <td height="30" align="center"><input type="radio" name="b2"  value="3"/></td>
            <td height="30" align="center"><input type="radio" name="b2"  value="2"/></td>
            <td height="30" align="center"><input type="radio" name="b2"  value="1"/></td>
          </tr>
          <tr>
            <td height="30">&nbsp; 2.3 การดูเเลจากพี่เลี้ยงในระหว่างฝึกงาน</td>
            <td height="30" align="center"><input type="radio" name="b3" value="5" required="required" /></td>
            <td height="30" align="center"><input type="radio" name="b3"  value="4"/></td>
            <td height="30" align="center"><input type="radio" name="b3"  value="3"/></td>
            <td height="30" align="center"><input type="radio" name="b3"  value="2"/></td>
            <td height="30" align="center"><input type="radio" name="b3"  value="1"/></td>
          </tr>
          <tr>
            <td height="30">&nbsp; 2.4 ความเหมาะสมของปริมาณงานที่ได้รับในการหมอบหมาย</td>
            <td height="30" align="center"><input type="radio" name="b4"  value="5" required="required" /></td>
            <td height="30" align="center"><input type="radio" name="b4"  value="4"/></td>
            <td height="30" align="center"><input type="radio" name="b4"  value="3"/></td>
            <td height="30" align="center"><input type="radio" name="b4"  value="2"/></td>
            <td height="30" align="center"><input type="radio" name="b4"  value="1"/></td>
          </tr>
          <tr>
            <td height="30">&nbsp; 2.5 ความมั่นใจของนักศึกษาในการทำงานที่ได้รับมอบหมาย</td>
            <td height="30" align="center"><input type="radio" name="b5"  value="5" required="required" /></td>
            <td height="30" align="center"><input type="radio" name="b5" value="4"/></td>
            <td height="30" align="center"><input type="radio" name="b5" value="3"/></td>
            <td height="30" align="center"><input type="radio" name="b5" value="2"/></td>
            <td height="30" align="center"><input type="radio" name="b5" value="1"/></td>
          </tr>
          <tr>
            <td height="30">&nbsp; 2.6 การเรียนรู้งานที่ได้รับมอบหมายด้วยตนเอง</td>
            <td height="30" align="center"><input type="radio" name="b6"  value="5" required="required" /></td>
            <td height="30" align="center"><input type="radio" name="b6" value="4"/></td>
            <td height="30" align="center"><input type="radio" name="b6" value="3"/></td>
            <td height="30" align="center"><input type="radio" name="b6" value="2"/></td>
            <td height="30" align="center"><input type="radio" name="b6" value="1"/></td>
          </tr>
          <tr>
            <td height="30">&nbsp; 2.7 ความรู้เเละประสบการณ์ที่ได้รับจากการฝึกงาน</td>
            <td height="30" align="center"><input type="radio" name="b7"  value="5" required="required" /></td>
            <td height="30" align="center"><input type="radio" name="b7" value="4"/></td>
            <td height="30" align="center"><input type="radio" name="b7" value="3"/></td>
            <td height="30" align="center"><input type="radio" name="b7" value="2"/></td>
            <td height="30" align="center"><input type="radio" name="b7" value="1"/></td>
          </tr>
          <tr>
            <td height="30">&nbsp; 2.8 นักศึกษาสามารถนำความรู้มาประยุกต์ใช้ในการปฎิบัติงานได้อย่างเหมาะสม</td>
            <td height="30" align="center"><input type="radio" name="b8"  value="5" required="required" /></td>
            <td height="30" align="center"><input type="radio" name="b8" value="4"/></td>
            <td height="30" align="center"><input type="radio" name="b8" value="3"/></td>
            <td height="30" align="center"><input type="radio" name="b8" value="2"/></td>
            <td height="30" align="center"><input type="radio" name="b8" value="1"/></td>
          </tr>
          <tr>
            <td height="30">&nbsp; 2.9 นักศึกษาได้มีโอกาสได้ใช้ภาษาอังกฤษหรือภาษาต่างประเทศในการปฎิบัติงาน</td>
            <td height="30" align="center"><input type="radio" name="b9"  value="5" required="required" /></td>
            <td height="30" align="center"><input type="radio" name="b9" value="4"/></td>
            <td height="30" align="center"><input type="radio" name="b9" value="3"/></td>
            <td height="30" align="center"><input type="radio" name="b9" value="2"/></td>
            <td height="30" align="center"><input type="radio" name="b9" value="1"/></td>
          </tr>
          <tr>
            <td height="30">&nbsp; 2.10 ตวามต้องการสมัครงาน ณ สถานที่ฝึกงาน หลังจากนักศึกษาจบการศึกษาเเล้ว</td>
            <td height="30" align="center"><input type="radio" name="b10"  value="5" required="required" /></td>
            <td height="30" align="center"><input type="radio" name="b10" value="4"/></td>
            <td height="30" align="center"><input type="radio" name="b10" value="3"/></td>
            <td height="30" align="center"><input type="radio" name="b10" value="2"/></td>
            <td height="30" align="center"><input type="radio" name="b10" value="1"/></td>
          </tr>
          <tr>
            <td height="30" colspan="6" bgcolor="#F4F4F4"><strong>หลังฝึกงาน</strong></td>
          </tr>
          <tr>
            <td height="30">&nbsp; 3.1 นักศึกษาได้รับประสบการณ์การทำงานในวิชาชีพจากการฝึกงาน</td>
            <td height="30" align="center"><input type="radio" name="c1"  value="5" required="required" /></td>
            <td height="30" align="center"><input type="radio" name="c1"  value="4"/></td>
            <td height="30" align="center"><input type="radio" name="c1"  value="3"/></td>
            <td height="30" align="center"><input type="radio" name="c1"  value="2"/></td>
            <td height="30" align="center"><input type="radio" name="c1"  value="1"/></td>
          </tr>
          <tr>
            <td height="30">&nbsp; 3.2 นักศึกษาประสงค์จะเเนะนำสถานประกอบการนี้เเก่นักศึกษาฝึกงานรุ่นถัดไป</td>
            <td height="30" align="center"><input type="radio" name="c2"  value="5" required="required" /></td>
            <td height="30" align="center"><input type="radio" name="c2"  value="4"/></td>
            <td height="30" align="center"><input type="radio" name="c2"  value="3"/></td>
            <td height="30" align="center"><input type="radio" name="c2"  value="2"/></td>
            <td height="30" align="center"><input type="radio" name="c2"  value="1"/></td>
          </tr>
        </table>
        <br>
        <p>ข้อเสนอแนะเพิ่มเติม</p>
        <textarea name="detail" cols="90" rows="3" id="detail"></textarea>
        <br>
        <br>
      </form>
      <br /><br />
    </div>
</div>
                                                <?php } else {
                                                    $display="display:none";
                                                    $decs ="<b>กรุณาจองสถานประกอบการก่อนค่ะ</b>" ;
                                                    echo '</fieldset><h3>ก่อนฝึกงาน</h3>
                                                        <fieldset>
                                                        <h4>ข้อมูลสถานประกอบการ</h4>
                                                        <p class="desc">'.$decs.'</p><div class="fieldset-content">';
                                                    $br = '<br><br><br><br><br><br><br><br><br><br><br>';
                                                    echo $br;
                                                    }
                                                ?> 
                                            </fieldset>
                                        </div>
                                    </form>
                                </div>
                                <!-- ไม่มีอะไร แค่เติมสีส่วนที่ขาด -->
                                 <div id="box-color">  .
                                </div>
                            </div>
                        </div>
                        <?php } else {echo "กรุณา login ก่อน" ;}?> 
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
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.29.1/dist/sweetalert2.min.js"></script>
        <script src="vendor/jquery-validation/dist/jquery.validate.min.js"></script>
        <script src="vendor/jquery-validation/dist/additional-methods.min.js"></script>
        <script src="vendor/jquery-steps/jquery.steps.min.js"></script>
        <script src="vendor/minimalist-picker/dobpicker.js"></script>
        <script src="vendor/nouislider/nouislider.min.js"></script>
        <script src="vendor/wnumb/wNumb.js"></script>
        <script src="js/stdklankrong.js"></script>
    </body>
</html>