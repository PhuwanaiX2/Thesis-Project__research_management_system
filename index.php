<?php include('./head.php');
$menu = "index";
$where = "";


isset($_GET['search']) ? $search = $_GET['search'] : $search = "";
isset($_GET['searchType']) ? $searchType = $_GET['searchType'] : $searchType = "";

if ($searchType === 'thesis_name') {
  $where .= " AND (thesis.thesis_name1 LIKE '%" . $search . "%') ";
} elseif ($searchType === 'thesis_keyword') {
  $where .= " AND (thesis.thesis_keyword LIKE '%" . $search . "%') ";
} elseif ($searchType === 'thesis_des') {
  $where .= " AND (thesis.thesis_des LIKE '%" . $search . "%') ";
} elseif ($searchType === 'author') {
  $where .= " AND (CONCAT(author.author_name1, ' ', author.author_name2)  LIKE '%" . $search . "%') ";
} else {
  // เงื่อนไขเมื่อไม่ได้ระบุประเภทการค้นหาหรือเลือกทั้งหมด
  $where .= " AND ( 
                thesis.thesis_name1 LIKE '%" . $search . "%' 
                OR thesis.thesis_name2 LIKE '%" . $search . "%' 
                OR thesis.thesis_des LIKE '%" . $search . "%' 
                OR thesis.thesis_keyword LIKE '%" . $search . "%' 
             OR (CONCAT(author.author_name1, ' ', author.author_name2)  LIKE '%" . $search . "%')
              ) ";
}


isset($_GET['advisor']) ? $advisor = $_GET['advisor'] : $advisor = "";
if (!empty($advisor)) {
  $where .= " AND ( 
    thesis.Advisor_id LIKE '%" . $advisor . "%' 
    OR thesis.thesis_name2 LIKE '%" . $advisor . "%' 
  ) ";
} else {
  unset($advisor);
}

isset($_GET['branch']) ? $branch = $_GET['branch'] : $branch = "";
if (!empty($branch)) {
  $where .= " AND ( 
    thesis.branch_id = $branch 
  ) ";
} else {
  unset($advisor);
}

isset($_GET['faculty']) ? $faculty = $_GET['faculty'] : $faculty = "";
if (!empty($faculty)) {
  $where .= " AND ( 
    thesis.faculty_id = $faculty 
  ) ";
} else {
  unset($advisor);
}




isset($_GET['typethesis']) ? $typethesis = $_GET['typethesis'] : $typethesis = "";
if (!empty($typethesis)) {
  $where .= " AND ( 
    thesis.typethesis_id = $typethesis 
  ) ";
} else {
  unset($typethesis);
}

isset($_GET['year']) ? $year = $_GET['year'] : $year = "";
if (!empty($year)) {
  $where .= " AND ( 
    thesis.thesis_year = $year 
  ) ";
} else {
  unset($typethesis);
}
// คำสั่ง SQL สำหรับดึงข้อมูลจากตาราง type_thesis
$sql_search = "SELECT 
thesis.thesis_id,
thesis.thesis_name1,
thesis.thesis_name2,
type_thesis.typethesis_name,
thesis.thesis_des,
thesis.thesis_keyword,
thesis.thesis_year,
thesis.thesis_view,
thesis.thesis_status,
thesis.thesis_file,
type_thesis.typethesis_id,
type_thesis.typethesis_name,
Advisor.Advisor_id,
prefix.prefix_id,
prefix.prefix_name,
COUNT(author.author_id) AS num_authors,
GROUP_CONCAT( CONCAT(author.author_name1, ' ', author.author_name2) SEPARATOR ' / ') AS author_full_names,
CONCAT('อาจารย์ ',prefix.prefix_name,'', Advisor.Advisor_name1, ' ', Advisor.Advisor_name2) AS Advisor_full_name,
CONCAT('คณะ',faculty.faculty_name, 'สาขา', branch.branch_name) AS Agency
  FROM 
      thesis      
      JOIN 
        type_thesis ON thesis.typethesis_id = type_thesis.typethesis_id
      JOIN
        Advisor ON thesis.Advisor_id = Advisor.Advisor_id
      JOIN 
        author ON thesis.thesis_id = author.thesis_id 
      JOIN 
        prefix ON Advisor.prefix_id = prefix.prefix_id 
      JOIN 
        faculty ON thesis.faculty_id = faculty.faculty_id 
      JOIN 
        branch ON thesis.branch_id = branch.branch_id  
  WHERE thesis.thesis_status = '1' {$where}
  GROUP BY
      thesis.thesis_id";
$result_search = mysqli_query($conn, $sql_search);

?>

<body>
  <!-- Layout wrapper -->
  <div class="layout-wrapper layout-content-navbar layout-without-menu">
    <div class="layout-container">
      <!-- Layout container -->
      <div class="layout-page">
        <!-- Navbar -->

        <?php include('./navbar.php'); ?>

        <!-- / Navbar -->

        <!-- Content wrapper -->
        <div class="content-wrapper">
          <!-- Content -->

          <div class="container-fluid flex-grow-1 container-p-y">
            <!-- Layout Demo -->


            <div class="col-lg-11 m-auto">


              <div class="card mb-3">
                <div class="card-body">
                  <div class="col-lg-12">
                    <div class="h3 text-center">
                      ค้นหาปริญญานิพนธ์
                    </div>
                  </div>
                  <div class="col-lg-12 mb-2">
                    <form action="<?= $_SERVER['PHP_SELF']; ?>" method="get">

                      <div class="row">

                        <div class="col-lg-3 col-sm-12">
                          <label class="form-label" for="searchType">เลือกประเภทค้นหา:</label>
                          <select id="searchType" name="searchType" class="form-select">
                            <option value="" <?= !empty($_GET['searchType']) ? htmlspecialchars($_GET['searchType']) : ''; ?>>เลือกทั้งหมด</option>
                            <option value="thesis_name" <?= isset($_GET['searchType']) && $_GET['searchType'] == 'thesis_name' ? 'selected' : ''; ?>>ชื่อเรื่อง</option>
                            <option value="thesis_keyword" <?= isset($_GET['searchType']) && $_GET['searchType'] == 'thesis_keyword' ? 'selected' : ''; ?>>คำสำคัญ</option>
                            <option value="thesis_des" <?= isset($_GET['searchType']) && $_GET['searchType'] == 'thesis_des' ? 'selected' : ''; ?>>บทคัดย่อ</option>
                            <option value="author" <?= isset($_GET['searchType']) && $_GET['searchType'] == 'author' ? 'selected' : ''; ?>>ชื่อผู้แต่ง</option>
                          </select>
                        </div>

                        <div class="col-lg-6 col-sm-12 mb-3">
                          <label class="form-label" for="inputGroupSelect01">ค้นหา</label>
                          <div class="input-group input-group-merge">
                            <span class="input-group-text" id="basic-addon-search31"><i class="bx bx-search"></i></span>
                            <input name="search" type="text" class="form-control" placeholder="Search..." aria-label="Search..." aria-describedby="basic-addon-search31" value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>" />
                          </div>
                        </div>


                        <div class="col-lg-3 col-sm-12 mb-3">
                          <label class="form-label" for="inputGroupSelect01">ปีที่วิจัย</label>

                          <select id="thesis_year" name="year" class="form-select select2" data-allow-clear="true">

                            <option selected value="">เลือกทั้งหมด</option>
                            <?php
                            $startYear = 2007;
                            $endYear = date("Y");

                            for ($year = $endYear; $year >= $startYear; $year--) {
                              $buddhistYear = $year + 543;

                              $selected = ($buddhistYear == $_REQUEST["year"]) ? "selected" : "";

                              echo '<option value="' . $buddhistYear . '" ' . $selected . '>' . $buddhistYear . '</option>';
                            }
                            ?>
                          </select>
                        </div>

                        <div class="col-lg-3 col-sm-12 mb-3">
                          <label class="form-label" for="inputGroupSelect01">ประเภทปริญญานิพนธ์</label>
                          <select name="typethesis" class="form-select">
                            <option selected value="">เลือกทั้งหมด</option>
                            <?php
                            // คำสั่ง SQL เพื่อดึงข้อมูลจากตาราง type_thesis
                            $sql = "SELECT typethesis_id, typethesis_name FROM type_thesis";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                              while ($row2 = $result->fetch_assoc()) {
                                $selected = ($row2["typethesis_id"] == $_REQUEST["typethesis"]) ? "selected" : "";
                            ?>
                                <option value="<?php echo $row2["typethesis_id"]; ?>" <?php echo $selected; ?>>
                                  <?php echo $row2["typethesis_name"]; ?>
                                </option>
                            <?php
                              }
                            }
                            ?>
                          </select>
                        </div>

                        <!-- <div class="col-lg-3 col-sm-12 mb-3">
                          <label class="form-label" for="inputGroupSelect01">ที่ปรึกษา</label>
                          <select name="advisor" class="form-select">
                            <option selected value="">เลือกทั้งหมด</option>
                            <?php
                            // คำสั่ง SQL เพื่อดึงข้อมูลจากตาราง type_thesis
                            $sql = "SELECT Advisor.*, prefix.* FROM Advisor LEFT JOIN prefix ON Advisor.prefix_id = prefix.prefix_id";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                              while ($row2 = $result->fetch_assoc()) {
                                $selected = ($row2["Advisor_id"] == $_REQUEST["advisor"]) ? "selected" : "";
                            ?>
                                <option value="<?php echo $row2["Advisor_id"]; ?>" <?php echo $selected; ?>>
                                  <?php echo "ที่ปรึกษา ", $row2["prefix_name"] . "" . $row2["Advisor_name1"] . " " . $row2["Advisor_name2"]; ?>
                                </option>
                            <?php
                              }
                            }
                            ?>
                          </select>
                        </div> -->

                        <div class="col-lg-3 col-sm-12 mb-3">
                          <label class="form-label" for="inputGroupSelect01">คณะ</label>
                          <select name="faculty" id="faculty" class="form-select faculty-search">
                            <option selected value="">เลือกทั้งหมด</option>
                            <?php
                            $sql_faculty = "SELECT faculty_id, faculty_name FROM faculty";
                            $result_faculty = $conn->query($sql_faculty);

                            if ($result_faculty->num_rows > 0) {
                              while ($row_faculty = $result_faculty->fetch_assoc()) {
                                $selected = ($row_faculty["faculty_id"] == $_REQUEST["faculty"]) ? "selected" : "";
                                echo "<option value='{$row_faculty["faculty_id"]}' $selected>{$row_faculty["faculty_name"]}</option>";
                              }
                            }
                            ?>
                          </select>
                        </div>

                        <div class="col-lg-3 col-sm-12 mb-3">
                          <label class="form-label" for="inputGroupSelect01">สาขาวิชา <as class="text-danger">*เลือกคณะก่อน</as></label>
                          <select name="branch" id="branch" class="form-select branch-search">
                            <option value="">เลือกทั้งหมด</option>
                            <?php
                            // โค้ด PHP เพื่อเลือกตัวเลือกสาขาที่ถูกเลือกไว้ก่อนหน้า
                            $selectedBranchId = $_REQUEST['branch'];
                            $cleanedFaculty = mysqli_real_escape_string($conn, $_REQUEST['faculty']);
                            $sql_branch = "SELECT branch_id, branch_name FROM branch WHERE faculty_id = '$cleanedFaculty' ";
                            $result_branch = $conn->query($sql_branch);

                            if ($result_branch->num_rows > 0) {
                              while ($row_branch = $result_branch->fetch_assoc()) {
                                $selected = ($row_branch["branch_id"] == $selectedBranchId) ? "selected" : "";
                                echo "<option value='{$row_branch["branch_id"]}' $selected>{$row_branch["branch_name"]}</option>";
                              }
                            }
                            ?>
                          </select>
                        </div>

                        <div class="col-lg-3 col-sm-12 mb-3">
                          <label class="form-label" for="inputGroupSelect01">ที่ปรึกษา <as class="text-danger">*เลือกสาขาก่อน</as>  </label>
                          <select name="advisor" id="advisor" class="form-select advisor-search">
                            <option value="">เลือกทั้งหมด</option>
                            <?php
                            // โค้ด PHP เพื่อเลือกตัวเลือกสาขาที่ถูกเลือกไว้ก่อนหน้า
                            $selectedAdvisorId = $_REQUEST['advisor'];
                            $cleanedBranch = mysqli_real_escape_string($conn, $_REQUEST['branch']);
                            $sql_advisor = "SELECT advisor.Advisor_id,advisor.Advisor_name1,advisor.Advisor_name2,advisor.branch_id,prefix.prefix_name  FROM advisor 
                            LEFT JOIN prefix ON prefix.prefix_id = advisor.prefix_id WHERE faculty_id = '$cleanedBranch'";
                            $result_advisor = $conn->query($sql_advisor);

                            if ($result_advisor->num_rows > 0) {
                              while ($row_advisor = $result_advisor->fetch_assoc()) {
                                $selected = ($row_advisor["Advisor_id"] == $selectedAdvisorId) ? "selected" : "";
                                echo "<option value='{$row_advisor["Advisor_id"]}' $selected >{$row_advisor["prefix_name"]}{$row_advisor["Advisor_name1"]} {$row_advisor["Advisor_name2"]}</option>";
                              }
                            }
                            ?>
                          </select>
                        </div>

                      </div>
                      <div class="text-end">
                        <button type="button" class="btn btn-danger" onclick="clearGetParams()"><i class='bx bxs-trash menu-icon tf-icons'> </i>ล้างผลการค้นหา</button>
                        <button class="btn btn-success" type="submit"> <i class='bx bx-search-alt-2 menu-icon tf-icons'> </i> ค้นหาข้อมูล</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>

              <div class="card">
                <div class="card-body">
                  <table id="example" class="table" style="width:100%">
                    <thead>
                      <tr>
                        <th width="5%">#</th>
                        <th>รายละเอียด</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $SOLO = 1;
                      if ($result_search->num_rows > 0) {
                        while ($row_search = $result_search->fetch_assoc()) { ?>
                          <tr>
                            <td><?php echo $SOLO++ ?></td>
                            <td>
                              <div class="text-nowrap"><a href="thesis_detail.php?id=<?php echo $row_search["thesis_id"] ?>"><?php echo $row_search["thesis_name1"] ?></a></div>
                              <div><a href="thesis_detail.php?id=<?php echo $row_search["thesis_id"] ?>"><?php echo $row_search["thesis_name2"] ?></a></div>
                              <div>ผู้แต่ง : <?php echo $row_search["author_full_names"] ?></div>
                              ที่ปรึกษา: <a href="index.php?advisor=<?php echo $row_search['Advisor_id'] ?>"><?php echo $row_search["Advisor_full_name"] ?></a><br>
                              <?php echo ($row_search['Agency'] == null) ? "ไม่มีข้อมูล" : $row_search['Agency']; ?></a><br>
                              ปีที่วิจัย: <?php echo ($row_search['thesis_year'] == null) ? "ไม่มีข้อมูล" : $row_search['thesis_year']; ?></a><br>
                            </td>
                          </tr>
                      <?php }
                      }
                      ?>

                    </tbody>
                    
                  </table>
                </div>
              </div>



              <!-- Content wrapper -->
            </div>
          </div>

          <?php include("./footer.php"); ?>
        </div>


        <!-- / Footer -->

      </div>
      <!-- Content wrapper -->
    </div>
    <!-- / Layout page -->
  </div>
  </div>
  <!-- / Layout wrapper -->

  <?php include('./script.php'); ?>

</body>

</html>