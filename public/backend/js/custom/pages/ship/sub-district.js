/**
 * Get all district by changing state dropdown option
 */
$('#subDistState').on('change', function() {
	// get state id
	let id = $(this).val();

	// send ajax request
	$.ajax({
		url: url(`shipping/dist/ajax/${id}`),
		method: 'GET',
		dataType: 'JSON',
		success: function(data) {
			console.log(data);
			// get select
			let select = $('#subDistDistrict').empty();

			// show options
			data.forEach((element) => {
				select.append(`<option value="${element.id}">${element.name}</option>`);
			});
		}
	});
});
