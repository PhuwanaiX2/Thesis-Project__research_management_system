<div class="card">


    <div class="card-header d-flex align-items-center justify-content-between">
        <h4 class="mb-0">เพิ่มปริญญานิพนธ์</h4>
        <div class="text-muted float-end d-none d-sm-inline-block btn-group-sm btn-group" role="group" aria-label="Basic example">
            <a class="btn btn-danger" href="javascript:history.back()"><i class='bx bxs-left-arrow'></i> ย้อนกลับ </a>

        </div>
        <div class="btn-group-sm btn-group d-sm-none" role="group" aria-label="Basic example">
            <a class="btn btn-danger" href="javascript:history.back()"><i class='bx bxs-left-arrow'></i></a>
        </div>
    </div>


    <div class="card-body">

        <form action="../inc/inc_thesis.php" method="post" id="add_research" enctype="multipart/form-data">
            <div class="modal-body">
                <!-- Account Details -->
                <div class="divider divider-danger">
                    <div class="divider-text">1. ข้อมูลปริญญานิพนธ์</div>
                </div>

                <input type="hidden" name="member_id" value="<?php echo $_SESSION['member_id']; ?>">

                <div class="col mb-3">
                    <label class="form-label" for="formValidationName">ชื่อปริญญานิพนธ์ภาษาไทย</label>
                    <input type="text" id="formValidationName" class="form-control" name="thesis_name1" placeholder="ชื่อปริญญานิพนธ์ภาษาไทย" />
                </div>
                <div class="col mb-3">
                    <label class="form-label" for="formValidationName">ชื่อปริญญานิพนธ์ภาษาอังกฤษ</label>
                    <input type="text" id="formValidationName" class="form-control" name="thesis_name2" placeholder="ชื่อปริญญานิพนธ์ภาษาอังกฤษ" />
                </div>

                <div class="col mb-3">
                    <label class="form-label" for="formValidationBio">บทคัดย่อ</label>
                    <textarea class="form-control" id="formValidationBio" name="thesis_des" rows="12"></textarea>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="exampleFormControlTextarea1" class="form-label">ประเภทปริญญานิพนธ์</label>
                        <select id="typethesis_id" name="typethesis_id" class="form-select" required>
                            <?php
                            // คำสั่ง SQL เพื่อดึงข้อมูลจากตาราง type_thesis
                            $sql = "SELECT typethesis_id, typethesis_name FROM type_thesis";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo '<option value="' . $row["typethesis_id"] . '">' . $row["typethesis_name"] . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label" for="thesis_year">ปีที่วิจัย</label>
                        <select id="thesis_year" name="thesis_year" class="form-select select2" data-allow-clear="true">
                            <?php
                            // กำหนดค่าเริ่มต้นของปี
                            $startYear = 2007;
                            $endYear = date("Y");;

                            // สร้างรายการปีตั้งแต่ $startYear ถึง $endYear
                            for ($year = $endYear; $year >= $startYear; $year--) {
                                $buddhistYear = $year + 543;
                                echo '<option value="' . $buddhistYear . '"';
                                if ($buddhistYear == date("Y")) {
                                    echo ' selected';
                                }
                                echo '>' . $buddhistYear . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="row mb-3">


                    <div class="col-md-6">
                        <label for="exampleFormControlTextarea1" class="form-label">คณะ</label>

                        <select id="faculty_add" name="faculty_id"  class="form-select" required>
                            <option value="">เลือกคณะ</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="exampleFormControlTextarea1" class="form-label">สาขาวิชา</label>
                        <select id="branch_add" name="branch_id"  class="form-select" required>
                            <option value="">เลือกสาขา</option>
                        </select>
                    </div>
                </div>

                <div class="col mb-3">
                    <label class="form-label" for="formValidationLang">คำสำคัญ</label>
                    <input type="text" value="" class="form-control" name="thesis_keyword" placeholder="คำสำคัญ (ใช้ &quot;,&quot; เช่น คำสำคัญ1,คำสำคัญ2)" id="formValidationLang" />
                </div>


                <div class="col mb-3">
                    <label for="formValidationFile" class="form-label">ไฟล์ปริญญานิพนธ์</label>
                    <input class="form-control" type="file" id="formFileMultiple" accept=".pdf" name="file_1">
                </div>

                <div class="col-md-12 mb-3">
                    <div class="col mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">เลือกอาจารย์ที่ปรึกษา</label>
                        <select id="m_id" name="advisor_id" class="form-select" required>
                            <?php
                            // คำสั่ง SQL เพื่อดึงข้อมูลจากตาราง type_thesis
                            $sql = "SELECT Advisor.*,prefix.* FROM Advisor
                            LEFT join prefix ON prefix.prefix_id = advisor.prefix_id";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo '<option value="' . $row["Advisor_id"] . '">' . $row["prefix_name"] . "" . $row["Advisor_name1"] . "  " . $row["Advisor_name2"] . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>



                    <div id="show_item" class="mb-3">

                        <label class="mb-3">สมาชิกในกลุ่ม</label>
                        <div class="row">
                            <div class="col-md-12 mb-3 d-grid">
                                <div class="input-group">
                                    <span>
                                        <select id="prefix_id" name="prefix_id[]" class="form-select" required>
                                            <?php
                                            // คำสั่ง SQL เพื่อดึงข้อมูลจากตาราง prefix
                                            $sql_prefix = "SELECT prefix_id, prefix_name FROM prefix";
                                            $result_prefix = $conn->query($sql_prefix);
                                            if ($result_prefix->num_rows > 0) {
                                                while ($row_prefix = $result_prefix->fetch_assoc()) {
                                            ?>
                                                    <option value="<?php echo $row_prefix['prefix_id'] ?>"> <?php echo $row_prefix["prefix_name"] ?> </option>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </span>
                                    <input type="text" class="form-control" name="author_name1[]" placeholder="ชื่อจริง" required>
                                    <input type="text" class="form-control" name="author_name2[]" placeholder="นามสกุล" required>
                                    <button class="btn btn-success add_item_btn">
                                        <i class='bx bx-duplicate'></i>
                                    </button>
                                </div>
                            </div>



                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="submit" name="add_research" class="btn btn-primary">บันทึก</button>
            </div>

        </form>
    </div>
</div>

<script>
    $(document).ready(function() {
        // เมื่อหน้าเว็บโหลดเสร็จ
        loadFaculties();

        // เมื่อเลือกคณะ
        $('#faculty_add').change(function() {
            var facultyId = $(this).val();
            if (facultyId) {
                loadBranches(facultyId);
            } else {
                $('#branch_add').html('<option value="">เลือกสาขา</option>');
            }
        });
    });

    // ฟังก์ชันสำหรับโหลดคณะ
    function loadFaculties() {
        $.ajax({
            url: '../inc/get_faculties.php',
            type: 'post',
            success: function(response) {
                $('#faculty_add').html(response);
            }
        });
    }

    // ฟังก์ชันสำหรับโหลดสาขาตามคณะที่เลือก
    function loadBranches(facultyId) {
        $.ajax({
            url: '../inc/get_branches.php',
            type: 'post',
            data: {
                faculty_id: facultyId
            },
            success: function(response) {
                $('#branch_add').html(response);
            }
        });
    }
</script>