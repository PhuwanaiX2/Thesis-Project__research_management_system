function toggle_check(news_id) {
    $.ajax({
      method: 'POST',
      url: '../inc/inc_news.php',
      data: {
        news_id: news_id ,
        sum: 'sum'
      },
      success: function(response) {
        console.log(response); // เพื่อตรวจสอบการตอบสนองจาก PHP
      },
      error: function(error) {
        console.error(error); // กรณีเกิดข้อผิดพลาด
      }
    });
  }

  $("#add_news").submit(function(e) {
    e.preventDefault();
    let formUrl = $(this).attr("action");
    let reqMethod = $(this).attr("method");
    let formData = new FormData(this);

    // เพิ่มค่าจากปุ่ม submit ที่ถูกคลิก
    formData.append('add_news', $(document.activeElement).val());

    $.ajax({
      url: formUrl,
      type: reqMethod,
      data: formData,
      dataType: 'json',
      contentType: false,
      processData: false,
      success: function(data) {
        if (data.status === "success") {
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

  $(".edit-form-news").submit(function(e) {
    e.preventDefault();
    let formUrl = $(this).attr("action");
    let reqMethod = $(this).attr("method");
    let formData = new FormData(this);
    // เพิ่มค่าจากปุ่ม submit ที่ถูกคลิก
    formData.append($(document.activeElement).attr('edit_news'), $(document.activeElement).val());
    formData.append('edit_news', $(document.activeElement).val());
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