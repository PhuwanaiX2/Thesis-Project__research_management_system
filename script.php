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

<script>
$(document).ready(function() {
    $('.faculty-search').change(function() {
        var faculty_id = $(this).val();
        $.ajax({
            url: './inc/get_branch.php',
            type: 'post',
            data: {
                faculty_id: faculty_id
            },
            dataType: 'json',
            success: function(response) {
                // เริ่มต้นด้วยการเพิ่มตัวเลือกเปล่าเพื่อให้ผู้ใช้เลือก
                $(".branch-search").html("<option value=''>เลือกทั้งหมด</option>");
                $(".advisor-search").html("<option value=''>เลือกทั้งหมด</option>");
                if (response && response.length > 0) {
                    var len = response.length;
                    // เพิ่มตัวเลือกจริงๆ ที่ได้รับมาจาก AJAX
                    for (var i = 0; i < len; i++) {
                        var branch_id = response[i]['branch_id'];
                        var branch_name = response[i]['branch_name'];
                        $(".branch-search").append("<option value='" + branch_id + "'>" + branch_name + "</option>");
                    }
                }
            },
            error: function(xhr, status, error) {
                console.error("เกิดข้อผิดพลาดในการร้องขอ: " + error);
            }
        });
    });

    $('.branch-search').change(function() {
        var branch_id = $(this).val();
        if (!branch_id) {
            $(".advisor-search").html("<option value=''>เลือกทั้งหมด</option>");
            return; // หยุดการทำงานของฟังก์ชันหลังจากแสดงข้อความ "ไม่มีข้อมูล"
        }
        $.ajax({
            url: './inc/get_advisor.php',
            type: 'post',
            data: {
                branch_id: branch_id
            },
            dataType: 'json',
            success: function(response) {
                $(".advisor-search").html("<option value=''>ไม่มีที่ปรึกษา</option>");
                if (response && response.length > 0) {
                    $(".advisor-search").html("<option value=''>เลือกทั้งหมด</option>");
                    var len = response.length;

                    for (var i = 0; i < len; i++) {
                        var advisor_id = response[i]['Advisor_id'];
                        var advisor_name1 = response[i]['Advisor_name1'];
                        var advisor_prefix = response[i]['prefix_name'];
                        var advisor_name2 = response[i]['Advisor_name2'];
                        $(".advisor-search").append("<option value='" + advisor_id + "'>" + advisor_prefix + advisor_name1 + " " + advisor_name2 + "</option>");
                    }
                }
            },
            error: function(xhr, status, error) {
                console.error("เกิดข้อผิดพลาดในการร้องขอ: " + error);
            }
        });
    });
});
</script>
<!-- 
<script>
  $(document).ready(function() {
    // เมื่อเลือกคณะ
    $('#faculty').change(function() {
      var facultyId = $(this).val();
      // โหลดข้อมูลสาขาของคณะนั้นๆ
      loadBranches(facultyId);
    });

    // เมื่อโหลดหน้าเว็บเริ่มต้นให้โหลดสาขาที่เกี่ยวข้องกับคณะที่ถูกเลือก (ถ้ามี)
    $('#faculty').trigger('change');

    // เมื่อเลือกสาขา
    $('#branch').change(function() {
      var selectedBranch = $(this).val();
      // ถ้าเลือกสาขาที่ไม่ใช่ "เลือกทั้งหมด" ให้แสดงสาขานั้น
      if (selectedBranch !== '') {
        $('#branch option[value=""]').removeAttr('selected');
        $('#branch option[value="' + selectedBranch + '"]').attr('selected', 'selected');
      }
    });

    // ฟังก์ชันโหลดข้อมูลสาขาของคณะ
    function loadBranches(facultyId) {
      // โหลดข้อมูลสาขาของคณะที่ถูกเลือก

      $.ajax({
        url: './inc/fetch_branches.php',
        type: 'post',
        data: {
          faculty_id: facultyId,
          selected_branch: $('#branch').val()
        }, // ส่งค่าสาขาที่ถูกเลือกไว้ก่อนหน้า
        dataType: 'json',
        success: function(response) {
          var len = response.branch-searches.length;
          $('#branch').empty().append("<option value=''>เลือกทั้งหมด</option>");
          for (var i = 0; i < len; i++) {
            var branchId = response.branch-searches[i]['branch_id'];
            var branchName = response.branch-searches[i]['branch_name'];
            var selected = (branchId == response.selected_branch) ? "selected" : "";
            $('#branch').append("<option value='" + branchId + "' " + selected + ">" + branchName + "</option>");
          }
        }
      });
    }


    $('#branch').change(function() {
    var branchId = $(this).val();
    loadadvisor(branchId);
});

$('#branch').trigger('change');

function loadadvisor(branchId) {
    if (!branchId) {
        $('#advisor').empty().append("<option value='' selected>เลือกทั้งหมด</option>");
        return;
    }
    
    $.ajax({
        url: './inc/fetch_advisors.php',
        type: 'post',
        data: {
            branch_id: branchId,
            selected_advisor: $('#advisor').val()
        },
        dataType: 'json',
        success: function(response) {
            var len = response.advisor-searchs.length;

            $('#advisor').empty();
            if (len > 0) {
                $('#advisor').append("<option value=''>เลือกทั้งหมด</option>");
                for (var i = 0; i < len; i++) {
                    var advisorId = response.advisor-searchs[i]['Advisor_id'];
                    var advisorName1 = response.advisor-searchs[i]['Advisor_name1'];
                    var prefix = response.advisor-searchs[i]['prefix_name'];
                    var advisorName2 = response.advisor-searchs[i]['Advisor_name2'];
                    var selected = (advisorId == response.selected_advisor) ? "selected" : "";
                    $('#advisor').append("<option value='" + advisorId + "' " + selected + ">" +prefix + advisorName1 + " " + advisorName2 + "</option>");
                }
            } else {
              $('#advisor').append("<option value=''>ไม่พบข้อมูล</option>");
            }
        }
    });
}

  });
</script> -->