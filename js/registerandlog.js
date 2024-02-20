//ล็อกอิน
$("#login").submit(function(e) {
    e.preventDefault();
    let formUrl = $(this).attr("action");
    let reqMethod = $(this).attr("method");
    let formData = $(this).serialize();
    $.ajax({
        url: formUrl,
        type: reqMethod,
        data: formData,
        dataType: 'json',  // ระบุว่าคาดหวังข้อมูลเป็น JSON
        success: function(data) {
            console.log(data);
            if (data.status === "success") {
                Swal.fire({
                    title: "สำเร็จ",      // Title of the SweetAlert, in this case, "Success"
                    text: data.msg,        // Dynamic content, likely a message retrieved from the 'data' object
                    icon: data.status,     // The status from the 'data' object, which is used to determine the type of alert (success, error, etc.)
                    showConfirmButton: false,
                    allowOutsideClick: false,
                });
            
                setTimeout(function () {
                    if (data.role == 1) {
                        window.location.href = './admin/';
                    } else {
                        window.location.href = './user/';
                    }
                }, 2000);
            } else {
                Swal.fire("ล้มเหลว" , data.msg ,  data.status);
            }
        }
    });
});


//สมัครสมาชิก
$("#register").submit(function(e) {
    e.preventDefault();
    let formUrl = $(this).attr("action");
    let reqMethod = $(this).attr("method");
    let formData = $(this).serialize();

    $.ajax({
        url: formUrl,
        type: reqMethod,
        data: formData,
        dataType: 'json',
        success: function(data){
            console.log(data);
            if(data.status === "success"){
                Swal.fire("สำเร็จ" , data.msg ,  data.status).then(function(){
                    window.location.href = "login.php";
                });
            }else{
                Swal.fire("ล้มเหลว" , data.msg ,  data.status);
            }
        }
    })
});


