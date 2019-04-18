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
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@7.29.1/dist/sweetalert2.min.css">
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
                background-color: #4f5f6f;;
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
                                    <div class="img" style="background-image: url('https://avatars3.githubusercontent.com/u/3959008?v=3&s=40')">
                                    </div>
                                    <span class="name"><?php echo $staffName;?> </span>
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
                                <li>
                                    <a href="">
                                        <i class="fa fa-building-o"></i> จัดการสถานประกอบการ <i class="fa arrow"></i>
                                    </a>
                                    <ul class="sidebar-nav">
                                        <li>
                                            <a href="staff-compTable.php"> เปิดจองสถานประกอบการ </a>
                                        </li>
                                        <li>
                                            <a href="staff-bookingstudent.php"> การจองสถานประกอบการของนักศึกษา </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="active">
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
                <article class="content staff-klankrong-waiting-page">
                    <section class="section">
                        <?php
                            $klankrongID=$_REQUEST['klankrongID'];
                            $sql = "SELECT * FROM stdklankrong LEFT JOIN company on stdklankrong.companyID = company.companyID 
                                    LEFT JOIN student_data ON stdklankrong.stdID=student_data.stdID  
                                    WHERE  stdklankrong.klankrongID=$klankrongID";
                            $result=mysqli_query($conn,$sql)or die(mysqli_error($conn));
                            if($result->num_rows > 0){  
                                while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
                        ?>
                        <!-- Breadcrumbs-->
                        <div class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="staff-klankrong-waiting.php">กลั่นกรองสถานประกอบการ</a>
                            </li>
                            <li class="breadcrumb-item active">รายละเอียดกลั่นกรอง</li>
                        </div>
                        <?php
                            if($row['approve']=='waiting'){
                                $info= 'กำลังรอการกลั่นกรอง';
                                $moreinfo="กรุณารอคณะกรรมการทำการตรวจสอบ";
                                $alrtclass='alert-primary';
                                $footer='';
                            }elseif ($row['approve']=='yes') {
                                $info= 'การกลั่นกรองผ่านแล้ว';
                                $moreinfo="คุณสามารถสามารดำเนินการขั้นตอนต่อไป";
                                $alrtclass='alert-success';
                                $footer='';
                            }elseif ($row['approve']=='no') {
                                $info= 'การกลั่นกรองไม่ผ่าน <br>';
                                $moreinfo="กรุณาส่งกลั่นกรองใหม่";
                                $footer='';
                                $alrtclass='alert-danger';
                            }
                        
                        ?>
                        <div class="alert <?php  echo  $alrtclass;?> alert-dismissible fade show" role="alert">
                        <h4 class="alert-heading"><?php  echo  $info;?></h4>
                        <!-- <p><?php // echo  $moreinfo;?></p> -->
                        <hr>
                        <!-- <p class="mb-0"><?php//  echo  $footer;?></p> -->
                        </div>
                        <div class="row">
                            <div class="col-lg-8">
                                <h3 class="text-center"><b>กลั่นกรองสถานประกอบการ ครั้งที่&nbsp;
                                <?php
                                    //ตรวจ กลั่นกรองที่ส่งมา เป็นครั้งที่เท่าไหร่ รวมถึง กรณีมี่หลายครั้ง แต่ละครั้งเป็นของครั้งที่เท่าไหร่
                                    $sql = "SELECT klankrongID FROM `stdklankrong` WHERE stdID=".$row['stdID'];
                                    $result=mysqli_query($conn,$sql)or die(mysqli_error($conn));
                                    if($result->num_rows > 0){
                                        $i=1;  
                                        while($row1 = mysqli_fetch_array($result,MYSQLI_ASSOC)){
                                            if ( $row1['klankrongID'] ==$klankrongID) {
                                                echo $i;
                                            }  
                                            $i++;
                                        }
                                    }
                                ?>
                                </b></h3><br>
                                <div class="topic">ข้อมูลนักศึกษา</div>
                                <div class="col std-detail"data-klankrong="<?php echo $row['klankrongID'];?>">
                                    <table class="table">
                                        <tbody >
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
                                </div>
                                <div class="topic">ข้อมูลสถานประกอบการ</div>
                                <div class="detail">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <th scope="row" style="width:50%">ชื่อสถานประกอบการ :</th>
                                                <td><?php echo $row['companyName'];?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">ชื่อผู้บริหาร :</th>
                                                <td><?php echo $row['bossname'];?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">ตำแหน่ง :</th>
                                                <td><?php echo $row['position'];?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">ลักษณะการประกอบการขององค์กร:</th>
                                                <td><?php echo $row['description'];?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">ที่อยู่ :</th>
                                                <td>เลขที่ <?php echo $row['companyAddress'];?><br><b>แขวง/ตำบล </b><?php echo $row['companyTambol'];?> <b>อำเภอ/เขต </b><?php echo $row['companyAmpo'];?> <b>จังหวัด </b><?php echo $row['companyChangwat'];?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">รหัสไปรษณีย์ :</th>
                                                <td><?php echo $row['companyZipCode'];?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">เบอร์โทรศัพท์ :</th>
                                                <td><?php echo $row['compnumber'];?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">เบอร์โทรสาร :</th>
                                                <td><?php echo $row['faxnumber'];?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Website/E-mail Address :</th>
                                                <td><?php echo $row['website'];?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="topic">ข้อมูลการฝึกงาน</div>
                                <div class="detail">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <th scope="row" style="width:50%">แผนกที่ฝึกงาน :</th>
                                                <td><?php echo $row['department'];?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">ลักษณะงานที่ได้รับมอบหมาย :</th>
                                                <td><?php echo $row['workdetail'];?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">ชื่อผู้ติดต่อ :</th>
                                                <td><?php echo $row['pesoncont'];?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">เบอร์โทรศัพท์ :</th>
                                                <td><?php echo $row['telephone'];?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <br>
                                    
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <br><br><br>
                                <!-- <div class ="text-center">
                                    <button type="button" class="btn btn-lg btn-success btn-oval btn-block approve">อนุมัต</button>
                                    <button type="button" class="btn btn-lg btn-danger btn-oval btn-block not-approve">ไม่อนุมัต</button>
                                </div> -->
                                <div class="topic">ผู้ที่ส่งกลั่นสถานประกอบการนี้</div>
                                <br>
                                <table class="table-bordered" style="width:100%">
                                    <thead class="thead-light">
                                        <tr>
                                            <th class ="text-center">ส่งครั้งที่</th>
                                            <th class ="text-center">ชื่อ</th>
                                            <th class ="text-center">สาขาวิชา</th>
                                            <th class ="text-center">สถานะ</th>
                                        </tr>
                                    </thead>
                                    <tbody>                           
                                    <?php
                                        $std=$row['stdID'];
                                        $companyID=$row['companyID'];
                                        $sql = "SELECT * FROM stdklankrong LEFT JOIN student_data 
                                                ON stdklankrong.stdID = student_data.stdID 
                                                WHERE stdklankrong.semesterID=$semesterID 
                                                AND stdklankrong.companyID = $companyID 
                                                ORDER BY stdklankrong.stdID, klankrongID"; //ORDER BY สำคัญ เพื่อนับจำนวนครั้ง ตามลำดับ
                                        $result2=mysqli_query($conn,$sql)or die(mysqli_error($conn));
                                        if($result2->num_rows >1){  
                                            $count=1;
                                            $sdid='';
                                            while($row2 = mysqli_fetch_array($result2,MYSQLI_ASSOC)){
                                                if ($row2['klankrongID']==$klankrongID) {
                                                    echo '<tr class="table-active">';
                                                }else {
                                                    echo '<tr>';
                                                }
                                                if ($row2['stdID']==$sdid) {
                                                    $count++;
                                                }else {
                                                    $count=1;
                                                }
                                                //ตรวจ กลั่นกรองที่ส่งมา เป็นครั้งที่เท่าไหร่ รวมถึง กรณีมี่หลายครั้ง แต่ละครั้งเป็นของครั้งที่เท่าไหร่
                                                // $xsql = "SELECT klankrongID FROM `stdklankrong` WHERE stdID=".$row2['stdID'];
                                                // $xresult=mysqli_query($conn,$xsql)or die(mysqli_error($conn));
                                                // if($xresult->num_rows > 0){
                                                //     $i=1;  
                                                //     while($xrow = mysqli_fetch_array($xresult,MYSQLI_ASSOC)){
                                                //         if ( $xrow['klankrongID'] ==$row2['klankrongID']) {
                                                //             echo '<td>'.$i.'</td>';
                                                //         }  
                                                //         $i++;
                                                //     }
                                                // }
                                                echo '<td>'.$count.'</td>';
                                                echo '<td>';
                                                if ($row2['majorID']==1) {
                                                    echo ' <a href="staff-klankrongsend.php?klankrongID='.$row2['klankrongID'].'">'.$row2['stdFirstname'].' '.$row2['stdLastname'].'</a></td>';
                                                    echo '<td>ICM</td>';
                                                    if ($row2['approve']=='yes') {
                                                        $approve=' class="text-success">ผ่าน';
                                                    }else if ($row2['approve']=='no') {
                                                        $approve=' class="text-danger">ไม่ผ่าน';
                                                    }else if ($row2['approve']=='waiting') {
                                                        $approve=' class="text-primary">รอ';
                                                    }
                                                    echo '<td '.$approve.'</td>';
                                                    echo '</tr>';
                                                }else if ($row2['majorID']==2) {
                                                    echo ' <a href="staff-klankrongsend.php?klankrongID='.$row2['klankrongID'].'">'.$row2['stdFirstname'].' '.$row2['stdLastname'].'</a></td>';
                                                    echo '<td>ECM</td>';
                                                    if ($row2['approve']=='yes') {
                                                        $approve=' class="text-success">ผ่าน';
                                                    }else if ($row2['approve']=='no') {
                                                        $approve=' class="text-danger">ไม่ผ่าน';
                                                    }else if ($row2['approve']=='waiting') {
                                                        $approve=' class="text-primary">รอ';
                                                    }
                                                    echo '<td '.$approve.'</td>';
                                                    echo '</tr>';
                                                }
                                                
                                                $sdid=$row2['stdID'] ;   
                                            }
                                        }else {
                                            echo '<tr><td colspan="3" class ="text-center text-danger">ยังไม่มีผู้ส่งกลั่นกรองที่นี่</td></tr>';
                                        }
                                    ?>
                                    </tbody>    
                                </table>
                            </div>
                        </div>
                        <?php
                                    }
                                }
                        ?>
                        
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
        <script src="js/klankrong-app.js"></script>
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