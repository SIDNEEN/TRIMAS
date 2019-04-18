$.Thailand({
    database: './jquery.Thailand.js/database/db.json', 

    $district: $('.autoaddr [name="district"]'),
    $amphoe: $('.autoaddr [name="amphoe"]'),
    $province: $('.autoaddr [name="province"]'),
    $zipcode: $('.autoaddr [name="zipcode"]'),

    onDataFill: function(data){
        console.info('Data Filled', data);
    },

    // onLoad: function(){
    //     console.info('Autocomplete is ready!');
    //     $('#loader, .demo').toggle();
    // }
});
$(document).ready(function () {
    $('#btn-insertowncomp').click(function() {
        $('#card-insowncomp').show();
        $('#btn-insertowncomp').hide();
    });

    $('.submitCom').click(function () {
        var comName = $('#companyName').val()
        var Add = $('#companyAddress').val()
        var Tamb = $('#companyTambol').val()
        var Amp = $('#companyAmpo').val()
        var Changw = $('#companyChangwat').val()
        var zipc = $('#companyZipCode').val()
        var Phon = $('#companyPhone').val()
        var note = $('#note').val()
        var stdid = $('#studentID').val()
        if (comName !== "" && Add !== "" && Tamb !== "" && Amp !== "" && Changw !== "" && zipc !== "" && Phon !== "") {
            let timerInterval
            swal({
                title: 'ตรวจสอบฐานข้อมูล!',
                html: 'กำลังตรวจสอบฐานข้อมูลสถานประกอบการ <strong></strong>',
                timer: 1000,
                onOpen: () => {
                    swal.showLoading()
                    timerInterval = setInterval(() => {
                        swal.getContent().querySelector('strong')
                            .textContent = swal.getTimerLeft()
                    }, 100)
                },
                onClose: () => {
                    clearInterval(timerInterval)
                }
            }).then((result) => {
                if (result.dismiss === swal.DismissReason.timer) {
                    console.log('closed by the timer')
                }
            }).then(function () {
                $.ajax({
                    url: 'checkcomp_insert.php',
                    type: 'POST',
                    data: { tambol: Tamb, ampo: Amp, changwat: Changw },
                    dataType: "json",
                    success: function (response) {
                        console.log(response);
                        if (response.length > 0) {       //ถ้ามีสถานประกอบการที่มีที่อยู่ซ้ำกัน
                            var companyInfo = '<tr class="text-info"> ' +
                                '<th scope="row"><b>#</b></th>' +
                                '<td><b>' + comName + '</b></td>' +
                                '<td><b>' + Add + '  ต. ' + Tamb + '  อ. ' + Amp + '  จ. ' + Changw +
                                '  ' + zipc + '</b></td>' + '<td><b>' + Phon + '</b></td>' +
                                '</tr>' +
                                '<tr><td colspan="4" class="text-center text-danger">มีที่อยู่เดียวกันกับ</td></tr>';
                            for (let index = 0; index < response.length; index++) {
                                const element = response[index];
                                companyInfo += '<tr> ' +
                                    '<th scope="row">' + (index + 1) + '</th>' +
                                    '<td>' + element.companyName + '</td>' +
                                    '<td>' + element.companyAddress + '  ต. ' + element.companyTambol + '  อ. ' + element.companyAmpo +
                                    '  จ. ' + element.companyChangwat + '  ' + element.companyZipCode + '</td>' +
                                    '<td>' + element.companyPhonet + '</td>' +
                                    '</tr>'
                            }
                            $('#list-company').html(companyInfo)
                            $('#showCompanyChecked').modal('show');
                            $('.btnaddit').click(function () {
                                $.ajax({
                                    url: 'ins_comp.php',
                                    type: 'POST',
                                    data: { companyName: comName, companyAddress: Add, district: Tamb, amphoe: Amp, province: Changw, zipcode: zipc, companyPhonet: Phon, note: note, rating: rating },
                                    dataType: "json"
                                })
                                    .done(function (response) {
                                        swal('Success!', response.message, response.status).then(function () {
                                            location.reload();
                                        }
                                        );
                                    })
                                    .fail(function () {
                                        swal('Oops...', 'Something went wrong with ajax !', 'error');
                                    });
                            });
                        }
                        else {
                            $.ajax({
                                url: 'ins_ownbooking.php',
                                type: 'POST',
                                data: { companyName: comName, companyAddress: Add, district: Tamb, amphoe: Amp, province: Changw, zipcode: zipc, companyPhonet: Phon, note: note, stdid: stdid },
                                dataType: "json"
                            })
                                .done(function (response) {
                                    swal('Success!', response.message, response.status).then(function () {
                                        location.reload();
                                    }
                                    );
                                })
                                .fail(function () {
                                    swal('Oops...', 'Something went wrong with ajax !', 'error');
                                });
                        }
                    }
                });
            }
            );


        }

    });
    $('#btnreset').click(function () {
        $('#cancelReason').modal('hide');
    });
   
    $('#btnSubmitCancel').click(function () {
        var bookedid = $(this).attr("booked-id");
        var companyID = $(this).attr("data-companyID");
        var stdid = $(this).attr("std-id");
        var reason = $('#reason').val()
        //alert(compname);
        if (reason !== "") {
            console.log(bookedid,companyID, stdid, reason);
            SwalCancel(bookedid,companyID, stdid, reason);
        }
    });

    function SwalCancel(bookedid,companyID,stdid,reason) {
        swal({
            title: 'ยกเลิกการจอง?',
            text: "ยืนยันการยกเลิกการจองสถานประกอบการนี้ ",
            type: 'question',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'ใช่, ยกเลิกการจอง!',
            showLoaderOnConfirm: true,

            preConfirm: function () {
                return new Promise(function (resolve) {
                    $.ajax({
                        url: 'cancel.php',
                        type: 'POST',
                        data: { stdID: stdid,companyID:companyID, bookedID: bookedid,reason:reason },
                        dataType: 'json'
                    })
                        .done(function (response) {
                            swal('Success!', response.message, response.status).then(function () {
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