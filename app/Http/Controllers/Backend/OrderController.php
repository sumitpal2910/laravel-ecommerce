<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
    {
        # middleware
        $this->middleware(['auth:sanctum,admin', 'auth:admin']);
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
}
