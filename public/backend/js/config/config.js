
/**
 * Get website address
 */
function url(link) {
	return `${window.location.origin}/${link}`;
}

/**
 * Ajax Configration
 */
$.ajaxSetup({
	headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	}
});