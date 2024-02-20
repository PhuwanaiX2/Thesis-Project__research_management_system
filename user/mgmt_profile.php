<?php
include('./head.php');
$menu = 'profile';

$profile = isset($_GET['profile']) ? $_GET['profile'] : null;
if ($profile == 'profile') {
    $menu = "profile";
} elseif ($profile == 'edit') {
    $menu = "edit";
} elseif ($profile == 'change') {
    $menu = "change";
} else {
    $menu = "profile";
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

                        <!-- <div class="btn-group btn-group-sm mb-3" role="group" aria-label="Second group">
                            <a type="button" class="btn btn-info" href="mgmt_profile.php?profile=profile">
                                <i class='bx bxs-user-detail'> </i> ข้อมูลส่วนตัว
                            </a>
                            <a type="button" class="btn btn-success" href="mgmt_profile.php?profile=edit">
                                <i class='bx bx-edit-alt'> </i> แก้ไขข้อมูลส่วนตัว
                            </a>
                            <a type="button" class="btn btn-warning" href="mgmt_profile.php?profile=change">
                                <i class='bx bxs-id-card'> </i> เปลี่ยนรหัสผ่าน
                            </a>
                        </div> -->

                        <div class="row">
                            <!-- FormValidation -->
                            <div class="col-12">
                                <?php
                                $Profile = isset($_GET['profile']) ? $_GET['profile'] : null;
                                if ($Profile == 'profile') {
                                    include('profile_host.php');
                                } elseif ($Profile == 'edit') {
                                    include('profile_edit.php');
                                } elseif ($Profile == 'change') {
                                    include('profile_changepass.php');
                                } else {
                                    include('profile_host.php');
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