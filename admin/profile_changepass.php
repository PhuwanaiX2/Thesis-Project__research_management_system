<div class="card mb-4">
    <h5 class="card-header">เปลี่ยนรหัสผ่าน</h5>
    <div class="card-body">
        <form action="../inc/inc_profile.php" method="post" id="change_password">
            <?php
            // echo $_SESSION['member_id'];
            if (isset($_SESSION['member_id'])) {
                $acc = $_SESSION['member_id'];

                // ค้นหาข้อมูลถ้ำ
                $select_sql = "SELECT * FROM members WHERE m_id = ?";
                $select_stmt = mysqli_prepare($conn, $select_sql);

                if ($select_stmt) {
                    mysqli_stmt_bind_param($select_stmt, "i", $acc);
                    mysqli_stmt_execute($select_stmt);
                    $result = mysqli_stmt_get_result($select_stmt);

                    if (mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_assoc($result);
            ?>
                        <div class="row">
                            <input class="form-control" class="form-label" type="hidden" id="id_user" name="id_user" value="<?php echo $row['m_id']; ?>" autofocus>

                            <div class="col-md-6 mb-3">
                                <div class="form-password-toggle">
                                    <label class="form-label" for="formValidationPass">รหัสผ่านใหม่</label>
                                    <div class="input-group input-group-merge">
                                        <input class="form-control" type="password" id="formValidationPass" name="password_1" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="multicol-password2" required />
                                        <span class="input-group-text cursor-pointer" id="multicol-password2"><i class="bx bx-hide"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-password-toggle">
                                    <label class="form-label" for="formValidationConfirmPass">ยืนยันรหัสผ่าน</label>
                                    <div class="input-group input-group-merge">
                                        <input class="form-control" type="password" id="formValidationConfirmPass" name="password_2" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="multicol-confirm-password2" required />
                                        <span class="input-group-text cursor-pointer" id="multicol-confirm-password2"><i class="bx bx-hide"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="form-password-toggle">
                                    <label class="form-label" for="formValidationPass">รหัสผ่านเก่า</label>
                                    <div class="input-group input-group-merge">
                                        <input class="form-control" type="password" id="formValidationPass" name="password_old" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="multicol-password2" required />
                                        <span class="input-group-text cursor-pointer" id="multicol-password2"><i class="bx bx-hide"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary me-2" name="change_password">บันทึก</button>
                        </div>
            <?php
                    }
                }
            }
            ?>
        </form>
    </div>

</div>