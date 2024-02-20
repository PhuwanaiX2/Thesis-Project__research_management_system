<!-- Core JS -->
<!-- build:js assets/vendor/js/core.js -->

<script src="../assets/vendor/libs/jquery/jquery.js"></script>
<script src="../assets/vendor/libs/popper/popper.js"></script>
<script src="../assets/vendor/js/bootstrap.js"></script>
<script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
<script src="../assets/vendor/js/menu.js"></script>


<!-- endbuild -->

<!-- Vendors JS -->
<script src="../assets/vendor/libs/apex-charts/apexcharts.js"></script>

<!-- Main JS -->
<script src="../assets/js/main.js"></script>

<!-- Page JS -->
<script src="../assets/js/dashboards-analytics.js"></script>

<!-- Place this tag in your head or just before your close body tag. -->
<script async defer src="https://buttons.github.io/buttons.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

<!-- Sweet toggle-->
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

<!-- เขียนเพิ่ม-->
<!-- <script src="../js/full_thesis.js"></script> research -->
<script src="../js/profile.js"></script> <!--Profile-->
<script src="../js/registerandlog.js"></script> <!-- LOGIN-->
<!-- <script src="../js/text.js"></script> LOGIN -->
<script src="../js/delete_multiselect.js"></script> <!-- multiselect and Delete-->
<script src="../js/type_research.js"></script> <!--type_research-->
<script src="../js/news.js"></script> <!--type_research-->
<script src="../js/thesis.js"></script> 
<!-- <script src="../js/ayo.js"></script>  -->
<script src="../js/members.js"></script> 
<script src="../js/prefix.js"></script> 
<script src="../js/branch.js"></script> 
<script src="../js/faculty.js"></script> 



<!-- datadable -->

<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.colVis.min.js"></script>

<!-- summernote -->
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script>
  $('.summernote').summernote({
    tabsize: 2,
    height: 300,
    disableDragAndDrop: true,
    disableFileUpload: true, // ปิดการอัพโหลดไฟล์
    disableDragAndDrop: true, // ปิดการลากและวางไฟล์
    callbacks: {
      onImageUpload: function(files, editor, welEditable) {
        // ไม่อนุญาตให้อัพโหลดรูป
        Swal.fire({
          icon: "warning",
          title: "Oops...",
          text: "ไม่สามารถอัปรูปภาพผ่านเครื่องได้ กรุณาใส่รูปภาพผ่านลิ้งค์เท่านั้น",
          footer: '<a href="https://pic.in.th/?lang=th" target="_blank">? ฝากรูปภาพ</a>'
        });
        return false;
      }
    },
    toolbar: [
      ['style', ['style']],
      ['font', ['bold', 'underline', 'clear']],
      ['color', ['color']],
      ['para', ['ul', 'ol', 'paragraph']],
      ['insert', ['link', 'picture']]
    ]
  });
</script>

<!-- datatable -->
<script>
  $(document).ready(function() {
    var table = $('#myTable').DataTable({
      lengthChange: true,
      autoWidth: true,
      search: {
        return: true
      },
      pagingType: "first_last_numbers",
      order: [
        [0, "asc"]
      ],
      lengthMenu: [
        [10, 25, 50, -1],
        [10, 25, 50, "All"]
      ],
      scrollX: true, // เปิดใช้งานการเลื่อนแนวนอน
      scrollXInner: "100%", // กำหนดความกว้างของตาราง
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