                  <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                      <h4 class="mb-0">จัดการประเภทปริญญานิพนธ์</h4>
                      <div class="text-muted float-end d-none d-sm-inline-block btn-group-sm btn-group" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal"> <i class='bx bxs-plus-square'> </i> เพิ่มข้อมูล</button>
                        <button type="button" class="btn btn-danger delete_multi_type"><i class='bx bxs-trash'></i> ลบข้อมูล</button>
                      </div>
                      <div class="btn-group-sm btn-group d-sm-none" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal"> <i class='bx bxs-plus-square'> </i></button>
                        <button type="button" class="btn btn-danger delete_multi_type"><i class='bx bxs-trash'></i></button>
                      </div>
                    </div>

                    <div class="card-body">
                      <?php
                      $sql_script2 = "SELECT * FROM type_thesis";
                      $result2 = mysqli_query($conn, $sql_script2) or die(mysqli_connect_error());
                      ?>
                      <table id="myTable" class="table table-striped">
                        <thead>
                          <tr class="info">
                            <th width="5%">
                              <input type="checkbox" id="select_all" class="form-check-input">
                            </th>
                            <th width="5%">#</th>
                            <th>ประเภทปริญญานิพนธ์</th>
                            <th width="5%">Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $i = 1;
                          while ($row_result2 = mysqli_fetch_assoc($result2)) { ?>
                            <tr>
                              <td><input type="checkbox" class="checkbox form-check-input" data-ids="<?php echo $row_result2["typethesis_id"]; ?>"></td>
                              <td><?php echo $i++ ?> </td>
                              <td><?php echo $row_result2["typethesis_name"] ?> </td>
                              <td>
                                <div class="btn-group btn-group-sm" role="group" aria-label="Second group">
                                  <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit_type<?php echo $row_result2['typethesis_id'] ?>">
                                    <i class="bx bx-edit-alt"></i>
                                  </button>
                                  <button type="button" class="btn btn-danger delete-type" data-id="<?= $row_result2['typethesis_id']; ?>">
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
                            <th>#</th>
                            <th width="5%">#</th>
                            <th>ประเภทปริญญานิพนธ์</th>
                            <th width="5%">Actions</th>
                          </tr>
                        </tfoot>
                      </table>
                    </div>
                  </div>

                  <!-- Modal -->
                  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="exampleModalLabel">เพิ่มประเภทปริญญานิพนธ์</h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="../inc/inc_type_research.php" method="post" id="add_type_thesis">
                          <div class="modal-body">
                            <label for="">ประเภทปริญญานิพนธ์</label>
                            <input type="text" class="form-control mb-3" name="typethesis_name">
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                            <button type="submit" name="add_type_thesis" class="btn btn-primary">บันทึก</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>