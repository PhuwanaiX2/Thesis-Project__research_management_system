<?php
session_start();
include("./connect.php");


//ลบ 1ตัว
if (isset($_POST['delete'])) {
    $delete_id = $_POST['delete'];

    $del_type = "DELETE FROM thesis WHERE thesis_id = ?";
    $stmt_del_type = mysqli_prepare($conn, $del_type);
    mysqli_stmt_bind_param($stmt_del_type, "i", $delete_id);

    if (mysqli_stmt_execute($stmt_del_type)) {
        $del_author = "DELETE FROM author WHERE thesis_id IN ( ? )";
        $stmt_del_author = mysqli_prepare($conn, $del_author);
        mysqli_stmt_bind_param($stmt_del_author, "i", $delete_id);
        $result_del_author = mysqli_stmt_execute($stmt_del_author);

        if ($result_del_author){
            echo json_encode(array("status" => "success", "msg" => "ลบข้อมูลสำเร็จ"));
        }else{
            echo json_encode(array("status" => "error", "msg" => "ไม่สามารถลบข้อมูลได้"));
        }

    } else {
        echo json_encode(array("status" => "error", "msg" => "ไม่สามารถลบข้อมูลได้"));
    }
    exit();
}


// ตรวจสอบว่ามีการส่งข้อมูล ids มาหรือไม่
if (isset($_POST['ids'])) {
    // ดึงค่า ids จากข้อมูลที่ส่งมา
    $idsString = $_POST['ids'];
    // แยกค่า ids ออกเป็น array
    $idsArray = explode(",", $idsString);
    if (count($idsArray) > 0) {
        $placeholders = implode(',', array_fill(0, count($idsArray), '?'));
        $sql = "DELETE FROM thesis WHERE thesis_id IN ($placeholders)";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
            // Bind parameters
            $types = str_repeat('i', count($idsArray)); 
            mysqli_stmt_bind_param($stmt, $types, ...$idsArray); 
            $result = mysqli_stmt_execute($stmt);

            if ($result) {
                // สร้างคำสั่ง SQL ลบข้อมูลจากตาราง 'author'
                $del_author = "DELETE FROM author WHERE thesis_id IN ($placeholders)";
                $stmt_del_author = mysqli_prepare($conn, $del_author);

                // Bind parameters
                mysqli_stmt_bind_param($stmt_del_author, $types, ...$idsArray); 

                // ประมวลผลคำสั่ง SQL
                $result_del_author = mysqli_stmt_execute($stmt_del_author);

                if ($result_del_author){
                    echo json_encode(array("status" => "success", "msg" => "ลบข้อมูลสำเร็จ"));
                } else {
                    echo json_encode(array("status" => "error", "msg" => "ไม่สามารถลบข้อมูลได้"));
                }
            } else {
                echo json_encode(array("status" => "error", "msg" => "ไม่สามารถลบข้อมูลได้"));
            }

            // ปิด prepared statement
            mysqli_stmt_close($stmt);
        } else {
            echo json_encode(array("status" => "error", "msg" => "กรณีเกิดข้อผิดพลาดในการเตรียมคำสั่ง"));
        }
    } else {
        echo json_encode(array("status" => "error", "msg" => "ถ้าไม่มีการส่งข้อมูล"));
    }
}





if (isset($_POST['add_research'])) {
    $member_id = $_POST["member_id"];
    $thesis_name1 = $_POST["thesis_name1"];
    $thesis_name2 = $_POST["thesis_name2"];
    $advisor_id = $_POST["advisor_id"];
    $thesis_des = $_POST["thesis_des"];
    $typethesis_id = $_POST["typethesis_id"];
    $thesis_year = $_POST["thesis_year"];
    $thesis_keyword = $_POST["thesis_keyword"];
    $branch_id = $_POST["branch_id"];
    $faculty_id = $_POST["faculty_id"];

    if ($_SESSION['status'] == 1) {
        $add_status = '1';
    } else {
        $add_status = '0';
    }

    if ((!$thesis_name1) || (!$thesis_name2) || (!$advisor_id) || (!$thesis_des) || (!$typethesis_id) || (!$thesis_year) || (!$thesis_keyword)) {
        echo json_encode(array("status" => "error", "msg" => "ข้อมูลไม่ครบ"));
    } else {
        // ถ้าข้อมูลทั้งหมดครบ

        //เช็คชื่อซ้ำ 
        $checkDuplicateSql = "SELECT * FROM thesis WHERE thesis_name1 = ? OR thesis_name2 = ?";
        $checkStmt = mysqli_prepare($conn, $checkDuplicateSql);
        mysqli_stmt_bind_param($checkStmt, "ss", $thesis_name1, $thesis_name2);
        mysqli_stmt_execute($checkStmt);
        mysqli_stmt_store_result($checkStmt);

        if (mysqli_stmt_num_rows($checkStmt) > 0) {
            echo json_encode(array("status" => "error", "msg" => "ชื่อปริญญานิพนธ์นี้มีอยู่แล้ว"));
        } else {
            // ไม่มีข้อมูลซ้ำ ทำการเพิ่มข้อมูล
            $conn->begin_transaction(); // เริ่ม transaction

            $file1 = $_FILES['file_1'];
            $newname1 = null;
            //กำหนดชื่อที่จะตั้ง 
            $date = date("Ymd_His");
            //ที่เก็บไฟล์PDF
            $uploadDirectory = '../uploads/';

            // หากไฟล์ มีค่าname = '' จะไม่เข้าเงื่อนไข
            if (!empty($file1['name'])) {
                // ข้อมูลไฟล์ที่ 1
                $typefile1 = strrchr($file1['name'], ".");
                $newname1 = 'research' .  uniqid() . $date . $typefile1;
                $path_copy1 = $uploadDirectory . $newname1;
                move_uploaded_file($file1['tmp_name'], $path_copy1);
            } else {
                echo json_encode(array("status" => "error", "msg" => "ไม่มีไฟล์"));
                exit();
            }

            //บันทึกข้อมูล ปริญญานิพนธ์
            $insertQuery = "INSERT INTO thesis (thesis_name1, thesis_name2, thesis_des, thesis_keyword, thesis_year,thesis_status, typethesis_id, advisor_id , faculty_id , branch_id ,thesis_file, m_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $insertStmt = mysqli_prepare($conn, $insertQuery);
            mysqli_stmt_bind_param($insertStmt, "ssssssiiiisi", $thesis_name1, $thesis_name2, $thesis_des, $thesis_keyword, $thesis_year, $add_status, $typethesis_id, $advisor_id, $faculty_id, $branch_id, $newname1, $member_id);

            //หากบันทึกสำเร็จ
            if (mysqli_stmt_execute($insertStmt) === TRUE) {
                //หากบันทุกสำเร็จจะเก็บ ค่าตามนี้
                $last_insert_id = $conn->insert_id; // รหัสปริญญานิพนธ์ที่เพิ่มล่าสุด

                //บันทึกสมชิก
                foreach ($_POST['author_name1'] as $key => $value) {

                    $insertAuthor = "INSERT INTO author (prefix_id, author_name1, author_name2, thesis_id) VALUES (?, ?, ?, ?)";
                    $insertStmt1 = mysqli_prepare($conn, $insertAuthor);
                    mysqli_stmt_bind_param($insertStmt1, 'issi', $_POST['prefix_id'][$key], $_POST['author_name1'][$key], $_POST['author_name2'][$key], $last_insert_id);
                    mysqli_stmt_execute($insertStmt1);
                }

                //สำเร็จ 
                $conn->commit();
                echo json_encode(array("status" => "success", "msg" => "เพิ่มปริญญานิพนธ์สำเร็จแล้ว"));


                // echo json_encode(array("status" => "success", "msg" => "สำเร็จ"));
            } else {

                $conn->rollback();
                echo json_encode(array("status" => "error", "msg" => "ไม่สามารถเพิ่มสมาชิกปริญญานิพนธ์ได้"));
            }
        }
    };

    exit();
}


if (isset($_POST['edit_research'])) {

    $file1 = $_FILES['file_1'];
    $thesis_id = $_POST["thesis_id"];
    $thesis_name1 = $_POST["thesis_name1"];
    $thesis_name2 = $_POST["thesis_name2"];
    $advisor_id = $_POST["advisor_id"];
    $thesis_des = $_POST["thesis_des"];
    $typethesis_id = $_POST["typethesis_id"];
    $thesis_year = $_POST["thesis_year"];
    $thesis_keyword = $_POST["thesis_keyword"];
    $branch_id = $_POST["branch_id"];
    $faculty_id = $_POST["faculty_id"];

    if ($_SESSION['status'] == 1) {
        $thesis_status = '1';
    } else {
        $thesis_status = '0';
    }


    if ((!$thesis_name1) || (!$thesis_name2) ||  (!$thesis_des) || (!$typethesis_id) || (!$thesis_year) || (!$thesis_keyword)) {
        echo json_encode(array("status" => "error", "msg" => "ข้อมูลไม่ครบ"));
    } else {
        //เช็คชื่อซ้ำ 
        $checkDuplicateSql = "SELECT * FROM thesis WHERE (thesis_name1 = ? OR thesis_name2 = ?) AND thesis_id != ?";
        $checkStmt = mysqli_prepare($conn, $checkDuplicateSql);
        mysqli_stmt_bind_param($checkStmt, "ssi", $thesis_name1, $thesis_name2, $thesis_id);
        mysqli_stmt_execute($checkStmt);
        mysqli_stmt_store_result($checkStmt);

        if (mysqli_stmt_num_rows($checkStmt) > 0) {
            echo json_encode(array("status" => "error", "msg" => "ชื่อปริญญานิพนธ์นี้มีอยู่แล้ว"));
        } else {


            //ถ้ามีไฟล์ เข้า
            if (!empty($file1['name'])) {
                // ไม่มีข้อมูลซ้ำ ทำการเพิ่มข้อมูล
                $conn->begin_transaction(); // เริ่ม transaction

                //กำหนดชื่อที่จะตั้ง 
                $date = date("Ymd_His");
                //ที่เก็บไฟล์PDF
                $uploadDirectory = '../uploads/';
                // ข้อมูลไฟล์ที่ 1
                $typefile1 = strrchr($file1['name'], ".");
                $newname1 = 'research_' .  uniqid() . $date . $typefile1;
                $path_copy1 = $uploadDirectory . $newname1;
                move_uploaded_file($file1['tmp_name'], $path_copy1);

                //บันทึกข้อมูล ปริญญานิพนธ์
                $updateQuery = "UPDATE thesis SET thesis_name1 = ?, thesis_name2 = ?, thesis_des = ?, thesis_keyword = ?, thesis_year = ?, thesis_status = ?, typethesis_id = ? , Advisor_id = ? , faculty_id = ? , branch_id = ?, thesis_file = ? WHERE thesis_id = ?";
                $updateStmt = mysqli_prepare($conn, $updateQuery);
                mysqli_stmt_bind_param($updateStmt, "ssssssiiiisi", $thesis_name1, $thesis_name2, $thesis_des, $thesis_keyword, $thesis_year, $thesis_status, $typethesis_id, $advisor_id, $faculty_id, $branch_id, $newname1, $thesis_id);

                if (mysqli_stmt_execute($updateStmt) === TRUE) {

                    // ลบข้อมูลสมาชิกเก่าออกก่อน
                    $sql_delete_author = "DELETE FROM author WHERE thesis_id = ?";
                    $deleteStmt = mysqli_prepare($conn, $sql_delete_author);
                    mysqli_stmt_bind_param($deleteStmt, "i", $thesis_id);
                    mysqli_stmt_execute($deleteStmt);

                    //เพิ่มข้อมูลใหม่
                    foreach ($_POST['author_name1'] as $key => $value) {

                        $insertAuthor = "INSERT INTO author (prefix_id, author_name1, author_name2, thesis_id) VALUES (?, ?, ?, ?)";
                        $insertStmt1 = mysqli_prepare($conn, $insertAuthor);
                        mysqli_stmt_bind_param($insertStmt1, 'issi', $_POST['prefix_id'][$key], $_POST['author_name1'][$key], $_POST['author_name2'][$key], $thesis_id);
                        mysqli_stmt_execute($insertStmt1);
                    }
                }
                //สำเร็จ 
                $conn->commit();
                echo json_encode(array("status" => "success", "msg" => "แก้ไขปริญญานิพนธ์สำเร็จ"));
            } else {

                // ไม่มีข้อมูลซ้ำ ทำการเพิ่มข้อมูล
                $conn->begin_transaction(); // เริ่ม transaction
                //บันทึกข้อมูล ปริญญานิพนธ์
                $updateQuery = "UPDATE thesis SET thesis_name1 = ?, thesis_name2 = ?, thesis_des = ?, thesis_keyword = ?, thesis_year = ?, thesis_status = ?, typethesis_id = ? , Advisor_id = ? , faculty_id = ? , branch_id = ?, thesis_file = ? WHERE thesis_id = ?";
                $updateStmt = mysqli_prepare($conn, $updateQuery);
                mysqli_stmt_bind_param($updateStmt, "ssssssiiiisi", $thesis_name1, $thesis_name2, $thesis_des, $thesis_keyword, $thesis_year, $thesis_status, $typethesis_id, $advisor_id, $faculty_id, $branch_id, $newname1, $thesis_id);

                if (mysqli_stmt_execute($updateStmt) === TRUE) {

                    // ลบข้อมูลสมาชิกเก่าออกก่อน
                    $sql_delete_author = "DELETE FROM author WHERE thesis_id = ?";
                    $deleteStmt = mysqli_prepare($conn, $sql_delete_author);
                    mysqli_stmt_bind_param($deleteStmt, "i", $thesis_id);
                    mysqli_stmt_execute($deleteStmt);

                    //เพิ่มข้อมูลใหม่
                    foreach ($_POST['author_name1'] as $key => $value) {

                        $insertAuthor = "INSERT INTO author (prefix_id, author_name1, author_name2, thesis_id) VALUES (?, ?, ?, ?)";
                        $insertStmt1 = mysqli_prepare($conn, $insertAuthor);
                        mysqli_stmt_bind_param($insertStmt1, 'issi', $_POST['prefix_id'][$key], $_POST['author_name1'][$key], $_POST['author_name2'][$key], $thesis_id);
                        mysqli_stmt_execute($insertStmt1);
                    }
                }
                //สำเร็จ 
                $conn->commit();
                echo json_encode(array("status" => "success", "msg" => "แก้ไขปริญญานิพนธ์สำเร็จ"));
            }
        }
    };
    exit();
}



if (isset($_POST['consider'])) {

    $thesis_id = $_POST["thesis_id"];
    $status = $_POST['consider'];

    if ($status == 'consider1') {
        $consider = '1';
    } elseif ($status == 'consider2') {
        $consider = '2';
    } else {
        echo json_encode(array("status" => "error", "msg" => "ค่าสถานะไม่ถูกต้อง"));
        exit;
    }

    // ไม่มีข้อมูลซ้ำ ทำการเพิ่มข้อมูล
    $updateQuery = "UPDATE thesis SET thesis_status = ? WHERE thesis_id = ?";
    $updateStmt = mysqli_prepare($conn, $updateQuery);
    mysqli_stmt_bind_param($updateStmt, "si", $consider, $thesis_id);
    mysqli_stmt_execute($updateStmt);
    echo json_encode(array("status" => "success", "msg" => "ตรวจสอบสำเร็จ"));
    mysqli_stmt_close($updateStmt);
}
