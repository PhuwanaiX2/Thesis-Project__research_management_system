<div class="card">

    <div class="card-header d-flex align-items-center justify-content-between">
        <h4 class="mb-0">แก้ไขปริญญานิพนธ์</h4>
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


            // ค้นหาข้อมูลถ้ำ
            $select_sql = "SELECT 
                                            thesis.thesis_id,
                                            thesis.thesis_name1,
                                            thesis.thesis_name2,
                                            thesis.thesis_des,
                                            thesis.thesis_keyword,
                                            thesis.thesis_year ,
                                            thesis.thesis_file ,
                                            type_thesis.typethesis_id,
                                            type_thesis.typethesis_name,
                                            faculty.faculty_name,
                                            faculty.faculty_id,
                                            branch.branch_id,
                                            branch.branch_name,
                                            thesis.advisor_id
                                            FROM thesis
                                            JOIN type_thesis ON thesis.typethesis_id = type_thesis.typethesis_id
                                            LEFT JOIN Advisor ON thesis.Advisor_id = Advisor.Advisor_id
                                            LEFT JOIN author ON thesis.thesis_id = author.thesis_id
                                            LEFT JOIN faculty ON thesis.faculty_id = faculty.faculty_id 
                                            LEFT JOIN branch ON thesis.branch_id = branch.branch_id 
                                            WHERE thesis.thesis_id = ?";
            $select_stmt = mysqli_prepare($conn, $select_sql);

            if ($select_stmt) {
                mysqli_stmt_bind_param($select_stmt, "i", $thesis_id);
                mysqli_stmt_execute($select_stmt);
                $result = mysqli_stmt_get_result($select_stmt);

                if (mysqli_num_rows($result) > 0) {
                  
                    $row = mysqli_fetch_assoc($result);

                 
        ?>


                    <div class="col-xl-10"></div>


                    <form method="post" action="../inc/inc_thesis.php" class="edit-form-research" enctype="multipart/form-data">

                        <div class="modal-body">
                            <!-- Account Details -->

                            <input type="hidden" name="thesis_id" value="<?php echo $_GET['id']; ?>">

                            <div class="col mb-1">
                                <label class="form-label" for="formValidationName">ชื่อปริญญานิพนธ์ภาษาไทย</label>
                                <input type="text" id="formValidationName" class="form-control" name="thesis_name1" placeholder="ชื่อปริญญานิพนธ์ภาษาไทย" value="<?php echo $row['thesis_name1'] ?>" />
                            </div>
                            <div class="col mb-1">
                                <label class="form-label" for="formValidationName">ชื่อปริญญานิพนธ์ภาษาอังกฤษ</label>
                                <input type="text" id="formValidationName" class="form-control" name="thesis_name2" placeholder="ชื่อปริญญานิพนธ์ภาษาอังกฤษ" value="<?php echo $row['thesis_name2'] ?>" />
                            </div>

                            <div class="col mb-1">
                                <label class="form-label" for="formValidationBio">บทคัดย่อ</label>
                                <textarea class="form-control" id="formValidationBio" name="thesis_des" rows="10"><?php echo $row['thesis_des']?></textarea>
                            </div>
                            <div class="row mb-1">
                                <div class="col-6">
                                    <label for="exampleFormControlTextarea1" class="form-label">ประเภทปริญญานิพนธ์</label>
                                    <select id="typethesis_id" name="typethesis_id" class="form-select" required>
                                        <?php
                                        // คำสั่ง SQL เพื่อดึงข้อมูลจากตาราง type_thesis
                                        $sql = "SELECT typethesis_id, typethesis_name FROM type_thesis";
                                        $result = $conn->query($sql);

                                        if ($result->num_rows > 0) {
                                            while ($row2 = $result->fetch_assoc()) {
                                                $selected = ($row2["typethesis_id"] == $row["typethesis_id"]) ? "selected" : "";
                                        ?>
                                                <option value="<?php echo $row2["typethesis_id"]; ?>" <?php echo $selected; ?>>
                                                    <?php echo $row2["typethesis_name"]; ?>
                                                </option>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="col-6">
                                    <label class="form-label" for="thesis_year">ปีที่วิจัย</label>
                                    <select id="thesis_year" name="thesis_year" class="form-select mb-2" required>
                                        <?php
                                        // กำหนดค่าเริ่มต้นของปี
                                        $startYear = 2007;
                                        $endYear = date("Y");

                                        for ($year = $endYear; $year >= $startYear; $year--) {
                                            // แปลงปีจาก คศ เป็น พศ โดยเพิ่ม 543
                                            $buddhistYear = $year + 543;
                                            echo '<option value="' . $buddhistYear . '"';
                                            if ($buddhistYear == $row['thesis_year']) {
                                                echo ' selected';
                                            }
                                            echo '>' . $buddhistYear . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-1">
                            <?php $faculty_id = $row["faculty_id"];
                                        $branch_id = $row["branch_id"];
                                        ?>
                                <div class="col-6">
                                    <label for="exampleFormControlTextarea1" class="form-label">คณะ</label>
                                   <select id="faculty_edit" name="faculty_id" class="form-select">
                                        <option value="">เลือกคณะ</option>
                                        <?php
                                        // ดึงรายการคณะจากฐานข้อมูล
                                        $sql_faculty = "SELECT * FROM faculty";
                                        $result_faculty = mysqli_query($conn, $sql_faculty) or die(mysqli_connect_error());
                                        while ($row_faculty = mysqli_fetch_assoc($result_faculty)) {
                                            $selected = ($row_faculty['faculty_id'] == $faculty_id) ? "selected" : "";
                                            echo "<option value='" . $row_faculty['faculty_id'] . "' $selected>" . $row_faculty['faculty_name'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="col-6">
                                    <label for="exampleFormControlTextarea1" class="form-label">สาขาวิชา</label>
                                    <select id="branch_edit" name="branch_id" class="form-select">
                                        <option value="">เลือกสาขา</option>
                                        <?php
                                        // ดึงรายการสาขาจากฐานข้อมูล
                                        
                                        $sql_branch = "SELECT * FROM branch WHERE faculty_id = '$faculty_id'";
                                        $result_branch = mysqli_query($conn, $sql_branch) or die(mysqli_connect_error());
                                        while ($row_branch = mysqli_fetch_assoc($result_branch)) {
                                            $selected = ($row_branch['branch_id'] == $branch_id) ? "selected" : "";
                                            echo "<option value='" . $row_branch['branch_id'] . "' $selected>" . $row_branch['branch_name'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>

                            </div>

                            <div class="col mb-1">
                                <label class="form-label" for="formValidationLang">คำสำคัญ</label>
                                <input type="text" value="<?php echo $row['thesis_keyword'] ?>" class="form-control" name="thesis_keyword" placeholder="คำสำคัญ (ใช้ &quot;,&quot; เช่น ไก่,ไข่)" id="formValidationLang" />
                            </div>

                            <div class="col mb-1">
                                <label for="formValidationFile" class="form-label">ไฟล์ปริญญานิพนธ์</label>
                                <input class="form-control" type="file" id="formFileMultiple" accept=".pdf" name="file_1">
                                <?php if(!empty($row['thesis_file'])){
                                    ?>
                                         <p class="mt-1">สามารถอัพโหลดไฟล์หากต้องการเปลี่ยน <a href="../uploads/<?php echo $row['thesis_file'] ?>" download>ไฟล์ปริญญานิพนธ์</a></p>
                                    <?php
                                }else{ ?>
                                        <p class="mt-1 text-danger">กรุณาอัพโหลดไฟล์</p>
                                    <?php
                                } ?>
                               
                            </div>

                            <div class="col-md-12 mb-1">
                                <div class="col mb-1">
                                    <label for="exampleFormControlTextarea1" class="form-label">เลือกประเภทปริญญานิพนธ์</label>
                                    <select id="typethesis_id" name="advisor_id" class="form-select" required>
                                        <?php
                                        // คำสั่ง SQL เพื่อดึงข้อมูลจากตาราง type_thesis
                                        $sql3 = "SELECT Advisor.*,prefix.* FROM Advisor
                                        LEFT join prefix ON prefix.prefix_id = advisor.prefix_id";
                                        $result3 = $conn->query($sql3);

                                        if ($result3->num_rows > 0) {
                                            while ($row3 = $result3->fetch_assoc()) {
                                                $selected = ($row3["Advisor_id"] == $row["advisor_id"]) ? "selected" : "";
                                        ?>
                                                <option value="<?php echo $row3["Advisor_id"]; ?>" <?php echo $selected; ?>>
                                                    <?php echo $row3["prefix_name"], $row3["Advisor_name1"] . " " . $row3["Advisor_name2"]; ?>
                                                </option>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div id="show_item" class="mb-3">
                                    <div class="row mb-3">
                                        <div class="col h4">เพิ่มสมาชิก</div>
                                    </div>

                                    <?php
                                    $thesis_id = $_GET['id'];
                                    $sql_select_researchers = "SELECT * FROM author WHERE thesis_id = $thesis_id";
                                    $result_researchers = mysqli_query($conn, $sql_select_researchers);

                                    echo '<div id="field_edit">';  // Open the container outside the loop

                                    if (mysqli_num_rows($result_researchers) > 0) {
                                        $count = 1;
                                        while ($row_researcher = mysqli_fetch_assoc($result_researchers)) {

                                            $prefix_id = $row_researcher['prefix_id'];
                                            $author_id = $row_researcher['author_id'];
                                            $author_name1 = $row_researcher['author_name1'];
                                            $author_name2 = $row_researcher['author_name2'];
                                            $button = '';

                                            // $count++;
                                            if ($count > 1) {
                                                $button = '      
                                                <button class="btn btn-danger remove_item_btn" id="remove_' . $count . '">
                                                <i class="bx bxs-tag-x"></i>
                                                </button> 
                                                 ';
                                            } else {
                                                $button = '             
                                                    <button class="btn btn-success add_item_btn" id="add-more-edit">
                                                    <i class="bx bx-duplicate"></i>
                                                    </button> 
                                                ';
                                            }

                                            echo '        
    <div class="row" id="field_edit' . $count . '">            
        <div class="col-md-12 mb-3 d-grid">
            <div class="input-group">
                <span>
                    <select id="m_id" name="prefix_id[]" value="' . $prefix_id . '" class="form-select" required>';
                                            // คำสั่ง SQL เพื่อดึงข้อมูลจากตาราง type_thesis
                                            $sql_prefix = "SELECT prefix_id, prefix_name FROM prefix";
                                            $result_prefix = $conn->query($sql_prefix);
                                            if ($result_prefix->num_rows > 0) {
                                                while ($row_prefix = $result_prefix->fetch_assoc()) {
                                                    $selected = ($row_prefix["prefix_id"] == $prefix_id) ? "selected" : "";
                                                    echo '<option ' . " $selected" . ' value="' . $row_prefix["prefix_id"] . '"> ' . $row_prefix["prefix_name"]  . '</option>';
                                                }
                                            }

                                            echo '
                    </select>
                </span>
                <input type="text" class="form-control name_list" name="author_name1[]" placeholder="ชื่อจริง" value="' . $author_name1 . '"  required>  
                <input type="text" class="form-control name_list" name="author_name2[]" placeholder="นามสกุล" value="' . $author_name2 . '"  required>
                ' . $button . '
            </div>
        </div>       
    </div>';
                                            $count++;
                                        }
                                    }

                                    echo '</div>';  // Close the container outside the loop
                                    ?>


                                </div>
                            </div>

                          
                        </div><!-- body -->

                        <div class="modal-footer">
                            <button type="submit" name="edit_research" class="btn btn-primary">บันทึก</button>
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


<script>
    $(document).ready(function() {
        // เมื่อหน้าเว็บโหลดเสร็จ
        loadBranches(<?php echo $faculty_id; ?>, <?php echo $branch_id; ?>);

        // เมื่อเลือกคณะ
        $('#faculty_edit').change(function() {
            var facultyId = $(this).val();
            if (facultyId) {
                loadBranches(facultyId);
            } else {
                $('#branch_edit').html('<option value="">เลือกสาขา</option>');
            }
        });
    });

    // ฟังก์ชันสำหรับโหลดสาขาตามคณะที่เลือก
    function loadBranches(facultyId, selectedBranchId = null) {
        $.ajax({
            url: '../inc/get_branches.php',
            type: 'post',
            data: {
                faculty_id: facultyId
            },
            success: function(response) {
                $('#branch_edit').html(response);
                if (selectedBranchId) {
                    $('#branch_edit').val(selectedBranchId);
                }
            }
        });
    }

    // ฟังก์ชันสำหรับโหลดคณะ
    function loadFaculties() {
        $.ajax({
            url: '../inc/get_faculties.php',
            type: 'post',
            success: function(response) {
                $('#faculty_edit').html(response);
            }
        });
    }
</script>