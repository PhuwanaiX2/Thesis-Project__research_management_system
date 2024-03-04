<?php
include './connect.php';

$branch_id = $_POST['branch_id'];

// คิวรี่ข้อมูลที่ปรึกษาที่เกี่ยวข้องกับสาขา
$sql = "SELECT advisor.Advisor_id,advisor.Advisor_name1,advisor.Advisor_name2,advisor.branch_id,prefix.prefix_name  FROM advisor 
LEFT JOIN prefix ON prefix.prefix_id = advisor.prefix_id
WHERE advisor.branch_id = '$branch_id'";
$result = $conn->query($sql);

$rows = array();
while($r = mysqli_fetch_assoc($result)) {
    $rows[] = $r;
}

echo json_encode($rows);

$conn->close();
?>
