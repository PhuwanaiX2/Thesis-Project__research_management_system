<?php include('./head.php');
$menu = "news";
if (isset($_GET['id'])) {
    $thesis_id = isset($_GET['id']) ? mysqli_real_escape_string($conn, $_GET['id']) : '';

    // ... (rest of your code)


    // ค้นหาข้อมูลถ้ำ
    $select_sql = "SELECT * FROM news WHERE news_id = ? AND news_status != '0'";
    $select_stmt = mysqli_prepare($conn, $select_sql);

    if ($select_stmt) {
        mysqli_stmt_bind_param($select_stmt, "i", $thesis_id);
        mysqli_stmt_execute($select_stmt);
        $result = mysqli_stmt_get_result($select_stmt);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);

            //ยอดวิว
            $stmt_view = "UPDATE news SET news_view = news_view + 1 WHERE news_id = ?";
            $updateStmt = mysqli_prepare($conn, $stmt_view);

            if ($updateStmt) {
                mysqli_stmt_bind_param($updateStmt, "i", $thesis_id);
                mysqli_stmt_execute($updateStmt);
                mysqli_stmt_close($updateStmt);
            } else {
                echo "Error in preparing the update statement: " . mysqli_error($conn);
            }
?>

            <head>
                <style>
                    /* CSS สำหรับทำให้รูปภาพ responsive */
                    img {
                        max-width: 100%;
                        /* ให้รูปภาพปรับขนาดไม่เกินขนาดของคอลัมน์ */
                        height: auto;
                        /* ให้ความสูงของรูปภาพปรับตามอัตราส่วน */
                    }
                </style>

            </head>

            <body>
                <!-- Layout wrapper -->
                <div class="layout-wrapper layout-content-navbar layout-without-menu">
                    <div class="layout-container">
                        <!-- Layout container -->
                        <div class="layout-page">
                            <!-- Navbar -->

                            <?php include('./navbar.php'); ?>

                            <!-- / Navbar -->

                            <!-- Content wrapper -->
                            <div class="content-wrapper">
                                <!-- Content -->

                                <div class="container-fluid flex-grow-1 container-p-y">
                                    <!-- Layout Demo -->
                                    <div class="col-lg-11 m-auto">
                                        <div class="row">
                                            <div class="col-12 m-auto">

                                                <div class="card" tabindex="-1">


                                                    <div class="card-header d-flex align-items-center justify-content-between">
                                                        <h4 class="mb-0">ข่าวประชาสัมพันธ์</h4>
                                                        <small class="text-muted float-end d-none d-sm-inline-block">
                                                            <a class="btn btn-sm btn-danger" href="javascript:history.back()"><i class='bx bxs-left-arrow'></i> ย้อนกลับ </a></small>
                                                        <a class="btn btn-sm btn-danger d-sm-none" href="javascript:history.back()"><i class='bx bxs-left-arrow menu-icon tf-icons'></i></a>
                                                    </div>

                                                    <div class="card-body">
                                                        <h5><?php echo $row['news_titel']; ?></h5>

                                                        <?php echo $row['news_description']; ?>


                                                        <p class="text-right"><span class="badge bg-label-warning rounded-pill text-danger">ยอดเข้าชม <?php echo $row['news_view']; ?> ครั้ง</span></p>

                                                    </div>

                                                </div>
                                            </div>


                                        </div>


                                        <!-- Content wrapper -->
                                    </div>
                                </div>
                                <?php include("./footer.php"); ?>
                            </div>

                            <!-- / Footer -->

                        </div>
                        <!-- Content wrapper -->
                    </div>
                    <!-- / Layout page -->
                </div>
                </div>
                <!-- / Layout wrapper -->

                <?php include('./script.php'); ?>

    <?php } else {
            echo '<script>alert("ปริญญานิพนธ์นี้ไม่สามารถแสดงได้");</script>';
        }
        mysqli_stmt_close($select_stmt);
    } else {
        echo '<script>alert("เกิดข้อผิดพลาดในการเตรียมคำสั่ง SQL");</script>';
    }
} else {
    echo 'ไม่พบข้อมูลที่ต้องการ';
}

// ปิดการเชื่อมต่อฐานข้อมูล
mysqli_close($conn);
    ?>

            </body>

            </html>