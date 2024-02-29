<div class="card">

<div class="card-header d-flex align-items-center justify-content-between">
        <h4 class="mb-0">ปริญญานิพนธ์ที่ยืนยันแล้ว</h4>
        <div class="text-muted float-end d-none d-sm-inline-block btn-group-sm btn-group" role="group" aria-label="Basic example">
            <a class="btn btn-success" href="mgmt_research.php?showstatus=add"><i class='bx bxs-plus-square'></i> เพิ่มข้อมูล </a>
            <button type="button"  class="btn btn-danger delete_multi_thesis"><i class='bx bxs-trash'></i> ลบข้อมูล</button>

        </div>
        <div class="btn-group-sm btn-group d-sm-none" role="group" aria-label="Basic example">
            <a class="btn  btn-success" href="mgmt_research.php?showstatus=add"><i class='bx bxs-plus-square'></i>  </a>
            <button type="button"  class="btn btn-danger delete_multi_thesis"><i class='bx bxs-trash'></i> </button>
        </div>
    </div>
    <div class="card-body">
        <?php

        $who_id = $_SESSION['member_id'];
        $sql_script2 = "SELECT 
                                                    thesis.thesis_id,
                                                        thesis.thesis_name1,
                                            thesis.thesis_name2,
                                            type_thesis.typethesis_name,
                                            thesis.thesis_des,
                                            thesis.thesis_keyword,
                                            thesis.thesis_year,
                                            thesis.thesis_view,
                                            thesis.thesis_status,
                                            thesis.thesis_file,
                                            type_thesis.typethesis_id,
                                            type_thesis.typethesis_name,
                                            Advisor.Advisor_id,                
                                            COUNT(author.author_id) AS num_authors,
                                            GROUP_CONCAT(CONCAT(AUTHOR.AUTHOR_name1, ' ', AUTHOR.AUTHOR_name2) SEPARATOR ' / ') AS author_full_names,
                                            CONCAT(Advisor.Advisor_name1, ' ', Advisor.Advisor_name2) AS Advisor_full_name
                                        FROM 
                                            thesis      
                                        JOIN 
                                            type_thesis ON thesis.typethesis_id = type_thesis.typethesis_id
                                        JOIN 
                                            Advisor ON thesis.Advisor_id = Advisor.Advisor_id
                                        JOIN 
                                            author ON thesis.thesis_id = author.thesis_id
                                        JOIN 
                                            faculty ON thesis.faculty_id = faculty.faculty_id 
                                        JOIN 
                                            branch ON thesis.branch_id = branch.branch_id 
                                        WHERE thesis.thesis_status = '1' AND (thesis.m_id = $who_id)
                                        GROUP BY
                                            thesis.thesis_id;
                                                    ";
        $result2 = mysqli_query($conn, $sql_script2) or die(mysqli_connect_error());
        $i = 1;
        ?>
        <table id="myTable" class="table table-striped">
            <thead>
                <tr class="info">

                    <th>
                        <input type="checkbox" id="select_all" class="form-check-input">
                    </th>
                    <th>#</th>
                    <th>ชื่อประเภทปริญญานิพนธ์</th>
                    <th width="5%">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row_result2 = mysqli_fetch_assoc($result2)) { ?>
                    <tr>

                        <td><input type="checkbox" class="checkbox form-check-input" data-ids="<?php echo $row_result2["thesis_id"]; ?>"></td>
                        <td><?php echo $i++ ?></td>
                        <td>
                            <a href="../thesis_detail.php?id=<?php echo $row_result2["thesis_id"]; ?>"><?php echo $row_result2["thesis_name1"]  ?></a>
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm" role="group" aria-label="Second group">
                            
                                <a type="button" class="btn btn-warning" href="mgmt_research.php?showstatus=edit&id=<?php echo $row_result2['thesis_id']; ?>">
                                    <i class="bx bx-edit-alt"></i>
                                </a>
                                <button type="button" class="btn btn-danger delete-thesis" data-id="<?= $row_result2['thesis_id']; ?>">
                                    <i class="bx bx-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>

                <?php } ?>
            </tbody>
            <tfoot>
                <tr class="info">
                    <th width="5%">#</th>
                    <th width="5%">#</th>
                    <th>ชื่อประเภทปริญญานิพนธ์</th>
                    <th width="5%">Actions</th>
                </tr>
            </tfoot>
        </table>
    </div>

</div>