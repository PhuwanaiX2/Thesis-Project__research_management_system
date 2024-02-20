<?php 
session_start();
include("./inc/connect.php");
$c_log = $_SERVER['REMOTE_ADDR'];
$sql_counter = "INSERT INTO web_counter (c_log) VALUE ('$c_log')";
$result_counter = mysqli_query($conn, $sql_counter) or die("Error in query: $result_counter " . mysqli_error($conn));

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>System Research</title>

    <meta name="description" content="" />


    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet" />

    <link rel="stylesheet" href="./assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="./assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="./assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="./assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="./assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="./assets/vendor/libs/apex-charts/apex-charts.css" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="./assets/vendor/js/helpers.js"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="./assets/js/config.js"></script>

    <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
  </head>
  <style>

/* ถ้าเลือกอยู่ */
.dataTables_wrapper .dataTables_paginate .paginate_button.current,
.dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
  border-color: #696cff;
  color: white !important;
  background-color: #696cff;

}

/* ถ้าจะเลือก */
.dataTables_wrapper .dataTables_paginate .paginate_button:hover {
    color:  #697a8d !important;
    background-color: #e1e4e8;
    background:  #e1e4e8;
    border-color: #e1e4e8;
}

/* ถ้าจะกดเลือก */
.dataTables_wrapper .dataTables_paginate .paginate_button:focus {
    color:  #697a8d !important;
    background-color: #e1e4e8;
    background:  #e1e4e8;
    border-color: #e1e4e8;
    box-shadow: none;
}

/* ปุ่มที่ไม่ถูกเลือก */
.dataTables_wrapper .dataTables_paginate .paginate_button {
    color: #697a8d !important;
    background-color: #fff;
    background:  #f0f2f4;
    padding: 8px, 18px;
}




</style>
