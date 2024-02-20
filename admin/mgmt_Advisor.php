<?php
include('./head.php');
$menu = "Advisor";
?>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            <?php include('./sidebar.php'); ?>

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                <?php include('./navbar.php') ?>

                <div class="content-wrapper">
                    <!-- Content -->
                    <div class="content-wrapper">
                        <!-- Content -->
                        <div class="container-xxl flex-grow-1 container-p-y">
                            <div class="row">
                                <!-- FormValidation -->
                                <div class="col-12">
                                    <div class="card">
                                  

                                        <div class="card-header d-flex align-items-center justify-content-between">
                                            <h4 class="mb-0">ที่ปรึกษาปริญญานิพนธ์</h4>
                                            <div class="text-muted float-end d-none d-sm-inline-block btn-group-sm btn-group" role="group" aria-label="Basic example">
                                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal"> <i class='bx bxs-plus-square'></i>เพิ่มข้อมูล</button>
                                                <button type="button" class="btn btn-danger delete_multi_advisor"><i class='bx bxs-trash'></i> ลบข้อมูล</button>
                                            </div>
                                            <div class="btn-group-sm btn-group d-sm-none" role="group" aria-label="Basic example">
                                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal"> <i class='bx bxs-plus-square'></i></button>
                                                <button type="button" class="btn btn-danger delete_multi_advisor"><i class='bx bxs-trash'></i></button>
                                            </div>
                                        </div>

                                        <div class="card-body">
                                            <?php
                                            $sql_script2 = "SELECT Advisor.*,prefix.* FROM Advisor
                                            LEFT join prefix ON prefix.prefix_id = advisor.prefix_id";
                                            $result2 = mysqli_query($conn, $sql_script2) or die(mysqli_connect_error());
                                            $i = 1;
                                            ?>
                                            <table id="myTable" class="table table-striped">
                                                <thead>
                                                    <tr class="info">
                                                        <th width="5%">
                                                            <input type="checkbox" id="select_all" class="form-check-input">
                                                        </th>
                                                        <th width="5%">#</th>
                                                        <th>ชื่อ</th>
                                                        <th width="5%">Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $i = 1;
                                                    while ($row_result2 = mysqli_fetch_assoc($result2)) { ?>
                                                        <tr>
                                                            <td><input type="checkbox" class="checkbox form-check-input" data-ids="<?php echo $row_result2["Advisor_id"]; ?>"></td>
                                                            <td><?php echo $i++ ?></td>
                                                            <td><?php echo $row_result2["prefix_name"] . "" . $row_result2["Advisor_name1"] . "  " . $row_result2["Advisor_name2"] ?> </td>
                                                            <td>
                                                                <div class="btn-group btn-group-sm" role="group" aria-label="Second group">
                                                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit_Advisor<?php echo $row_result2['Advisor_id'] ?>">
                                                                        <i class="bx bx-edit-alt"></i>
                                                                    </button>
                                                                    <button type="button" class="btn btn-danger delete-advisor" data-id="<?= $row_result2['Advisor_id']; ?>">
                                                                        <i class="bx bx-trash"></i>
                                                                    </button>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <?php include('./edit_modal.php'); ?>

                                                    <?php } ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr class="info">
                                                        <th>#</th>
                                                        <th>#</th>
                                                        <th>ชื่อ</th>
                                                        <th width="5%">Actions</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">เพิ่มชื่ออาจาย์รที่ปรึกษา</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="../inc/inc_Advisor.php" method="post" id="add_Advisor">
                                            <div class="modal-body">
                                                <div class="col-md-12 mb-3 d-grid">
                                                    <div class="input-group">
                                                        <span>
                                                            <select id="prefix_id" name="prefix_id" class="form-select" required>
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
                                                        <input type="text" class="form-control" name="Advisor_name1" placeholder="ชื่อจริง" required>
                                                        <input type="text" class="form-control" name="Advisor_name2" placeholder="นามสกุล" required>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                                                <button type="submit" name="add_Advisor" class="btn btn-primary">บันทึก</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php include('./footer.php'); ?>

            </div>
            <div class="layout-overlay layout-menu-toggle"></div>
        </div>

        <?php include('./script.php') ?>


        <script>
            $("#add_Advisor").submit(function(e) {
                e.preventDefault();
                let formUrl = $(this).attr("action");
                let reqMethod = $(this).attr("method");
                let formData = new FormData(this);

                // เพิ่มค่าจากปุ่ม submit ที่ถูกคลิก
                formData.append('add_Advisor', $(document.activeElement).val());

                $.ajax({
                    url: formUrl,
                    type: reqMethod,
                    data: formData,
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        if (data.status === "success") {
                            Swal.fire({
                                icon: 'success',
                                title: 'สำเร็จ',
                                text: data.msg
                            }).then(function() {
                                location.reload()
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'ล้มเหลว',
                                text: data.msg
                            });
                        }
                    }
                });
            });

            $(".edit-form-Advisor").submit(function(e) {
                e.preventDefault();
                let formUrl = $(this).attr("action");
                let reqMethod = $(this).attr("method");
                let formData = new FormData(this);
                // เพิ่มค่าจากปุ่ม submit ที่ถูกคลิก
                formData.append($(document.activeElement).attr('edit_Advisor'), $(document.activeElement).val());
                formData.append('edit_Advisor', $(document.activeElement).val());
                $.ajax({
                    url: formUrl,
                    type: reqMethod,
                    data: formData,
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        if (data.status == "success") {
                            Swal.fire({
                                icon: 'success',
                                title: 'สำเร็จ',
                                text: data.msg
                            }).then(function() {
                                location.reload()
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'ล้มเหลว',
                                text: data.msg
                            });
                        }
                    }
                });
            });
        </script>

</body>

</html>