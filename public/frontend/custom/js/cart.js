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
		url: url('product/ajax'),
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
			image.attr('src', url(data.thumbnail));

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
			if (sessionLanguage === 'hindi') {
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
				let colors = sessionLanguage === 'hindi' ? data.color_hin.split(',') : data.color_en.split(',');

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
				let sizes = sessionLanguage === 'hindi' ? data.size_hin.split(',') : data.size_en.split(',');

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
		url: url('cart/store'),
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
			// call coupon update function to update price
			couponUpdate();

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
		url: url('cart/get-product'),
		method: 'GET',
		dataType: 'JSON',
		success: function(data) {
			let cartData = '';
			$.each(data.carts, function(_i, cart) {
				cartData += `
				<div class="cart-item product-summary">
					<div class="row">
						<div class="col-xs-4">
							<div class="image"> 
								<a href="#"><img src="${url(cart.options.image)}" alt="" /></a>
							</div>
						</div>
						<div class="col-xs-7">
							<h3 class="name"><a href="#">${cart.name.substring(0, 25)}..</a></h3>
							<div class="price">$${cart.price} * ${cart.qty}</div>
						</div>
						<div class="col-xs-1 action"><button class="btn btn-xs btn-danger" onclick="cartRemove(this.id)" id="${cart.rowId}"><i class="fa fa-trash"></i></button>
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
 * Show all product in cart page
 */
function cart() {
	// get parent element
	let parent = $('#cartPage').empty();

	// ajax call to get all product
	$.ajax({
		url: url('cart/get-product'),
		method: 'GET',
		dataType: 'JSON',
		success: function(data) {
			// call coupon calculation function
			couponCalculation();

			let rows = '';

			$.each(data.carts, function(i, cart) {
				// define color, size
				let size = '',
					color = '';

				// show color
				if (cart.options.color) {
					color = `<div class="cart-product-info">
								<span class="product-color">COLOR:<strong><span>${cart.options.color}</span></strong></span>
							</div>`;
				}
				// show Size
				if (cart.options.size) {
					size = `<div class="cart-product-info">
								<span class="product-color">SIZE:<strong><span>${cart.options.size}</span></strong></span>
							</div>`;
				}

				// decrement button
				let decrementBtn = `<button class="btn btn-danger btn-sm" id="${cart.rowId}" onclick="cartQtyDecrement(this.id)">-</button>`;
				if (cart.qty <= 1) {
					decrementBtn = `<button class="btn btn-danger btn-sm" disabled>-</button>`;
				}

				rows += `<tr>
				
				<td class="cart-image">
					<a class="entry-thumbnail" href="">
						<img src="${url(cart.options.image)}" alt="">
					</a>
				</td>

				<td class="cart-product-name-info">
					<h4 class='cart-product-description'>
						<a href="#">${cart.name}</a>
					</h4>
					<div class="row">
						<div class="col-sm-4">
							<div class="rating rateit-small"></div>
						</div>
						<div class="col-sm-8">
							<div class="reviews">
								(06 Reviews)
							</div>
						</div>
					</div><!-- /.row -->
					<!-- size and color-->
					<div>	${size}	${color}</div>		
				</td>

				<td class="cart-product-quantity">
					<div class="row">
						<div class="col-md-4">
							${decrementBtn}
						</div>
						<div class="col-md-4">
							<span class="btn btn-light btn-sm"><strong> ${cart.qty}</strong></span>
						</div>
						<div class="col-md-4">
							<button class="btn btn-success btn-sm"  id="${cart.rowId}" onclick="cartQtyIncrement(this.id)">+</button>
						</div>
					</div>
				</td>

				<td class="cart-product-sub-total"><span class="cart-sub-total-price">$${cart.price}</span></td>

				<td class="cart-product-grand-total"><span class="cart-grand-total-price" id="cartSubTotal">$${cart.subtotal}</span></td>

				<td class="romove-item">
					<button class="btn btn-danger btn-sm" type="submit" id="${cart.rowId}" onclick="cartRemove(this.id)">
						<i class="fa fa-times"></i>
					</button>
				</td>
			</tr>`;
			});

			// add html to parent
			parent.html(rows);
		}
	});
}
cart();

/**
 * Remove Product from cart using ajax 
 */
function cartRemove(id) {
	$.ajax({
		url: url('cart/delete'),
		method: 'POST',
		data: {
			id: id
		},
		dataType: 'JSON',
		success: function(data) {
			couponUpdate();
			// call cart function
			cart();

			// call mini cart function
			miniCart();

			// call toast function
			sweetAlertToast(data);
		}
	});
}

/**
 * Cart Quantity Increment
 */
function cartQtyIncrement(rowId) {
	// send ajax request
	$.ajax({
		url: url('cart/increment'),
		method: 'POST',
		data: {
			id: rowId
		},
		dataType: 'JSON',
		success: function(data) {
			// call cart function
			cart();

			// call mini cart function
			miniCart();
		}
	});
}

/**
 * Cart Quantity Decrement
 */
function cartQtyDecrement(rowId) {
	// send ajax request
	$.ajax({
		url: url('cart/decrement'),
		method: 'POST',
		data: {
			id: rowId
		},
		dataType: 'JSON',
		success: function(data) {
			// call cart function
			cart();

			// call mini cart function
			miniCart();
		}
	});
}

/**
 * Cart Apply coupon
 */
function applyCoupon() {
	// get coupon
	let coupon = $('#couponName').val();

	// get coupon parent element
	let ele = $('#applyCouponDiv');

	// send ajax request
	$.ajax({
		url: url('cart/coupon/apply'),
		method: 'POST',
		data: {
			coupon: coupon
		},
		dataType: 'JSON',
		success: function(data) {
			console.log(data);

			if (data.status === 'success') {
				// hide the coupon div
				ele.hide();

				// call coupon calculation function to show discount
				couponCalculation();
			}

			// show sweetalert toast notification
			sweetAlertToast(data);
		}
	});
}

/**
 * Coupon Calculation 
 */
function couponCalculation() {
	// get parent element
	let element = $('#couponCalField').empty();

	// send ajax request
	$.ajax({
		url: url('cart/coupon/cal'),
		method: 'GET',
		dataType: 'JSON',
		success: function(data) {
			console.log(data);
			if (data.subTotal) {
				element.html(`
				<tr>
					<th>
						<div class="cart-sub-total text-muted">
							Coupon<span class="inner-left-md">${data.coupon_name}</span>
							<button type="button" onclick="removeCoupon()" class="btn btn-danger btn-xs"><i class="fa fa-times"></i></button>
						</div>
						<hr>
						<div class="cart-sub-total">
							Subtotal <span class="inner-left-md"> $${data.subTotal}</span>
						</div>
						<div class="cart-sub-total">
							Discount<span class="inner-left-md"> &minus;$${data.discount_amount}</span>
						</div>
						<hr>
						<div class="cart-grand-total">
							Grand Total<span class="inner-left-md">$${data.total}</span>
						</div>
					</th>
				</tr>`);
			} else {
				element.html(`
				<tr>
					<th>
						<div class="cart-sub-total">
							Subtotal<span class="inner-left-md">$${data.total}</span>
						</div>
						<div class="cart-grand-total">
							Grand Total<span class="inner-left-md">$${data.total}</span>
						</div>
					</th>
				</tr>`);
			}
		}
	});
}
couponCalculation();

/**
 * Remove Coupon
 */
function removeCoupon() {
	// send ajax request
	$.ajax({
		url: url('cart/coupon/remove'),
		method: 'GET',
		dataType: 'JSON',
		success: function(data) {
			console.log(data);
			// call coupon calculation
			couponCalculation();

			// show apply coupon box
			$('#applyCouponDiv').show();
			$('#applyCouponDiv input').val('');

			// show sweetalert toast notification
			sweetAlertToast(data);
		}
	});
}

/**
 * Cart Update - this function will update price after apply discount in session
 */
function couponUpdate() {
	$.ajax({
		url: url('cart/coupon/update'),
		method: 'GET',
		dataType: 'JSON',
		success: function(data) {
			console.log(data);
		}
	});
}
