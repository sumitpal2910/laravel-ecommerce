/**
 * Get all district by changing state dropdown option
 */
$('#checkoutState').on('change', function() {
	// get state id
	let id = $(this).val();

	// send ajax request
	$.ajax({
		url: url(`checkout/dist/ajax/${id}`),
		method: 'GET',
		dataType: 'JSON',
		success: function(data) {
			// get select
			let select = $('#checkoutDistrict').empty();
			if (data) {
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