/* Formatting function for row details - modify as you need */
function format(data) {
    // `d` is the original data object for the row
    if (data.length==0) {
      var stdname = '<span class="text-danger">ไม่มีผู้จอง</span>';
    } else {
      var stdname = '';
      for (let index = 0; index < data.length; index++) {
          const element = data[index];
          stdname  += (index + 1) + '<b> :' + element.stdFirstname + ' ' + element.stdLastname + ' </b>&emsp;';
      }
    }
    
    return '<div style=\"background-color:#eee; padding: .5em;\">' +
            '<span> ผู้จอง     &emsp;' + stdname +'</span>'+
        '</div>';
  
  }

$(document).ready(function () {
    var table = $('#bookingTable').DataTable({
        "bInfo" : false,
        "pageLength": 25,
        "oLanguage": {
          "sSearch": "ค้นหา:",
          "sLengthMenu": "แสดง _MENU_ แถว",
        }
      });
    // Add event listener for opening and closing details
    $('#bookingTable tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = table.row(tr);
        var bookingid = $(this).attr("booking-id");
        $.ajax({
            url: 'stdBooker.php',
            type: 'POST',
            data: { bookingid },
            dataType: "json",
            success: function (response) {
                console.log(response);
                
                if (row.child.isShown()) {
                    // This row is already open - close it
                    row.child.hide();
                    tr.removeClass('shown');
                }
                else {
                    // Open this row
                    row.child(format(response)).show();
                    console.log(format(response));
                    tr.addClass('shown');
                }
            }
        });

    });


    // std booking
    $(document).ready(function () {
        $('.booking').click(function () {
            // alert("ok");
            var openbookingid = $(this).attr("data-openbookingid");
            var compid = $(this).attr("data-id");
            var stdID = $(this).attr("data-stdID");
            SwalBooking(compid, openbookingid, stdID);

            console.log("openbookingid  " + openbookingid);
            console.log("stdID : " + stdID);
            //

            //alert(compname);
            // SwalDelete(compid, compname);


        });
    });

    function SwalBooking(companyid, openbookingid, stdID) {
        swal({
            title: 'ยืนยันจองสถานประกอบการนี้?',
            text: "เมื่อจองแล้ว หากต้องการยกเลิก ต้องยื่นเหตุผลประกอบด้วย",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: 'green',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'ใช่, จองเลย!',
            showLoaderOnConfirm: true,

            preConfirm: function () {
                return new Promise(function (resolve) {

                    $.ajax({
                        url: 'reserved_comp.php',
                        type: 'POST',
                        data: { companyID: companyid, openbookingid: openbookingid, stdid: stdID },
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


    //cancel booking

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