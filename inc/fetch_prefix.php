<?php
include './connect.php'; // เชื่อมต่อฐานข้อมูล

$sql_prefix = "SELECT prefix_id, prefix_name FROM prefix";
$result_prefix = $conn->query($sql_prefix);
$options = '';

if ($result_prefix->num_rows > 0) {
    while ($row_prefix = $result_prefix->fetch_assoc()) {
        $options .= '<option value="' . $row_prefix['prefix_id'] . '">' . $row_prefix['prefix_name'] . '</option>';
    }
}

echo $options;
?>
