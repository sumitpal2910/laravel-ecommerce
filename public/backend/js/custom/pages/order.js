/**
 * Order change status Pending to confirmed using ajax
 */
$("#updateStatus").on("click", function (event) {
    event.preventDefault();
    let link = $(this).attr("href");
    let status = $(this).text();
    status = status.split(" ")[0];

    Swal.fire({
        title: `Are you sure to ${status}?`,
        text: `once ${status} , You won't be able to revert this!`,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: `Yes, ${status} it!`,
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = link;
            Swal.fire(`${status}`, `Order has been ${status}.`, "success");
        }
    });
});
