<?php
include('./head.php');
$menu = "various";

$mgmt = isset($_GET['mgmt']) ? $_GET['mgmt'] : null;
if ($mgmt == 'faculty') {
    $menu = "faculty";
} elseif ($mgmt == 'branch') {
    $menu = "branch";
} elseif ($mgmt == 'prefix') {
    $menu = "prefix";
} elseif ($mgmt == 'type') {
    $menu = "type";
} else {
    $menu = "various";
}

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
                    <div class="container-xxl flex-grow-1 container-p-y">

                        <!-- <div class="btn-group btn-group-sm ms-0 mb-3">
                            <a type="button" class="btn btn-info" href="mgmt_various.php?mgmt=prefix">
                                </i>จัดการคำนำหน้าชื่อ
                            </a>
                            <a type="button" class="btn btn-success" href="mgmt_various.php?mgmt=type">
                                </i>จัดการประเภทปริญญานิพนธ์
                            </a>
                            <a type="button" class="btn btn-warning" href="mgmt_various.php?mgmt=faculty">
                                </i>จัดการคณะ
                            </a>
                            <a type="button" class="btn btn-danger" href="mgmt_various.php?mgmt=branch">
                                </i>จัดการสาขา
                            </a>
                        </div> -->

                        <div class="row">
                            <!-- FormValidation -->
                            <div class="col-12">

                                <?php
                                $mgmt = isset($_GET['mgmt']) ? $_GET['mgmt'] : null;
                                if ($mgmt == 'faculty') {
                                    include('faculty.php');
                                } elseif ($mgmt == 'branch') {
                                    include('branch.php');
                                } elseif ($mgmt == 'prefix') {
                                    include('prefix.php');
                                } elseif ($mgmt == 'type') {
                                    include('type_thesis.php');
                                } else {
                                    include('faculty.php');
                                }
                                ?>
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