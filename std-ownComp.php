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
      $stdphoto=$row['stdPhoto'];
      $stdMajor=$row["majorID"];
      $stdSemester=$row["semesterID"];
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
    <link rel="stylesheet" href="./jquery.Thailand.js/dist/jquery.Thailand.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@7.29.1/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="css/modalcheckedstyle.css">
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
                                    <li>
                                        <a href="std-compforstd.php"> จองสถานประกอบการ </a>
                                    </li>
                                    <li class="active">
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
                            <a href="">
                                <i class="fa fa-cog"></i> Customize </a>
                        </li>
                    </ul>
                </footer>
            </aside>
            <div class="sidebar-overlay" id="sidebar-overlay"></div>
            <div class="sidebar-mobile-menu-handle" id="sidebar-mobile-menu-handle"></div>
            <div class="mobile-menu-handle"></div>
            <article class="content std-ownComp-page">
                <section class="section">
                    <!-- Breadcrumbs-->
                    <div class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="#">สถานประกอบการ</a>
                        </li>
                        <li class="breadcrumb-item active">สถานประกอบการที่หาเอง</li>
                    </div>
                    <?php
                        $sql = "SELECT * FROM company,booked WHERE company.companyID=booked.companyID and booked.stdID=".$stdID;
                        $result = $conn->query($sql);
                        if($result->num_rows > 0){
                            $row2 = $result->fetch_assoc();
                            $bookedID=$row2['bookedID'] ;
                            $companyID = $row2['companyID'];
                            $companyName = $row2['companyName'];
                            $companyAddr= $row2['companyAddress']." ต. ".$row2['companyTambol']." อ. ".$row2['companyAmpo']." จ. ".$row2['companyChangwat']." รหัสไปรษย์ณี ".$row2['companyZipCode'];
                            $bookingDateTime= '<b>วันที่จอง : </b>'.$row2['bookingDate'].' <b>เวลา : </b>'.$row2['bookingTime'];
                            $query = "SELECT * FROM cancelbooking Where stdID=$stdID";
                            $rs = $conn->query($query);
                            if($rs->num_rows > 0){
                                $btnCancel='<button type="button" class="btn btn-info btn-lg" disabled>กำลังรอดำเนินการยกเลิก...</button>';
                            }else{
                                $btnCancel='<button type="button" class="btn btn-oval btn-block btn-danger" data-toggle="modal" data-target="#cancelReason">ยกเลิก</button>';
                            }
                            // $btnCancel='<a href="#" class="btn btn-primary">ยกเลิก</a>';
                            $btnAdd = "disabled>คุณมีสถานประกอบการแล้ว";
                        }else {
                            $companyName = '<p class="text-danger">ยังไม่มีข้อมูล</p></li>';
                            $companyAddr="";
                            $bookingDateTime="";
                            $btnCancel='';
                            $btnAdd = ">เพิ่มสถานประกอบการ";
                        }

                    ?>
                    <div class="card text-left card-primary">
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
                    <div class="col-md-12 text-center">
                        <?php echo '<button type="button" class="btn btn-primary" id="btn-insertowncomp"'.$btnAdd.'</button>'; ?>
                    </div>
                    <div class="card card-primary" id="card-insowncomp" style="display:none">
                        <div class="card-header text-white">
                            เพิ่มสถานประกอบการลงฐานข้อมูล
                        </div>
                        <div class="card-body">
                            <form class="form-horizontal autoaddr" id="insertform" onsubmit="return false">
                                <input type="hidden" name="studentID" id="studentID" value="<?php echo $stdID;?>">
                                <!-- ชื่อสถานประกอบการ-->
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label" for="companyName">ชื่อสถานประกอบการ</label>
                                    <div class="col-md-10 inputGroupContainer">
                                        <input id="companyName" name="companyName" type="text" class="form-control"
                                            required="true">
                                    </div>
                                </div>
                                <!-- ที่อยู่-->
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label" for="companyAddress">ที่อยู่</label>
                                    <div class="col-md-10">
                                        <input id="companyAddress" name="companyAddress" type="text" class="form-control"
                                            required="true">
                                    </div>
                                </div>
                                <!-- ตำบล อำเภอ จังหวัด-->
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label" for="companyTambol">ตำบล</label>
                                    <div class="col-md-4">
                                        <input id="companyTambol" name="district" type="text" class="form-control"
                                            required="true">
                                    </div>
                                    <label class="col-md-2 col-form-label text-right" for="companyAmpo">อำเภอ</label>
                                    <div class="col-md-4">
                                        <input id="companyAmpo" name="amphoe" type="text" class="form-control" required="true">
                                    </div>
                                </div>
                                <!-- รหัสไปรษณีย์-->
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label" for="companyChangwat">จังหวัด</label>
                                    <div class="col-md-4">
                                        <input id="companyChangwat" name="province" type="text" class="form-control"
                                            required="true">
                                    </div>
                                    <label class="col-md-2 col-form-label text-right" for="companyZipCode">รหัสไปรษณีย์</label>
                                    <div class="col-md-4">
                                        <input id="companyZipCode" name="zipcode" type="text" class="form-control"
                                            required="true">
                                    </div>
                                </div>
                                <!-- เบอร์โทร-->
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label" for="companyPhone">เบอร์โทร</label>
                                    <div class="col-md-10">
                                        <input id="companyPhone" name="companyPhonet" type="text" class="form-control"
                                            required="true">
                                    </div>
                                </div>
                                <hr>
                                <!-- หมายเหตุ -->
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label" for="compPhone">หมายเหตุ</label>
                                    <div class="col-md-10">
                                        <textarea class="form-control" name="note" id="note" cols="85" rows="3"
                                            required></textarea>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="reset" class="btn btn-info-outline closeModal">เคลียร์</button>
                                    <button type="submit" class="btn btn-primary submitCom" style="width:15%">บันทึก</button>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer">
                        </div>
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
            <!-- ตรวจสอบ การซ้ำกัน -->
            <div class="modal" id="showCompanyChecked" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-full" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">ตรวจสอบสถานประกอบการ</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body checkCom modal-checkhight" id="result">
                            <p>กรุณาตรวจสอบข้อมูลสถานประกอบว่าซ้ำกับที่มีอยู่หรือไม่</p>
                            <div class="row">
                                <table class="table table-bordered ">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">ชื่อสถานประกอบการ</th>
                                            <th scope="col">ที่อยู่</th>
                                            <th scope="col">เบอร์โทร</th>
                                        </tr>
                                    </thead>
                                    <tbody id="list-company"></tbody>
                                </table>
                                <div class="col text-center">
                                    <div class="taxt-margin">
                                        <b>ยืนยันการเพิ่มสถานประกอบการ ?</b>
                                    </div>
                                    <div class="btn-group col-3">
                                        <button type="button" class="btn btn-pill-left btn-success btn-block btnaddit">ยืนยัน</button>
                                        <button type="button" class="btn btn-pill-right btn-danger btn-block btndontaddit" data-dismiss="modal">ยกเลิก</button>
                                    </div>
                                    
                                </div>
                            
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- reason cancel -->
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.29.1/dist/sweetalert2.min.js"></script>
    <script type="text/javascript" src="./jquery.Thailand.js/dependencies/zip.js/zip.js"></script>
    <!-- / dependencies for zip mode -->

    <script type="text/javascript" src="./jquery.Thailand.js/dependencies/JQL.min.js"></script>
    <script type="text/javascript" src="./jquery.Thailand.js/dependencies/typeahead.bundle.js"></script>
    
    <script type="text/javascript" src="./jquery.Thailand.js/dist/jquery.Thailand.min.js"></script>
    <script src="js/owncomp-app.js"></script>
    <script type="text/javascript">
    // $.Thailand({
    //         database: './jquery.Thailand.js/database/db.json', 

    //         $district: $('.autoaddr [name="district"]'),
    //         $amphoe: $('.autoaddr [name="amphoe"]'),
    //         $province: $('.autoaddr [name="province"]'),
    //         $zipcode: $('.autoaddr [name="zipcode"]'),

    //         onDataFill: function(data){
    //             console.info('Data Filled', data);
    //         },

    //         // onLoad: function(){
    //         //     console.info('Autocomplete is ready!');
    //         //     $('#loader, .demo').toggle();
    //         // }
    //     });

        
    </script>
</body>

</html>