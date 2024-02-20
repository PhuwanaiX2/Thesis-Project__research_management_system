<!-- Core JS -->
<!-- build:js assets/vendor/js/core.js -->

<script src="./assets/vendor/libs/jquery/jquery.js"></script>
<script src="./assets/vendor/libs/popper/popper.js"></script>
<script src="./assets/vendor/js/bootstrap.js"></script>
<script src="./assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
<script src="./assets/vendor/js/menu.js"></script>


<!-- endbuild -->

<!-- Vendors JS -->
<script src="./assets/vendor/libs/apex-charts/apexcharts.js"></script>

<!-- Main JS -->
<script src="./assets/js/main.js"></script>

<!-- Page JS -->
<script src="./assets/js/dashboards-analytics.js"></script>

<!-- Place this tag in your head or just before your close body tag. -->
<script async defer src="https://buttons.github.io/buttons.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

<script src="./js/registerandlog.js"></script>
<script src="./js/page_admin.js"></script>

<script src="./js/profile.js"></script>
<script src="./js/page_together.js"></script>
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

<script>

$(document).ready(function() {
    $('#example').DataTable({
        "paging": true,
        "scrollX": true,
        "responsive": true,
        language: {
            "sProcessing": "กำลังดำเนินการ...",
            "sLengthMenu": "แสดง _MENU_ แถว",
            "sZeroRecords": "ไม่พบข้อมูล",
            "sInfo": "แสดง _START_ ถึง _END_ จาก _TOTAL_ แถว",
            "sInfoEmpty": "แสดง 0 ถึง 0 จาก 0 แถว",
            "sInfoFiltered": "(กรองข้อมูล _MAX_ ทุกแถว)",
            "sInfoPostFix": "",
            "sSearch": "ค้นหา ",
            "sUrl": "",
            "oPaginate": {
                "sFirst": "หน้าแรก",
                "sPrevious": "ก่อนหน้า",
                "sNext": "ถัดไป",
                "sLast": "หน้าสุดท้าย"
            }
        }
    });
});


</script>
<script>
    function logout() {
        Swal.fire({
            title: "คุณแน่ใจใช่ไหม?",
            text: "คุณต้องการที่จะออกจากระบบใช่ไหม?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            cancelButtonText: "ยกเลิก",
            confirmButtonText: "ใช่"
        }).then((result) => {
            if (result.isConfirmed) {
                // Make an AJAX request to the logout.php file
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "../inc/logout.php", true);
                xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        // Redirect or perform any other client-side actions after logout
                        window.location.href = "../login.php"; // Redirect to login page, for example
                    }
                };
                xhr.send();
            }
        });
    }
</script>