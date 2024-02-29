<?php
// ทำการเชื่อมต่อฐานข้อมูล
include '../inc/connect.php';

// ตรวจสอบว่ามีข้อมูลที่ถูกส่งมาหรือไม่
if(isset($_POST['faculty_id'])){
    $facultyId = $_POST['faculty_id'];
    
    // ดึงรายการสาขาตามคณะที่เลือกจากฐานข้อมูล
    $sql = "SELECT * FROM branch WHERE faculty_id = '$facultyId'";
    $result = mysqli_query($conn, $sql);
    
    // สร้าง dropdown list สำหรับสาขา
    $output = '<option value="">เลือกสาขา</option>';
    while ($row = mysqli_fetch_array($result)) {
        $output .= '<option value="' . $row['branch_id'] . '">' . $row['branch_name'] . '</option>';
    }
    
    echo $output;
}
?>
