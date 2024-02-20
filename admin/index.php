<?php
include('./head.php');

$menu = "dash";

$sql = "SELECT thesis_id,thesis_status FROM thesis WHERE thesis_status = '0'";

//นับจำนวน ปริญญานิพนธ์
$sql_script1 = "SELECT thesis_id,thesis_status FROM thesis";
$result1 = mysqli_query($conn, $sql_script1) or die(mysqli_connect_error());
$thesis_all = mysqli_num_rows($result1);

$sql_script2 = "SELECT thesis_id,thesis_status FROM thesis WHERE thesis_status = '0'";
$result2 = mysqli_query($conn, $sql_script2) or die(mysqli_connect_error());
$thesis_waitconfirm = mysqli_num_rows($result2);

$sql_script3 = "SELECT thesis_id,thesis_status FROM thesis WHERE thesis_status = '1'";
$result3 = mysqli_query($conn, $sql_script3) or die(mysqli_connect_error());
$thesis_confirm = mysqli_num_rows($result3);

$sql_script4 = "SELECT thesis_id,thesis_status FROM thesis WHERE thesis_status = '2'";
$result4 = mysqli_query($conn, $sql_script4) or die(mysqli_connect_error());
$thesis_notconfirm = mysqli_num_rows($result4);


//นับยอดวิวปริญญานิพนธ์
$sql_view_thesis = "SELECT SUM(thesis_view) as all_view FROM thesis";
$result1_view_thesis = mysqli_query($conn, $sql_view_thesis);
$view_thesis = mysqli_fetch_assoc($result1_view_thesis);


$sql_news = "SELECT * FROM news";
$result_news = mysqli_query($conn, $sql_news) or die(mysqli_connect_error());
$news_count = mysqli_num_rows($result_news);

$sql_news1 = "SELECT * FROM news WHERE news_status ='1'";
$result_news1 = mysqli_query($conn, $sql_news1) or die(mysqli_connect_error());
$news_count_show = mysqli_num_rows($result_news1);

$sql_counter = "SELECT * FROM web_counter";
$result_counter = mysqli_query($conn, $sql_counter) or die(mysqli_connect_error());
$counter_web = mysqli_num_rows($result_counter);

//สมาชิก
$sql_members = "SELECT * FROM members";
$result_members = mysqli_query($conn, $sql_members) or die(mysqli_connect_error());
$check_members = mysqli_num_rows($result_members);

//สมาชิก
$sql_advisor = "SELECT * FROM advisor";
$result_advisor = mysqli_query($conn, $sql_advisor) or die(mysqli_connect_error());
$check_advisor = mysqli_num_rows($result_advisor);

?>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            <?php
            include('./sidebar.php');
            ?>

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->

                <?php
                include('./navbar.php')
                ?>

                <div class="content-wrapper">
                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">

                        <div class="row">
                            <div class="col-lg-8 col-md-12 order-1">
                                <div class="row">

                                    <div class="col-lg-12 col-md-12 col-12 mb-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
                                                    <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                                                        <div class="card-title">
                                                            <h5 class="text-nowrap mb-2">ยินดีต้อนรับ !</h5>
                                                            <span class="badge bg-label-warning rounded-pill"><?php echo $_SESSION['fname'] . "    " . $_SESSION['lname'] ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12 col-12 mb-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="card-title d-flex align-items-start justify-content-between">
                                                    <div class="avatar flex-shrink-0">
                                                        <i class='bx bx-news text-info h2'></i>                                                        
                                                    </div>
                                                    <small><a href="./mgmt_members.php">ดูเพิ่มเติม</a></small>
                                                </div>
                                                <span class="fw-medium d-block mb-1">ข่าวประชาพันธ์</span>
                                                ทั้งหมด <a class="card-title mb-2 h3"><?= $news_count ?></a> เรื่อง /
                                                แสดง <a class="card-title mb-2 h3"><?= $news_count_show ?></a> เรื่อง
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-12 mb-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="card-title d-flex align-items-start justify-content-between">
                                                    <div class="avatar flex-shrink-0">
                                                        <i class='bx bx-user text-danger h2'></i>
                                                    </div>
                                                    <small><a href="./mgmt_members.php">ดูเพิ่มเติม</a></small>
                                                </div>
                                                <span class="fw-medium d-block mb-1">สมาชิก</span>
                                                <a class="card-title mb-2 h3"><?= $check_members ?></a> คน

                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-12 mb-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="card-title d-flex align-items-start justify-content-between">
                                                    <div class="avatar flex-shrink-0">
                                                        <i class='bx bx-user-voice text-info h2'></i>
                                                    </div>
                                                    <small><a href="./mgmt_members.php">ดูเพิ่มเติม</a></small>
                                                </div>
                                                <span class="fw-medium d-block mb-1">ที่ปรึกษา</span>
                                                <a class="card-title mb-2 h3"><?= $check_advisor ?></a> คน

                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-12 mb-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="card-title d-flex align-items-start justify-content-between">
                                                    <div class="avatar flex-shrink-0">
                                                        <i class='bx bx-world text-success h2'></i>
                                                    </div>
                                                   
                                                </div>
                                                <span class="fw-medium d-block mb-1">ยอดเข้าชมเว็บไซต์</span>
                                                <a class="card-title mb-2 h3"><?= $counter_web ?></a> ครั้ง
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12 mb-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="card-title d-flex align-items-start justify-content-between">
                                                    <div class="avatar flex-shrink-0">
                                                        <i class='bx bxs-book-reader text-warning h2' ></i>
                                                    </div>
                                                </div>
                                                <span class="fw-medium d-block mb-1">ยอดเข้าชมปริญานิพนธ์</span>
                                                <a class="card-title mb-2 h3"><?= $view_thesis['all_view']; ?></a> ครั้ง
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <!--/ Total Revenue -->
                            <div class="col-lg-4 col-md-12 col-12 order-2">
                                <div class="row">

                                    <div class="col-lg-12 col-md-12 col-lg-4 order-2 mb-4">
                                        <div class="card h-100">
                                            <div class="card-header d-flex align-items-center justify-content-between">
                                                <i class='bx bxs-book-bookmark text-warning h2'></i>
                                                <small class="me-2 h4">ปริญญานิพนธ์</small>
                                            </div>
                                            <div class="card-body">
                                                <ul class="ps-3 m-0">
                                                    <!--รายงาน 1 -->
                                                    <li class="d-flex mb-4 pb-1">
                                                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                            <div class="me-2">
                                                                <a class="mb-0" href="mgmt_research.php?showstatus=all">ปริญญานิพนธ์ทั้งหมด</a>
                                                            </div>
                                                            <div class="user-progress d-flex align-items-center gap-1">
                                                                <span class="badge rounded-pill bg-label-danger"><?php echo $thesis_all ?></span>

                                                            </div>
                                                        </div>
                                                    </li>

                                                    <!--รายงาน 1 -->
                                                    <li class="d-flex mb-4 pb-1">
                                                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                            <div class="me-2">
                                                                <a class="mb-0" href="mgmt_research.php?showstatus=confirm">ปริญญานิพนธ์ที่ยืนยันแล้ว</a>
                                                            </div>
                                                            <div class="user-progress d-flex align-items-center gap-1">
                                                                <span class="badge rounded-pill bg-label-danger"><?php echo $thesis_confirm ?></span>
                                                            </div>
                                                        </div>
                                                    </li>

                                                    <!--รายงาน 1 -->
                                                    <li class="d-flex mb-4 pb-1">
                                                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                            <div class="me-2">
                                                                <a class="mb-0" href="mgmt_research.php?showstatus=waitconfirm">ปริญญานิพนธ์ที่รอยืนยัน</a>
                                                            </div>
                                                            <div class="user-progress d-flex align-items-center gap-1">
                                                                <span class="badge rounded-pill bg-label-danger"><?php echo $thesis_waitconfirm ?></span>

                                                            </div>
                                                        </div>
                                                    </li>

                                                    <!--รายงาน 1 -->
                                                    <li class="d-flex mb-4 pb-1">
                                                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                            <div class="me-2">
                                                                <a class="mb-0" href="mgmt_research.php?showstatus=notconfirm">ปริญญานิพนธ์ที่ไม่ได้รับการยืนยัน</a>
                                                            </div>
                                                            <div class="user-progress d-flex align-items-center gap-1">
                                                                <span class="badge rounded-pill bg-label-danger"><?php echo $thesis_notconfirm ?></span>

                                                            </div>
                                                        </div>
                                                    </li>



                                                </ul>
                                            </div>
                                        </div>
                                    </div>


                                </div>

                            </div>
                            <!-- / Content -->


                        </div>
                 
                  


                    </div>
                    <?php
                    include('./footer.php');
                    ?>

                    <!-- Content wrapper -->
                </div>
                <!-- / Layout page -->
            </div>

            <!-- Overlay -->
            <div class="layout-overlay layout-menu-toggle"></div>
        </div>
        <!-- / Layout wrapper -->
        <?php
        include('./script.php');
        ?>

</body>

</html>