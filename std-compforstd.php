<?php
    /**
     * เปิดใช้งาน Session
     */
    session_start();
    if ($_SESSION['userID']=="") {
        header("Location: login.php");
    }
    $semesterID= $_SESSION['semesterID'];
    require_once('conn_mysql.php');
    $sql = "SELECT * FROM `student_data` WHERE `userID` = '".$_SESSION['userID']."'";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
      $row = $result->fetch_assoc();
      $stdID=$row["stdID"];
      $stdMajor=$row["majorID"];
      $stdSemester=$row["semesterID"];
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
    <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@7.29.1/dist/sweetalert2.min.css">
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
                            <li class="active open">
                                <a href="">
                                    <i class="fa fa-building-o"></i> สถานประกอบการ <i class="fa arrow"></i>
                                </a>
                                <ul class="sidebar-nav">
                                    <li class="active">
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
                            <li>
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
                            <a href=""><i class="fa fa-cog"></i> Customize </a>
                        </li>
                    </ul>
                </footer>
            </aside>
            <div class="sidebar-overlay" id="sidebar-overlay"></div>
            <div class="sidebar-mobile-menu-handle" id="sidebar-mobile-menu-handle"></div>
            <div class="mobile-menu-handle"></div>
            <article class="content std-compforstd-page">
                <section class="section">
                    <!-- Breadcrumbs-->
                    <?php
                        $sql = "SELECT * FROM company,booked WHERE company.companyID=booked.companyID and booked.stdID=".$stdID;
                        $result = $conn->query($sql);
                        if($result->num_rows > 0){
                            $row2 = $result->fetch_assoc();
                            $bookedID=$row2['bookedID'] ;
                            $companyID = $row2['companyID'];
                            $companyName = $row2['companyName'];
                            $companyAddr= $row2['companyAddress']." ต. ".$row2['companyTambol']." อ. ".$row2['companyAmpo']." จ. ".$row2['companyChangwat']." รหัสไปรษย์ณี ".$row2['companyZipCode'];
                            $booked = 1;
                            $bookingDateTime= '<b>วันที่จอง : </b>'.$row2['bookingDate'].' <b>เวลา : </b>'.$row2['bookingTime'];
                            $query = "SELECT * FROM cancelbooking Where stdID=$stdID";
                            $rs = $conn->query($query);
                            if($rs->num_rows > 0){
                                $btnCancel='<button type="button" class="btn btn-info btn-lg" disabled>กำลังรอดำเนินการยกเลิก...</button>';
                            }else{
                                $btnCancel='<button type="button" class="btn btn-oval btn-block btn-danger" data-toggle="modal" data-target="#cancelReason">ยกเลิก</button>';
                            }
                        }else {
                            $companyName = '<p class="text-danger">ยังไม่มีข้อมูล</p></li>';
                            $companyAddr="";
                            $bookingDateTime= '';
                            $booked = 0;
                            $btnCancel='';
                        }
                    ?>
                    <div class="card text-left  card-primary">
                        <div class="card-header text-white">
                            สถานประกอบการของคุณ
                        </div>
                        <div class="card-body row">
                            <div class="col-9">
                                <h5 class="card-title">
                                    <?php echo $companyName;?>
                                </h5>
                                <p class="card-text">
                                    <?php echo $companyAddr;?>
                                </p>

                            </div>
                            <div class="col-3">
                                <?php
                                if ($semesterID==$stdSemester) { 
                                    echo $btnCancel;
                                }else{
                                    echo '<button type="button" class="btn btn-oval btn-block btn-danger" disabled>ไม่อยู่ในช่วงเวลาดำเนินการ</button>';
                                }
                                ?>
                            </div>
                        </div>
                        <div class="card-footer text-muted">
                            <?php echo $bookingDateTime;?>
                        </div>
                    </div>
                    <br>
                    <!-- ตารางสถานประกอบการที่เปิดให้นักศึกษาจอง-->
                    <div class="card mb-3">
                        <div class="card-header">
                            <i class="fa fa-table"></i> ตารางสถานประกอบการที่เปิดให้นักศึกษาจอง
                            <h4 class="text-center ml-auto"><i class='fa fa-user text-danger'></i> = จองแล้ว
                            <i class='fa fa-user text-success'></i> = ว่าง</h4>
                        </div>
                        
                        
                        <div class="card-body">
                            <div class="table-responsive">

                                <?php
                                $major= $_SESSION['majorID'];
                                $sql="SELECT*FROM booking LEFT JOIN  company ON booking.companyID = company.companyID WHERE booking.majorID =  $stdMajor AND semesterID = $stdSemester";
                                $result=mysqli_query($conn,$sql)or die("Query failed");
                                
                                if(mysqli_num_rows($result)>0){
                                    print'<table class="table table-bordered" id="bookingTable" width="100%" cellspacing="0">';
                                    echo"<thead>
                                    <tr style='font-size: 90%' class='text-center'>
                                        <th>ชื่อสถานประกอบการ</th>
                                        <th>ที่อยู่</th>
                                        <th>จังหวัด</th>
                                        <th style=\"width: 10%\">ที่ว่าง</th>
                                        <th style=\"width: 8%\">ผู้จอง</th>
                                        <th>การจอง</th>
                                    </tr>
                                    </thead>";
                                    while($row=mysqli_fetch_assoc($result)){
                                        $remain="";
                                        $reserved="";
                                        for ($i=0; $i < $row["reserved"]; $i++) { 
                                            $reserved .= "<i class='fa fa-user text-danger'>";
                                        }
                                        $remainNum=$row["setQuota"]-$row["reserved"];
                                        for ($i=0; $i < $remainNum; $i++) { 
                                            $remain .= "<i class='fa fa-user text-success'>";
                                        }
                                        print'<tr style="font-size: 90%">';
                                        echo'<td><b>'.$row["companyName"].'</b></td>';
                                        echo'<td><b>'.$row["companyAddress"].'</b> แขวง/ตำบล <b>'.$row["companyTambol"].'</b> เขต/อำเภอ <b>'.$row["companyAmpo"].'</b> จังหวัด <b>'.$row["companyChangwat"].'</b> รหัสไปรษย์ณี <b>'.$row["companyZipCode"].'</b></td>';
                                        echo'<td>'.$row["companyChangwat"].'</td>';
                                        echo"<td><h3>$reserved$remain</h3></td>";
                                        echo '<td class="details-control text-center" booking-id="'.$row["openBookingID"].'"><button type="button" class="btn btn-primary btn-oval waves-effect waves-light"
                                                data-toggle="tooltip" data-placement="top" title="ดู">
                                                <i class="fa fa-eye"></i>
                                                </button></td>';
                                        if ($semesterID==$stdSemester) {
                                            if ($booked == 0) {
                                                if($row["reserved"]==$row["setQuota"] ){
                                                    echo"<td><button type=\"button\" class=\"btn  btn-secondary btn-block \" disabled>เต็ม</button></td>";
                                                }else{
                                                    echo'<td><button type="button" class="btn btn-success btn-block booking"data-id="'.$row["companyID"].'" data-openbookingid ="'.$row["openBookingID"].'" data-stdID="'.$stdID.'">จอง</button></td>';
                                                }
                                            }else {
                                                echo"<td><button type=\"button\" class=\"btn  btn-secondary btn-block \" disabled>ปิดจอง</button></td>";
                                            }  
                                        }else {
                                            echo "<td><button type=\"button\" class=\"btn  btn-secondary btn-block \" disabled>ไม่อยู่ในช่วง<br>การจอง</button></td>";
                                        }        
                                        
                                        print"\t</tr>";
                                    }
                                }else{
                                    echo"0 results";
                                }
                                print"</table>";
                                echo"จำนวนข้อมูลทั้งหมด : ",mysqli_num_rows($result),"รายการ<br>";
                                
                                
                                mysqli_free_result($result);
                                mysqli_close($conn);
                                ?>

                            </div>
                        </div>
                        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
                    </div>
                </section>
            </article>
            <footer class="footer">
                <div class="footer-block buttons">
                    <div class="footer-copyright"> Copyright <i class="fa fa-copyright"></i> ICM PROJECT PSU TRANG 2018
                    </div>
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
            <!-- reason cancel modal -->
            <div class="modal fade" id="cancelReason" tabindex="-1" role="dialog" aria-labelledby="cancelReasonLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="cancelReasonLabel">เหตุผลที่ต้องการยกเลิก</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form onsubmit="return false">
                        <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-md-12">
                            <p>ชื่อสถานประกอบการ : <?php echo $companyName;?></p>
                            <textarea class="form-control" name="reason" id="reason" cols="100" rows="7"required ></textarea>
                            </div>
                        </div>
                        </div>
                        <div class="modal-footer">
                        <button class="btn btn-secondary" id="btnreset" type="reset">Cancel</button>
                        <button id="btnSubmitCancel" type="submit" booked-id="<?php echo $bookedID;?>" std-id="<?php echo $stdID;?>"data-companyID=" <?php echo $companyID;?>" class="btn btn-danger">ส่ง</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
            <!-- Logout Modal-->
            <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel"
                aria-hidden="true">
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
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.29.1/dist/sweetalert2.min.js"></script>
    <script src="js/datatables.js"></script>
    <script src="js/comforstd-table.js"></script>
</body>

</html>