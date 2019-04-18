(function ($) {



    var form = $("#signup-form");
    form.validate({
        errorPlacement: function errorPlacement(error, element) {
            element.before(error);
        },
        rules: {
            email: {
                email: true
            }
        },
        onfocusout: function (element) {
            $(element).valid();
        },
    });
    form.children("div").steps({
        headerTag: "h3",
        bodyTag: "fieldset",
        transitionEffect: "fade",
        stepsOrientation: "vertical",
        titleTemplate: '<div class="title"><span class="step-number">#index#</span><span class="step-text">#title#</span></div>',
        labels: {
            previous: 'Previous',
            next: 'Next',
            finish: 'Finish',
            current: ''
        },
        onStepChanging: function (event, currentIndex, newIndex) {
            if (currentIndex === 0) {
                form.parent().parent().parent().append('<div class="footer footer-' + currentIndex + '"></div>');
            }
            if (currentIndex === 1) {
                form.parent().parent().parent().find('.footer').removeClass('footer-0').addClass('footer-' + currentIndex + '');
            }
            if (currentIndex === 2) {
                form.parent().parent().parent().find('.footer').removeClass('footer-1').addClass('footer-' + currentIndex + '');
            }
            if (currentIndex === 3) {
                form.parent().parent().parent().find('.footer').removeClass('footer-2').addClass('footer-' + currentIndex + '');
            }
            // if(currentIndex === 4) {
            //     form.parent().parent().parent().append('<div class="footer" style="height:752px;"></div>');
            // }
            form.validate().settings.ignore = ":disabled,:hidden";
            return form.valid();
        },
        onFinishing: function (event, currentIndex) {
            form.validate().settings.ignore = ":disabled";
            return form.valid();
        },
        onFinished: function (event, currentIndex) {
            Swal({
                title: 'ยืนยันกันทำรายการ',
                text: "กด ตกลง เพื่อยืนยัน",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ตกลง'
              }).then((result) => {
                if (result.value) {
                    form.submit();
                    Swal(
                        'เรียบร้อย!',
                        'ทำรายการเรียบร้อยแล้ว',
                        'success'
                    )
                }
              })
            
        },
        onStepChanged: function (event, currentIndex, priorIndex) {

            return true;
        }
    });

    jQuery.extend(jQuery.validator.messages, {
        required: "",
        remote: "",
        email: "",
        url: "",
        date: "",
        dateISO: "",
        number: "",
        digits: "",
        creditcard: "",
        equalTo: ""
    });

    $.dobPicker({
        daySelector: '#birth_date',
        monthSelector: '#birth_month',
        yearSelector: '#birth_year',
        dayDefault: '',
        monthDefault: '',
        yearDefault: '',
        minimumAge: 0,
        maximumAge: 120
    });
    var marginSlider = document.getElementById('slider-margin');
    if (marginSlider != undefined) {
        noUiSlider.create(marginSlider, {
            start: [1100],
            step: 100,
            connect: [true, false],
            tooltips: [true],
            range: {
                'min': 100,
                'max': 2000
            },
            pips: {
                mode: 'values',
                values: [100, 2000],
                density: 4
            },
            format: wNumb({
                decimals: 0,
                thousand: '',
                prefix: '$ ',
            })
        });
        var marginMin = document.getElementById('value-lower'),
            marginMax = document.getElementById('value-upper');

        marginSlider.noUiSlider.on('update', function (values, handle) {
            if (handle) {
                marginMax.innerHTML = values[handle];
            } else {
                marginMin.innerHTML = values[handle];
            }
        });
    }
})(jQuery);



//   !!!!!ถูกยกเลิกเนื่องจากต้องส่งการกลั่นกรองทุกคน 

// ปุมเพิ่ม กรณีคนใดคนหนึ่งส่งกลั่นกรองพร้อมกันกับคนที่จองที่เดียวกัน
//
// $(document).ready(function () {
//     $('.btn-add').click(function () {
//         var companyid = $(this).attr("company-id");
//         var stdid = $(this).attr("std-id");
//         var major = $('#major').val();
//         // alert(companyid + 'and std =' + stdid+'mj= '+major)
//         $.ajax({
//             url: 'checkstd_forkk.php',
//             type: 'POST',
//             data: { companyid: companyid, stdid: stdid },
//             dataType: "json",
//             success: function (response) {
//                 console.log(response);
//                 if (response.length > 1) {       //ถ้ามีผู้จองมากกว่า 1 คน(รวมตัวเขาเอง)
//                     var stdinfo = '';
//                     for (let index = 0; index < response.length; index++) {
//                         const element = response[index];
//                         if (element.stdID !== stdid) {  //จะเลือกข้อมูลคนอื่นที่ไม่ใช่ตัวเขาเง
//                             stdinfo += '<hr class="style5"><div class="form-row"><div class="form-flex"><div class="form-group">' +
//                                         '<label for="studcode" class="form-label">รหัสนักศึกษา</label>'+
//                                         '<input type="hidden" name="stdID[]" value="'+element.stdID+'">'+
//                                         '<input type="text" name="studcode" id="studcode" value="'+element.stdNumber+'" readonly/></div>'+
//                                         '<div class="form-group"><label for="studname" class="form-label">ชื่อ-สกุล</label>'+
//                                         '<input type="text" name="studname" id="studname" value="'+element.stdFirstname+'  '+element.stdLastname+'" readonly/>'+
//                                         '</div></div></div><div class="form-group">'+
//                                         '<label for="major" class="form-label">สาขาวิชา</label>'+
//                                         '<input type="major" name="major" id="major" value="'+major+'" readonly/></div>'+
//                                         '<div class="form-group">'+
//                                         '<label for="email" class="form-label">E-mail Address</label>'+
//                                         '<input type="email" name="email" id="email" value="'+element.stdEmail+'" readonly/>'+
//                                         '</div><div class="form-group"><label for="stdphone" class="form-label">หมายเลขโทรศัพท์ที่ติดต่อสะดวก</label>'+
//                                         '<input type="text" name="stdphone" id="stdphone" value="'+element.stdPhone+'" readonly/></div>';
//                         }
//                     }
//                     $('#otherperson').html(stdinfo)
//                     $('.btn-add').hide()
//                     // $('#showCompanyChecked').modal('show');
//                 }
//                 else { //ไม่มีคนอื่นที่จองที่เดียวกัน
//                     alert('ไม่มีผู้จองที่เดียวกัน')
//                 }
//             }
//         });



//     });
// });