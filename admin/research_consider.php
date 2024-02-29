<div class="card">

    <div class="card-header d-flex align-items-center justify-content-between">
        <h4 class="mb-0">ตรวจสอบปริญญานิพนธ์</h4>
        <div class="text-muted float-end d-none d-sm-inline-block btn-group-sm btn-group" role="group" aria-label="Basic example">
            <a class="btn btn-danger" href="javascript:history.back()"><i class='bx bxs-left-arrow'></i> ย้อนกลับ </a>

        </div>
        <div class="btn-group-sm btn-group d-sm-none" role="group" aria-label="Basic example">
            <a class="btn btn-danger" href="javascript:history.back()"><i class='bx bxs-left-arrow'></i></a>
        </div>
    </div>
    <div class="card-body">

        <?php
        // เชื่อมต่อกับฐานข้อมูล

        if (isset($_GET['id'])) {
            $thesis_id = $_GET['id'];
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
WHERE thesis.thesis_id = ?
GROUP BY 
thesis.thesis_id";
            $select_stmt = mysqli_prepare($conn, $select_sql);

            if ($select_stmt) {
                mysqli_stmt_bind_param($select_stmt, "i", $thesis_id);
                mysqli_stmt_execute($select_stmt);
                $result = mysqli_stmt_get_result($select_stmt);

                if (mysqli_num_rows($result) > 0) {

                    $row = mysqli_fetch_assoc($result);


        ?>



                    <div class="modal-body">

                        <dl class="row mt-2">
                            <dt class="col-sm-3">ชื่อปริญญานิพนธ์ (ภาษาไทย)</dt>
                            <dd class="col-sm-9 lead"><?php echo $row['thesis_name1'] ?></dd>

                            <dt class="col-sm-3">ชื่อปริญญานิพนธ์ (ภาษาอังกฤษ)</dt>
                            <dd class="col-sm-9 lead">
                                <p><?php echo $row['thesis_name2'] ?></p>
                            </dd>

                            <dt class="col-sm-3 text-truncate">บทคัดย่อ</dt>
                            <dd class="col-sm-9 lead" style="text-align: justify;  text-justify: distribute-all-lines;">
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
                                ?><a href="../uploads/<?php echo $row['thesis_file'] ?>" download><?php echo $row['thesis_name1'] ?>.pdf</a>
                                <?php                                      } else {
                                    echo "ไม่มีไฟล์ปริญญานิพนธ์";
                                }
                                ?>
                            </dd>

                        </dl>

                    </div>

                    <form action="../inc/inc_thesis.php" method="post" class="edit-form-con">
                        <input type="hidden" class="form-control" name="thesis_id" value="<?php echo $row['thesis_id'] ?>">
                        <div class="card-footer text-end">
                            <button type="submit" value="consider1" name="consider" class="btn btn-success">อนุมัติปริญญานิพนธ์</button>
                            <button type="button" data-bs-toggle="modal" data-bs-target="#rejectModal" class="btn btn-danger">ไม่อนุมัติปริญญานิพนธ์</button>
                        </div>
                    </form>



        <?php } else {
                    echo 'ไม่พบข้อมูลที่ต้องการแก้ไข';
                }

                mysqli_stmt_close($select_stmt);
            } else {
                echo 'เกิดข้อผิดพลาดในการเตรียมคำสั่ง SQL';
            }
        } else {
            echo 'ไม่ระบุรหัสที่ต้องการแก้ไข';
        }

        // ปิดการเชื่อมต่อฐานข้อมูล
        mysqli_close($conn);
        ?>



    </div>
</div>


<div class="modal fade" id="rejectModal" tabindex="-1" aria-labelledby="sad" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="sad">ไม่อนุมัติปริญญานิพนธ์</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="../inc/inc_thesis.php" method="post" class="edit-form-con">

                <div class="modal-body">
                    <input type="hidden" class="form-control" name="thesis_id" value="<?php echo $row['thesis_id'] ?>">
                    <div class="form-group">
                        <label for="reason">เหตุผลที่ไม่อนุมัติปริญญานิพนธ์:</label>
                        <textarea class="form-control" id="reason" name="thesis_reason" required></textarea>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                    <button type="submit" name="consider" value="consider2" class="btn btn-primary">ยืนยัน</button>
                </div>
            </form>
        </div>
    </div>
</div>