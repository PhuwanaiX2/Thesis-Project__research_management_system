<?php
// เชื่อมต่อฐานข้อมูล

include ('./connect.php');

if(isset($_POST['branch_id'])) {
    $branchId = $_POST['branch_id'];

    // ดึงข้อมูลสาขาของคณะที่ถูกเลือก
    $sql_branch = "SELECT advisor.Advisor_id,advisor.Advisor_name1,advisor.Advisor_name2,advisor.branch_id,prefix.prefix_name  FROM advisor 
    LEFT JOIN prefix ON prefix.prefix_id = advisor.prefix_id WHERE advisor.branch_id = '$branchId'";
    $result_branch = $conn->query($sql_branch);

    $advisors = array();
    while ($row_branch = $result_branch->fetch_assoc()) {
        $advisors[] = $row_branch;
    }

    // ตรวจสอบสาขาที่ถูกเลือก
    $selectedAdvisor = '';
    if(isset($_POST['selected_advisor'])) {
        $selectedAdvisor = $_POST['selected_advisor'];
    }

    // ส่งค่ากลับในรูปแบบ JSON
    echo json_encode(array("advisors" => $advisors, "selected_advisor" => $selectedAdvisor));
}
?>
