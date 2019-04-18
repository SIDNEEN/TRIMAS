$(document).ready(function () {
    $('#open-semester').click(function () {
        var year = $('#semestar-year').val();
        var term = $('#semestar-term').val();
        SwalOpenSemester(year,term);
    });


    function SwalOpenSemester(smtYr,smtTrm) {
        swal({
            title: 'เปิดรอบการฝึกงาน?',
            text: "ยืนยันการเปิดรอบภาคการศึกษาการฝึกงาน ",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: 'green',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ตกลง',
            cancelButtonText: 'ยกเลิก',
            showLoaderOnConfirm: true,

            preConfirm: function () {
                return new Promise(function (resolve) {

                    $.ajax({
                        url: 'open-semester.php',
                        type: 'POST',
                        data: { year: smtYr, term : smtTrm},
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


    $('#save-board').click(function () {
        var semesterid = $(this).data("semesterid");
        var boardID = []; 
        $('.selected ul li').each(function () {
			boardID.push($(this).attr('id')); // insert row company id's to array
        });
        console.log(boardID);
        console.log('sms='+semesterid);
        $.ajax({
            url: 'inser-boardright.php',
            type: 'POST',
            data: { boardID :boardID,semesterID:semesterid},
            dataType: 'json'
        })
            .done(function (response) {
                swal(response.title, response.message, response.status).then(function () {
                    location.reload();
                }
                );
            })
            .fail(function () {
                swal('Oops...', 'Something went wrong with ajax !', 'error');
            });
        // var year = $('#semestar-year').val();
        // var term = $('#semestar-term').val();
        // alert("test");
        // swal(
        //     'Good job!',
        //     'You clicked the button!',
        //     'success'
        //   )
        // SwalOpenSemester(year,term);
    });
    
});