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
      $boardID=$row["boardID"];
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@7.29.1/dist/sweetalert2.min.css">
    <link rel="stylesheet" type="text/css" href="css/animate.css">
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
                                <span class="name"><?php echo $boardName;?> </span>
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
                    <?php
                        //ตรวจสอบสิทธิของคณะกรรมการว่ามีสิทธื์จัดการข้อมูลไหม
                        $sql = "SELECT * FROM `boardright` WHERE boardID = $boardID AND semesterID = $semesterID";
                        $result = $conn->query($sql);
                        if($result->num_rows > 0){
                    ?>
                    <nav class="menu">
                        <ul class="sidebar-menu metismenu" id="sidebar-menu">
                            <li class="active">
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
                            <li>
                                <a href="board-progress.php">
                                    <i class="fa fa-tasks"></i> ความคืบหน้าการส่งเอกสาร </a>
                            </li>
                        </ul>
                    </nav>
                    <?php
                        }else {
                    ?>
                    <nav class="menu">
                        <ul class="sidebar-menu metismenu" id="sidebar-menu">
                            <li class="active">
                                <a href="board-dashboard.php">
                                    <i class="fa fa-home"></i> Dashboard </a>
                            </li>
                            <li>
                                <a href="#"class="linkdiseble">
                                    <i class="fa fa-database"></i> ฐานข้อมูลสถานประกอบการ </a>
                            </li>
                            <li>
                                <a href="#"class="linkdiseble">
                                    <i class="fa fa-th-large"></i> จัดการข้อมูล <i class="fa arrow"></i>
                                </a>
                                <ul class="sidebar-nav">
                                    <li>
                                        <a href="#"class="linkdiseble"> ข้อมูลนักศึกษา </a>
                                    </li>
                                    <li>
                                        <a href="#"class="linkdiseble"> ข้อมูลคณะกรรมการ </a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#"class="linkdiseble">
                                    <i class="fa fa-pencil-square-o"></i> ตรวจสอบคุณสมบัตินักศึกษา </a>
                            </li>
                            <li>
                                <a href="#"class="linkdiseble">
                                    <i class="fa fa-building-o"></i> จัดการสถานประกอบการ <i class="fa arrow"></i>
                                </a>
                                <ul class="sidebar-nav">
                                    <li>
                                        <a href="#"class="linkdiseble"> เปิดจองสถานประกอบการ </a>
                                    </li>
                                    <li>
                                        <a href="#"class="linkdiseble"> การจองสถานประกอบการของนักศึกษา </a>
                                    </li>
                                    <li>
                                        <a href="#"class="linkdiseble"> ยกเลิกการจองสถานประกอบการ </a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#"class="linkdiseble">
                                    <i class="fa fa-filter"></i> กลั่นกรองสถานประกอบการ </a>
                            </li>
                            <li>
                                <a href="#"class="linkdiseble">
                                    <i class="fa fa-print"></i> ออกรายงานผู้ผ่านการกลั่นกรอง </a>
                            </li>
                            <li>
                                <a href="#"class="linkdiseble">
                                    <i class="fa fa-tasks"></i> ความคืบหน้าการส่งเอกสาร </a>
                            </li>
                        </ul>
                    </nav>
                    <?php
                        }
                    ?>
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
            <article class="content board-dashboard-page">
                <section class="section">
                    <!-- Breadcrumbs-->
                    <div class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="#">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">My Dashboard</li>
                    </div>
                    <!-- Icon Cards-->
                    <!--  Bar Chart Card-->
                    <div class="card mb-3">
                        <div class="card-header">
                            <i class="fa fa-bar-chart"></i> ข้อมูลนักศึกษาที่ลงฝึกงานตามสาขาวิชา
                            <form class="float-right ml-auto form-inline">
                                <span id="stdterm">ปีการศึกษา &nbsp;
                                    <select class="form-control xs-4">
                                    <?php
                                        include('conn_mysql.php');
                                        $sql="SELECT*FROM semester";
                                        $result=mysqli_query($conn,$sql)or die("Query failed");
                                        if(mysqli_num_rows($result)>0){
                                            while($row=mysqli_fetch_assoc($result)){
                                                echo '<option value="'.$row["semesterID"].'"' ;
                                                if ($row["semesterID"] == $semesterID) {
                                                    echo ' selected="selected"';
                                                }
                                                echo '>'.$row["year"].'/'.$row["term"].'</option>';
                                            }
                                        }
                                        
                                    ?>
                                    </select>
                                </span>&nbsp; &nbsp;
                                <span id="stdmajor">สาขาวิชา &nbsp;
                                    <select class="form-control xs-4">
                                    <option value="all" selected="selected">ทั้งหมด</option>
                                    <?php
                                        $sql="SELECT*FROM major";
                                        $result=mysqli_query($conn,$sql)or die("Query failed");
                                        if(mysqli_num_rows($result)>0){
                                            while($row=mysqli_fetch_assoc($result)){
                                                echo '<option value="'.$row["majorID"].'">'.$row["major"].'</option>';
                                            }
                                        }
                                        
                                    ?>
                                    </select>
                                </span>&nbsp;&nbsp;
                                <!-- <button type="button" class="btn btn-success" id="btn-show">แสดง</button> -->
                            </form>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12 my-auto">
                                    <div id="container" style="height: 400px"></div>
                                    <canvas id="myBarChart" width="100%" height="40"></canvas>
                                </div>
                                <!-- <div class="col-sm-2 text-center my-auto">
                                <div class="h4 mb-0 text-primary">693</div>
                                <div class="small text-muted">จำนวนนักศึกษาฝึกงานทั้งหมด</div>
                                </div> -->
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
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/offline-exporting.js"></script>
    <script src="https://code.highcharts.com/highcharts-3d.js"></script>
    <script>
        $(document).ready(function () {
            var smesterID = $("#stdterm select").val()
            var majorID = $("#stdmajor select").val()
            console.log(smesterID + "-" + majorID);
            $.ajax({
                url: 'getgrafdata.php',
                type: 'POST',
                data: { smesterID,majorID },
                dataType: "json",
                success: function (response) {
                    console.log(response);
                    console.log(eval(response.join("+")));
                    var total=eval(response.join("+"));
                    console.log(total);
                    
                    $('#totalstd').html(total)
                    graph(response)
                
                
                }
            });
            
            $('select').change(function () {
                var smesterID = $("#stdterm select").val()
                var majorID = $("#stdmajor select").val()
                console.log(smesterID + "-" + majorID);
                $.ajax({
                    url: 'getgrafdata.php',
                    type: 'POST',
                    data: { smesterID,majorID },
                    dataType: "json",
                    success: function (response) {
                        console.log(response);
                        console.log(eval(response.join("+")));                    
                        var total=eval(response.join("+"));
                        console.log(total);
                        $('#totalstd').html(total)
                    graph(response)
                
                        graph(response)
                    
                    
                    }
                });
            });
            function graph(data) {
                Highcharts.chart('container', {
                exporting: {
                    chartOptions: { // specific options for the exported image
                    plotOptions: {
                        series: {
                        dataLabels: {
                            enabled: true
                        }
                        }
                    }
                    },
                    fallbackToExportServer: false
                },
                chart: {
                    type: 'bar',
                },
                title: {
                    text: ''
                },
                xAxis: {
                    categories: ["รอการกลั่นกรอง", "ไม่ผ่านการกลั่นกรอง", "ผ่านการกลั่นกรอง", "รอการตรวจสอบคุณสมบัติ", "ผ่านบคุณสมบัติ", "รอการตอบรับ", "ตอบปฎิเสธ", "ตอบรับแล้ว"],
                    labels: {
                    // rotation: -45,
                        style: {
                            fontSize: '13px',
                            fontFamily: 'Verdana, sans-serif'
                        }
                    }
                },

                plotOptions: {
                    bar:{
                        pointWidth:30,
                    },
                    series: {
                    colorByPoint: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true
                    },
                    point: {
                        events: {
                            <?php
                                //ตรวจสอบสิทธิของคณะกรรมการว่ามีสิทธื์จัดการข้อมูลไหม
                                $sql = "SELECT * FROM `boardright` WHERE boardID = $boardID AND semesterID = $semesterID";
                                $result = $conn->query($sql);
                                if($result->num_rows > 0){
                            ?>
                            click: function () {
                                if (this.category === 'รอการกลั่นกรอง') {
                                location.href='board-klankrong-waiting.php';
                                }else if(this.category === 'ไม่ผ่านการกลั่นกรอง'){
                                location.href='board-klankrong-notaprrove.php';
                                }else if(this.category === 'ผ่านการกลั่นกรอง'){
                                location.href='board-klankrong-aprrove.php';
                                }else if(this.category === 'รอการตรวจสอบคุณสมบัติ'){
                                location.href='board-qualify.php';
                                }else if(this.category === 'ผ่านบคุณสมบัติ'){
                                location.href='board-qualify.php';
                                }else if(this.category === 'รอการตอบรับ'){
                                location.href='board-progress.php';
                                }else if(this.category === 'ตอบปฎิเสธ'){
                                location.href='board-progress.php';
                                }
                                else {
                                    location.href='board-progress.php';
                                }

                            }
                            <?php }else {?>
                            click: function () {
                                swal({
                                    title: 'คุณไม่ได้รับสิทธิ์จัดการข้อมูล',
                                    text: "กรุณาติดต่อ Admin",
                                    animation: false,
                                    customClass: 'animated tada'
                                })
                            }
                            <?php }?>
                        }
                    }
                    }
                },

                series: [{
                    data: data
                }]
                });

            }

            function getdata(params) {
                var dt
                if (params == "2559/3") {
                dt = [129, 144, 176, 135, 148, 29, 71, 100];
                } else if (params == "2560/3") {
                dt = [144, 176, 135, 148, 29, 71, 106, 129,];
                } else if (params == "2561/3") {
                dt = [129, 144, 176, 135, 148, 29, 71, 106];
                }
                return dt
            }

            $('.linkdiseble').click(function () {
                swal({
                    title: 'คุณไม่ได้รับสิทธิ์จัดการข้อมูล',
                    text: "กรุณาติดต่อ Admin",
                    animation: false,
                    customClass: 'animated tada'
                })
            });
        });
    </script>
</body>

</html>