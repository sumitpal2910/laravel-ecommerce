<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum,admin', 'auth:admin']);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        # show report page
        return view('backend.report.index');
    }

    /**
     * Show report by date
     */
    public function date(Request $request)
    {
        # get order by date
        $orders = Order::where('order_date', $request->input('date'))->latest()->get();

        # show all order 
        return view('backend.report.show', compact('orders'));
    }

    /**
     * Show report by month
     */
    public function month(Request $request)
    {
        # get order by date
        $orders = Order::where('order_month', $request->input('month'))->where('order_year', $request->input('year'))->latest()->get();

        # show all order 
        return view('backend.report.show', compact('orders'));
    }

    /**
     * Show report by month
     */
    public function year(Request $request)
    {
        # get order by date
        $orders = Order::where('order_year', $request->input('year'))->latest()->get();

        # show all order 
        return view('backend.report.show', compact('orders'));
    }
}
