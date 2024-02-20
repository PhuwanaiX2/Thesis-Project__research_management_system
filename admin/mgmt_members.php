<?php
include('./head.php');
$menu = "member";
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
                                            <h4 class="mb-0">สมาชิก</h4>
                                            <div class="text-muted float-end d-none d-sm-inline-block btn-group-sm btn-group" role="group" aria-label="Basic example">
                                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal"> <i class='bx bxs-plus-square'></i>เพิ่มข้อมูล</button>
                                                <button type="button" class="btn btn-danger delete_multi_member"><i class='bx bxs-trash'></i> ลบข้อมูล</button>
                                            </div>
                                            <div class="btn-group-sm btn-group d-sm-none" role="group" aria-label="Basic example">
                                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal"> <i class='bx bxs-plus-square'></i></button>
                                                <button type="button" class="btn btn-danger delete_multi_member"><i class='bx bxs-trash'></i></button>
                                            </div>
                                        </div>

                                        <div class="card-body">
                                            <?php
                                            $sql = "SELECT * FROM members";
                                            $result = mysqli_query($conn, $sql);
                                            ?>
                                            <table id="myTable" class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th width="5%"><input type="checkbox" id="select_all" class="form-check-input"></th>
                                                        <th width="5%">#</th>
                                                        <th>ชื่อ-นามสกุล</th>
                                                        <th>เบอร์โทร</th>
                                                        <th>e-mail</th>
                                                        <th>username</th>
                                                        <th width="5%">Status</th>

                                                        <th width="5%">Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="table-border-bottom-0">
                                                    <?php

                                                    $i = 1;
                                                    foreach ($result as $row) {
                                                    ?>
                                                        <tr>
                                                            <td><input type="checkbox" class="checkbox form-check-input" data-ids="<?php echo $row["m_id"]; ?>"></td>
                                                            <td>
                                                                <span class="fw-medium"><?php echo $i++; ?></span>
                                                            </td>
                                                            <td>
                                                                <?php echo $row['m_name1'] . " " . $row['m_name2']; ?></td>
                                                            </td>
                                                            <td>
                                                                <?php echo $row['m_phone']; ?></td>
                                                            <td>
                                                                <?php echo $row['m_email']; ?>
                                                            </td>
                                                            <td> <?php echo $row['m_username']; ?></td>

                                                            <td>
                                                                <select id="toggle" class="form-select form-select-sm mb-3" onchange="toggle_status(<?= $row['m_id'] ?>)">
                                                                    <option value="1" <?php echo ($row['m_status'] == '1') ? 'selected' : ''; ?>>Admin</option>
                                                                    <option value="0" <?php echo ($row['m_status'] == '0') ? 'selected' : ''; ?>>User</option>
                                                                </select>

                                                            </td>
                                                            <td>
                                                                <div class="text-center">
                                                                    <button type="button" class="btn btn-sm btn-danger delete-type" data-id="<?= $row['m_id']; ?>">
                                                                        <i class="bx bx-trash"></i>
                                                                    </button>
                                                                </div>

                                                            </td>
                                                        </tr>
                                                    <?php
                                                        include('./edit_modal.php');
                                                    } ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th width="5%">#</th>
                                                        <th >ชื่อ-นามสกุล</th>
                                                        <th >เบอร์โทร</th>
                                                        <th >e-mail</th>
                                                        <th>username</th>
                                                        <th width="5%">Status</th>
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
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">เพิ่มสมาชิก</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="../inc/stmt_register.php" method="post" id="add_type_thesis">
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-6 mb-2">
                                                        <label for="username" class="form-label">ชื่อ</label>
                                                        <input type="text" class="form-control" id="m_name1" name="m_name1" required placeholder="ชื่อจริง" autofocus />
                                                    </div>
                                                    <div class="col-md-6 mb-2">
                                                        <label for="username" class="form-label">นามสกุล</label>
                                                        <input type="text" class="form-control" id="m_name2" name="m_name2" placeholder="นามสกุล" required autofocus />
                                                    </div>
                                                </div>
                                                <!-- end 1 -->

                                                <div class="mb-3">
                                                    <label for="username" class="form-label">อีเมล</label>
                                                    <input class="form-control" type="email" id="m_email" name="m_email" required placeholder="ต้องเป็น G mail" autofocus />
                                                </div>
                                                <div class="mb-3">
                                                    <label for="username" class="form-label">เบอร์โทร</label>
                                                    <input class="form-control" type="tel" id="m_phone" name="m_phone" pattern="[0-9]*" required placeholder="ใส่เบอร์โทร 0-9" autofocus />
                                                </div>
                                                <div class="mb-3">
                                                    <label for="username" class="form-label">ชื่อเข้าใช้ระบบ username</label>
                                                    <input type="text" class="form-control" placeholder="ชื่อเข้าใช้ระบบ" id="m_username" name="m_username" required autofocus />
                                                </div>
                                                <div class="mb-3 form-password-toggle">
                                                    <label class="form-label" for="password">รหัสผ่าน Password</label>
                                                    <div class="input-group input-group-merge">
                                                        <input type="password" class="form-control" id="m_password" name="m_password" required placeholder="รหัสผ่านต้องมี A-Z, a-z, 0-9 และตัวอักษรพิเศษ" aria-describedby="password" />
                                                    </div>
                                                </div>
                                                <div class="mb-3 form-password-toggle">
                                                    <label class="form-label" for="password">ยืนยันรหัสผ่าน Password</label>
                                                    <div class="input-group input-group-merge">
                                                        <input type="password" class="form-control" id="m_password_confirm" name="m_password_confirm" required placeholder="ต้องเหมือนกับรหัสด้านบน" aria-describedby="password" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                                                <button type="submit" name="register_m" class="btn btn-primary">บันทึก</button>
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
        <?php
        include('./script.php');
        ?>

</body>

</html>