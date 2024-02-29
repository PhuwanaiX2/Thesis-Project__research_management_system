$(".add_item_btn").click(function (e) {
    e.preventDefault();

    $("#show_item").append(`
<div class="row">

<div class="col-md-5 mb-3">
<input type="text" class="form-control" name="author_name1[]"
placeholder="ชื่อจริง" >
</div>
<div class="col-md-5 mb-3">
<input type="text" class="form-control" name="author_name2[]"
placeholder="นามสกุล" >
</div>
<div class="col-md-2 mb-3 d-grid">
<button class="btn btn-danger remove_item_btn">X</button>
</div>
</div>
`)
});

$(document).on('click', '.remove_item_btn', function (e) {
    e.preventDefault();
    let row_item = $(this).parent().parent();
    $(row_item).remove();
});


$("#add_research").submit(function (e) {
    e.preventDefault();
    let formUrl = $(this).attr("action");
    let reqMethod = $(this).attr("method");
    let formData = new FormData(this);

    // เพิ่มค่าจากปุ่ม submit ที่ถูกคลิก
    formData.append('add_research', $(document.activeElement).val());

    $.ajax({
        url: formUrl,
        type: reqMethod,
        data: formData,
        dataType: 'json',
        contentType: false,
        processData: false,
        success: function (data) {
            if (data.status === "success") {
                Swal.fire({
                    icon: 'success',
                    title: 'สำเร็จ',
                    text: data.msg
                }).then(function () {
                    window.location.href = "mgmt_research.php";
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


$(".edit-form-research").submit(function (e) {
    e.preventDefault();
    let formUrl = $(this).attr("action");
    let reqMethod = $(this).attr("method");
    let formData = new FormData(this);
    // เพิ่มค่าจากปุ่ม submit ที่ถูกคลิก
    formData.append($(document.activeElement).attr('edit_research'), $(document.activeElement).val());
    formData.append('edit_research', $(document.activeElement).val());
    $.ajax({
        url: formUrl,
        type: reqMethod,
        data: formData,
        dataType: 'json',
        contentType: false,
        processData: false,
        success: function (data) {
            if (data.status == "success") {
                Swal.fire({
                    icon: 'success',
                    title: 'สำเร็จ',
                    text: data.msg
                }).then(function () {
                    window.location.href = "mgmt_research.php";
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

$(".edit-form-con").submit(function (e) {
    e.preventDefault();
    let formUrl = $(this).attr("action");
    let reqMethod = $(this).attr("method");
    let formData = new FormData(this);
    // เพิ่มค่าจากปุ่ม submit ที่ถูกคลิก
    formData.append($(document.activeElement).attr('consider'), $(document.activeElement).val());
    formData.append('consider', $(document.activeElement).val());
    $.ajax({
        url: formUrl,
        type: reqMethod,
        data: formData,
        dataType: 'json',
        contentType: false,
        processData: false,
        success: function (data) {
            if (data.status == "success") {
                Swal.fire({
                    icon: 'success',
                    title: 'สำเร็จ',
                    text: data.msg
                }).then(function () {
                    window.location.href = "mgmt_research.php";
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