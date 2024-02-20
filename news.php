<?php include('./head.php');
$menu = "news";


$perpage = 4;
if (isset($_GET['page'])) {
  $page = $_GET['page'];
} else {
  $page = 1;
}
$start = ($page - 1) * $perpage;
$sql = "select * from news WHERE news_status = '1' limit {$start} , {$perpage} ";
$query = mysqli_query($conn, $sql);

$sql2 = "SELECT * FROM news WHERE news_status = '1'";
$query2 = mysqli_query($conn, $sql2);
$total_record = mysqli_num_rows($query2);
$total_page = ceil($total_record / $perpage);

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

          <div class="container-fluid container-p-y">
            
            <!-- Layout Demo -->
            <div class="h1 text-center mb-4">ข่าวประชาสัมพันธ์</div>
            <div class="divider text-center m-auto col-8 mb-3">
              <div class="divider-text">
                <i class="bx bx-news"></i>
              </div>
            </div>

            <div class="row">
              <div class="col-lg-8 col-md-10 col-12 m-auto justify-content-center">

                <?php
                if ($query->num_rows > 0) {
                  $rowNumber = 1;
                  while ($row = $query->fetch_assoc()) { ?>
                    <a href="./news_detail.php?id=<?php echo $row['news_id'] ?>">
                      <div class="card mb-3">
                        <div class="card-body">

                          <div class="h4"> <?php echo $row["news_titel"] ?></div>
                          <span class="badge bg-label-danger"> เมื่อวันที่ <?php echo ($row['news_day'] == null) ? "ไม่มีข้อมูล" : $row['news_day']; ?></span>
                        </div>
                      </div>
                    </a>

                <?php }
                } else {
                  echo '
                  <div class="card mb-3">
                     <div class="card-body">
                       <h4>ไม่มีข่าว ประชาสัมพ์พันธ์</h4>
                     </div>
                   </div>
                 ';
                }
                ?>

              </div>
              <!-- / Content -->
            </div>

            <div class="col-lg-12 col-md-10 col-12 d-flex justify-content-center">
              <ul class="pagination">
                <?php if ($page > 1) { ?>
                  <li class="page-item">
                    <a class="page-link" href="?page=<?php echo ($page - 1); ?>">
                      <i class="tf-icon bx bx-chevron-left"></i>
                    </a>
                  </li>
                <?php } else { ?>
                  <li class="page-item">
                    <a class="page-link" href="#">
                      <i class="tf-icon bx bx-chevron-left"></i>
                    </a>
                  </li>
                <?php } ?>
                <?php for ($i = 1; $i <= $total_page; $i++) { ?>
                  <li class="page-item <?php if ($i == $page) echo "active"; ?>">
                    <a class="page-link" href="?page=<?php echo $i; ?>">
                      <?php echo $i; ?>
                    </a>
                  </li>
                <?php } ?>
                <?php if ($page < $total_page) { ?>
                  <li class="page-item">
                    <a class="page-link" href="?page=<?php echo ($page + 1); ?>">
                      <i class="tf-icon bx bx-chevron-right"></i>
                    </a>
                  </li>
                <?php } else { ?>
                  <li class="page-item">
                    <a class="page-link" href="#">
                    <i class="tf-icon bx bx-chevron-right"></i>
                    </a>
                  </li>
                <?php } ?>
              </ul>
            </div>
            <!-- Content wrapper -->
          </div>
          <div class="divider text-center m-auto col-8 mb-3">
            <div class="divider-text">
              <i class="bx bx-news"></i>
            </div>
          </div>

        </div>



        <?php include("./footer.php"); ?>
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