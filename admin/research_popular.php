<div class="card">
    <div class="card-header py-3 align-items-center ">
        <div class="row m-auto">
            <div class="col-lg-6 col-md-6">
                <div class="text-center text-md-start h4">ปริญญานิพนธ์ที่รับชมมากที่สุด </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <?php

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
                                                GROUP BY
                                                    thesis.thesis_id
                                                    ORDER BY
        thesis.thesis_view DESC
                                                LIMIT 3;
                                                ";
        $result2 = mysqli_query($conn, $sql_script2) or die(mysqli_connect_error());
        ?>
        <table class="table table-striped">
            <thead>
                <tr class="info">
                    <th>#</th>
                    <th>ชื่อประเภทปริญญานิพนธ์</th>
                    <th>ยอดเข้าชม</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                while ($row_result2 = mysqli_fetch_assoc($result2)) { ?>
                    <tr>
                        <td>
                            <?php echo $i++ ?>
                        </td>
                        <td>
                            <a type="button" data-bs-toggle="modal" data-bs-target="#duresearch<?php echo $row_result2['thesis_id']; ?>">
                                <?php echo $row_result2["thesis_name1"]  ?>
                            </a>
                        </td>
                        <td>
                            <div class="badge bg-label-primary"><?php echo $row_result2["thesis_view"]  ?></div>
                                
                            
                        </td>

                    </tr>
                    <?php include('./edit_modal.php'); ?>


                <?php } ?>
            </tbody>
        </table>
    </div>

</div>