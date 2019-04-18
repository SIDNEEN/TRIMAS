
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
	$('.deleteDataBooking').click(function () {
		var compid = $(this).attr("id");
		var compname = $(this).attr("data-name");
		//alert(compname);
		SwalDelete(compid, compname);


	});

	function SwalDelete(companyid, comname) {
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
						data: 'delete=' + companyid,
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

	$('.viewStdbookInfo').click(function () {
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
	$('.editData').click(function () {
		var compid = $(this).attr("id");
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
				$('#bookingeditData').modal('show');
			}
		});
	});





	$('#saveToBooking').click(function () {
		// //  alert("clicked");
		// var val = [];
		// $(':checkbox:checked').each(function (i) {
		// 	val[i] = $(this).val();
		// });
		// console.log(val + " "+se);
		$('#modalListToBooking').modal('hide');
		swal(
			"Good job!",
			"You clicked the button!",
			"success",

		).then(function () {
			location.reload();
		}
		);


	});


	// std booking
	$(document).ready(function () {
		$('.booking').click(function () {
			// alert("ok");
			var openbookingid =$(this).attr("data-openbookingid");
			var compid = $(this).attr("data-id");
			var reserved = $(this).attr("data-reserved");
			var stdID = $(this).attr("data-stdID");
			reserved++;
			SwalBooking(compid, reserved,openbookingid,stdID);

			console.log("openbookingid  "+openbookingid);
			console.log("จองแล้ว "+reserved);
			console.log("stdID : "+stdID);
			//

			//alert(compname);
			// SwalDelete(compid, compname);
	
	
		});
	});
	
	function SwalBooking(companyid, reserved,openbookingid,stdID) {
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
						data: { companyID : companyid , reservedData : reserved, openbookingid : openbookingid, stdid:stdID },
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

