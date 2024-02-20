<div class="card mb-4">
    <h5 class="card-header">ข้อมูลส่วนตัว</h5>
    <div class="card-body">
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
                    <dl class="row mt-2">
                        <dt class="col-sm-2">ชื่อ-นามสกุล</dt>
                        <dd class="col-sm-10 lead"><?php echo $row['m_name1'] . " " . $row['m_name2'] ?></dd>

                        <dt class="col-sm-2">เบอร์โทรศัพท์</dt>
                        <dd class="col-sm-10 lead"><?php echo $row['m_phone'] ?></dd>

                        <dt class="col-sm-2 text-truncate">Email</dt>
                        <dd class="col-sm-10 lead">
                            <?php echo $row['m_email'] ?>
                        </dd>
                        
                        <dt class="col-sm-2">ชื่อผู้ใช้</dt>
                        <dd class="col-sm-10 lead"><?php echo $row['m_username'] ?></dd>
                    </dl>
            <?php
                }
            }
        }
            ?>
    </div>
</div>