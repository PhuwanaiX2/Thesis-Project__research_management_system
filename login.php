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
                                                <h3 class="mb-2 pb-2 pb-md-0 mb-md-4 text-center">เข้าสู่ระบบ</h3>
                                            </div>
                                            <form action="./inc/stmt_login.php" method="POST" id="login">
                                                <div class="mb-3">
                                                    <label for="username" class="form-label">ชื่อผู้ใช้</label>
                                                    <input type="text" class="form-control" id="username" name="m_username" placeholder="ชื่อผู้ใช้" autofocus />
                                                </div>
                                                <div class="mb-3 form-password-toggle">
                                                    <div class="d-flex justify-content-between">
                                                        <label class="form-label" for="password">Password</label>
                                                    </div>
                                                    <div class="input-group input-group-merge">
                                                        <input type="password" id="password" class="form-control" name="m_password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                                                        <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <button class="btn btn-primary d-grid w-100" type="submit">เข้าสู่ระบบ</button>
                                                </div>
                                            </form>
                                            <p class="text-center">
                                                <span>ไม่ได้เป็นสมาชิก ?</span>
                                                <a href="register.php">
                                                    <span>สร้างบัญชี</span>
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