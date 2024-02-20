<?php include('./head.php');
$menu = "index";
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




                        <div class="col-lg-4 col-md-6 col-sm-8 col-10 m-auto">
                            <!-- Register -->
                            <div class="card">
                                <div class="card-body">
                                    <div class="justify-content-center">
                                        <h3 class="mb-2 pb-2 pb-md-0 mb-md-4 text-center">สมัครสมาชิก</h3>
                                    </div>
                                    <form action="./inc/stmt_register.php" method="POST" id="register">
                                        <!-- 1 -->
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


                                        <div class="mb-3">
                                            <button class="btn btn-primary d-grid w-100" type="submit">สมัครสมาชิก</button>
                                        </div>
                                    </form>
                                    <p class="text-center">
                                        <span>เป็นสมาชิกอยู่แล้ว ?</span>
                                        <a href="login.php">
                                            <span>เข้าสู่ระบบ</span>
                                        </a>
                                    </p>
                                </div>
                            </div>
                            <!-- /Register -->
                        </div>

                        <!-- Content wrapper -->
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

</body>

</html>