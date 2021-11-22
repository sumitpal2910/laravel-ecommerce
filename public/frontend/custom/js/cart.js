/**
 * Sweetalert2 Toast Meassage 
 */
function sweetAlertToast(data, success = '', error = '') {
	let Toast = Swal.mixin({
		toast: true,
		position: 'top-end',
		showConfirmButton: false,
		timer: 3000
	});

	if ($.isEmptyObject(data.error)) {
		Toast.fire({
			icon: 'success',
			title: success ? success : data.success
		});
	} else {
		Toast.fire({
			icon: 'error',
			title: error ? error : data.error
		});
	}
}

/**
 * View Product by ajax
 */
function viewProduct(id) {
	// get all field
	let selectSize = $('#pSize').empty();
	let selectColor = $('#pColor').empty();
	let image = $('#pImage');
	let oldPrice = $('#pOldPrice').empty();
	let price = $('#pPrice').empty();
	let code = $('#pCode').empty();
	let title = $('#pName').empty();
	let category = $('#pCategory').empty();
	let brand = $('#pBrand').empty();
	let stock = $('#pStock').empty();
	let productId = $('#productId').empty();
	let qty = $('#pQty').empty();

	// hide both parent
	selectColor.parent().hide();
	selectSize.parent().hide();

	$.ajax({
		url: '/product/ajax',
		method: 'POST',
		data: {
			id: id
		},
		dataType: 'JSON',
		success: function(data) {
			// Set id
			productId.val(data.id);

			// Set quantity
			qty.val(1);

			// display image
			image.attr('src', `${window.location.origin}/${data.thumbnail}`);

			// Price
			if (data.discount_price > 0) {
				oldPrice.text('$' + data.selling_price);
				price.text(data.discount_price);
			} else {
				price.text(data.selling_price);
			}

			// Code
			code.text(data.code);

			// Stock

			stock.addClass('text-success');
			if (data.qty >= 10) {
				stock.text('In Stock');
			} else if (data.qty < 10 && data.qty > 0) {
				stock.text(`Hurry! Only ${data.qty} Left`);
			} else {
				stock.text(`Out of Stock`);
				stock.removeClass('text-success');
				stock.addClass('text-danger');
			}

			// Check session Language
			if (session === 'hindi') {
				// Show Title
				title.text(data.name_hin);
				// Show Category
				category.text(data.category.name_hin);
				// Show Brand
				brand.text(data.brand.name_hin);
			} else {
				// Show Title
				title.text(data.name_en);
				// Show Category
				category.text(data.category.name_en);
				// Show Brand
				brand.text(data.brand.name_en);
			}

			// Select color

			if (data.color_en && data.color_hin) {
				// show parent div
				selectColor.parent().show();

				// get color english or hindi
				let colors = session === 'hindi' ? data.color_hin.split(',') : data.color_en.split(',');

				colors.forEach((color) => {
					// append color option
					selectColor.append(`<option value="${color}">${color.toUpperCase()}</option>`);
				});
			}

			// Select Size
			if (data.size_en && data.size_hin) {
				// show parent div
				selectSize.parent().show();

				// get size english or hindi
				let sizes = session === 'hindi' ? data.size_hin.split(',') : data.size_en.split(',');

				sizes.forEach((size) => {
					// append size option
					selectSize.append(`<option value="${size}">${size.toUpperCase()}</option>`);
				});
			}
		}
	});
}

/**
 * Add Product to Cart
 */
function addToCart() {
	// get all field
	let size = $('#pSize').val();
	let color = $('#pColor').val();
	let code = $('#pCode').text();
	let id = $('#productId').val();
	let qty = $('#pQty').val();
	let name = $('#pName').text().trim();

	// send ajax post request
	$.ajax({
		url: '/cart/store',
		method: 'POST',
		data: {
			size,
			color,
			code,
			id,
			qty,
			name
		},
		dataType: 'JSON',
		success: function(data) {
			// call miniCart function to update header mini cart
			miniCart();

			// close modal
			$('#closeModal').click();

			// call toast function
			sweetAlertToast(data);
		}
	});
}

/**
 * Show Product in header mini cart
 */
function miniCart() {
	//  get cart parent div
	let cartParent = $('#miniCart').empty();
	let qty = $('#miniCartQty').empty();
	let total = $('#miniCartTotal').empty();
	let subTotal = $('#miniCartSubTotal').empty();

	// get data by ajax
	$.ajax({
		url: '/cart/mini',
		method: 'GET',
		dataType: 'JSON',
		success: function(data) {
			let cartData = '';
			$.each(data.carts, function(i, cart) {
				cartData += `
				<div class="cart-item product-summary">
					<div class="row">
						<div class="col-xs-4">
							<div class="image"> 
								<a href="#"><img src="${window.location.origin}/${cart.options.image}" alt="" /></a>
							</div>
						</div>
						<div class="col-xs-7">
							<h3 class="name"><a href="#">${cart.name.substring(0, 20)}</a></h3>
							<div class="price">$${cart.price} * ${cart.qty}</div>
						</div>
						<div class="col-xs-1 action"> <button class="btn btn-sm btn-danger" onclick="miniCartRemove(this.id)" id="${cart.rowId}"><i class="fa fa-trash"></i></button>
						</div>
					</div>
				</div>
				<div class="clearfix"></div>
				       <hr>`;
			});

			// append to parent div
			cartParent.html(cartData);

			// set card count
			qty.text(data.cartQty);

			// set cart total
			total.text(data.cartTotal);
			subTotal.text(data.cartTotal);
		}
	});
}
miniCart();

/**
 * Mini Cart Remove Product
 */
function miniCartRemove(id) {
	$.ajax({
		url: '/cart/mini/delete',
		method: 'POST',
		data: {
			id: id
		},
		dataType: 'JSON',
		success: function(data) {
			// call mini cart function
			miniCart();

			// call toast function
			sweetAlertToast(data);
		}
	});
}
