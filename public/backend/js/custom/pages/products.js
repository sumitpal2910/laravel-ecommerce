/***
 * set product id and name to modal
 */
$("#productTable").on("click", ".manageStock", function () {
    // get id and name
    let pid = $(this).attr("pid");
    let pname = $(this).attr("pname");

    //set id and name
    $("span#productName").text(pname);
    $("input#product_id").val(pid);
});

/**
 * ====================================================================================================================
 *          PRODUCT IMAGE
 * ====================================================================================================================
 */

// Dropzone
//$("#pdropzone").dropzone();

/**
 * Sortable
 */
$(document).ready(function () {
    $(".product-table").sortable({
        update: function (event, ui) {
            var productId = [];
            $(".product-table-item").each(function (index, element) {
                productId.push($(this).find(".product-id").val());
            });

            $.ajax({
                type: "POST",
                url: `${BASE_URL}product/re-order`,
                data: { productId: productId, _token: CSRF_TOKEN },
                beforeSend: function () {},
                success: function (res) {
                    console.log(res);
                },
            });
        },
    });
});
