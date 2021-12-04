<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use PDF;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
    {
        # middleware
        $this->middleware(['auth:sanctum,admin', 'auth:admin']);
    }

    /**
     * Show Order
     */
    public function show($id)
    {
        # get order
        $order = Order::with("district", "state", "orderItem.product")->findOrFail($id);

        # show order page
        return view("backend.order.show", compact("order"));
    }

    /**
     * Show all pending order
     */
    public function pending()
    {
        # get all pending orders
        $orders = Order::where("status", "pending")->latest()->get();

        # show pending order page
        return view("backend.order.pending", compact("orders"));
    }

    /**
     * Show all Confirmed Order
     */
    public function confirmed()
    {
        # get all confirmed order
        $orders = Order::where("status", "confirmed")->latest()->get();

        # show confirmed order page
        return view("backend.order.confirmed", compact("orders"));
    }

    /**
     * Show all Processing Order
     */
    public function processing()
    {
        # get all confirmed order
        $orders = Order::where("status", "processing")->latest()->get();

        # show confirmed order page
        return view("backend.order.processing", compact("orders"));
    }

    /**
     * Show all Picked Order
     */
    public function picked()
    {
        # get all confirmed order
        $orders = Order::where("status", "picked")->latest()->get();

        # show confirmed order page
        return view("backend.order.picked", compact("orders"));
    }

    /**
     * Show all Shipped Order
     */
    public function shipped()
    {
        # get all confirmed order
        $orders = Order::where("status", "shipped")->latest()->get();

        # show confirmed order page
        return view("backend.order.shipped", compact("orders"));
    }

    /**
     * Show all Delivered Order
     */
    public function delivered()
    {
        # get all confirmed order
        $orders = Order::where("status", "delivered")->latest()->get();

        # show confirmed order page
        return view("backend.order.delivered", compact("orders"));
    }

    /**
     * Show all Cancel Order
     */
    public function cancel()
    {
        # get all confirmed order
        $orders = Order::where("status", "cancel")->latest()->get();

        # show confirmed order page
        return view("backend.order.cancel", compact("orders"));
    }

    /**
     * Update Order status
     */
    public function updateStatus($id, $status)
    {
        # get order
        $order = Order::findOrFail($id);

        # update stauts
        $order->update(["status" => $status]);

        # notification
        $notification = ['message' => "Order $status", "alert-type" => "success"];

        # redirect to next page
        return redirect()->route("order.$status")->with($notification);
    }

    /**
     * Download order invoice
     */
    public function invoice($id)
    {
        # get order
        $order = Order::with("orderItem", "state", "district", "user", "orderItem.product")->findOrFail($id);

        # show order page
        $pdf = PDF::loadView("backend.order.invoice", compact("order"))->setPaper("a4")->setOptions([
            "tempDir" => public_path(),
            'chroot' => public_path()
        ]);
        return $pdf->download('invoice.pdf');
    }
}
