<?php
include('./head.php');

$menu = "dash";


$sql = "SELECT thesis_id,thesis_status FROM thesis WHERE thesis_status = '0'";

$who_ids = $_SESSION['member_id'];
//นับจำนวน ปริญญานิพนธ์
$sql_script1 = "SELECT thesis_id,thesis_status FROM thesis WHERE (m_id = $who_ids)";
$result1 = mysqli_query($conn, $sql_script1) or die(mysqli_connect_error());
$thesis_all = mysqli_num_rows($result1);

$sql_script2 = "SELECT thesis_id,thesis_status FROM thesis WHERE thesis_status = '0' AND (m_id = $who_ids)";
$result2 = mysqli_query($conn, $sql_script2) or die(mysqli_connect_error());
$thesis_waitconfirm = mysqli_num_rows($result2);

$sql_script3 = "SELECT thesis_id,thesis_status FROM thesis WHERE thesis_status = '1' AND (m_id = $who_ids)";
$result3 = mysqli_query($conn, $sql_script3) or die(mysqli_connect_error());
$thesis_confirm = mysqli_num_rows($result3);

$sql_script4 = "SELECT thesis_id,thesis_status FROM thesis WHERE thesis_status = '2' AND (m_id = $who_ids)";
$result4 = mysqli_query($conn, $sql_script4) or die(mysqli_connect_error());
$thesis_notconfirm = mysqli_num_rows($result4);



$sql_view_thesis = "SELECT SUM(thesis_view) as all_view FROM thesis WHERE m_id = $who_ids";
$result1_view_thesis = mysqli_query($conn, $sql_view_thesis);

if (mysqli_num_rows($result1_view_thesis) > 0) {
    $view_thesis = mysqli_fetch_assoc($result1_view_thesis);
    // ทำสิ่งที่ต้องการเมื่อมีข้อมูล
} else {
    echo "ไม่มีงานวิจัย";
}


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


                                    <div class="col-lg-6 col-md-6 col-12 mb-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="card-title d-flex align-items-start justify-content-between">
                                                    <div class="avatar flex-shrink-0">
                                                        <i class='bx bxs-book-reader text-warning h2'></i>
                                                    </div>
                                                </div>
                                                <span class="fw-medium d-block mb-1">ยอดเข้าชมปริญานิพนธ์</span>
                                                <?php
                                                if (isset($view_thesis['all_view'])) {
                                                    echo '<a class="card-title mb-2 h3">' . $view_thesis['all_view'] . ' ครั้ง</a>';
                                                } else {
                                                    echo "ยังไม่มีงานวิจัย";
                                                }
                                                ?>
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