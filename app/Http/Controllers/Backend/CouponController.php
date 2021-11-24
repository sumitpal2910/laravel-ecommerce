<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\CouponRequest;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function __construct()
    {
        # middleware
        $this->middleware(['auth:sanctum,admin', 'auth:admin']);
    }

    /**
     * index to show all coupon page
     */
    public function index()
    {
        # get all data
        $coupons = Coupon::latest()->get();

        # return coupon view page
        return view('backend.coupon.view', compact('coupons'));
    }

    /**
     * store coupon
     */
    public function store(CouponRequest $request)
    {
        # get validate data
        $validate = $request->validated();

        # make coupon name uppercase
        $validate['name'] = strtoupper($validate['name']);

        # insert to database
        Coupon::create($validate);

        # notification
        $notification = ['message' => 'Coupon add Successfully', 'alert-type' => 'success'];

        # return back with notification
        return  redirect()->back()->with($notification);
    }

    /**
     * Show edit page
     */
    public function edit($id)
    {
        # get coupon 
        $coupon = Coupon::findOrFail($id);

        # return edit page
        return view('backend.coupon.edit', compact('coupon'));
    }

    /**
     * Update Coupon
     */
    public function update(CouponRequest $request, $id)
    {
        # get validate data
        $validate = $request->validated();

        # make coupon name uppercase
        $validate['name'] = strtoupper($validate['name']);

        # update coupon
        Coupon::findOrFail($id)->update($validate);

        # notification
        $notification = ['message' => 'Coupon update Successfully', 'alert-type' => 'info'];

        # return back with notification
        return  redirect()->route('coupon.index')->with($notification);
    }

    /**
     * delete coupon
     */
    public function delete($id)
    {
        # get coupon
        $coupon = Coupon::findOrFail($id);

        # delete 
        $coupon->delete();

        # notification
        $notification = ['message' => 'Coupon deleted Successfully', 'alert-type' => 'success'];

        # return back with notification
        return  redirect()->back()->with($notification);
    }
}
