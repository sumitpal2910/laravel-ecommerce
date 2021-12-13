<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class ReturnController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:admin']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function request()
    {
        # get order
        $orders = Order::where('return_date', '!=', null)->where('return_order', 0)->latest()->get();

        # show return page
        return view('backend.return.request', compact('orders'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        # get order
        $orders = Order::where('return_order', 1)->latest()->get();

        # show return page
        return view('backend.return.index', compact('orders'));
    }

    /**
     * Approve return order
     */
    public function approve(Request $request, $id)
    {
        # get order
        $order = Order::findOrFail($id);

        # update return
        $order->return_order = 1;
        $order->status = "return";
        $order->update();

        # notification
        $notification = ['message' => 'Return approved Successfully', 'alert-type' => 'success'];

        # return back with notification
        return  redirect()->back()->with($notification);
    }
}
