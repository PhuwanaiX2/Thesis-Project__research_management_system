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