$(document).ready(function () {
    var klankrongid= [];
    $('.std-detail').each(function() {     //ก่อนหน้านี้ สามารถดำเนินการอนุมัติ/ไม่อนุมัติ หลายคนต่อครั้ง จึงสร้างอาเรย์รับค่า
        klankrongid.push($(this).data('klankrong'));    //ตอนนี้การอนุมัติ/ไม่อนุมัติ ทำเป็นรายคน แต่สามารถได้เหมือนกัน  ดังนั้น klankrongid.lenght=1
    });
    $('.approve').click(function () {
        var approvement = 1;
        SwalApprove(klankrongid, approvement);
        console.log(klankrongid);

    });
    $('.not-approve').click(function () {
        var approvement = 0;
        SwalNotApprove(klankrongid, approvement);

    });
    function SwalApprove(klankrongid, approvement) {
        swal({
            title: 'คุณต้องการอนุมัตนักศึกษานี้ ?',
            text: "ยืนยันการการทำรายการ ",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: 'green',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'ใช่, ยืนยัน',
            showLoaderOnConfirm: true,

            preConfirm: function () {
                return new Promise(function (resolve) {

                    $.ajax({
                        url: 'approveklankrong.php',
                        type: 'POST',
                        data: {klankrongid, approvement},
                        dataType: 'json'
                    })
                        .done(function (response) {
                            swal( response.title, response.message, response.status).then(function () {
                                location.reload();
                            }
                            );
                        })
                        .fail(function () {
                            swal('Oops...', 'Something went wrong with ajax !', 'error');
                        });
                });

            },
            allowOutsideClick: false
        });

    }
    function SwalNotApprove(klankrongid, approvement) {
        swal({
            title: 'คุณไม่ต้องการอนุมัตนักศึกษานี้ ?',
            text: "ยืนยันการการทำรายการ",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: 'green',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'ใช่, ยืนยัน',
            showLoaderOnConfirm: true,

            preConfirm: function () {
                return new Promise(function (resolve) {

                    $.ajax({
                        url: 'approveklankrong.php',
                        type: 'POST',
                        data: {klankrongid, approvement},
                        dataType: 'json'
                    })
                        .done(function (response) {
                            swal( response.title, response.message, response.status).then(function () {
                                location.reload();
                            }
                            );
                        })
                        .fail(function () {
                            swal('Oops...', 'Something went wrong with ajax !', 'error');
                        });
                });

            },
            allowOutsideClick: false
        });

    }
});