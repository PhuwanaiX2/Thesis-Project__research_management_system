<?php

include('connect.php');
// print_r($_POST);
// exit();

//ลบ 1ตัว
if (isset($_POST['delete'])) {
    $delete_id = $_POST['delete'];

    $del_type = "DELETE FROM news WHERE news_id = ?";
    $stmt_del_type = mysqli_prepare($conn, $del_type);
    mysqli_stmt_bind_param($stmt_del_type, "i", $delete_id);

    if (mysqli_stmt_execute($stmt_del_type)) {
        echo json_encode(array("status" => "success", "msg" => "ลบข้อมูลสำเร็จ"));
    } else {
        echo json_encode(array("status" => "error", "msg" => "ไม่สามารถลบข้อมูลได้"));
    }
    exit();
}


//ลบหลายตัว


// เพิ่ม
if (isset($_POST['add_news'])) {
    $news_title =  $_POST['news_title'];
    $news_description =  $_POST['news_description']; // แก้ไขตรงนี้

    if (empty($news_title)) {
        echo json_encode(array("status" => "error", "msg" => "ไม่มี TITEL"));
    } elseif (empty($news_description)) {
        echo json_encode(array("status" => "error", "msg" => "ไม่มี รายละเอียด"));
    } else {
        // ไม่มีข้อมูลซ้ำ ทำการเพิ่มข้อมูล
        $insertQuery = "INSERT INTO news (news_titel, news_description) VALUES (?, ?)";
        $insertStmt = mysqli_prepare($conn, $insertQuery);
        mysqli_stmt_bind_param($insertStmt, "ss", $news_title, $news_description);
        mysqli_stmt_execute($insertStmt);

        echo json_encode(array("status" => "success", "msg" => "ประชาสัมพันธ์แล้ว"));
        exit();
    }
    exit();
}


//แก้ไข
if (isset($_POST['edit_news'])) {

    if (empty($_POST['news_title']) || empty($_POST['news_description'])) {
        echo json_encode(array("status" => "error", "msg" => "ข้อมูลไม่ครบ"));
        exit();
    }else{
        $news_id = $_POST['news_id'];
        $news_title = $_POST['news_title'];
        $news_description = $_POST['news_description'];
        // ทำการอัปเดตรหัสผ่านในฐานข้อมูล
        $updateQuery = "UPDATE news SET news_titel = ? , news_description = ? , news_day = NOW() WHERE news_id = ?";
        $updateStmt = mysqli_prepare($conn, $updateQuery);
        mysqli_stmt_bind_param($updateStmt, "ssi", $news_title, $news_description,  $news_id);
        mysqli_stmt_execute($updateStmt);
    
        echo json_encode(array("status" => "success", "msg" => "แก้ไขประชาสัมพันธ์แล้ว"));
        exit();
    }
}

//sum คือตัวแปลที่ส่่งมา
if (isset($_POST["sum"])) {
    $news_id = mysqli_real_escape_string($conn, $_POST["news_id"]);
    // Fetch news_status from the database
    $query_status = "SELECT news_status FROM news WHERE news_id = $news_id";
    $result_query = mysqli_query($conn, $query_status) or die("Error in query: $query_status " . mysqli_error($conn));
    $row = $result_query->fetch_assoc();
    $status = $row['news_status'];

    // Prepare statement
    $update_query = "UPDATE news SET news_status = ? WHERE news_id = ?";
    $stmt = mysqli_prepare($conn, $update_query);

    if ($stmt) {
        // กำหนดค่าแบบมีประเภทข้อมูล (i คือ integer)
        $new_status = ($status == '1') ? '0' : '1';
        mysqli_stmt_bind_param($stmt, "si", $new_status, $news_id);
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
        $sql = "DELETE FROM news WHERE news_id IN ($placeholders)";

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
