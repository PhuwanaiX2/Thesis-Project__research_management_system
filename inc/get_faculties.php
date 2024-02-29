<?php
// ทำการเชื่อมต่อฐานข้อมูล
include '../inc/connect.php';

// ดึงรายการคณะจากฐานข้อมูล
$sql = "SELECT * FROM faculty";
$result = mysqli_query($conn, $sql);

// สร้าง dropdown list สำหรับคณะ
$output = '<option value="">เลือกคณะ</option>';
while ($row = mysqli_fetch_array($result)) {
    $output .= '<option value="' . $row['faculty_id'] . '">' . $row['faculty_name'] . '</option>';
}

echo $output;
?>
