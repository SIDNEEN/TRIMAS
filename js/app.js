// var app = angular.module('myApp', []);
// app.controller('usercontroller', function($scope, $http) {
//     $http.get("select.php")
//     .then(function (response) {$scope.names = response.data.records;});
// });

$(document).ready(function () {
	$("#dataTable").on("click", ".deleteData", function () {
		// $('.deleteData').click(function () {
		var compid = $(this).attr("id");
		var compname = $(this).attr("data-name");
		//alert(compname);
		SwalDelete(compid, compname);


	});

	function SwalDelete(companyid, comname) {
		swal({
			title: 'ลบข้อมูล?',
			text: "ยืนยันลบสถานประกอบการที่ชื่อ " + comname,
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#d33',
			cancelButtonColor: '#3085d6',
			confirmButtonText: 'Yes, delete it!',
			showLoaderOnConfirm: true,

			preConfirm: function () {
				return new Promise(function (resolve) {

					$.ajax({
						url: 'del_comp.php',
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

	$('.submitCom').click(function () {
		var comName = $('#companyName').val()
		var Add = $('#companyAddress').val()
		var Tamb = $('#companyTambol').val()
		var Amp = $('#companyAmpo').val()
		var Changw = $('#companyChangwat').val()
		var zipc = $('#companyZipCode').val()
		var Phon = $('#companyPhone').val()
		var note = $('#note').val()
		var rating = $('.star-selected').length;
		console.log(rating);
		if (comName !== "" && Add !== "" && Tamb !== "" && Amp !== "" && Changw !== "" && zipc !== "" && Phon !== "") {
			if (rating == 0) {
				$('#alert-rating').html("กรุณาเลือกความน่าสนใจ")
			} else {
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
									'<tr><td colspan="4" class="text-center text-danger">มีที่อยู่ใกล้เคียงกันกับ</td></tr>';
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
							}
						}
					});
				}
				);
			}

		}

	});


	$("#dataTable").on("click", ".viewData", function () {
		// $('.viewData').click(function () {
		var compid = $(this).attr("id");
		$.ajax({
			url: 'select.php',
			type: 'POST',
			data: { id: compid },
			dataType: "json",
			success: function (response) {
				console.log(response);
				console.log(response.companyName);
				$('#companyNameShow').text(response.companyName);
				$('#companyAdrrShow').html(response.companyAddress +
					"  ต. " + response.companyTambol +
					"  อ. " + response.companyAmpo +
					"  จ. " + response.companyChangwat +
					"  " + response.companyZipCode);
				$('#companyPhoneShow').text(response.companyPhonet);
				$('#noteShow').text(response.note);
				$('#dataModal').modal('show');
			}
		});

	});
	$("#dataTable").on("click", ".editData", function () {
		// $('.editData').click(function () {
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
				console.log(response.rating);
				$('#compID').val(response.companyID);
				$('#compName').val(response.companyName);
				$('#compAddress').val(response.companyAddress);
				$('#compTambol').val(response.companyTambol);
				$('#compAmpo').val(response.companyAmpo);
				$('#compChangwat').val(response.companyChangwat);
				$('#compZipCode').val(response.companyZipCode);
				$('#compPhone').val(response.companyPhonet);
				$('#edit-rating').html('<input type="range" min="0"max="5"value="' + response.rating + '" data-orientation="vertical" id="rateRange"></input>'
					+ '<p>ระดับ: <span id="rateVal"></span></p>');
				var slider = document.getElementById("rateRange");
				var output = document.getElementById("rateVal");
				output.innerHTML = slider.value;
				$('#compNote').val(response.note);
				slider.oninput = function () {
					output.innerHTML = this.value;
					$('#rating').val(this.value);
				}

				$('#editData').modal('show');
			}
		});
	});




	// ไม่มี ไม่เกี่ยว ลบได้
	$('#saveToBooking').click(function () {
		//  alert("clicked");
		var val = [];
		$(':checkbox:checked').each(function (i) {
			val[i] = $(this).val();
		});
		console.log(val);
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


	

});

