/**
 * Get website address
 */
function url(link) {
    return `${window.location.origin}/${link}`;
}

/**
 * csrf token
 */
const csrfToken = $('meta[name="csrf-token"]').attr("content");

/**
 * Ajax Configration
 */
$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

/**
 * Sweet alert for delete button of all
 */
$(document).on("click", "#delete", function (event) {
    event.preventDefault();

    let form = $(this).parent().children("#deleteForm");

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
            form.submit();
            Swal.fire("Deleted!", "Your file has been deleted.", "success");
        }
    });
});
