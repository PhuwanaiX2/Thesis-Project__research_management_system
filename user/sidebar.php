<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="index.php" class="app-brand-link">
            <span class="app-brand-text demo menu-text fw-bold ms-2">ระบบหลังบ้าน </span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
       
        <li class="menu-item <?php if ($menu == "dash") { echo "active"; } ?>" >
            <a  href="./index.php" class="menu-link <?php if ($menu == "dash") { echo "active"; } ?> ">
            <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Datatables">หน้าหลัก</div>
            </a>
        </li>

      
      
        <li class="menu-item <?php if ($menu == "research" || $menu == "research_add" ||$menu == "research_all" || $menu == "research_confirm" || $menu == "research_waitconfirm" || $menu == "research_notconfirm") { echo "active open"; } ?>">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-book-bookmark"></i>
                <div data-i18n="Datatables">จัดการปริญญานิพนธ์</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item <?php if ($menu == "research_add") { echo "active"; } ?> ">
                    <a href="./mgmt_research.php?showstatus=add" class="menu-link">
                        <div data-i18n="Analytics">เพิ่มปริญญานิพนธ์</div>
                    </a>
                </li>
                <li class="menu-item <?php if ($menu == "research_all") { echo "active"; } ?> ">
                    <a href="./mgmt_research.php?showstatus=all" class="menu-link">
                        <div data-i18n="Analytics">ปริญญานิพนธ์ทั้งหมด</div>
                    </a>
                </li>
                <li class="menu-item <?php if ($menu == "research_confirm") { echo "active"; } ?> ">
                    <a href="./mgmt_research.php?showstatus=confirm" class="menu-link">
                        <div data-i18n="Analytics">ปริญญานิพนธ์ที่ยืนยันแล้ว</div>
                    </a>
                </li>
                <li class="menu-item <?php if ($menu == "research_waitconfirm") { echo "active"; } ?> ">
                    <a href="./mgmt_research.php?showstatus=waitconfirm" class="menu-link">
                        <div data-i18n="Analytics">ปริญญานิพนธ์ที่รอยืนยัน</div>
                    </a>
                </li>
                <li class="menu-item <?php if ($menu == "research_notconfirm") { echo "active"; } ?> ">
                    <a href="./mgmt_research.php?showstatus=notconfirm" class="menu-link">
                        <div data-i18n="Analytics">ปริญญานิพนธ์ที่ไม่ได้รับการยืนยัน</div>
                    </a>
                </li>
            </ul>
        </li> 

        

        <li class="menu-item <?php if ($menu == "profile" || $menu == "edit" || $menu == "change" ) { echo "active open"; } ?>">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bxs-user"></i>
                <div data-i18n="Datatables">ข้อมูลส่วนตัว</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item <?php if ($menu == "profile") { echo "active"; } ?> ">
                    <a href="mgmt_profile.php?profile=profile" class="menu-link">
                        <div data-i18n="Analytics">ข้อมูลส่วนตัว</div>
                    </a>
                </li>
                <li class="menu-item <?php if ($menu == "edit") { echo "active"; } ?> ">
                    <a href="mgmt_profile.php?profile=edit" class="menu-link">
                        <div data-i18n="Analytics">แก้ไขข้อมูลส่วนตัว</div>
                    </a>
                </li>
                <li class="menu-item <?php if ($menu == "change") { echo "active"; } ?> ">
                    <a href="mgmt_profile.php?profile=change" class="menu-link">
                        <div data-i18n="Analytics">ปริญญานิพนธ์ที่รอยืนยัน</div>
                    </a>
                </li>
            </ul>
        </li> 


    </ul>
</aside>
<!-- / Menu -->