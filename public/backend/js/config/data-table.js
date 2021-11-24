$(function() {
	'use strict';

	/**
    * Brand Table
    */
	$('#brandTable').DataTable({
		ordering: false
	});

	/**
     * Category Table
     */
	$('#categoryTable').DataTable();

	/**
     * Sub Category Table
     */
	$('#subCategoryTable').DataTable();

	/**
     * Sub Sub Category Table
     */
	$('#subSubCategoryTable').DataTable();

	/**
     * Product Table
     */
	$('#productTable').DataTable();

	/**
     * Slider Table
     */
	$('#sliderTable').DataTable();

	/**
     * Coupon Table
     */
	$('#couponTable').DataTable();

	$('#example2').DataTable({
		paging: true,
		lengthChange: false,
		searching: false,
		ordering: true,
		info: true,
		autoWidth: false
	});
});
