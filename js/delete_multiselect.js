//ลบข้อมูล 
function setupDeleteConfirmation(selector, incUrl) {
  $(selector).click(function (e) {
    e.preventDefault();
    var del_data = $(this).data('id');
    deleteConfirm(del_data, incUrl);
  });
}

function deleteConfirm(del_data, incUrl) {
  Swal.fire({
    icon: 'warning',
    title: 'คุณแน่ใจที่จะลบใช่ไหม?',
    text: "หากลบแล้วจะไม่สามารถกู้ข้อมูลคืนได้ !!",
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    cancelButtonText: 'ยกเลิก',
    confirmButtonText: 'ใช่ ลบเลย!',
    showLoaderOnConfirm: true,
    preConfirm: function () {
      return new Promise(function (resolve) {
        $.ajax({
          url: incUrl,
          type: 'POST',
          data: 'delete=' + del_data,
          dataType: 'json',
          success: function (data) {
            console.log(data);
            console.log(data.msg);
            if (data.status === "success") {
              Swal.fire("สำเร็จ", data.msg, data.status).then(function () {
                location.reload();
              });
            } else {
              console.log(data);
              Swal.fire("ล้มเหลว", data.msg, data.status);
            }
          }
        });
      });
    },
  });
}
// เซ็ตค่าการลบ
setupDeleteConfirmation(".delete-type", '../inc/inc_type_research.php');
setupDeleteConfirmation(".delete-thesis", '../inc/inc_thesis.php');
setupDeleteConfirmation(".delete-news", '../inc/inc_news.php');
setupDeleteConfirmation(".delete-advisor", '../inc/inc_Advisor.php');
setupDeleteConfirmation(".delete-prefix", '../inc/inc_prefix.php');
setupDeleteConfirmation(".delete-branch", '../inc/inc_branch.php');
setupDeleteConfirmation(".delete-faculty", '../inc/inc_faculty.php');

// Select 
$('#select_all').on('click', function () {
  if (this.checked) {
    $('.checkbox').each(function () {
      this.checked = true;
    })
  } else {
    $('.checkbox').each(function () {
      this.checked = false;
    })
  }
})

$('.checkbox').on('click', function () {
  if ($('.checkbox:checked').length == $('.checkbox').length) {
    $('#select_all').prop('checked', true);
  } else {
    $('#select_all').prop('checked', false);
  }
})



// $('#select_all').on('click', function () {
//   if (this.checked) {
//     $('.checkbox').each(function () {
//       this.checked = true;
//     });
//   } else {
//     $('.checkbox').each(function () {
//       this.checked = false;
//     });
//   }
// });

// // Update select all checkbox state based on individual checkboxes
// $('.checkbox').on('click', function () {
//   if ($('.checkbox:checked').length == $('.checkbox').length) {
//     $('#select_all').prop('checked', true);
//   } else {
//     $('#select_all').prop('checked', false);
//   }
// });


// เซ็ตค่าการลบหลายรายการ
setupDeletemulti(".delete_multi_type", '../inc/inc_type_research.php');
setupDeletemulti(".delete_multi_thesis", '../inc/inc_thesis.php');
setupDeletemulti(".delete_multi_news", '../inc/inc_news.php');
setupDeletemulti(".delete_multi_advisor", '../inc/inc_Advisor.php');
setupDeletemulti(".delete_multi_prefix", '../inc/inc_prefix.php');
setupDeletemulti(".delete_multi_branch", '../inc/inc_branch.php');
setupDeletemulti(".delete_multi_faculty", '../inc/inc_faculty.php');
setupDeletemulti(".delete_multi_member", '../inc/inc_member.php');

function setupDeletemulti(selector, incUrldel) {
  $(selector).click(function (e) {
    e.preventDefault();

    var employee = [];
    $(".checkbox:checked").each(function () {
      employee.push($(this).data('ids'));
    });

    if (employee.length <= 0) {
      Swal.fire({
        text: 'กรุณาเลือกรายการที่ต้องการลบ',
        icon: 'warning'
      })
    } else {
      Swal.fire({
        icon: 'warning',
        title: 'คุณแน่ใจที่จะลบใช่ไหม?',
        text: "หากลบแล้วจะไม่สามารถกู้ข้อมูลคืนได้ !!",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'ยกเลิก',
        confirmButtonText: 'ใช่ ลบเลย!',
        showLoaderOnConfirm: true,
        preConfirm: function () {
          var selected_values = employee.join(",");
          $.ajax({
            type: "POST",
            url: incUrldel,
            cache: false,
            data: 'ids=' + selected_values,
            success: function (response) {
              var data = JSON.parse(response); // แปลงข้อมูล JSON เป็น object
              if (data.status === "success") {
                Swal.fire({
                  icon: 'success',
                  title: 'Success',
                  text: data.msg
                }).then(function () {
                  // ทำบางอย่างหลังจากกด OK ใน SweetAlert ได้ที่นี่
                  // เช่น การรีโหลดหน้าเว็บ
                  location.reload();
                });
              } else {
                Swal.fire({
                  icon: 'error',
                  title: 'Failed',
                  text: data.msg
                });
              }
            }
          });
        }
      })
    }
  })
}


// เซ็ตค่าการลบ
setupstatus(".up-status", '../inc/inc_news.php');
//ลบข้อมูล 
function setupstatus(selector, incUrl) {
  $(selector).click(function (e) {
    e.preventDefault();
    var up_status = $(this).data('up');
    up_statusConfirm(up_status, incUrl);
  });
}

function up_statusConfirm(up_status, incUrl) {
  Swal.fire({
    icon: 'warning',
    title: 'คุณแน่ใจใช่ไหม?',
    text: "ต้องการเปลี่ยนสถานะเป็นแอดมิน !!",
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    cancelButtonText: 'ยกเลิก',
    confirmButtonText: 'ใช่ ลบเลย!',
    showLoaderOnConfirm: true,
    preConfirm: function () {
      return new Promise(function (resolve) {
        $.ajax({
          url: incUrl,
          type: 'POST',
          data: 'up_status=' + up_status,
          dataType: 'json',
          success: function (data) {
            console.log(data);
            console.log(data.msg);
            if (data.status === "success") {
              Swal.fire("สำเร็จ", data.msg, data.status).then(function () {
                location.reload();
              });
            } else {
              console.log(data);
              Swal.fire("ล้มเหลว", data.msg, data.status);
            }
          }
        });
      });
    },
  });
}