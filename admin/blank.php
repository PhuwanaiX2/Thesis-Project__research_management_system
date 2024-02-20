<?php
include('./head.php');
?>
<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            <?php
            include('./sidebar.php');
            ?>

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->

                <?php
                include('./navbar.php')
                ?>

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->

                    <div class="container-xxl flex-grow-1 container-p-y">




        


                    </div>
                    <!-- / Content -->


                    <?php
                    include('./footer.php');
                    ?>

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->



    <?php
    include('./script.php');
    ?>

</body>

</html>