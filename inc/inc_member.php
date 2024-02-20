<?php
include ('./connect.php');
//sum คือตัวแปลที่ส่่งมา
if (isset($_POST["up_down"])) {
    $m_id = mysqli_real_escape_string($conn, $_POST["m_id"]);
    // Fetch news_status from the database
    $query_status = "SELECT m_status FROM members WHERE m_id = $m_id";
    $result_query = mysqli_query($conn, $query_status) or die("Error in query: $query_status " . mysqli_error($conn));
    $row = $result_query->fetch_assoc();
    $status = $row['m_status'];

    // Prepare statement
    $update_query = "UPDATE members SET m_status = ? WHERE m_id = ?";
    $stmt = mysqli_prepare($conn, $update_query);

    if ($stmt) {
        // กำหนดค่าแบบมีประเภทข้อมูล (i คือ integer)
        $m_status = ($status == '1') ? '0' : '1';
        mysqli_stmt_bind_param($stmt, "si", $m_status, $m_id);
        // Execute statement
        mysqli_stmt_execute($stmt);
        // ตรวจสอบว่ามีการอัปเดตสถานะเรียบร้อยหรือไม่
        if (mysqli_stmt_affected_rows($stmt) > 0) {
            echo "Update successful";
            
        } else {
            echo "No rows affected. The news_id may not exist or the status is already set to the desired value.";
        }
        // ปิด statement
        mysqli_stmt_close($stmt);
    } else {
        echo "Error preparing statement: " . mysqli_error($conn);
    }
    exit();
}


// ตรวจสอบว่ามีการส่งข้อมูล ids มาหรือไม่
if (isset($_POST['ids'])) {
    // ดึงค่า ids จากข้อมูลที่ส่งมา
    $idsString = $_POST['ids'];

    // แยกค่า ids ออกเป็น array
    $idsArray = explode(",", $idsString);


    // ตรวจสอบจำนวนตัวแปรที่ใช้ใน mysqli_stmt_bind_param
    if (count($idsArray) > 0) {
        // ทำตามขั้นตอนลบข้อมูล
        $placeholders = implode(',', array_fill(0, count($idsArray), '?'));

        // กำหนดคำสั่ง SQL ในรูปแบบของ prepared statement
        $sql = "DELETE FROM members WHERE m_id IN ($placeholders)";

        // ประมวลผลคำสั่ง SQL
        $stmt = mysqli_prepare($conn, $sql);

        // ตรวจสอบว่าสามารถ bind parameters ได้หรือไม่
        if ($stmt) {
            // Bind parameters
            $types = str_repeat('i', count($idsArray)); // กำหนดประเภทของตัวแปรเป็น 'i' สำหรับ integer
            mysqli_stmt_bind_param($stmt, $types, ...$idsArray); // ใช้ ...$idsArray เพื่อป้องกันจำนวนตัวแปรที่ไม่ตรงกับ prepared statement

            // ประมวลผลคำสั่ง SQL
            $result = mysqli_stmt_execute($stmt);

            // ตรวจสอบผลลัพธ์จากการลบข้อมูล
            if ($result) {
                echo json_encode(array("status" => "success", "msg" => "ลบข้อมูลสำเร็จ"));
            } else {
                echo json_encode(array("status" => "error", "msg" => "ไม่สามารถลบข้อมูลได้"));
            }

            // ปิด prepared statement
            mysqli_stmt_close($stmt);
        } else {
            // กรณีเกิดข้อผิดพลาดในการเตรียมคำสั่ง SQL
            echo json_encode(array("status" => "error", "msg" => "กรณีเกิดข้อผิดพลาดในการเตรียมคำสั่ง"));
        }
    } else {
        // ถ้าไม่มีการส่งข้อมูล ids มา
        echo json_encode(array("status" => "error", "msg" => "ถ้าไม่มีการส่งข้อมูล"));
    }
}
?>