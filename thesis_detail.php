<?php include('./head.php');
$menu = "index";
if (isset($_GET['id'])) {
    $thesis_id = isset($_GET['id']) ? mysqli_real_escape_string($conn, $_GET['id']) : '';
    // ค้นหาข้อมูลถ้ำ

    $select_sql = "SELECT 
    thesis.thesis_id,
    thesis.thesis_name1,
    thesis.thesis_name2,
    type_thesis.typethesis_name,
    thesis.thesis_des,
    thesis.thesis_keyword,
    thesis.thesis_year,
    thesis.thesis_view,
    thesis.thesis_status,
    thesis.thesis_file,
    type_thesis.typethesis_id,
    type_thesis.typethesis_name,
    Advisor.Advisor_id,
    faculty.faculty_name,
    branch.branch_name,
    prefix_author.prefix_id AS author_prefix_id,
    prefix_author.prefix_name AS author_prefix_name,
    COUNT(author.author_id) AS num_authors,
    GROUP_CONCAT( CONCAT(prefix_author.prefix_name,author.author_name1, ' ', author.author_name2) SEPARATOR ' / ') AS author_full_names,
    CONCAT('อาจารย์ ', prefix_advisor.prefix_name, Advisor.Advisor_name1, ' ', Advisor.Advisor_name2) AS Advisor_full_name,
    CONCAT(faculty.faculty_name, ' ', branch.branch_name) AS Agency
FROM 
    thesis      
JOIN 
    type_thesis ON thesis.typethesis_id = type_thesis.typethesis_id
JOIN
    Advisor ON thesis.Advisor_id = Advisor.Advisor_id
JOIN 
    author ON thesis.thesis_id = author.thesis_id 
JOIN 
    prefix AS prefix_author ON author.prefix_id = prefix_author.prefix_id 
JOIN 
    prefix AS prefix_advisor ON Advisor.prefix_id = prefix_advisor.prefix_id 
JOIN 
    faculty ON thesis.faculty_id = faculty.faculty_id 
JOIN 
    branch ON thesis.branch_id = branch.branch_id  
WHERE 
    thesis.thesis_id = ? AND thesis.thesis_status != '0'
GROUP BY 
    thesis.thesis_id";
    $select_stmt = mysqli_prepare($conn, $select_sql);

    if ($select_stmt) {
        mysqli_stmt_bind_param($select_stmt, "i", $thesis_id);
        mysqli_stmt_execute($select_stmt);
        $result = mysqli_stmt_get_result($select_stmt);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);

            //ยอดวิว
            $stmt_view = "UPDATE thesis SET thesis_view = thesis_view + 1 WHERE thesis_id = ?";
            $updateStmt = mysqli_prepare($conn, $stmt_view);

            if ($updateStmt) {
                mysqli_stmt_bind_param($updateStmt, "i", $thesis_id);
                mysqli_stmt_execute($updateStmt);
                mysqli_stmt_close($updateStmt);
            } else {
                echo "Error in preparing the update statement: " . mysqli_error($conn);
            }
?>

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
                                                        <h4 class="mb-0">ข้อมูลปริญญานิพนธ์</h4>
                                                        <small class="text-muted float-end d-none d-sm-inline-block">
                                                            <a class="btn btn-sm btn-danger"  href="javascript:history.back()"><i class='bx bxs-left-arrow'></i> ย้อนกลับ </a></small>
                                                        <a class="btn btn-sm btn-danger d-sm-none"  href="javascript:history.back()"><i class='bx bxs-left-arrow menu-icon tf-icons'></i></a>
                                                    </div>


                                                    <div class="card-body">
                                                        <dl class="row mt-2">
                                                            <dt class="col-sm-3">ชื่อปริญญานิพนธ์ (ภาษาไทย)</dt>
                                                            <dd class="col-sm-9 lead"><?php echo $row['thesis_name1'] ?></dd>

                                                            <dt class="col-sm-3">ชื่อปริญญานิพนธ์ (ภาษาอังกฤษ)</dt>
                                                            <dd class="col-sm-9 lead">
                                                                <p><?php echo $row['thesis_name2'] ?></p>
                                                            </dd>

                                                            <dt class="col-sm-3 text-truncate">บทคัดย่อ</dt>
                                                            <dd class="col-sm-9 lead">
                                                                <?php echo $row['thesis_des'] ?>
                                                            </dd>

                                                            <dt class="col-sm-3">ประเภทปริญญานิพนธ์ </dt>
                                                            <dd class="col-sm-9 lead"><?php echo $row['typethesis_name'] ?></dd>
                                                            <dt class="col-sm-3 text-truncate">คำสำคัญ</dt>

                                                            <dd class="col-sm-9 lead">
                                                                <?php echo $row['thesis_keyword'] ?>
                                                            </dd>

                                                            <dt class="col-sm-3">ปีการศึกษา</dt>
                                                            <dd class="col-sm-9 lead"><?php echo $row['thesis_year'] ?></dd>

                                                            <dt class="col-sm-3 text-truncate">สมาชิก</dt>
                                                            <dd class="col-sm-9 lead">
                                                                <?php echo $row['author_full_names'] ?>
                                                            </dd>

                                                            <dt class="col-sm-3 text-truncate">ที่ปรึกษา</dt>
                                                            <dd class="col-sm-9 lead">
                                                                <?php echo $row['Advisor_full_name'] ?>
                                                            </dd>

                                                            <dt class="col-sm-3 text-truncate">คณะ</dt>
                                                            <dd class="col-sm-9 lead">
                                                                <?php echo $row['faculty_name'] ?>
                                                            </dd>

                                                            <dt class="col-sm-3 text-truncate">สาขา</dt>
                                                            <dd class="col-sm-9 lead">
                                                                <?php echo $row['branch_name'] ?>
                                                            </dd>

                                                            <dt class="col-sm-3 text-truncate">ไฟล์ข้อมูล</dt>
                                                            <dd class="col-sm-9">
                                                                <?php if (!empty($row['thesis_file'])) {
                                                                ?><a href="./uploads/<?php echo $row['thesis_file'] ?>" download><?php echo $row['thesis_name1'] ?>.pdf</a>
                                                                <?php                                      } else {
                                                                    echo "ไม่มีไฟล์ปริญญานิพนธ์";
                                                                }
                                                                ?>
                                                            </dd>

                                                        </dl>
                                                        <p class="text-right"><span class="badge bg-label-warning rounded-pill text-danger">ยอดเข้าชม <?php echo $row['thesis_view']; ?> ครั้ง</span></p>

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