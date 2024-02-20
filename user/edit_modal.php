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