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

                        <?php
                        $sql = "SELECT * FROM faculty";
                        $result = $conn->query($sql);
                        ?>
                        <div class="row mb-3">

                            <div class="col-md-6">
                                <label for="exampleFormControlTextarea1" class="form-label">คณะ</label>


                                <select id="faculty" name="faculty_id" class="form-select" required>
                                    <option value="">เลือกคณะ</option>
                                    <?php
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<option value='" . $row['faculty_id'] . "'>" . $row['faculty_name'] . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="exampleFormControlTextarea1" class="form-label">สาขาวิชา</label>

                                <select id="branch" name="branch_id" disabled class="form-select" required>
                                    <option value="">โปรดเลือก คณะ ก่อน</option>
                                </select>
                            </div>
                        </div>


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

    <script>
        $(document).ready(function() {
            $('#faculty').change(function() {
                var faculty_id = $(this).val();
                if (faculty_id) {
                    $.ajax({
                        type: 'POST',
                        url: '../inc/get_branch.php',
                        data: 'faculty_id=' + faculty_id,
                        success: function(html) {
                            $('#branch').html(html);
                            $('#branch').prop('disabled', false);
                        }
                    });
                } else {
                    $('#branch').html('<option value="">โปรดเลือก faculty ก่อน</option>');
                    $('#branch').prop('disabled', true);
                }
            });
        });
    </script>
</body>

</html>