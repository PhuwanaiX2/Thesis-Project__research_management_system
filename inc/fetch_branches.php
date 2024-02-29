<?php
// เชื่อมต่อฐานข้อมูล

include ('./connect.php');

if(isset($_POST['faculty_id'])) {
    $facultyId = $_POST['faculty_id'];

    // ดึงข้อมูลสาขาของคณะที่ถูกเลือก
    $sql_branch = "SELECT branch_id, branch_name FROM branch WHERE faculty_id = '$facultyId'";
    $result_branch = $conn->query($sql_branch);

    $branches = array();
    while ($row_branch = $result_branch->fetch_assoc()) {
        $branches[] = $row_branch;
    }

    // ตรวจสอบสาขาที่ถูกเลือก
    $selectedBranch = '';
    if(isset($_POST['selected_branch'])) {
        $selectedBranch = $_POST['selected_branch'];
    }

    // ส่งค่ากลับในรูปแบบ JSON
    echo json_encode(array("branches" => $branches, "selected_branch" => $selectedBranch));
}
?>
