function toggle_status(m_id) {
    $.ajax({
      method: 'POST',
      url: '../inc/inc_member.php',
      data: {
        m_id: m_id ,
        up_down: 'up_down'
      },
      success: function(response) {
        console.log(response); // เพื่อตรวจสอบการตอบสนองจาก PHP
        // สามารถทำการปรับแต่งหน้าเว็บหรือทำอื่น ๆ ต่อไปได้
      },
      error: function(error) {
        console.error(error); // กรณีเกิดข้อผิดพลาด
      }
    });
  }