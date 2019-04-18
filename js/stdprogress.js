$(document).ready(function () {
    $(document).on('click', '.btn-send', function (){
    // $('.btn-pass').on("click",function () {
        var klankrongid = $(this).attr("klankrong-id");
        var progress='send';
        $.ajax({
            url: 'updprogress.php',
            type: 'POST',
            data: { klankrongid,progress },
            dataType: "json",
            success: function (response) {
                console.log(response);
                var btn='รอการตอบรับ';
                $('#btn-checked'+klankrongid).removeClass('btn-success btn-primary btn-danger').addClass('btn-warning');
                $('#btn-checked'+klankrongid).html(btn)
            }
        });
        
    });
    $(document).on('click', '.btn-accept', function (){
    // $('.btn-nopass').on("click",function () {
        var klankrongid = $(this).attr("klankrong-id");
        var progress='accept';
        $.ajax({
            url: 'updprogress.php',
            type: 'POST',
            data: { klankrongid,progress },
            dataType: "json",
            success: function (response) {
                console.log(response);
                var btn='ตอบรับแล้ว';
                $('#btn-checked'+klankrongid).removeClass('btn-warning btn-primary btn-danger').addClass('btn-success');
                $('#btn-checked'+klankrongid).html(btn)
                // $('#btn-checked'+klankrongid).html('<button class="btn btn-success btn-sm btn-block text-white btn-pass" klankrong-id="'+klankrongid+'">ผ่าน</button>')
            }
        });
        
    });
    $(document).on('click', '.btn-reject', function (){
        // $('.btn-nopass').on("click",function () {
            var klankrongid = $(this).attr("klankrong-id");
            var progress='reject';
            $.ajax({
                url: 'updprogress.php',
                type: 'POST',
                data: { klankrongid,progress },
                dataType: "json",
                success: function (response) {
                    console.log(response);
                    var btn='ตอบปฏิเสธ';
                    $('#btn-checked'+klankrongid).removeClass('btn-warning btn-success btn-primary ').addClass('btn-danger');
                    $('#btn-checked'+klankrongid).html(btn)
                    // $('#btn-checked'+klankrongid).html('<button class="btn btn-success btn-sm btn-block text-white btn-pass" klankrong-id="'+klankrongid+'">ผ่าน</button>')
                }
            });
            
        });
});