
<?php
include './connect.php';

$faculty_id = $_POST['faculty_id'];

// คิวรี่ข้อมูลที่ปรึกษาที่เกี่ยวข้องกับสาขา
$sql = "SELECT * FROM branch WHERE faculty_id = '$faculty_id'";
$result = $conn->query($sql);

$rows = array();
while($r = mysqli_fetch_assoc($result)) {
    $rows[] = $r;
}

echo json_encode($rows);

$conn->close();
?>
