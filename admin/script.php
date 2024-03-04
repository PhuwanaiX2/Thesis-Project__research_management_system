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
<!-- multiselect and Delete -->
<script src="../js/delete_multiselect.js"></script>
<script src="../js/type_research.js"></script> <!--type_research-->
<script src="../js/news.js"></script> <!--type_research-->
<script src="../js/thesis.js"></script>
<script src="../js/ayo.js"></script> 
<script src="../js/members.js"></script>
<script src="../js/prefix.js"></script>
<script src="../js/branch.js"></script>
<script src="../js/faculty.js"></script>
<script src="../js/advisor.js"></script>



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
    height: 300,
    pastePlain: true,
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

<script>
   $(".edit-form-Advisor").submit(function(e) {
                e.preventDefault();
                let formUrl = $(this).attr("action");
                let reqMethod = $(this).attr("method");
                let formData = new FormData(this);
                // เพิ่มค่าจากปุ่ม submit ที่ถูกคลิก
                formData.append($(document.activeElement).attr('edit_Advisor'), $(document.activeElement).val());
                formData.append('edit_Advisor', $(document.activeElement).val());
                $.ajax({
                    url: formUrl,
                    type: reqMethod,
                    data: formData,
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        if (data.status == "success") {
                            Swal.fire({
                                icon: 'success',
                                title: 'สำเร็จ',
                                text: data.msg
                            }).then(function() {
                                location.reload()
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'ล้มเหลว',
                                text: data.msg
                            });
                        }
                    }
                });
            });
</script>
<!-- 
<script>
  $(document).ready(function() {
    $('.faculty').change(function() {
        var faculty_id = $(this).val();
        $.ajax({
            url: '../inc/get_branch.php',
            type: 'post',
            data: {
                faculty_id: faculty_id
            },
            dataType: 'json',
            success: function(response) {
                // เริ่มต้นด้วยการเพิ่มตัวเลือกเปล่าเพื่อให้ผู้ใช้เลือก
                $(".branch").html("<option value=''>เลือกสาขา</option>");
                $(".advisor").html("<option value=''>เลือกที่ปรึกษา</option>");
                if (response && response.length > 0) {
                    var len = response.length;
                    // เพิ่มตัวเลือกจริงๆ ที่ได้รับมาจาก AJAX
                    for (var i = 0; i < len; i++) {
                        var branch_id = response[i]['branch_id'];
                        var branch_name = response[i]['branch_name'];
                        $(".branch").append("<option value='" + branch_id + "'>" + branch_name + "</option>");
                    }
                }
            },
            error: function(xhr, status, error) {
                console.error("เกิดข้อผิดพลาดในการร้องขอ: " + error);
            }
        });
    });

    $('.branch').change(function() {
        var branch_id = $(this).val();
        if (!branch_id) {
            $(".advisor").html("<option value=''>ไม่มีข้อมูล</option>");
            return; // หยุดการทำงานของฟังก์ชันหลังจากแสดงข้อความ "ไม่มีข้อมูล"
        }
        $.ajax({
            url: '../inc/get_advisor.php',
            type: 'post',
            data: {
                branch_id: branch_id
            },
            dataType: 'json',
            success: function(response) {
                $(".advisor").html("<option value=''>ไม่มีที่ปรึกษา</option>");
                if (response && response.length > 0) {
                    $(".advisor").html("<option value=''>เลือกที่ปรึกษา</option>");
                    var len = response.length;

                    for (var i = 0; i < len; i++) {
                        var advisor_id = response[i]['Advisor_id'];
                        var advisor_name1 = response[i]['Advisor_name1'];
                        var advisor_prefix = response[i]['prefix_name'];
                        var advisor_name2 = response[i]['Advisor_name2'];
                        $(".advisor").append("<option value='" + advisor_id + "'>" + advisor_prefix + advisor_name1 + " " + advisor_name2 + "</option>");
                    }
                }
            },
            error: function(xhr, status, error) {
                console.error("เกิดข้อผิดพลาดในการร้องขอ: " + error);
            }
        });
    });
});

</script> -->
