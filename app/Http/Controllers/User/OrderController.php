<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'user']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        # get all orders
        $orders = Order::where("user_id", Auth::id())->latest()->get();

        # show order page
        return view("frontend.user.order.view", compact("orders"));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        # get order
        $order = Order::with("orderItem", "state", "district", "user", "orderItem.product")->where("user_id", Auth::id())->findOrFail($id);

        # show order page
        return view("frontend.user.order.show", compact("order"));
    }

    /**
     * Dwnload Invoice
     */
    public function invoice($id)
    {
        # get order
        $order = Order::with("orderItem", "state", "district", "user", "orderItem.product")->where("user_id", Auth::id())->findOrFail($id);

        # show order page
        // return view("frontend.user.order.invoice", compact("order"));

        $pdf = PDF::loadView("frontend.user.order.invoice", compact("order"))->setPaper("a4")->setOptions([
            "tempDir" => public_path(),
            'chroot' => public_path()
        ]);
        return $pdf->download('invoice.pdf');
    }

    /**
     * Return order
     */
    public function return(Request $request, $id)
    {
        # get order
        $order = Order::findOrFail($id);

        # update return date and reason
        $order->update([
            'return_date' => now(),
            'return_reason' => $request->input('return_reason')
        ]);

        # notification
        $notification = ['message' => 'Return Request send successfully', 'alert-type' => 'success'];

        # return to order page
        return redirect()->route('user.order.index')->with($notification);
    }

    /**
     * Show all return order
     */
    public function showReturnOrder()
    {
        # get all return order
        $orders = Order::where('return_reason', '!=', null)->where('user_id', Auth::id())->latest()->get();

        # show order page
        return view("frontend.user.order.return", compact("orders"));
    }

    /**
     * Show all return order
     */
    public function showCancelOrder()
    {
        # get all return order
        $orders = Order::where('status', 'cancel')->where('user_id', Auth::id())->latest()->get();

        # show order page
        return view("frontend.user.order.cancel", compact("orders"));
    }
}
