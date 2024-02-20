<?php

include('connect.php');

//แก้ไขประเภทปริญญานิพนธ์
if (isset($_POST['profile_edit'])) {

    $user_id = $_POST["id_user"];
    $fristname = $_POST["firstName"];
    $lastname = $_POST["lastName"];
    $email = $_POST['email'];
    $phone = $_POST['phoneNumber'];
      
    $checkDuplicateSql = "SELECT * FROM members WHERE (?, ?) IN (SELECT m_name1, m_name2 FROM members WHERE m_id != ? GROUP BY m_name1, m_name2 ) ";
    $checkStmt = mysqli_prepare($conn, $checkDuplicateSql);
    mysqli_stmt_bind_param($checkStmt, "ssi", $fristname, $lastname, $user_id);
    mysqli_stmt_execute($checkStmt);
    mysqli_stmt_store_result($checkStmt);
    if (mysqli_stmt_num_rows($checkStmt) > 0) {
        echo json_encode(array("status" => "error", "msg" => "ชื่อนามสกุลนี้มีอยู่แล้ว"));
        exit();
    }
    mysqli_stmt_close($checkStmt);


    if (!preg_match("/^[0-9]{10}$/", $phone)) {
        echo json_encode(array("status" => "error", "msg" => "เบอร์โทรไม่ถูกต้อง"));
        exit;
    }
    // ตรวจสอบข้อมูลที่ไม่สามารถใช้ซ้ำกันได้ (เบอร์)
    $check_phone = "SELECT m_id FROM members WHERE m_phone = ? AND (m_id != ?)";
    $stmtcheck_phone = mysqli_prepare($conn, $check_phone);
    mysqli_stmt_bind_param($stmtcheck_phone, "si", $phone, $user_id);
    mysqli_stmt_execute($stmtcheck_phone);
    mysqli_stmt_store_result($stmtcheck_phone);
    if (mysqli_stmt_num_rows($stmtcheck_phone) > 0) {
        echo json_encode(array("status" => "error", "msg" => "เบอร์โทรศัพท์นี้มีคนใช้แล้ว"));
        exit();
    }
    mysqli_stmt_close($stmtcheck_phone);


    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(array("status" => "error", "msg" => "อีเมลไม่ถูกต้อง"));
        exit;
    }
    // ตรวจสอบข้อมูลที่ไม่สามารถใช้ซ้ำกันได้ (mail)
    $check_email = "SELECT m_id FROM members WHERE m_email = ? AND (m_id != ?)";
    $stmtcheck_email = mysqli_prepare($conn, $check_email);
    mysqli_stmt_bind_param($stmtcheck_email, "si", $email, $user_id);
    mysqli_stmt_execute($stmtcheck_email);
    mysqli_stmt_store_result($stmtcheck_email);
    if (mysqli_stmt_num_rows($stmtcheck_email) > 0) {
        echo json_encode(array("status" => "error", "msg" => "อีเมลนี้มีคนใช้แล้ว"));
        exit();
    }
    mysqli_stmt_close($stmtcheck_email);


    // ไม่มีข้อมูลซ้ำ ทำการเพิ่มข้อมูล
    $updateQuery = "UPDATE members SET m_name1 = ? , m_name2 = ?, m_phone = ?, m_email = ? WHERE m_id = ?";
    $updateStmt = mysqli_prepare($conn, $updateQuery);
    mysqli_stmt_bind_param($updateStmt, "ssssi", $fristname, $lastname, $phone, $email, $user_id);
    mysqli_stmt_execute($updateStmt);

    echo json_encode(array("status" => "success", "msg" => "แก้ไขสำเร็จ"));

    mysqli_stmt_close($updateStmt);
}


if (isset($_POST['change_password'])) {

    $user_id = $_POST["id_user"];
    $pass1 = $_POST["password_1"];
    $pass2 = $_POST["password_2"];
    $pass_old = $_POST["password_old"];

    // ค้นหาข้อมูลถ้ำ
    $select_sql = "SELECT m_password FROM members WHERE m_id = ?";
    $select_stmt = mysqli_prepare($conn, $select_sql);

    if ($select_stmt) {
        mysqli_stmt_bind_param($select_stmt, "i", $user_id);
        mysqli_stmt_execute($select_stmt);

        // การป้องกัน SQL injection
        mysqli_stmt_store_result($select_stmt);

        if (mysqli_stmt_num_rows($select_stmt) > 0) {
            mysqli_stmt_bind_result($select_stmt, $hashed_password);
            mysqli_stmt_fetch($select_stmt);

            // ตรวจสอบว่ารหัสผ่านเก่าที่ผู้ใช้ป้อนตรงกับรหัสผ่านที่ถูกเข้ารหัสในฐานข้อมูลหรือไม่
            if (password_verify($pass_old, $hashed_password)) {

                // ตรวจสอบว่ารหัสผ่านใหม่ตรงกันไหม
                if ($pass1 != $pass2) {
                    echo json_encode(array("status" => "error", "msg" => "รหัสผ่านใหม่ไม่ตรง"));
                    exit;
                }

                // ตรวจสอบว่ารหัสผ่านมีความซับซ้อนตามเงื่อนไข
                if (strlen($pass1) < 8 || !preg_match("/[A-Z]/", $pass1) || !preg_match("/[a-z]/", $pass1) || !preg_match("/\d/", $pass1) || !preg_match("/\W/", $pass1)) {
                    echo json_encode(array("status" => "error", "msg" => "รหัสผ่านต้องมีอย่างน้อย 8 ตัวอักษร ประกอบด้วยพิมพ์ใหญ่, พิมพ์เล็ก, ตัวเลข, และอักขระพิเศษ"));
                    exit;
                }

                // เข้ารหัสรหัสผ่านใหม่
                $password_save = password_hash($pass1, PASSWORD_BCRYPT);

                // ทำการอัปเดตรหัสผ่านในฐานข้อมูล
                $updateQuery = "UPDATE members SET m_password = ? WHERE m_id = ?";
                $updateStmt = mysqli_prepare($conn, $updateQuery);
                mysqli_stmt_bind_param($updateStmt, "si", $password_save, $user_id);

                mysqli_stmt_execute($updateStmt);

                echo json_encode(array("status" => "success", "msg" => "แก้ไขสำเร็จ"));
            } else {
                // รหัสผ่านเก่าไม่ถูกต้อง
                echo json_encode(array("status" => "error", "msg" => "รหัสผ่านเก่าไม่ถูกต้อง"));
                exit;
            }
        } else {
            // ไม่พบข้อมูลผู้ใช้
            echo json_encode(array("status" => "error", "msg" => "ไม่พบข้อมูลผู้ใช้"));
            exit;
        }
    }
}
