$(document).ready(function(){
  var printCounter = 0;
  $("#dataTable").DataTable({
    "bInfo" : false,
    "oLanguage": {
      "sSearch": "ค้นหา:"
    },
    "pageLength": 25,
  });
  $("#dataTable-studinfo").DataTable({
    // lengthChange: false,
    "pageLength": 25,
    dom: 'Bfrtip',
    buttons: [
              {
                extend: 'copy',
                className: 'btn btn-primary',
            },
            {
                extend: 'excel',
                messageTop: 'The information in this table is copyright to Sirius Cybernetics Corp.',
                className: 'btn btn-primary',
            },
            {
                extend: 'pdf',
                messageBottom: null,
                className: 'btn btn-primary',
            },
            {
                extend: 'print',
                className: 'btn btn-primary',
                title: 'Data export',
                messageTop: function () {
                    printCounter++;
 
                    if ( printCounter === 1 ) {
                        return 'This is the first time you have printed this document.';
                    }
                    else {
                        return 'You have printed this document '+printCounter+' times';
                    }
                },
                messageBottom: null
            }
    ],
    "bInfo" : false,
    "oLanguage": {
      "sSearch": "ค้นหา:"
    }
    
  });

  $("#dataTable-report").DataTable({
    lengthChange: false,
    dom: 'Bfrtip',
    buttons: [
              {
                extend: 'copy',
                className: 'btn btn-primary',
            },
            {
                extend: 'excel',
                messageTop: 'หลักสูตร ICM และ ECM',
                className: 'btn btn-primary',
                title: 'นักศึกษาที่ผ่านการกลั่นกรอง',
            },
            // {
            //     extend: 'pdf',
            //     orientation: 'landscape',
            //     pageSize: 'A4',
            //     messageBottom: null,
            //     className: 'btn btn-primary',
            //     title: 'นักศึกษาที่ผ่านการกลั่นกรอง',
            // },
            {
                extend: 'print',
                orientation: 'landscape',
                pageSize: 'LEGAL',
                className: 'btn btn-primary',
                title: 'นักศึกษาที่ผ่านการกลั่นกรอง',
            }
    ],
    "bInfo" : false,
    "oLanguage": {
      "sSearch": "ค้นหา:"
    },
    "columnDefs": [
      {
        "targets": [ 4 ],
        "visible": false,
        "searchable": false
      },
      {
        "targets": [ 6 ],
        "visible": false
      },
      {
        "targets": [ 7 ],
        "visible": false
      },
      {
        "targets": [ 8 ],
        "visible": false
      },
      {
        "targets": [ 9 ],
        "visible": false
      }
        ]
    
  });
  

  var ecmtable = $('#dataTable-ecm').DataTable({
    "bInfo" : false,
    "pageLength": 25,
    "oLanguage": {
      "sSearch": "ค้นหา:"
    }
  });
  // Add event listener for opening and closing details for ECM
  $('#dataTable-ecm tbody').on('click', '.details-control', function () {
    var tr = $(this).closest('tr');
    var row = ecmtable.row(tr);
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


  var icmtable = $('#dataTable-icm').DataTable({
    "bInfo" : false,
    "pageLength": 25,
    "oLanguage": {
      "sSearch": "ค้นหา:"
    }
  });
      // Add event listener for opening and closing details for ICM
  $('#dataTable-icm tbody').on('click', '.details-control', function () {
    var tr = $(this).closest('tr');
    var row = icmtable.row(tr);
    var bookingid = $(this).attr("booking-id");
    // var whoclick = $(this).attr("clicker"); //ผู้กด จะได้ไปหน้าที่ถูก
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
});


function format(data,clicker) {
  // `d` is the original data object for the row
  if (data.length==0) {
    var stdname = '<span class="text-danger">ไม่มีผู้จอง</span>';
  } else {
    var stdname = '';
    for (let index = 0; index < data.length; index++) {
        const element = data[index];
        stdname  += (index + 1) + '<b> :<a href="'+clicker+'-studentprofile.php?stdNumber='+element.stdNumber+'" target="_blank">' + element.stdFirstname + ' ' + element.stdLastname + '</a> </b>&emsp;';
    }
  }

  return '<div style=\"background-color:#eee; padding: .5em;\">' +
          '<span> ผู้จอง     &emsp;' + stdname +'</span>'+
      '</div>';

}