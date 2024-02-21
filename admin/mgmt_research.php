<?php
include('./head.php');

$showstatus = isset($_GET['showstatus']) ? $_GET['showstatus'] : null;
if ($showstatus == 'all') {
    $menu = "research_all";
} elseif ($showstatus == 'waitconfirm') {
    $menu = "research_waitconfirm";
} elseif ($showstatus == 'confirm') {
    $menu = "research_confirm";
} elseif ($showstatus == 'notconfirm') {
    $menu = "research_notconfirm";
} elseif ($showstatus == 'add') {
    $menu = "research_add";
}  else {
    $menu = "research";
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

                        <!-- <div class="btn-group ms-0 mb-3">
                            <a type="button" class="btn btn-info" href="mgmt_research.php?showstatus=all">
                                ทั้งหมด
                            </a>
                            <a type="button" class="btn btn-success" href="mgmt_research.php?showstatus=confirm">
                                ยืนยันแล้ว
                            </a>
                            <a type="button" class="btn btn-warning" href="mgmt_research.php?showstatus=waitconfirm">
                                รอยืนยัน
                            </a>
                            <a type="button" class="btn btn-danger" href="mgmt_research.php?showstatus=notconfirm">
                               ไม่ได้ยืนยัน
                            </a>
                        </div> -->

                      

                        <div class="row">
                            <!-- FormValidation -->
                            
                            <div class="col-12">

                                <?php
                                $showstatus = isset($_GET['showstatus']) ? $_GET['showstatus'] : null;
                                if ($showstatus == 'all') {

                                    include('show_status.php');
                                    $menu = "research_all";
                                } elseif ($showstatus == 'waitconfirm') {

                                    include('show_status0.php');
                                    $menu = "research_waitconfirm";

                                } elseif ($showstatus == 'confirm') {
                                    $menu = "research_confirm";

                                    include('show_status1.php');
                                } elseif ($showstatus == 'notconfirm') {

                                    include('show_status2.php');
                                    $menu = "research_notconfirm";

                                }
                                elseif ($showstatus == 'add') {

                                    include('research_add.php');
                                }
                                elseif ($showstatus == 'edit') {

                                    include('research_edit.php');
                                } else {
                                    include('show_status.php');
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