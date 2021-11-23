/**
 * Get session to a variable
 */
const session = $('meta[name="session-language"]').attr('content');

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

/**
 * Sweetalert2 Toast Meassage 
 */
function sweetAlertToast(data, message = '') {
	let Toast = Swal.mixin({
		toast: true,
		position: 'top-end',
		showConfirmButton: false,
		timer: 3000
	});

	let icon = '';
	switch (data.status) {
		case 'warning':
			icon = 'warning';
			break;
		case 'error':
			icon = 'error';
			break;
		case 'danger':
			icon = 'danger';
			break;
		case 'info':
			icon = 'info';
			break;
		case 'success':
			icon = 'success';
			break;
		case 'question':
			icon = 'question';
			break;
	}

	// fire the toast alert
	Toast.fire({
		icon: icon,
		title: message ? message : data.message
	});
}
