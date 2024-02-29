<div class="card">

    <div class="card-header d-flex align-items-center justify-content-between">
        <h4 class="mb-0">ปริญญานิพนธ์ที่ไม่ได้รับการยืนยัน</h4>
        <div class="text-muted float-end d-none d-sm-inline-block btn-group-sm btn-group" role="group" aria-label="Basic example">
            <a class="btn btn-success" href="mgmt_research.php?showstatus=add"><i class='bx bxs-plus-square'></i> เพิ่มข้อมูล </a>
        </div>
        <div class="btn-group-sm btn-group d-sm-none" role="group" aria-label="Basic example">
            <a class="btn btn-success" href="mgmt_research.php?showstatus=add"><i class='bx bxs-plus-square'></i></a>
           
        </div>
    </div>
    <div class="card-body">
        <?php

        $sql_script2 = "SELECT thesis.thesis_id,
                                                    thesis.thesis_name1,
                                                    thesis.thesis_name2,
                                                    type_thesis.typethesis_name,
                                                    thesis.thesis_des,
                                                    thesis.thesis_keyword,
                                                    thesis.thesis_year,
                                                    thesis.thesis_view,
                                                    thesis.thesis_status,
                                                    thesis.thesis_file,
                                                    thesis.thesis_reason,
                                                    type_thesis.typethesis_id,
                                                    type_thesis.typethesis_name,
                                                    Advisor.Advisor_id,                
                                                    members.m_id,         
                                                    CONCAT(members.m_name1, ' ', members.m_name2) AS members_add_research   ,     
                                                    COUNT(author.author_id) AS num_authors,
                                                    GROUP_CONCAT(CONCAT(AUTHOR.AUTHOR_name1, ' ', AUTHOR.AUTHOR_name2) SEPARATOR ' / ') AS author_full_names,
                                                    CONCAT(Advisor.Advisor_name1, ' ', Advisor.Advisor_name2) AS Advisor_full_name
                                                FROM 
                                                    thesis      
                                                JOIN 
                                                    type_thesis ON thesis.typethesis_id = type_thesis.typethesis_id
                                                JOIN 
                                                    members ON thesis.m_id = members.m_id
                                                JOIN 
                                                    Advisor ON thesis.Advisor_id = Advisor.Advisor_id
                                                JOIN 
                                                    author ON thesis.thesis_id = author.thesis_id
                                                JOIN 
                                                    faculty ON thesis.faculty_id = faculty.faculty_id 
                                                JOIN 
                                                    branch ON thesis.branch_id = branch.branch_id 
                                                    WHERE thesis.thesis_status = '2' 
                                                GROUP BY
                                                    thesis.thesis_id;
                                                ";
        $result2 = mysqli_query($conn, $sql_script2) or die(mysqli_connect_error());
        ?>
        <table id="myTable" class="table table-striped">
            <thead>
                <tr class="info">
                    <th width="5%">#</th>
                    <th>ชื่อประเภทปริญญานิพนธ์</th>
                    <th>เหตุผลที่ไม่อนุมัติปริญญานิพนธ์</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                while ($row_result2 = mysqli_fetch_assoc($result2)) { ?>
                    <tr>
                        <td><?php echo $i++ ?></td>
                        <td><?php echo $row_result2["thesis_name1"] ?></td>                        
                        <td><?php echo $row_result2["thesis_reason"] ?></td>                        
                    </tr>
                    <?php include('./edit_modal.php'); ?>


                <?php } ?>
            </tbody>
            <tfoot>
                <tr class="info">
                    <th>#</th>
                    <th>ชื่อประเภทปริญญานิพนธ์</th>
                    <th>เหตุผลที่ไม่อนุมัติปริญญานิพนธ์</th>
                </tr>
            </tfoot>
        </table>
    </div>

</div>