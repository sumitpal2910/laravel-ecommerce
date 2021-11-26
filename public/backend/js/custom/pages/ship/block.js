/**
 * Get all district by changing state dropdown option
 */
$('#blockState').on('change', function() {
	// get state id
	let id = $(this).val();

	// send ajax request
	$.ajax({
		url: url(`shipping/dist/ajax/${id}`),
		method: 'GET',
		dataType: 'JSON',
		success: function(data) {
			// get select
			let select = $('#blockDistrict').empty();
			if (data) {
				select.append(`<option disabled selected>--Select District--</option>`);
				// show options
				data.forEach((element) => {
					select.append(`<option value="${element.id}">${element.name}</option>`);
				});
			} else {
				select.append(`<option disabled selected>--District Not Avlaiable--</option>`);
			}
		}
	});
});

/**
 * Get all sub district by changing state dropdown option
 */
$('#blockDistrict').on('change', function() {
	// get state id
	let id = $(this).val();

	// send ajax request
	$.ajax({
		url: url(`shipping/sub-dist/ajax/${id}`),
		method: 'GET',
		dataType: 'JSON',
		success: function(data) {
			// get select
			let select = $('#blockSubDistrict').empty();
			if (data) {
				select.append(`<option disabled selected>--Select Sub District--</option>`);
				// show options
				data.forEach((element) => {
					select.append(`<option value="${element.id}">${element.name}</option>`);
				});
			} else {
				select.append(`<option disabled selected>--Sub District Not Avlaiable--</option>`);
			}
		}
	});
});
