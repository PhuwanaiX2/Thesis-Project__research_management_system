<?php
include('connect.php');
// print_r($_POST);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // echo json_encode(array("status" => "success", "msg" => "เข้าสู่ระบบเป็น admin"));

    $m_name1 = $_POST['m_name1'];
    $m_name2 = $_POST['m_name2'];
    $m_phone = $_POST['m_phone'];
    $m_email = $_POST['m_email'];
    $m_username = $_POST['m_username'];
    $m_password = $_POST['m_password'];
    $m_password_confirm = $_POST['m_password_confirm'];


    // ตรวจสอบว่ารหัสผ่านตรงกันหรือไม่
    if ($m_password !== $m_password_confirm) {
        echo json_encode(array("status" => "error", "msg" => "รหัสผ่านไม่ตรงกัน"));
        exit;
    }

    // ตรวจสอบว่ารหัสผ่านมีความซับซ้อนตามเงื่อนไข
    if (strlen($m_password) < 8 || !preg_match("/[A-Z]/", $m_password) || !preg_match("/[a-z]/", $m_password) || !preg_match("/\d/", $m_password) || !preg_match("/\W/", $m_password)) {
        echo json_encode(array("status" => "error", "msg" => "รหัสผ่านต้องมีอย่างน้อย 8 ตัวอักษร ประกอบด้วยพิมพ์ใหญ่, พิมพ์เล็ก, ตัวเลข, และอักขระพิเศษ"));
        exit;
    }

    // ตรวจสอบว่าUSERNAME มีความซับซ้อนตามเงื่อนไข
    if (strlen($m_username) < 4) {
        echo json_encode(array("status" => "error", "msg" => "USERNAME ต้องมีความยาวมากกว่า 4ตัว"));
        exit;
    }

    // ตรวจสอบว่าUSERNAME มีความซับซ้อนตามเงื่อนไข
    if (!preg_match("/^[a-zA-Z0-9\d\W]+$/", $username)) {
        echo json_encode(array("status" => "error", "msg" => "ชื่อผู้ใช้ถูกต้อง"));
        exit;
    }

    if (!filter_var($m_email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(array("status" => "error", "msg" => "อีเมลไม่ถูกต้อง"));
        exit;
    }

    if (!preg_match("/^[0-9]{10}$/", $m_phone)) {
        echo json_encode(array("status" => "error", "msg" => "เบอร์โทรไม่ถูกต้อง"));
        exit;
    }

    // ตรวจสอบข้อมูลที่ไม่สามารถใช้ซ้ำกันได้ (username)
    $check_username = "SELECT m_id FROM members WHERE m_username = ?";
    $stmtcheck_username = mysqli_prepare($conn, $check_username);
    mysqli_stmt_bind_param($stmtcheck_username, "s", $m_username);
    mysqli_stmt_execute($stmtcheck_username);
    // ดึงผลลัพธ์
    mysqli_stmt_store_result($stmtcheck_username);
    // ตรวจสอบจำนวนแถวที่ได้
    if (mysqli_stmt_num_rows($stmtcheck_username) > 0) {
        echo json_encode(array("status" => "error", "msg" => "Username นี้มีคนใช้แล้ว"));
        exit();
    }
    mysqli_stmt_close($stmtcheck_username);


    // ตรวจสอบข้อมูลที่ไม่สามารถใช้ซ้ำกันได้ (เบอร์)
    $check_phone = "SELECT m_id FROM members WHERE m_phone = ?";
    $stmtcheck_phone = mysqli_prepare($conn, $check_phone);
    mysqli_stmt_bind_param($stmtcheck_phone, "s", $m_phone);
    mysqli_stmt_execute($stmtcheck_phone);
    // ดึงผลลัพธ์
    mysqli_stmt_store_result($stmtcheck_phone);
    // ตรวจสอบจำนวนแถวที่ได้
    if (mysqli_stmt_num_rows($stmtcheck_phone) > 0) {
        echo json_encode(array("status" => "error", "msg" => "เบอร์โทรศัพท์นี้มีคนใช้แล้ว"));
        exit();
    }
    mysqli_stmt_close($stmtcheck_phone);


    // ตรวจสอบข้อมูลที่ไม่สามารถใช้ซ้ำกันได้ (email)
    $check_email = "SELECT m_id FROM members WHERE m_email = ?";
    $stmtcheck_email = mysqli_prepare($conn, $check_email);
    mysqli_stmt_bind_param($stmtcheck_email, "s", $m_email);
    mysqli_stmt_execute($stmtcheck_email);
    // ดึงผลลัพธ์
    mysqli_stmt_store_result($stmtcheck_email);
    // ตรวจสอบจำนวนแถวที่ได้
    if (mysqli_stmt_num_rows($stmtcheck_email) > 0) {
        echo json_encode(array("status" => "error", "msg" => "อีเมลนี้มีคนใช้แล้ว"));
        exit();
    }
    mysqli_stmt_close($stmtcheck_email);

    $checkDuplicateSql = "SELECT * FROM members WHERE (?, ?) IN (SELECT m_name1, m_name2 FROM members GROUP BY m_name1, m_name2 ) ";
    $checkStmt = mysqli_prepare($conn, $checkDuplicateSql);
    mysqli_stmt_bind_param($checkStmt, "ss", $m_name1, $m_name2);
    mysqli_stmt_execute($checkStmt);
    mysqli_stmt_store_result($checkStmt);
    if (mysqli_stmt_num_rows($checkStmt) > 0) {
        echo json_encode(array("status" => "error", "msg" => "ชื่อนามสกุลนี้มีอยู่แล้ว"));
        exit();
    }
    mysqli_stmt_close($checkStmt);

    // เข้ารหัสรหัสผ่าน
    $hashed_password = password_hash($m_password, PASSWORD_BCRYPT);

    $register = "INSERT INTO members (m_name1, m_name2, m_phone, m_email, m_username, m_password) 
        VALUES (?, ?, ?, ?, ?, ?)";
    $stmt_register = mysqli_prepare($conn, $register);
    mysqli_stmt_bind_param($stmt_register, "ssssss",  $m_name1, $m_name2, $m_phone, $m_email, $m_username, $hashed_password);
    if (mysqli_stmt_execute($stmt_register)) {
        echo json_encode(array("status" => "success", "msg" => "สมัครสมาชิกสำเร็จ"));
    }
} else {
    header("Location: logout.php"); // หน้า login.php หรือหน้าหลังจากออกจากระบบ
}
