$("#profile_edit").submit(function(e) {
    e.preventDefault();
    let formUrl = $(this).attr("action");
    let reqMethod = $(this).attr("method");
    let formData = new FormData(this);
  
    // เพิ่มค่าจากปุ่ม submit ที่ถูกคลิก
    formData.append('profile_edit', $(document.activeElement).val());
  
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

  $("#change_password").submit(function(e) {
    e.preventDefault();
    let formUrl = $(this).attr("action");
    let reqMethod = $(this).attr("method");
    let formData = new FormData(this);
  
    // เพิ่มค่าจากปุ่ม submit ที่ถูกคลิก
    formData.append('change_password', $(document.activeElement).val());
  
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