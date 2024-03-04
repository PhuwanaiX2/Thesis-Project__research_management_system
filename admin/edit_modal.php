  <!-- faculty -->
  <div class="modal fade" id="edit_faculty<?php echo $row_result2['faculty_id'] ?>" tabindex="-1" aria-labelledby="sad" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h1 class="modal-title fs-5" id="sad">แก้ไขชื่อคณะ</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form method="post" action="../inc/inc_faculty.php" class="edit-form-faculty">
                  <div class="modal-body">
                      <label for="">ชื่อคณะ</label>
                      <input type="text" class="form-control" name="faculty_name" value="<?php echo $row_result2['faculty_name'] ?>">
                      <input type="hidden" class="form-control" name="faculty_id" value="<?php echo $row_result2['faculty_id'] ?>">
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                      <button type="submit" name="edit_faculty" class="btn btn-primary">บันทึก</button>
                  </div>
              </form>
          </div>
      </div>
  </div>


  <!-- branch -->
  <div class="modal fade" id="edit_branch<?php echo $row_result2['branch_id'] ?>" tabindex="-1" aria-labelledby="sad" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h1 class="modal-title fs-5" id="sad">แก้ไขชื่อสาขาวิชา</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form method="post" action="../inc/inc_branch.php" class="edit-form-branch">
                  <div class="modal-body">

                      <div class="col mb-3">

                          <label for="exampleFormControlTextarea1" class="form-label">ประเภทปริญญานิพนธ์</label>
                          <select id="faculty_id" name="faculty" class="form-select" required>
                              <?php
                                // คำสั่ง SQL เพื่อดึงข้อมูลจากตาราง type_thesis
                                $sql = "SELECT faculty_id, faculty_name FROM faculty";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    while ($row2 = $result->fetch_assoc()) {
                                        $selected = ($row2["faculty_id"] == $row_result2["faculty_id"]) ? "selected" : "";
                                ?>
                                      <option value="<?php echo $row2["faculty_id"]; ?>" <?php echo $selected; ?>>
                                          <?php echo $row2["faculty_name"]; ?>
                                      </option>
                              <?php
                                    }
                                }
                                ?>
                          </select>

                      </div>
                      <div class="col mb-3">
                          <label for="">ชื่อสาขาวิชา</label>
                          <input type="text" class="form-control" name="branch_name" value="<?php echo $row_result2['branch_name'] ?>">
                      </div>

                      <input type="hidden" class="form-control" name="branch_id" value="<?php echo $row_result2['branch_id'] ?>">
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                      <button type="submit" name="edit_branch" class="btn btn-primary">บันทึก</button>
                  </div>
              </form>
          </div>
      </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="edit_type<?php echo $row_result2['typethesis_id'] ?>" tabindex="-1" aria-labelledby="sad" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h1 class="modal-title fs-5" id="sad">แก้ไขประเภทปริญญานิพนธ์</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form method="post" action="../inc/inc_type_research.php" class="edit-form">
                  <div class="modal-body">
                      <label for="">ประเภทปริญญานิพนธ์</label>
                      <input type="text" class="form-control" name="typethesis_name" value="<?php echo $row_result2['typethesis_name'] ?>">
                      <input type="hidden" class="form-control" name="typethesis_id" value="<?php echo $row_result2['typethesis_id'] ?>">
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                      <button type="submit" name="edit_type_thesis" class="btn btn-primary">บันทึก</button>
                  </div>
              </form>
          </div>
      </div>
  </div>

  <!-- prefix -->
  <div class="modal fade" id="edit_prefix<?php echo $row_result2['prefix_id'] ?>" tabindex="-1" aria-labelledby="sad" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h1 class="modal-title fs-5" id="sad">แก้ไขคำนำหน้าชื่อ</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form method="post" action="../inc/inc_prefix.php" class="edit-form-prefix">
                  <div class="modal-body">
                      <label for="">คำนำหน้าชื่อ</label>
                      <input type="text" class="form-control" name="prefix_name" value="<?php echo $row_result2['prefix_name'] ?>">
                      <input type="hidden" class="form-control" name="prefix_id" value="<?php echo $row_result2['prefix_id'] ?>">
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                      <button type="submit" name="edit_prefix" class="btn btn-primary">บันทึก</button>
                  </div>
              </form>
          </div>
      </div>
  </div>


  <!-- Modal -->
  <div class="modal fade modal-xl" id="duresearch<?php echo $row_result2['thesis_id'] ?>" tabindex="-1" aria-labelledby="sad" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h1 class="modal-title fs-5" id="sad">ปริญญานิพนธ์</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>

              <div class="modal-body">

                  <dl class="row mt-2">
                      <dt class="col-sm-3">ชื่อปริญญานิพนธ์ (ภาษาไทย)</dt>
                      <dd class="col-sm-9 lead"><?php echo $row_result2['thesis_name1'] ?></dd>

                      <dt class="col-sm-3">ชื่อปริญญานิพนธ์ (ภาษาอังกฤษ)</dt>
                      <dd class="col-sm-9 lead">
                          <p><?php echo $row_result2['thesis_name2'] ?></p>
                      </dd>

                      <dt class="col-sm-3 text-truncate">บทคัดย่อ</dt>
                      <dd class="col-sm-9 lead">
                          <?php echo $row_result2['thesis_des'] ?>
                      </dd>

                      <dt class="col-sm-3">ประเภทปริญญานิพนธ์ </dt>
                      <dd class="col-sm-9 lead"><?php echo $row_result2['typethesis_name'] ?></dd>
                      <dt class="col-sm-3 text-truncate">คำสำคัญ</dt>

                      <dd class="col-sm-9 lead">
                          <?php echo $row_result2['thesis_keyword'] ?>
                      </dd>

                      <dt class="col-sm-3">ปีการศึกษา</dt>
                      <dd class="col-sm-9 lead"><?php echo $row_result2['thesis_year'] ?></dd>

                      <dt class="col-sm-3 text-truncate">สมาชิก</dt>
                      <dd class="col-sm-9 lead">
                          <?php echo $row_result2['author_full_names'] ?>
                      </dd>

                      <dt class="col-sm-3 text-truncate">ที่ปรึกษา</dt>
                      <dd class="col-sm-9 lead">
                          <?php echo $row_result2['Advisor_full_name'] ?>
                      </dd>

                      <dt class="col-sm-3 text-truncate">ไฟล์ข้อมูล</dt>
                      <dd class="col-sm-9">
                          <?php if (!empty($row_result2['thesis_file'])) {
                            ?><a href="../uploads/<?php echo $row_result2['thesis_file'] ?>" download><?php echo $row_result2['thesis_file'] ?></a>
                          <?php                                      } else {
                                echo "ไม่มีไฟล์ปริญญานิพนธ์";
                            }
                            ?>
                      </dd>

                  </dl>

              </div>

          </div>
      </div>
  </div>


  <!-- ที่ปรึกษา -->
  <div class="modal fade " id="edit_Advisor<?php echo $row_result2['Advisor_id'] ?>" tabindex="-1" aria-labelledby="sad" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h1 class="modal-title fs-5" id="sad">แก้ไขชื่อ-นามสกุลที่ปึกษา</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form method="post" action="../inc/inc_Advisor.php" class="edit-form-Advisor">
                  <div class="modal-body">
                      <input type="hidden" class="form-control" name="Advisor_id" value="<?php echo $row_result2['Advisor_id'] ?>">
                      <div class="row mb-1">
                                <?php 
                                $faculty_id = $row_result2["faculty_id"];
                                $branch_id = $row_result2["branch_id"];
                                ?>
                                <div class="col-6">
                                    <label for="exampleFormControlTextarea1" class="form-label">คณะ</label>
                                    <select id="faculty" name="faculty_id" class="form-select faculty" required>
                                        <option value="">เลือกคณะ</option>
                                        <?php
                                        // ดึงรายการคณะจากฐานข้อมูล
                                        $sql_faculty = "SELECT * FROM faculty";
                                        $result_faculty = mysqli_query($conn, $sql_faculty) or die(mysqli_connect_error());
                                        while ($row_faculty = mysqli_fetch_assoc($result_faculty)) {
                                            $selected = ($row_faculty['faculty_id'] == $faculty_id) ? "selected" : "";
                                            echo "<option value='" . $row_faculty['faculty_id'] . "' $selected>" . $row_faculty['faculty_name'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="col-6">
                                    <label for="exampleFormControlTextarea1" class="form-label">สาขาวิชา</label>
                                    <select id="branch" name="branch_id" class="form-select branch" required>
                                        <option value="">เลือกสาขา</option>
                                        <?php
                                        // ดึงรายการสาขาจากฐานข้อมูล
                                        $sql_branch = "SELECT * FROM branch WHERE faculty_id = '$faculty_id'";
                                        $result_branch = mysqli_query($conn, $sql_branch) or die(mysqli_connect_error());
                                        while ($row_branch = mysqli_fetch_assoc($result_branch)) {
                                            $selected = ($row_branch['branch_id'] == $branch_id) ? "selected" : "";
                                            echo "<option value='" . $row_branch['branch_id'] . "' $selected>" . $row_branch['branch_name'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>

                            </div>
                      <div class="col-md-12 mb-3 d-grid">
                          <div class="input-group">
                              <span>
                                  <select id="typethesis_id" name="prefix_id" class="form-select" required>

                                      <?php
                                        // คำสั่ง SQL เพื่อดึงข้อมูลจากตาราง type_thesis
                                        $sql = "SELECT * FROM prefix ";
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                            while ($row2 = $result->fetch_assoc()) {
                                                $selected = ($row2["prefix_id"] == $row_result2["prefix_id"]) ? "selected" : "";
                                        ?>
                                              <option value="<?php echo $row2["prefix_id"]; ?>" <?php echo $selected; ?>>
                                                  <?php echo $row2["prefix_name"] ?>
                                              </option>
                                      <?php
                                            }
                                        }
                                        ?>
                                  </select>
                              </span>

                              <input type="text" class="form-control" name="Advisor_name1" placeholder="ชื่อจริง" value="<?php echo $row_result2['Advisor_name1'] ?>" required>

                              <input type="text" class="form-control" name="Advisor_name2" placeholder="นามสกุล" value="<?php echo $row_result2['Advisor_name2'] ?>" required>
                          </div>
                      </div>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                      <button type="submit" name="edit_Advisor" class="btn btn-primary">บันทึก</button>
                  </div>
              </form>
          </div>
      </div>
  </div>



  <!-- news -->
  <div class="modal fade modal-lg" id="edit_news<?php echo $row_result2['news_id'] ?>" tabindex="-1" aria-labelledby="sad" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h1 class="modal-title fs-5" id="sad">แก้ไขชื่อสาขาวิชา</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form method="post" action="../inc/inc_news.php" class="edit-form-news">

                  <div class="modal-body">
                      <label for="">หัวข้อข่าวประชาสัมพันธ์</label>
                      <input type="text" class="form-control mb-3" name="news_title" value="<?php echo $row_result2['news_titel'] ?>">
                      <label for="">รายละเอียดข่าวประชาสัมพันธ์</label>
                      <!-- <textarea name="news_description"  class="summernote mb-3" cols="30" rows="10"><?php echo $row_result2['news_description'] ?></textarea> -->
                      <input type="hidden" class="form-control" name="news_id" value="<?php echo $row_result2['news_id'] ?>">
                  </div>

                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                      <button type="submit" name="edit_news" class="btn btn-primary">บันทึก</button>
                  </div>
              </form>
          </div>
      </div>
  </div>

 
