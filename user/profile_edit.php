<div class="card mb-4">
            <h5 class="card-header">แก้ไขข้อมูลส่วนตัว</h5>
            <div class="card-body">
                <form action="../inc/inc_profile.php" method="post" id="profile_edit">
                    <?php
                    if (isset($_SESSION['member_id'])) {
                        $acc = $_SESSION['member_id'];
                        $select_sql = "SELECT * FROM members WHERE m_id = ?";
                        $select_stmt = mysqli_prepare($conn, $select_sql);
                        if ($select_stmt) {
                            mysqli_stmt_bind_param($select_stmt, "i", $acc);
                            mysqli_stmt_execute($select_stmt);
                            $result = mysqli_stmt_get_result($select_stmt);
                            if (mysqli_num_rows($result) > 0) {
                                $row = mysqli_fetch_assoc($result);
                    ?>

                                <input class="form-control" class="form-label" type="hidden" id="id_user" name="id_user" value="<?php echo $row['m_id']; ?>" autofocusd>
                                <div class="mb-3">
                                    <label for="firstName" class="form-label">ชื่อ</label>
                                    <input class="form-control" class="form-label" type="text" id="firstName" name="firstName" value="<?php echo $row['m_name1']; ?>" autofocus required>
                                </div>
                                <div class="mb-3">
                                    <label for="lastName" class="form-label">นามสกุล</label>
                                    <input class="form-control" type="text" name="lastName" id="lastName" value="<?php echo $row['m_name2']; ?>" require />
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">อีเมล</label>
                                    <input class="form-control" type="text" id="email" name="email" value="<?php echo $row['m_email']; ?>" placeholder="john.doe@example.com" required />
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="phoneNumber">เบอร์โทรศัพท์</label>
                                    <div class="input-group input-group-merge">
                                        <input type="text" id="phoneNumber" name="phoneNumber" class="form-control" value="<?php echo $row['m_phone']; ?>" placeholder="202 555 0111" required />
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <button type="submit" class="btn btn-primary me-2" name="profile_edit">บันทึก</button>
                                </div>
                    <?php
                            }
                        }
                    }
                    ?>
            </div>
            </form>
        </div>