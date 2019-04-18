$(function() {
	// rating form hide/show
 	$( "#rateProduct" ).click(function() {
		$("#ratingDetails").hide();
		$("#ratingSection").show();
	});	
	$( "#cancelReview" ).click(function() {
		$("#ratingSection").hide();
		$("#ratingDetails").show();		
	});	
	// implement start rating select/deselect
	$( ".rateButton" ).click(function() {
		if($(this).hasClass('btn-grey')) {			
			$(this).removeClass('btn-grey btn-default fa-star-o').addClass('btn-warning star-selected fa-star');
			$(this).prevAll('.rateButton').removeClass('btn-grey btn-default fa-star-o').addClass('btn-warning star-selected fa-star');
			$(this).nextAll('.rateButton').removeClass('btn-warning star-selected fa-star').addClass('btn-grey btn-default fa-star-o');			
		} else {						
			$(this).nextAll('.rateButton').removeClass('btn-warning star-selected fa-star').addClass('btn-grey btn-default fa-star-o');
		}
		var rating = $('.star-selected').length;
		// console.log(rating);	
	});
	// save review using Ajax
	// $('#ratingForm').on('submit', function(event){
	// 	event.preventDefault();
	// 	var formData = $(this).serialize();
	// 	$.ajax({
	// 		type : 'POST',
	// 		url : 'saveRating.php',
	// 		data : formData,
	// 		success:function(response){
	// 			 $("#ratingForm")[0].reset();
	// 			 window.setTimeout(function(){window.location.reload()},3000)
	// 		}
	// 	});		
	// });
});