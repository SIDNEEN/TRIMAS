
$(document).ready(function () {

    $('.btn-seereason').click(function () {
        var reason = $(this).data('reason');
        console.log(reason);
        $('#modalreason').html(reason);
        $('#cancelresaon').modal('show');
    });

    //cancel booking by board

    $('.btnAprrove').click(function () {
        console.log('test');
        var opration='approve'
        var stdID= $(this).attr('stdID');
        var bookedID= $(this).attr('bookedID');
        var companyID = $(this).attr('companyID');
        var reason=$(this).attr('reason');
        var aprrover=$(this).attr('aprrover');
        SwalCancel(opration,stdID,bookedID, companyID, reason,aprrover);
        
    });
   
    $('.btnnotAprrove').click(function () {
        console.log('test');
        var opration='notapprove'
        var stdID= $(this).attr('stdID');
        var bookedID= $(this).attr('bookedID');
        var companyID = $(this).attr('companyID');
        var reason=$(this).attr('reason');
        var aprrover=$(this).attr('aprrover');
        SwalCancel(opration,stdID,bookedID, companyID, reason,aprrover);
        
    });

    function SwalCancel(opration,stdID,bookedID, companyID, reason,aprrover) {
        swal({
            title: 'ยืนยัน?',
            text: "ยืนยันการทำรายการ ",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'ใช่, ยืนยัน!',
            showLoaderOnConfirm: true,

            preConfirm: function () {
                return new Promise(function (resolve) {
                    $.ajax({
                        url: 'cancelopration.php',
                        type: 'POST',
                        data: { opration,stdID,bookedID, companyID, reason,aprrover },
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
                });

            },
            allowOutsideClick: false
        });

    }
});