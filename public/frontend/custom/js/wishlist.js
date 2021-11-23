/**
 * Add to Wish List by ajax
 */
function addToWishList(id) {
	// call ajax post request
	$.ajax({
		url: url('wishlist/add'),
		method: 'POST',
		data: {
			id: id
		},
		dataType: 'JSON',
		success: function(data) {
			// show sweetalert2 toast message
			sweetAlertToast(data);
		}
	});
}

/**
 * Show all product in wishlist
 */
function wishlist() {
	// get parent element
	let wishlist = $('#wishlist').empty();

	// call ajax post request
	$.ajax({
		url: url('wishlist/get'),
		method: 'GET',
		dataType: 'JSON',
		success: function(data) {
			let rows = '';

			// loop over data and set value
			data.forEach((element) => {
				let product = element.product;
				let link = `details/${product.id}/${product.slug_en}`;

				// price
				let price = `$${product.selling_price}`;
				if (product.discount_price > 0) {
					price = `$${product.discount_price} <span>$${product.selling_price}</span>`;
				}

				rows += `<tr>
                <td class="col-md-2"><img src="${url(product.thumbnail)}" alt="image"></td>
                <td class="col-md-7">
                    <div class="product-name"><a href="${url(link)}">
                    ${product.name_en}
                    </a></div>
                    <div class="rating">
                        <i class="fa fa-star rate"></i>
                        <i class="fa fa-star non-rate"></i>
                        <span class="review">( 06 Reviews )</span>
                    </div>
                    <div class="price">
                        ${price}
                    </div>
                </td>
                <td class="col-md-2">
                    <button data-toggle="modal" data-target="#modalViewProduct" class="btn-upper btn btn-primary"
                    id="${product.id}" onclick="viewProduct(this.id)" type="button"> Add to cart</button>
                </td>
                <td class="col-md-1 close-btn">
                    <button class="btn btn-danger btn-sm" type="submit" id="${element.id}" onclick="wishlistRemove(this.id)">
						<i class="fa fa-times"></i>
					</button>
                </td>
            </tr>`;
			});

			// append all row to parent
			wishlist.html(rows);
		}
	});
}
wishlist();

/**
 * Wishlist Remove Product
 */
function wishlistRemove(id) {
	$.ajax({
		url: url('wishlist/delete'),
		method: 'POST',
		data: {
			id: id
		},
		dataType: 'JSON',
		success: function(data) {
			// call wishlist function
			wishlist();

			// call toast function
			sweetAlertToast(data);
		}
	});
}
