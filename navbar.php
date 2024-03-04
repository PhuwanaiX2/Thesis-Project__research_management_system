<nav class="navbar navbar-expand-lg navbar-detached bg-primary">
  <div class="container">
    <a class="navbar-brand" href="#">ระบบค้นหาและจัดการปริญญานิพนธ์</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link <?php if ($menu == "index") {echo "active";} ?> " href="./index.php">หน้าหลัก</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php if ($menu == "search") { echo "active"; } ?>" href="./index.php" >ค้นหาปริญญานิพนธ์</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php if ($menu == "news") {echo "active";} ?>" href="./news.php" ">ข่าวประชาสัมพันธ์</a>
        </li>
        <?php
        if (isset($_SESSION['status'])) {

          if (isset($_SESSION['status']) && $_SESSION['status'] == 0) {
            echo '
            <li class="nav-item">
          <a class="nav-link" href="./user/">จัดการข้อมูล</a>
        </li>               
                ';
          } else {
            echo '
            <li class="nav-item">
          <a class="nav-link" href="./admin/">จัดการข้อมูล</a>
        </li>
                ';
          }
        } else {
          echo '
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">เริ่มใช้งาน</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="./login.php">เข้าสู่ระบบ</a></li>
            <li><a class="dropdown-item" href="./register.php">สมัครสมาชิก</a></li>
          </ul>
        </li>
        ';
        }
        ?>



      </ul>
    </div>
  </div>
</nav>