<?php
include('connect.php');


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
        $m_username = $_POST['m_username'];
        $m_password = $_POST['m_password'];

    // ตรวจสอบข้อมูลที่ไม่สามารถใช้ซ้ำกันได้ (username)
    $check_username = "SELECT * FROM members WHERE m_username = ?";
    $stmtcheck_username = mysqli_prepare($conn, $check_username);
    mysqli_stmt_bind_param($stmtcheck_username, "s", $m_username);
    mysqli_stmt_execute($stmtcheck_username);
    // ดึงผลลัพธ์
    mysqli_stmt_store_result($stmtcheck_username);

    // ตรวจสอบจำนวนแถวที่ได้
    if (mysqli_stmt_num_rows($stmtcheck_username) > 0) {
        // กำหนดตัวแปรที่จะเก็บข้อมูลที่ถูกดึง
        mysqli_stmt_bind_result($stmtcheck_username, $id, $name1, $name2, $phone, $email, $username, $hashed_password, $status);

        // ดึงข้อมูลออกมา
        mysqli_stmt_fetch($stmtcheck_username);

        // ตรวจสอบรหัสผ่าน
        if (password_verify($m_password, $hashed_password)) {
            session_start();
            $_SESSION['status'] = $status;
            $_SESSION['member_id'] = $id;
            $_SESSION['fname'] = $name1;
            $_SESSION['lname'] = $name2;
            $_SESSION['phone'] = $phone;
            $_SESSION['email'] = $email;
            $_SESSION['username'] = $username;

            if ($status == 1) {
                echo json_encode(array("status" => "success", "msg" => "เข้าสู่ระบบเป็น admin", "role" => "1"));
                exit();
            } elseif ($status == 0) {
                echo json_encode(array("status" => "success", "msg" => "เข้าสู่ระบบเป็น USER", "role" => "0"));
                exit();
            }
        }else{
            echo json_encode(array("status" => "error", "msg" => "รหัสผ่านไม่ถูกต้อง"));
                exit();
        }
    }else{
        echo json_encode(array("status" => "error", "msg" => "ไม่พบชื่อเข้าใช้"));
                exit();
    }
    mysqli_stmt_close($stmtcheck_username);
session_write_close();  // ปิด session หลังจากที่เราได้ใช้ข้อมูล session ครบแล้ว

}
header("Location: logout.php"); // หน้า login.php หรือหน้าหลังจากออกจากระบบ

