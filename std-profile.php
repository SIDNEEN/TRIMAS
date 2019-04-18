<?php
    /**
     * เปิดใช้งาน Session
     */
    session_start();
    if ($_SESSION['userID']=="") {
        header("Location: login.php");
    }
    include('conn_mysql.php');
    $sql = "SELECT * FROM student_data LEFT JOIN semester ON student_data.semesterID=semester.semesterID WHERE `userID` = '".$_SESSION['userID']."'";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        $_SESSION['majorID'] = $row['majorID'];
        $stdphoto=$row['stdPhoto'];
        $stdID = $row['stdID'];
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
                        <b>ระบบบริหารข้อมูลการฝึกงาน</b>
                    </div>
                    <div class="header-block header-block-nav">
                        <ul class="nav-profile">
                            <li class="notifications new">
                                <a href="" data-toggle="dropdown">
                                    <i class="fa fa-bell-o"></i>
                                    <sup>
                                        <span class="counter"></span>
                                    </sup>
                                </a>
                                <div class="dropdown-menu notifications-dropdown-menu" data-stdID="<?php echo $stdID;?>">
                                    <ul class="notifications-container">
                                    </ul>
                                    <!-- <footer>
                                        <ul>
                                            <li>
                                                <a href=""> View All </a>
                                            </li>
                                        </ul>
                                    </footer> -->
                                </div>
                            </li>
                            <li class="profile dropdown">
                                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                    <div class="img" style="background-image: url('img/<?php echo $row['stdPhoto'];?>')">
                                    </div>
                                    <span class="name"> <?php echo $row['stdFirstname'].' '.$row['stdLastname'];?></span>
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
                            <li class="active open">
                                    <a href="">
                                        <i class="fa fa-address-card"></i> ก่อนฝึกงาน <i class="fa arrow"></i>
                                    </a>
                                    <ul class="sidebar-nav">
                                    <li class="active">
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
                                    <a href="std-address.php">
                                        <i class="fa fa-map-marker"></i> ข้อมูลที่พักของนักศึกษา </a>
                                </li>
                                <li>
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
                                                    <span class="color-item color-green" data-theme="green"></span>
                                                </li>
                                                <li>
                                                    <span class="color-item color-seagreen" data-theme="seagreen"></span>
                                                </li>
                                                <li>
                                                    <span class="color-item color-blue active" data-theme="blue"></span>
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
                <article class="content std-profile-page">
                    <section class="section">
                        <div class="row">
                            <div class="col-xl-3 col-lg-4">
                                <div class="card faq-left card-proimg">
                                    <div class="card-header">
                                        <img class="img-fluid mx-auto img-profile" src="img/<?php echo $row['stdPhoto'];?>" alt="">
                                        <div class="profile-hvr m-t-15">
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <h4 class="text-center text-primary">
                                            <?php echo $row['stdFirstname'].' '.$row['stdLastname'];?>
                                        </h4>
                                        <h5 class="text-center">
                                            <?php echo $row['stdNumber'];?>
                                        </h5>
                                    </div>
                                </div>
                                <!-- end of card-block -->
                            </div>
                            <!-- end of col-lg-3 -->
                            <!-- start col-lg-9 -->
                            <div class="col-xl-9 col-lg-8">
                                <!-- Nav tabs -->
                                <div class="tab-header">
                                    <ul class="nav nav-tabs md-tabs tab-timeline" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#personal" role="tab">Personal Info</a>
                                            <div class="slide"></div>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#project" role="tab">ข้อมูลสถานประการของนักศึกษา</a>
                                            <div class="slide"></div>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#address" role="tab">ที่พักของนักศึกษา</a>
                                            <div class="slide"></div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="personal" role="tabpanel">
                                        <div class="card card-primary">
                                            <div class="card-header">
                                                <h5 class="card-header-text float-left text-white">ข้อมูลนักศึกษา</h5>
                                                <button id="edit-btn" type="button" class="btn btn-oval btn-danger ml-auto"data-toggle="modal" data-target="#editProfile">&nbsp;&nbsp;แก้ไข&nbsp;&nbsp;</button>
                                            </div>
                                            <div class="card-block">
                                                <div class="view-info">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="general-info">
                                                                <div class="row">
                                                                    <div class="col-lg-12 col-xl-6">
                                                                        <table class="table m-0 table-borderless table-condensed table-hover">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <th scope="row">ชื่อนักศึกษา</th>
                                                                                    <td>
                                                                                        <?php echo $row['stdFirstname'].' '.$row['stdLastname'];?>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th scope="row">รหัศนักศึกษา</th>
                                                                                    <td>
                                                                                        <?php echo $row['stdNumber'];?>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th scope="row">สาขาวิชา</th>
                                                                                    <td>
                                                                                        <?php 
                                                                                        $majorID = $row['majorID'];
                                                                                        $sql1 = "SELECT majorName FROM major WHERE majorID=$majorID";
                                                                                        $result1 = $conn->query($sql1);
                                                                                        if ($result1->num_rows > 0) {
                                                                                            while($row1 = $result1->fetch_assoc()) {
                                                                                                $stdmajor= $row1["majorName"];
                                                                                                echo $stdmajor;
                                                                                            }
                                                                                        } else {
                                                                                            echo "ไม่มีข้อมูลสาขา";
                                                                                        }
                                                                                        ?>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th scope="row">เพศ</th>
                                                                                    <td>
                                                                                        <?php echo $row['gender'];?>
                                                                                    </td>
                                                                                </tr>
                                                                                <!-- <tr>
                                                                                    <th scope="row">Location</th>
                                                                                    <td>New York, USA</td>
                                                                                </tr> -->
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                    <!-- end of table col-lg-6 -->

                                                                    <div class="col-lg-12 col-xl-6">
                                                                        <table class="table table-borderless table-condensed table-hover">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <th scope="row">อีเมล</th>
                                                                                    <td>
                                                                                        <?php echo $row['stdEmail'];?>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th scope="row">หมายเลขโทรศัพท์</th>
                                                                                    <td>
                                                                                        <?php echo $row['stdPhone'];?>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th scope="row">Facebook</th>
                                                                                    <td>
                                                                                        <?php echo $row['stdFacebook'];?>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th scope="row">ช่วงเวลาฝึกงาน</th>
                                                                                    <td><?php echo $row['year'].'/'.$row['term'];?></td>
                                                                                </tr>
                                                                                <!-- <tr>
                                                                                    <th scope="row">Website</th>
                                                                                    <td><a href="#!">www.demo.com</a></td>
                                                                                </tr> -->
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                    <!-- end of table col-lg-6 -->
                                                                </div>
                                                                <!-- end of row -->
                                                            </div>
                                                            <!-- end of general info -->
                                                        </div>
                                                        <!-- end of col-lg-12 -->
                                                    </div>
                                                    <!-- end of row -->
                                                </div>
                                                <!-- end of view-info -->


                                            </div>
                                            <!-- end of card-block -->
                                        </div>
                                        <!-- end of card-->
                                        <br>
                                        <?php
                                        $sqlQuery = "SELECT * FROM studentcomgpa WHERE stdID = ".$row['stdID'];
                                        $tresult = $conn->query($sqlQuery);
                                        if($tresult->num_rows > 0){
                                            $rowrs = $tresult->fetch_assoc();
                                            $gpa = $rowrs['gpa'];
                                            if ($rowrs['comtest']=="ผ่าน") {
                                                $comtest='<p class="text-success">'.$rowrs['comtest'].'</p>';
                                            }
                                            elseif ($rowrs['comtest']=="ไม่ผ่าน") {
                                                $comtest='<p class="text-danger">'.$rowrs['comtest'].'</p>';
                                            }else {
                                                $comtest = $rowrs['comtest'];
                                            }
                                            
                                        }else {
                                            $gpa = "no data, need to insert data in table";
                                            $comtest="no data,need to insert data in table";
                                        }
                                        ?>
                                        <div class="row">
                                            <div class="col-xl-6">
                                                <div class="card card-primary">
                                                    <div class="card-header  text-white">
                                                        <h5>เกรดเฉลี่ยสะสม</h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <span class="font-weight-bold float-left" id="gpa"><?php echo $gpa;?> </span>
                                                        <button class="btn btn-sm btn-warning float-right" onclick="gpaFun()" id="btn-gpa" name="editgpa">แก้ไข</button>
                                                        <form id="gpaform" action="upd_stdprofile.php" method="post" enctype="multipart/form-data" style="display:none">
                                                            <input type="hidden" name="stdID" value="<?php echo $row['stdID'];?>">
                                                            <input type="number" name="gpa" step="0.01" max="4.00" min="0" value="<?php echo $gpa;?>">
                                                            <br>
                                                            <br>
                                                            <p>สามารถเอาข้อมูลได้จาก <a href="http://sis.trang.psu.ac.th/" target="_blank">sis-trang.psu.ac.th</a></p>
                                                            <p>*ไฟล์ pdf เท่านั้น</p>
                                                            <input type="file" id="input001" name="filegpa"required>
                                                            <br>
                                                            <button type="submit" class="btn btn-sm btn-success  float-right" name="editgpa">บันทึก</button>
                                                        </form>
                                                        
                                                    </div>
                                                    <!-- end of card-block -->
                                                </div>
                                                <!-- end of card -->
                                            </div>
                                            <!-- end of col-lg-6 -->

                                            <div class="col-xl-6">
                                                <div class="card card-primary">
                                                    <div class="card-header text-white">
                                                        <h5>การทดสอบทางคอมพิวเตอร์</h5>
                                                    </div>
                                                    <div class="card-body">

                                                        <span class="font-weight-bold float-left" id="comtest"><?php echo $comtest;?> </span>
                                                        <button class="btn btn-sm btn-warning float-right" onclick="comtestFun()"id="btn-comtest" name="editcomtest">แก้ไข</button>
                                                        <form id="comtestform" action="upd_stdprofile.php" method="post" enctype="multipart/form-data" style="display:none" class="form-inline">
                                                            <input type="hidden" name="stdID" value="<?php echo $row['stdID'];?>">
                                                            <select name="comtest" id="comtest">
                                                                <option value="none" <?php if ($rowrs['comtest']=='no comtest data'
                                                                    ) echo ' selected="selected"' ; ?>>กรุณาเลือก</option>
                                                                <option value="ผ่าน" <?php if ($rowrs['comtest']=='ผ่าน' ) echo
                                                                    ' selected="selected"' ; ?>>ผ่าน</option>
                                                                <option value="ไม่ผ่าน" <?php if ($rowrs['comtest']=='ไม่ผ่าน' )
                                                                    echo ' selected="selected"' ; ?>>ไม่ผ่าน</option>
                                                            </select>
                                                            <div id="inputfilecomtest">
                                                                <br>
                                                                <p>สามารถเอาข้อมูลได้จาก <a href="http://comtest.trang.psu.ac.th/" target="_blank">comtest.trang.psu.ac.th</a></p>
                                                                <p>*ไฟล์ pdf เท่านั้น</p>
                                                                <input type="file" id="input002" name="filecomtest"required>
                                                                <br>
                                                            </div>

                                                            <!-- <br> -->
                                                            <button type="submit" class="btn btn-sm btn-success float-right" name="editcomtest">บันทึก</button>
                                                        </form>

                                                    </div>
                                                    <!-- end of card-block -->
                                                </div>
                                                <!-- end of card -->
                                            </div>
                                            <!-- end of col-lg-6 -->
                                        </div>
                                        <!-- end of row of education and experience  -->
                                    </div>
                                    <div class="tab-pane" id="address" role="tabpanel">
                                        <div class="card card-primary">
                                            <div class="card-header">
                                                <h5 class="card-header-text float-left text-white">ข้อมูลที่อยู่</h5>
                                                <button id="edit-btn" type="button" class="btn btn-oval btn-danger ml-auto"data-toggle="modal" data-target="#editaddress">&nbsp;&nbsp;แก้ไข&nbsp;&nbsp;</button>
                                            </div>
                                            <div class="card-block">
                                                <div class="view-info">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="general-info">
                                                                <div class="row">
                                                                    <div class="col-lg-12 col-xl-6">
                                                                        <table class="table m-0 table-borderless table-condensed table-hover">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <th scope="row">บ้านเลขที่</th>
                                                                                    <td>
                                                                                        <?php echo "37"?>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th scope="row">หมู่บ้าน</th>
                                                                                    <td>
                                                                                    <?php echo "โค้กเค้ต"?>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th scope="row">ซอย</th>
                                                                                    <td>
                                                                                    <?php echo "-"?>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th scope="row">ถนน</th>
                                                                                    <td>
                                                                                    <?php echo "-"?>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th scope="row">หมู่</th>
                                                                                    <td>
                                                                                    <?php echo "6"?>
                                                                                    </td>
                                                                                </tr>
                                                                                <!-- <tr>
                                                                                    <th scope="row">Location</th>
                                                                                    <td>New York, USA</td>
                                                                                </tr> -->
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                    <!-- end of table col-lg-6 -->

                                                                    <div class="col-lg-12 col-xl-6">
                                                                        <table class="table table-borderless table-condensed table-hover">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <th scope="row">ตำบล</th>
                                                                                    <td>
                                                                                    <?php echo "บ้านนา"?>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th scope="row">อำเภอ</th>
                                                                                    <td>
                                                                                    <?php echo "จะนะ"?>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th scope="row">จังหวัด</th>
                                                                                    <td>
                                                                                    <?php echo "สงขลา"?>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th scope="row">รหัสไปรษณี</th>
                                                                                    <td> <?php echo "90130"?></td>
                                                                                </tr>
                                                                                <!-- <tr>
                                                                                    <th scope="row">Website</th>
                                                                                    <td><a href="#!">www.demo.com</a></td>
                                                                                </tr> -->
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                    <!-- end of table col-lg-6 -->
                                                                </div>
                                                                <!-- end of row -->
                                                            </div>
                                                            <!-- end of general info -->
                                                        </div>
                                                        <!-- end of col-lg-12 -->
                                                    </div>
                                                    <!-- end of row -->
                                                </div>
                                                <!-- end of view-info -->


                                            </div>
                                            <!-- end of card-block -->
                                        </div>
                                        <!-- end of card-->
                                        <br>
                                        <!-- end of row of education and experience  -->
                                    </div>
                                    <!-- end of tab-pane -->
                                    <!-- end of about us tab-pane -->

                                    <!-- start tab-pane of project tab -->
                                    <div class="tab-pane" id="project" role="tabpanel">
                                        <div class="card card-primary">
                                            <div class="card-header">
                                                <h5 class="card-header-text text-white">สถานประกอบการที่ส่งกลั่นกรอง</h5>
                                                <!-- <button type="button" class="btn btn-primary waves-effect waves-light f-right">
                                                    + ADD PROJECTS</button> -->
                                            </div>
                                            <!-- end of card-header  -->
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="project-table">
                                                        <div class="table-responsive">
                                                            <table class="table">
                                                                <thead>
                                                                    <tr>
                                                                        <th class="text-center txt-primary pro-pic">ครั้งที่</th>
                                                                        <th class="text-center txt-primary">ชื่อสถานประกอบการ</th>
                                                                        <th class="text-center txt-primary">จังหวัด</th>
                                                                        <th class="text-center txt-primary">สถานะ</th>
                                                                        <th class="text-center txt-primary">ดูการกลั่นกรอง</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody class="text-center">
                                                                    <?php    
                                                                        $sql = "SELECT * FROM stdklankrong LEFT JOIN company ON stdklankrong.companyID = company.companyID   WHERE  stdklankrong.stdID =".$row['stdID'] ;
                                                                        $result=mysqli_query($conn,$sql)or die(mysqli_error($conn));
                                                                        if($result->num_rows > 0){
                                                                            $i=1;  
                                                                            while($rw = mysqli_fetch_array($result,MYSQLI_ASSOC)){
                                                                                echo '<tr>';
                                                                                echo '<td>'.$i.'</td>';
                                                                                echo "<td>".$rw['companyName']."</td>";
                                                                                echo '<td>'.$rw['companyChangwat'].'</td>';
                                                                                if ($rw["approve"]=='yes') {
                                                                                    echo '<td>ผ่าน</td>';
                                                                                }elseif ($rw["approve"]=='no') {
                                                                                    echo '<td>ไม่ผ่าน</td>';
                                                                                }elseif ($rw["approve"]=='waiting') {
                                                                                    echo '<td>รอดำเนินการ</td>';
                                                                                }
                                                                                if($result->num_rows==$i){
                                                                                    echo '<td class="faq-table-btn">
                                                                                            <a href="std-klankrong-info.php" type="button" class="btn btn-success waves-effect waves-light"
                                                                                                data-toggle="tooltip" data-placement="top" title="ดู">
                                                                                                <i class="fa fa-eye"></i>
                                                                                            </a>
                                                                                        </td>';
                                                                                }else {
                                                                                    echo'<td></td>';
                                                                                }
                                                                                
                                                                                echo '<tr>';
                                                                                $i++;
                                                                            }
                                                                        }else{
                                                                            echo '<tr><td colspan="5" class="text-danger">ไม่ข้อมูลการกลั่นกรอง</td></tr>';
                                                                            
                                                                        }
                                                                    ?>    
                                                                </tbody>
                                                            </table>
                                                            <!-- end of table -->
                                                        </div>
                                                        <!-- end of table responsive -->
                                                    </div>
                                                    <!-- end of project table -->
                                                </div>
                                                <!-- end of col-lg-12 -->
                                            </div>
                                            <!-- end of row -->
                                        </div>
                                        <!-- end of card-main -->
                                    </div>
                                    <!-- end of project pane -->



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
                <?php }else{header("Location: logout.php");} ?>
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

                <!-- student edit modal -->
                <div class="modal fade" id="editProfile" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="upd_stdprofile.php" method="post" enctype="multipart/form-data">
                                <div class="modal-body">
                                    <input type="hidden" name="stdID" id="stdID" value="<?php echo $row['stdID'];?>">
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label" for="stdFirstname">ชื่อนักศึกษา</label>
                                        <div class="col-md-4 inputGroupContainer">
                                            <input id="stdFirstname" name="stdFirstname" type="text" class="form-control"
                                                value="<?php echo $row['stdFirstname'];?>" readonly>
                                        </div>
                                        <label class="col-md-2 col-form-label text-right" for="stdLastname">นามสกุล</label>
                                        <div class="col-md-4">
                                            <input id="stdLastname" name="stdLastname" type="text" class="form-control"
                                                value="<?php echo $row['stdLastname'];?>" readonly>
                                        </div>
                                    </div>

                                    <!-- ที่อยู่-->
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label" for="stdNumber">รหัศนักศึกษา</label>
                                        <div class="col-md-4">
                                            <input id="stdNumber" name="stdNumber" type="text" class="form-control"
                                                required="true" value="<?php echo $row['stdNumber'];?>" readonly>
                                        </div>
                                        <label class="col-md-2 col-form-label text-right" for="stdMajor">สาขาวิชา</label>
                                        <div class="col-md-4">
                                            <input id="stdMajor" name="" type="text" class="form-control" required="true"
                                                value="<?php echo $stdmajor;?>" readonly>
                                            <input type="hidden" name="majorID" value="<?php echo $majorID;?>">   
                                        </div>
                                    </div>
                                    <hr>
                                    <!-- ตำบล อำเภอ จังหวัด-->
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label" for="gender">เพศ</label>
                                        <div class="col-md-4">
                                            <select class="custom-select" name="gender" required>
                                                <option value="none" <?php if ($row['gender']=='none' ) echo
                                                    ' selected="selected"' ; ?>>กรุณาเลือกเพศ</option>
                                                <option value="ชาย" <?php if ($row['gender']=='ชาย' ) echo
                                                    ' selected="selected"' ; ?>>ชาย</option>
                                                <option value="หญิง" <?php if ($row['gender']=='หญิง' ) echo
                                                    ' selected="selected"' ; ?>>หญิง</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- รหัสไปรษณีย์-->
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label" for="stdEmail">อีเมล</label>
                                        <div class="col-md-4">
                                            <input id="stdEmail" name="stdEmail" type="text" class="form-control" required="true"
                                                value="<?php echo $row['stdEmail'];?>">
                                        </div>
                                        <label class="col-md-2 col-form-label text-right" for="stdFacebook">Facebook</label>
                                        <div class="col-md-4">
                                            <input id="stdFacebook" name="stdFacebook" type="text" class="form-control"
                                                required="true" value="<?php echo $row['stdFacebook'];?>">
                                        </div>
                                    </div>
                                    <!-- เบอร์โทร-->
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label" for="stdPhone">เบอร์โทร</label>
                                        <div class="col-md-10">
                                            <input id="stdPhone" name="stdPhone" type="text" class="form-control" required="true"
                                                value="<?php echo $row['stdPhone'];?>">
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <label for="fileUpload" class="col-md-2 col-form-label">เปลี่ยนภาพประจำตัว</label>
                                        <div class="col-md-10">
                                            <input type="file" class="form-control" id="fileUpload" name="fileUpload"
                                                onchange="readURL(this)">
                                        </div>
                                    </div>
                                    <figure class="figure text-center d-none">
                                        <img id="imgUpload" class="figure-img img-fluid rounded" alt="">
                                    </figure>
                                </div>


                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" name="submitEditModal">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
             <div class="modal fade" id="editaddress" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">ข้อมูลที่อยู่</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="upd_stdprofile.php" method="post" enctype="multipart/form-data">
                                <div class="modal-body">
                                    <input type="hidden" name="stdID" id="stdID" value="<?php echo $row['stdID'];?>">
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label" for="stdFirstname">บ้านเลขที่</label>
                                        <div class="col-md-4 inputGroupContainer">
                                            <input id="stdFirstname" name="stdFirstname" type="text" class="form-control"
                                                value="<?php echo "37"?>">
                                        </div>
                                        <label class="col-md-2 col-form-label text-right" for="stdLastname">หมู่บ้าน</label>
                                        <div class="col-md-4">
                                            <input id="stdLastname" name="stdLastname" type="text" class="form-control"
                                            value="<?php echo "โค้กเค้ต"?>">
                                        </div>
                                    </div>

                                    <!-- ที่อยู่-->
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label" for="stdNumber">ซอย</label>
                                        <div class="col-md-4">
                                            <input id="stdNumber" name="stdNumber" type="text" class="form-control"
                                                required="true" value="<?php echo "-"?>">
                                        </div>
                                        <label class="col-md-2 col-form-label text-right" for="stdMajor">ถนน</label>
                                        <div class="col-md-4">
                                            <input id="stdMajor" name="" type="text" class="form-control" required="true"
                                            value="<?php echo "-"?>">
                                            <input type="hidden" name="majorID" value="<?php echo $majorID;?>">  
                                        </div>
                                    </div>
                                    <!-- รหัสไปรษณีย์-->
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label" for="stdEmail">หมู่</label>
                                        <div class="col-md-4">
                                            <input id="stdEmail" name="stdEmail" type="text" class="form-control" required="true"
                                            value="<?php echo "6"?>">
                                        </div>
                                        <label class="col-md-2 col-form-label text-right" for="stdFacebook">ตำบล</label>
                                        <div class="col-md-4">
                                            <input id="stdFacebook" name="stdFacebook" type="text" class="form-control"
                                                required="true" value="<?php echo "บ้านนา"?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label" for="stdEmail">อำเภอ</label>
                                        <div class="col-md-4">
                                            <input id="stdEmail" name="stdEmail" type="text" class="form-control" required="true"
                                            value="<?php echo "จะนะ"?>">
                                        </div>
                                        <label class="col-md-2 col-form-label text-right" for="stdFacebook">จังหวัด</label>
                                        <div class="col-md-4">
                                            <input id="stdFacebook" name="stdFacebook" type="text" class="form-control"
                                                required="true" value="<?php echo "สงขลา"?>">
                                    </div>
                                    <br>
                                    <br>
                                    <br>
                                    <label class="col-md-2 col-form-label" for="stdEmail">รหัสไปรษณี</label>
                                        <div class="col-md-4">
                                            <input id="stdEmail" name="stdEmail" type="text" class="form-control" required="true"
                                            value="<?php echo "90130"?>">
                                        </div>
                                    
                                    
                                   
                                   
                                   
                                   
                                  
                                </div>


                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" name="submitEditModal">Save changes</button>
                                </div>
                            </form>
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
        <script type="text/javascript" src="js/bootstrap-filestyle.min.js"> </script>
        <script src="js/std-notification.js"></script>
        <script>
            /**
             * ประกาศ function readURL()
             * เพื่อทำการตรวจสอบว่า มีไฟล์ภาพที่กำหนดถูกอัพโหลดหรือไม่
             * ถ้ามีไฟล์ภาพที่กำหนดถูกอัพโหลดอยู่ ให้แสดงไฟล์ภาพนั้นผ่าน elements ที่มี id="imgUpload"
             */
            function readURL(input) {
                if (input.files[0]) {
                    var reader = new FileReader();
                    $('.figure').addClass('d-block');
                    reader.onload = function (e) {
                        console.log(e.target.result)
                        $('#imgUpload').attr('src', e.target.result).width(240);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }

            function gpaFun() {
                var x = document.getElementById("gpa");
                var y = document.getElementById("gpaform");
                var btn = document.getElementById("btn-gpa");
                if (x.style.display === "none") {
                    x.style.display = "block";
                    y.style.display = "none";
                    btn.innerHTML = "แก้ไข";
                } else {
                    x.style.display = "none";
                    y.style.display = "block";
                    btn.innerHTML = "ยกเลิก";
                }
            }
            function comtestFile() {
                var x = document.getElementById("comtest");
                var y = document.getElementById("comtestform");
                var btn = document.getElementById("btn-comtest");
                if (x.style.display === "none") {
                    x.style.display = "block";
                    y.style.display = "none";
                    btn.innerHTML = "แก้ไข";
                } else {
                    x.style.display = "none";
                    y.style.display = "block";
                    btn.innerHTML = "ยกเลิก";
                }
            }
            function gpaFile() {
                var x = document.getElementById("gpa");
                var y = document.getElementById("gpaform");
                var btn = document.getElementById("btn-gpa");
                if (x.style.display === "none") {
                    x.style.display = "block";
                    y.style.display = "none";
                    btn.innerHTML = "แก้ไข";
                } else {
                    x.style.display = "none";
                    y.style.display = "block";
                    btn.innerHTML = "ยกเลิก";
                }
            }
            function comtestFun() {
                var x = document.getElementById("comtest");
                var y = document.getElementById("comtestform");
                var btn = document.getElementById("btn-comtest");
                if (x.style.display === "none") {
                    x.style.display = "block";
                    y.style.display = "none";
                    btn.innerHTML = "แก้ไข";
                } else {
                    x.style.display = "none";
                    y.style.display = "block";
                    btn.innerHTML = "ยกเลิก";
                }
            }
        </script>
        <script type="text/javascript">
            $('#input001').filestyle({
                text: 'เลือก',
                placeholder: 'ไฟล์ผลการเรียน'
            });
            $('#input002').filestyle({
                text: 'เลือก',
                placeholder: 'ไฟล์ผลการสอบคอมฯ'
            });
            $('#fileUpload').filestyle({
                buttonBefore: true,
                text: 'เลือกไฟล์',
                placeholder: 'เลือกไฟล์รูปภาพประจำตัวของคุณ'
            });

            $("#input001,#input002").change(function () {
                var fileExtension = ['pdf'];
                if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
                    alert("รองรับไฟล์ : "+fileExtension.join(', ')+" เท่านั้น");
                    $("#input001,#input002").val(null);
                }
            });
        </script>
    </body>
</html>