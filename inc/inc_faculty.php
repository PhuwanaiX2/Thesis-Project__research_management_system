<?php // inc_type_research.php
include("./connect.php");

//ลบประเภทปริญญานิพนธ์
if (isset($_POST['delete'])) {
    $delete_id = $_POST['delete'];

    $del_type = "DELETE FROM faculty WHERE faculty_id = ?";
    $stmt_del_type = mysqli_prepare($conn, $del_type);
    mysqli_stmt_bind_param($stmt_del_type, "i", $delete_id);

    if (mysqli_stmt_execute($stmt_del_type)) {
        echo json_encode(array("status" => "success", "msg" => "ลบข้อมูลสำเร็จ"));
    } else {
        echo json_encode(array("status" => "error", "msg" => "ไม่สามารถลบข้อมูลได้"));
    }
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
        $sql = "DELETE FROM faculty WHERE faculty_id IN ($placeholders)";

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



//เพิ่มประเภทปริญญานิพนธ์
if (isset($_POST['add_faculty'])) {
    $typename = $_POST['faculty_name'];
    $checkDuplicateSql = "SELECT * FROM faculty WHERE faculty_name = ?";
    $checkStmt = mysqli_prepare($conn, $checkDuplicateSql);
    mysqli_stmt_bind_param($checkStmt, "s", $typename);
    mysqli_stmt_execute($checkStmt);
    mysqli_stmt_store_result($checkStmt);

    if (mysqli_stmt_num_rows($checkStmt) > 0) {
        // มีข้อมูลที่ไม่สามารถใช้ faculty_name ซ้ำกันได้
        echo json_encode(array("status" => "error", "msg" => "ข้อมูลนี้มีอยู่แล้ว"));
    } else {
        // ไม่มีข้อมูลซ้ำ ทำการเพิ่มข้อมูล
        $insertQuery = "INSERT INTO faculty (faculty_name) VALUES (?)";
        $insertStmt = mysqli_prepare($conn, $insertQuery);
        mysqli_stmt_bind_param($insertStmt, "s", $typename);
        mysqli_stmt_execute($insertStmt);
        echo json_encode(array("status" => "success", "msg" => "เพิ่มสำเร็จ"));
    }

    mysqli_stmt_close($checkStmt);
}


// แก้ไขประเภทปริญญานิพนธ์
if (isset($_POST['edit_faculty'])) {
    $thesis_id = $_POST["faculty_id"];
    $thesis_type_name = $_POST["faculty_name"];

    $checkDuplicateSql = "SELECT * FROM faculty WHERE faculty_name = ?  AND faculty_id != ?";
    $checkStmt = mysqli_prepare($conn, $checkDuplicateSql);
    mysqli_stmt_bind_param($checkStmt, "si", $thesis_type_name, $thesis_id);
    mysqli_stmt_execute($checkStmt);
    mysqli_stmt_store_result($checkStmt);

    if (mysqli_stmt_num_rows($checkStmt) > 0) {
        // มีข้อมูลที่ไม่สามารถใช้ faculty_name ซ้ำกันได้
        echo json_encode(array("status" => "error", "msg" => "ข้อมูลนี้มีอยู่แล้ว"));
    } else {
        // ไม่มีข้อมูลซ้ำ ทำการเพิ่มข้อมูล
        $updateQuery = "UPDATE faculty SET faculty_name = ? WHERE faculty_id = ?";
        $updateStmt = mysqli_prepare($conn, $updateQuery);
        mysqli_stmt_bind_param($updateStmt, "si", $thesis_type_name, $thesis_id);
        mysqli_stmt_execute($updateStmt);
        echo json_encode(array("status" => "success", "msg" => "แก้ไขสำเร็จ"));
    }
    mysqli_stmt_close($checkStmt);
}
