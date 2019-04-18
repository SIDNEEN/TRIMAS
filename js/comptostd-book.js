
$.Thailand({
	database: './jquery.Thailand.js/database/db.json',

	$district: $('.autoaddr [name="district"]'),
	$amphoe: $('.autoaddr [name="amphoe"]'),
	$province: $('.autoaddr [name="province"]'),
	$zipcode: $('.autoaddr [name="zipcode"]'),

	onDataFill: function (data) {
		console.info('Data Filled', data);
	},

	// onLoad: function(){
	//     console.info('Autocomplete is ready!');
	//     $('#loader, .demo').toggle();
	// }
});


$(document).ready(function () {
	$(".table-bordered").on("click", ".deleteDataBooking", function () {
	// $('.deleteDataBooking').click(function () {
		var compid = $(this).attr("id");
		var compname = $(this).attr("data-name");
		var majorid = $(this).attr("major-id");
		console.log(majorid);
		SwalDelete(compid, majorid);


	});

	function SwalDelete(companyid, majorid) {
		swal({
			title: 'ลบสถานประกอบการนี้ ?',
			text: "การลบสถานประกอบการนี้เป็นเพียงลบออกจากฐานข้อมูลการจองเท่านั้น ",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#d33',
			cancelButtonColor: '#3085d6',
			confirmButtonText: 'Yes, delete it!',
			showLoaderOnConfirm: true,

			preConfirm: function () {
				return new Promise(function (resolve) {

					$.ajax({
						url: 'del_booking.php',
						type: 'POST',
						data: { delete: companyid,majorid:majorid },
						dataType: 'json'
					})
						.done(function (response) {
							swal('Deleted!', response.message, response.status).then(function () {
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
	$(".table-bordered").on("click", ".viewStdbookInfo", function () {
	// $('.viewStdbookInfo').click(function () {
		var compid = $(this).attr("id");
		$.ajax({
			url: 'select.php',
			type: 'POST',
			data: { id: compid },
			dataType: "json",
			success: function (response) {
				console.log(response);
				console.log(response.companyName);
				$('#companyNameBooker').text(response.companyName);
				$('#stdNameBooker').html('<p class="text-primary">รายชื่อนักศึกษาที่จองสถานประกอบการนี้</p>');

				$('#dataBooker').modal('show');
			}
		});

	});
	$(".table-bordered").on("click", ".editData", function () {
	// $('.editData').click(function () {
		var compid = $(this).attr("id");
		var quota = $(this).attr("quota");
		var major = $(this).data("major")
		console.log(compid);
		$.ajax({
			url: 'select.php',
			type: 'POST',
			data: { id: compid },
			dataType: "json",
			success: function (response) {
				console.log(response);
				console.log(response.companyID);
				$('#bcompID').val(response.companyID);
				$('#bcompName').val(response.companyName);
				$('#bcompAddress').val(response.companyAddress);
				$('#bcompTambol').val(response.companyTambol);
				$('#bcompAmpo').val(response.companyAmpo);
				$('#bcompChangwat').val(response.companyChangwat);
				$('#bcompZipCode').val(response.companyZipCode);
				$('#bcompPhone').val(response.companyPhonet);
				$('#majorinfo').html(major);
				$('#bedit-rating').html('<input type="range" min="0"max="5"value="' + response.rating + '" data-orientation="vertical" id="rateRange"></input>'
					+ '<p>ระดับ: <span id="rateVal"></span></p>');
				var slider = document.getElementById("rateRange");
				var output = document.getElementById("rateVal");
				output.innerHTML = slider.value;

				slider.oninput = function () {
					output.innerHTML = this.value;
					$('#brating').val(this.value);
				}
				$('#bcompNote').text(response.note);
				$('#Quota').val(quota);
				$('#bookingeditData').modal('show');
			}
		});
	});


	$('.addToBooking').click(function () {
		var majorid = $(this).attr("majorid");
		console.log(majorid);
		$.ajax({
			url: 'compforinsertbooking.php', //รับข้อมูลที่ยังไม่มีใน booking เพื่อจะนำไปใส่ 
			type: 'POST',
			data: { majorid: majorid },
			dataType: "json",
			success: function (response) {
				console.log(response);
				var tbody = ""
				if (response.length < 1) {
					tbody = '<tr><td></td><td>ไม่มีข้อมูล</td><td></td><td></td></tr>'
				}
				response.forEach(element => {
					// tbody += element.companyID;
					tbody += '<tr data-id="' + element.companyID + '">' +
						'<td><div class="custom-control custom-checkbox mb-3">' +
						'<input type="checkbox" class="custom-control-input" id="companyID' + element.companyID + '" required="">' +
						'<label class="custom-control-label" for="companyID' + element.companyID + '">' + element.companyName + '</label>' +
						'<div class="invalid-feedback">กรุณาติ้กถูกเพื่อเลือก</div></div>' +
						'</td>' +
						'<td> ' + element.companyChangwat + '</td><td>'
					for (let index = 0; index < 5; index++) {
						if (index < element.rating) {
							tbody += '<span class="text-warning"><i class="fa fa-star" aria-hidden="true"></i></span>'
						} else {
							tbody += '<i class="fa fa-star-o" aria-hidden="true"></i>'
						}
					}
					tbody += '</td><td><input class="form-control icmQuota" id="compaid-' + element.companyID + '" name="icmQuota" type="number" value="2" required=""></td></tr>'
				});
				var btnsave = '<button type="button" class="btn btn-primary saveToBooking" major-id="' + majorid + '">Save changes</button>'
				$('#tbd-com').html(tbody);
				$('#btnsavetobooking').html(btnsave);
				$('#modalListToBooking').modal('show');
			}
		});
	});

	// เพิ่มจำนวนคนในตารารการจอง

	$(document).on('click', '.saveToBooking', function () {
		var comIDArr = [];  //ตัวแปรรับค่า company ID
		var valArr = [];     //ตัวแปรรับค่า val จำนวนคน
		$('input:checked').each(function () {
			console.log($(this).closest('tr[data-id]').data('id')); // just to see the rowid's
			comIDArr.push($(this).closest('tr[data-id]').data('id')); // insert row company id's to array
			valArr.push($(this).closest('tr').find('.icmQuota').val());
			console.log(comIDArr.length);
		});
		var majorid = $(this).attr("major-id");
		console.log('major id=' + majorid);
		// bug!!! array 3 ตัวแรก = undefined มาจากไหนไม่รู้ จึงต้องตัดออกโดยใช้ slice()
		comIDArr=comIDArr.slice(3);
		valArr=valArr.slice(3);
		console.log(comIDArr);
		console.log(valArr);
		if (comIDArr.length === 0) {
			swal(
				'ไม่มีข้อมูล',
				'กรุณติ้กถูกหน้าชื่อสถานประกอบเพื่อเลือก!!',
				'error'
			)
		} else {
			swalInsertTobooking(comIDArr, valArr, majorid);
		}
		// swalInsertTobooking(comIDArr, valArr);
		// $('#modalListToBooking').modal('hide');
	});

	function swalInsertTobooking(comIDArr, valArr, majorid) {
		swal({
			title: 'ยืนยันการเลือกสถานประการ ?',
			text: "ยืนยันการเลือกสถานประการให้นักศึกษาจอง  ",
			type: 'question',
			showCancelButton: true,
			confirmButtonColor: 'green ',
			cancelButtonColor: '#3085d6',
			confirmButtonText: 'ใช่, บันทึกเลย!',
			showLoaderOnConfirm: true,

			preConfirm: function () {
				return new Promise(function (resolve) {

					$.ajax({
						url: 'insert_booking.php',
						type: 'POST',
						data: { companyid: comIDArr, qoutaArr: valArr, majorid: majorid },
						dataType: 'json'
					})
						.done(function (response) {
							swal('เรียบร้อย!', response.message, response.status).then(function () {
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

	// std booking
	$(document).ready(function () {
		$('.booking').click(function () {
			// alert("ok");
			var openbookingid = $(this).attr("data-openbookingid");
			var compid = $(this).attr("data-id");
			var reserved = $(this).attr("data-reserved");
			var stdID = $(this).attr("data-stdID");
			reserved++;
			SwalBooking(compid, reserved, openbookingid, stdID);

			console.log("openbookingid  " + openbookingid);
			console.log("จองแล้ว " + reserved);
			console.log("stdID : " + stdID);
			//

			//alert(compname);
			// SwalDelete(compid, compname);


		});
	});

	function SwalBooking(companyid, reserved, openbookingid, stdID) {
		swal({
			title: 'จองสถานประกอบการ?',
			text: "ยืนยันการจองสถานประกอบการนี้ ",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#d33',
			cancelButtonColor: '#3085d6',
			confirmButtonText: 'Yes, delete it!',
			showLoaderOnConfirm: true,

			preConfirm: function () {
				return new Promise(function (resolve) {

					$.ajax({
						url: 'reserved_comp.php',
						type: 'POST',
						data: { companyID: companyid, reservedData: reserved, openbookingid: openbookingid, stdid: stdID },
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

