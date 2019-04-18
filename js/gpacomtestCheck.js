$(document).ready(function () {
    $(document).on('click', '.btn-pass', function (){
    // $('.btn-pass').on("click",function () {
        var comgpaid = $(this).attr("comgpa-id");
        var result='pass';
        $.ajax({
            url: 'comgpachecked.php',
            type: 'POST',
            data: { comgpaid,result },
            dataType: "json",
            success: function (response) {
                console.log(response);
                var btn='ผ่านแล้ว';
                $('#btn-checked'+comgpaid).removeClass('btn-warning').addClass('btn-success');
                $('#btn-checked'+comgpaid).html(btn)
            }
        });
        
    });
    $(document).on('click', '.btn-nopass', function (){
    // $('.btn-nopass').on("click",function () {
        var comgpaid = $(this).attr("comgpa-id");
        var result='none';
        $.ajax({
            url: 'comgpachecked.php',
            type: 'POST',
            data: { comgpaid,result },
            dataType: "json",
            success: function (response) {
                console.log(response);
                var btn='รออนุมัติ';
                $('#btn-checked'+comgpaid).removeClass('btn-success').addClass('btn-warning');
                $('#btn-checked'+comgpaid).html(btn)
                // $('#btn-checked'+comgpaid).html('<button class="btn btn-success btn-sm btn-block text-white btn-pass" comgpa-id="'+comgpaid+'">ผ่าน</button>')
            }
        });
        
    });
});