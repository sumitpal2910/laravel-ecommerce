/**
 * SHow Gallert
 */
function showImage() {
    let id = $("#product_id").val();

    // send ajax request
    $.ajax({
        url: url(`product/${id}/gallery/image`),
        method: "GET",
        success: function (res) {
            console.log(res);
            const size = new TextEncoder().encode(
                JSON.stringify(res.data)
            ).length;
            const kiloBytes = size / 1024;
            const megaBytes = kiloBytes / 1024;
            console.log(kiloBytes);

            $("#images").html(loadImageHtml(res.data));
        },
    });
}

/**
 * Load Html
 */
function loadImageHtml(images) {
    let html = "";
    images.forEach((image, i) => {
        let description = image.description ? image.description : "";
        let favIcon = image.favorite == 1 ? "heart fill-red" : "heart-o";
        let img;
        let status = image.status == 1 ? "d-none" : "";

        // if image and location local
        if (image.type == 1) {
            if (image.path_type == 1)
                img = `${window.location.origin}/storage/${image.path}`;
            else img = image.path;
        } else if (image.type == 2) {
            // if type video and has cover image
            if (image.cover_image)
                img = `${window.location.origin}/storage/${image.cover_image}`;
            else img = `${window.location.origin}/storage/asset/no-video.png`;
        }

        html += `
                <div class='col-md-3 ml-0 mr-0 image-item row' id='image-item-${image.id}'>
                    <input type='hidden' class='gallery-item-id' id='gallery-item-id-${image.id}' value='${image.id}'>
                    <input type='hidden' id='photo-status-${image.id}' value='${image.status}'>

                    <div class='col-md-12 row mt-5'>
                         <div class="col-md-12 row img-button-div">
                            <div class="col-md-6">
                                <i value='${image.favorite}' iid='${image.id}' onclick='changeFavorite(event)'
                                    type='button' id='favorite-btn-${image.id}'
                                    class='fa favorite-btn fa-${favIcon}'>
                                </i>
                            </div>
                            <div class="col-md-6">
                                <div class='dropdown float-right'>
                                    <i class='fa fa-exchange dropdown-toggle' type='button'
                                    id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true'
                                        aria-expanded='false'>
                                    </i>
                                    <div class='dropdown-menu pull-right' aria-labelledby='dropdownMenuButton'>
                                        <a href='#' id='${image.id}' onclick='changeStatus(this.id)'
                                            class='dropdown-item'> <i class='fa fa-eye'> Change Status</i>
                                        </a>
                                        <a href='javascript:void()' id='${image.id}' onclick='deleteItem(this.id)'
                                            class='img-delete dropdown-item'> <i class='fa fa-trash'> Delete</i>
                                        </a>

                                    </div>
                                </div>
                            </div>
                        </div>

                            <img width='100%' class='img-responsive img-thumbnail pimg' src='${img}'>
                            <div class="bg-danger ${status} img-hide-text" id="img-hide-text-${image.id}">Hide From Gallery </div>

                    </div>

                    <div class='col-md-12'>
                        <div class='galelery-item-info'>
                            <div class='custom-selection'>
                                <input type='checkbox' id='image-checkbox-${image.id}'
                                    class='custom-selection-input select-image' value='${image.id}'>

                                <label for='image-checkbox-${image.id}' class='custom-selection-label'>
                                    <span id="image-checkbox-label-${image.id}">Select</span>
                                </label>
                            </div>

                            <div class='order-number bg-warning' id='order-number-${image.id}'>
                                <span>${i+1}</span>
                            </div>
                        </div>
                    </div>
                    <div class='col-md-12'>
                        <div class='form-group'>
                            <textarea name='description' class='description form-control'
                                id='image-description-${image.id}' rows='3'
                                placeholder='Image Description'>${description}</textarea>
                        </div>
                        <button onclick='saveDescription(${image.id})'
                            class='btn btn-block btn-success'>Submit</button>
                    </div>
                </div>`;
    });

    return html;
}

/***
 * Delete Image
 */
function deleteItem(id) {
    // show alert
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
    }).then((result) => {
        if (result.isConfirmed) {
            // send delete request
            $.ajax({
                url: url(`product/gallery/${id}`),
                method: "DELETE",
                data: { _token: $('meta[name="csrf-token"]').attr("content") },
                success: function (res) {
                    console.log(res);
                    if (res.status == 1) {
                        Swal.fire(
                            "Deleted!",
                            "Your file has been deleted.",
                            "success"
                        );
                        showImage();
                    }
                },
            });
        }
    });
}

/**
 * Change Image Status
 */
function changeStatus(id) {
    // send request
    $.ajax({
        url: `${BASE_URL}product/gallery/${id}/update-status`,
        method: "PUT",
        data: { id, _token: CSRF_TOKEN },
        success: function (res) {
            console.log(res);
            $(`#img-hide-text-${id}`).toggleClass("d-none");
        },
    });
}

/**
 * Save Description
 */
function saveDescription(id) {
    // get description
    let description = $(`#image-description-${id}`).val();

    if (description) {
        // send ajax request
        $.ajax({
            url: url(`product/gallery/${id}/description`),
            method: "PUT",
            data: { description, id, _token: CSRF_TOKEN },
            success: function (res) {
                console.log(res);
            },
        });
    } else {
        toastr.error("Validattion Error", "Description field is required");
    }
}

/**
 * Change Favorite
 */
function changeFavorite(event) {
    // get value
    let button = $(event.target);
    let id = button.attr("iid");
    let favorite = parseInt(button.attr("value"));

    // toggle class
    if (favorite == 0) {
        button.attr("value", 1);
        button.removeClass("fa-heart-o");
        button.addClass("fa-heart fill-red");
    } else {
        button.attr("value", 0);
        button.removeClass("fa-heart fill-red");
        button.addClass("fa-heart-o");
    }

    // send ajax request
    $.ajax({
        url: `${BASE_URL}product/gallery/${id}/favorite`,
        method: "PUT",
        data: { id, favorite, _token: CSRF_TOKEN },
        success: function (res) {
            console.log(res);
        },
    });
}

/**
 * Save Image
 */
$("#formAddImage").on("submit", function (e) {
    e.preventDefault();
    let form = this;
    let data = new FormData(this);
    let productId = parseInt(data.get("product_id"));
    let pathType = data.get("path_type");
    let files = data.getAll("images");
    data.delete("images");

    // validate images
    if (pathType == 1) {
        if (files[0].size <= 0) {
            toastr.error("Image field is required", "Validation Error");
            return;
        }
        // loop over files
        files.forEach((file) => {
            let imgValid = validateImage(file);
            if (imgValid) {
                data.append("images[]", file);
            }
        });
    } else if (pathType == 2) {
        if (!validateURL(data.get("path"))) return;
    }

    // send requrest
    $.ajax({
        url: `${BASE_URL}product/${productId}/gallery/image`,
        method: "POST",
        data: data,
        processData: false,
        contentType: false,
        success: function (res) {
            console.log(res);
            if (res.status == 1) {
                $("#modalAddImage").modal("hide");
                //showGallery();
                form.reset();
            }
        },
    });
});

/**
 * Select ALl Image
 */
function selectAll(event) {
    let target = $(event.target).attr("target");
    $(target)
        .find(".select-image")
        .each(function (i, element) {
            console.log(element);
            element.checked = element.checked ? false : true;
            $(`#image-checkbox-label-${element.value}`).text("Selected");
        });
}

/**
 *  Select
 */
$(".select-image").on("change", select);
function select(event) {
    console.log("clicking..");
    let input = event.target;
    console.log(input);
    if (input.checked) {
        $(`#image-checkbox-label-${input.value}`).text("Select");
    } else {
        $(`#image-checkbox-label-${input.value}`).text("Selected");
    }
}

let checks = document.querySelectorAll(".select-image");
checks.forEach((check) => {
    check.addEventListener("change", function (e) {
        console.log(e.target);
    });
});

/**
 * Delete All
 */
function deleteAll(event) {
    let target = $(event.target).attr("target");
    let productId = $(event.target).attr("product-id");

    let imageId = [];

    $(target)
        .find(".select-image")
        .each(function (i, element) {
            if (element.checked) imageId.push(element.value);
        });

    if (imageId.length > 0) {
        // show alert
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
        }).then((result) => {
            if (result.isConfirmed) {
                // send request
                $.ajax({
                    url: `${BASE_URL}product/${productId}/gallery/delete-multiple`,
                    method: "DELETE",
                    data: { imageId, _token: CSRF_TOKEN },
                    success: function (res) {
                        console.log(res);
                        if (res.status == 1) {
                            toastr.success(res.message);
                            showImage();
                            showVideo();
                        }
                    },
                });
            }
        });
    } else {
        toastr.error("Select Image", "Error");
    }
}

/**
 * =============================
 * Helper Functions
 * =============================
 */

/**
 * Validate Url
 */
function validateURL(url) {
    if (!url) {
        toastr.error("Link is required", "Validation Error");
        return false;
    }

    let protocol = new URL(url).protocol;

    if (!["http:", "https:"].includes(protocol)) {
        toastr.error("Invalid link", "Validation Error");
        return false;
    }

    return true;
}

/**
 * Validate Image Type
 */
function validateImage(image) {
    if (!image) {
        toastr.error(
            $(image).attr("name") + "field is required",
            "Validation Error"
        );
        return false;
    }

    // size check
    let size = image.size / 1024 / 1024;
    if (size > 2) {
        toastr.error("File is too large", "Validation Error");
        return false;
    }

    // get extension and check
    let ext = image.name.toLowerCase().split(".");
    ext = ext[ext.length - 1];
    if (!["jpg", "jpeg", "png"].includes(ext)) {
        toastr.error("File type not supported", "Validation Error");
        return false;
    }

    return true;
}

$(document).ready(function () {
    /**
     * Show Gallery
     */
    let url = window.location.pathname.split("/");
    if (url[1] == "product" && url[url.length - 1] == "gallery") {
        showImage();
        showVideo();
    }
    /**
     * Sortable
     */
    $(".images").sortable({
        update: function (event, ui) {
            var photoIDArr = [];
            $(".image-item").each(function (index, element) {
                photoIDArr.push($(this).find(".gallery-item-id").val());
                $(this)
                    .find(".order-number span")
                    .html(parseInt(index) + parseInt(1));
            });
            let productId = $("#product_id").val();
            $.ajax({
                type: "POST",
                url: `${BASE_URL}product/${productId}/gallery/re-order`,
                data: { imageId: photoIDArr, _token: CSRF_TOKEN },
                beforeSend: function () {},
                success: function (res) {
                    //console.log(res);
                },
            });
        },
    });

    $(".videos").sortable({
        update: function (event, ui) {
            var photoIDArr = [];
            $(".video-item").each(function (index, element) {
                photoIDArr.push($(this).find(".gallery-item-id").val());
                $(this)
                    .find(".order-number span")
                    .html(parseInt(index) + parseInt(1));
            });
            let productId = $("#product_id").val();
            $.ajax({
                type: "POST",
                url: `${BASE_URL}product/${productId}/gallery/re-order`,
                data: { imageId: photoIDArr, _token: CSRF_TOKEN },
                beforeSend: function () {},
                success: function (res) {
                    //console.log(res);
                },
            });
        },
    });
});
