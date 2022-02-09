/**
 * Show Folders
 */
function showFolder() {
    // create new folder structure
    $("#jstree").jstree({
        core: {
            check_callback: true,
            multiple: false,
            data: {
                url: `${BASE_URL}folder`,
                dataType: "JSON",
            },
        },
    });

    // hide input
    hideFolderInput();
}

// 7 bind to events triggered on the tree
$("#jstree").on("activate_node.jstree", function (e, data) {
    console.log(data.node.id);
    console.log(data);
    setFolderIdName(data.node);
});

/**
 * Set folder parent id to input
 */
function setFolderIdName(node) {
    // set folder id to input
    $("#folder-parent-id").val(node.id);
    $(".folder-id").each(function (i, el) {
        $(el).val(node.id);
    });

    // change folder name on bottom of create folder button and folder input
    $(".folder-parent b").each(function (i, el) {
        $(el).text(node.text);
    });

    // set to input
    $(".folder-name").each(function (i, el) {
        $(el).val(node.text);
    });

    // if select root deselect node
    if (node.id == 0) {
        $("#jstree").jstree().deselect_all(true);
    }
}

/**
 * Show create folder input
 */
function showFolderInput() {
    // hide button div
    $("#folderButtonDiv").addClass("d-none");

    // show input div
    $("#folderInputDiv").removeClass("d-none");
}

function hideFolderInput() {
    // hide button div
    $("#folderButtonDiv").removeClass("d-none");

    // show input div
    $("#folderInputDiv").addClass("d-none");
}

/**
 * Insert Folder
 */
$("#createFolderForm").on("submit", function (e) {
    e.preventDefault();

    let form = this;
    let data = new FormData(this);
    data.append("_token", CSRF_TOKEN);

    // validate data
    if (!data.get("name")) {
        toastr.error("Name is required", "Validation Error");
        return;
    }

    // send request
    $.ajax({
        url: `${BASE_URL}folder`,
        method: "POST",
        data: data,
        processData: false,
        contentType: false,
        success: function (res) {
            if (res.status == 1) {
                toastr.success(res.message);
                //showFolder();
                hideFolderInput();
                refreshFolder();
            } else if (res.status == 0) {
                toastr.error(res.message);
            }
        },
    });
});

function refreshFolder() {
    hideFolderInput();
    $("#jstree").jstree(true).refresh();
}

$(document).ready(function () {
    /**
     * Show Gallery
     */
    let url = window.location.pathname.split("/");
    if (url[1] == "product" && url[url.length - 1] == "gallery") {
        setTimeout(() => {
            showFolder();
        }, 3000);
    }
});
