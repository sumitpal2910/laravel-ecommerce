$(function () {
    "use strict";

    /**
     * Brand Table
     */
    $("#brandTable").DataTable({
        ordering: false,
    });

    /**
     * Category Table
     */
    $("#categoryTable").DataTable({
        ordering: false,
    });

    /**
     * Sub Category Table
     */
    $("#subCategoryTable").DataTable({
        ordering: false,
    });

    /**
     * Sub Sub Category Table
     */
    $("#subSubCategoryTable").DataTable({
        ordering: false,
    });

    /**
     * Product Table
     */
    $("#productTable").DataTable({
        ordering: false,
    });

    /**
     * Slider Table
     */
    $("#sliderTable").DataTable({
        ordering: false,
    });

    /**
     * Coupon Table
     */
    $("#couponTable").DataTable({
        ordering: false,
    });

    /**
     * Shipping State Table
     */
    $("#shipStateTable").DataTable({
        ordering: true,
    });

    /**
     * Shipping District Table
     */
    $("#shipDistrictTable").DataTable({
        ordering: true,
    });

    /**
     * Coupon Table
     */
    $("#couponTable").DataTable({
        ordering: false,
    });

    /**
     * Pending Order Table
     */
    $("#pendingOrderTable").DataTable({
        ordering: true,
    });

    /**
     * Admin User Table
     */
    $("#usersTable").DataTable({
        ordering: true,
    });

    /**
     * ---------------------------------
     *      BLOG
     * ---------------------------------
     */

    /**
     * Blog Category Table
     */
    $("#blogPostCategoryTable").DataTable({
        ordering: true,
    });

    $("#example2").DataTable({
        paging: true,
        lengthChange: false,
        searching: false,
        ordering: true,
        info: true,
        autoWidth: false,
    });
});
