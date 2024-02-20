<?php
include('./head.php');
$menu = "news";
?>
<style>
  .action-btn {
    padding: 5px 10px;
    cursor: pointer;
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 5px;
  }
</style>

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
          <div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row">
                <!-- FormValidation -->
                <div class="col-12">
                  <div class="card">

                    <div class="card-header d-flex align-items-center justify-content-between">
                      <h4 class="mb-0">ปริญญานิพนธ์ทั้งหมด</h4>
                      <div class="text-muted float-end d-none d-sm-inline-block btn-group-sm btn-group" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal"> <i class='bx bxs-plus-square'></i>เพิ่มข้อมูล</button>
                        <button type="button" class="btn btn-danger delete_multi_news"><i class='bx bxs-trash'></i> ลบข้อมูล</button>
                      </div>
                      <div class="btn-group-sm btn-group d-sm-none" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal"> <i class='bx bxs-plus-square'></i></button>
                        <button type="button" class="btn btn-danger delete_multi_news"><i class='bx bxs-trash'></i> </button>
                      </div>
                    </div>

                    <div class="card-body">
                      <?php
                      $sql_script2 = "SELECT * FROM news ORDER BY news_id DESC";
                      $result2 = mysqli_query($conn, $sql_script2) or die(mysqli_connect_error());
                      ?>
                      <table id="myTable" class="table table-striped">
                        <thead>
                          <tr class="info">
                            <th>
                              <input type="checkbox" id="select_all" class="form-check-input">
                            </th>
                            <th width="5%">#</th>
                            <th>หัวข้อข่าวประชาสัมพันธ์</th>
                            <th>วันที่</th>
                            <th width="5%">เปิด/ปิด</th>
                            <th width="5%">Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $i = 1;
                          while ($row_result2 = mysqli_fetch_assoc($result2)) { ?>
                            <tr>
                              <td><input type="checkbox" class="checkbox form-check-input" data-ids="<?php echo $row_result2["news_id"]; ?>"></td>
                              <td><?php echo $i++ ?> </td>
                              <td><?php echo $row_result2["news_titel"] ?> </td>
                              <td><?php
                                  $date = new DateTime($row_result2['news_day']);
                                  $formatted_date = $date->format('d/m/Y');
                                  echo $formatted_date
                                  ?>

                              </td>
                              <td>
                                <input type="checkbox" id="toggle" onchange="toggle_check(<?= $row_result2['news_id'] ?>)" <?php echo ($row_result2['news_status'] == '1') ? 'checked' : ''; ?> data-toggle="toggle" data-onstyle="success" data-offstyle="danger" data-size="small">
                              </td>
                              <td>
                                <div class="btn-group btn-group-sm" role="group">
                                  <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit_news<?php echo $row_result2['news_id'] ?>">
                                    <i class="bx bx-edit-alt"></i>
                                  </button>
                                  <button type="button" class="btn btn-danger delete-news" data-id="<?= $row_result2['news_id']; ?>">
                                    <i class="bx bx-trash"></i>
                                  </button>
                                </div>
                                
                              </td>
                            </tr>
                            <?php include('./edit_modal.php'); ?>

                          <?php } ?>
                        </tbody>
                        <tfoot>
                          <tr class="info">
                            <th width="5%">#</th>
                            <th width="5%">#</th>
                            <th>หัวข้อข่าวประชาสัมพันธ์</th>
                            <th width="5%">วันที่</th>
                            <th width="5%">เปิด/ปิด</th>
                            <th width="5%">Actions</th>
                          </tr>
                        </tfoot>

                      </table>
                    </div>

                  </div>
                </div>
              </div>

              <!-- Modal -->
              <div class="modal fade modal-xl" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="exampleModalLabel">เพิ่มข่าวประชาสัมพันธ์</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="../inc/inc_news.php" method="post" id="add_news">
                      <div class="modal-body">
                        <label for="">หัวข้อข่าวประชาสัมพันธ์</label>
                        <input type="text" class="form-control mb-3"" name=" news_title">
                        <label for="">รายละเอียดข่าวประชาสัมพันธ์</label>
                        <textarea name="news_description" class="summernote mb-3"" cols=" 30" rows="10"></textarea>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                        <button type="submit" name="add_news" class="btn btn-primary">บันทึก</button>
                      </div>
                    </form>
                  </div>
                </div>
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