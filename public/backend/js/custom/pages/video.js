/**
 * Change Video Type
 */
function changeVideoType(event) {
    // get target
    let target = $($(event.target).attr("target"));
    let pathType = parseInt($(event.target).val());

    // get link and file div
    let linkDiv = $(target).find("div.link-div");
    let fileDiv = $(target).find("div.file-div");

    // show / hide
    if (pathType == 1) {
        fileDiv.removeClass("d-none");
        linkDiv.addClass("d-none");
    } else {
        linkDiv.removeClass("d-none");
        fileDiv.addClass("d-none");
    }

    // remove all input value
    let inputs = $(target).find("input");
    $.each(inputs, (i, input) => {
        if (!["folder", "folder_id"].includes($(input).attr("name"))) {
            $(input).val("");
        }
    });
}

/**
 * Submit Video Form
 */
$("#formAddVideo").on("submit", function (e) {
    e.preventDefault();
    let form = this;
    let data = new FormData(this);
    data.append("_token", CSRF_TOKEN);

    // validate files
    let valid = validateVideoForm(data);
    if (valid) {
        // send data
        $.ajax({
            url: `${BASE_URL}product/${data.get("product_id")}/gallery/video`,
            method: "POST",
            data: data,
            contentType: false,
            processData: false,
            xhr: function () {
                var xhr = new XMLHttpRequest();
                xhr.upload.addEventListener(
                    "progress",
                    function (evt) {
                        $("#videoProgress").removeClass("d-none");
                        progress(evt, $("#videoProgress div"));
                    },
                    false
                );
                return xhr;
            },
            success: function (res) {
                if (res.status == 1) {
                    $("#modalAddVideo").modal("hide");
                    showVideo();
                    form.reset();
                }
            },
        });
    }
});

function progress(e, target) {
    if (e.lengthComputable) {
        var max = e.total;
        var current = e.loaded;
        var Percentage = (current * 100) / max;
        $(target).css("width", parseInt(Percentage) + "%");
        $(target).attr("aria-valuenow", parseInt(Percentage));
        return Percentage;
    }
}

function validateVideoForm(data) {
    // check if video is valid
    if (data.get("path_type") == 1) {
        let video = data.get("video");
        let size = video.size / 1024 / 1024;

        if (!video) {
            // if there is not any video
            toastr.error("Video is required", "Validation Error");
            return false;
        } else if (!video.type.match("video.*")) {
            // if file is not video
            toastr.error("Upload a video", "Validation Error");
            return;
        } else if (size > 90) {
            // if size is greater then 90mb
            toastr.error("File size is too big", "Validation Error");
            return false;
        }

        // check cover image
        if (data.get("cover_image")) {
            let img = data.get("cover_image");
            let ext = img.name.toLowerCase().split(".");
            ext = ext[ext.length - 1];
            if (!["jpg", "jpeg", "png"].includes(ext)) {
                toastr.error("Invalid Cover Image", "Validation Error");
                return false;
            }
        }
    } else if (data.get("path_type") == 2) {
        $("#videoProgress").addClass("d-none");

        // check for valid url
        let link = data.get("path") ? new URL(data.get("path")).protocol : "";
        if (!data.get("path")) {
            toastr.error("Link is required", "Validation Error");
            return false;
        } else if (!["http:", "https:"].includes(link)) {
            toastr.error("Invalid link", "Validation Error");
            return false;
        }
    }

    return true;
}

/**
 * SHow Gallert
 */
function showVideo() {
    let id = $("#product_id").val();

    // send ajax request
    $.ajax({
        url: url(`product/${id}/gallery/video`),
        method: "GET",
        success: function (res) {
            console.log(res);
            const size = new TextEncoder().encode(
                JSON.stringify(res.data)
            ).length;
            const kiloBytes = size / 1024;
            const megaBytes = kiloBytes / 1024;
            console.log(kiloBytes);

            $("#videos").html(loadVideoHtml(res.data));
        },
    });
}

/**
 * Load Html
 */
function loadVideoHtml(videos) {
    let html = "";
    videos.forEach((item) => {
        let description = item.description ? item.description : "";
        let favIcon = item.favorite == 1 ? "heart fill-red" : "heart-o";
        let img;
        let status = item.status == 1 ? "d-none" : "";

        // if image and location local
        if (item.type == 2) {
            // if type video and has cover image
            if (item.cover_image)
                img = `${window.location.origin}/storage/${item.cover_image}`;
            else img = `${window.location.origin}/storage/asset/no-video.png`;
        }

        html += `
                <div class='col-md-3 ml-0 mr-0 image-item row' id='image-item-${item.id}'>
                    <input type='hidden' class='gallery-item-id' id='gallery-item-id-${item.id}' value='${item.id}'>
                    <input type='hidden' id='photo-status-${item.id}' value='${item.status}'>

                    <div class='col-md-12 row mt-5'>
                         <div class="col-md-12 row img-button-div">
                            <div class="col-md-6">
                                <i value='${item.favorite}' iid='${item.id}' onclick='changeFavorite(event)'
                                    type='button' id='favorite-btn-${item.id}'
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
                                        <a href='#' id='${item.id}' onclick='changeStatus(this.id)'
                                            class='dropdown-item'> <i class='fa fa-eye'> Change Status</i>
                                        </a>
                                        <a href='javascript:void()' id='${item.id}' onclick='deleteItem(this.id)'
                                            class='img-delete dropdown-item'> <i class='fa fa-trash'> Delete</i>
                                        </a>

                                    </div>
                                </div>
                            </div>
                        </div>
                            <a id="${item.id}" href="#" data-toggle="modal" data-target="#modalVideoPlayer">
                                <img width='100%' class='img-responsive img-thumbnail pimg' src='${img}'>
                                <div class="bg-danger ${status} img-hide-text" id="img-hide-text-${item.id}">Hide From Gallery </div>
                            </a>
                    </div>

                    <div class='col-md-12'>
                        <div class='galelery-item-info'>
                            <div class='custom-selection'>
                                <input type='checkbox' id='image-checkbox-${item.id}'
                                    class='custom-selection-input select-image' value='${item.id}'>

                                <label for='image-checkbox-${item.id}' class='custom-selection-label'>
                                    <span id="image-checkbox-label-${item.id}">Select</span>
                                </label>
                            </div>

                            <div class='order-number bg-warning' id='order-number-${item.id}'>
                                <span>${item.ordering}</span>
                            </div>
                        </div>
                    </div>
                    <div class='col-md-12'>
                        <div class='form-group'>
                            <textarea name='description' class='description form-control'
                                id='image-description-${item.id}' rows='3'
                                placeholder='Image Description'>${description}</textarea>
                        </div>
                        <button onclick='saveDescription(${item.id})'
                            class='btn btn-block btn-success'>Submit</button>
                    </div>
                </div>`;
    });

    return html;
}
