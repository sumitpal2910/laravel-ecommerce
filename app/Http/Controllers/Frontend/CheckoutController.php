<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\OrderRequest;
use App\Models\ShipDistrict;
use App\Models\ShipState;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
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
        # check user login or not
        if (Auth::check()) {

            # check cart has any product or not
            if (Cart::total() > 0) {
                # get cart all data
                $carts = Cart::content();

                # get cart quantity
                $cartQty = Cart::count();

                # get cart total price
                $cartTotal = Cart::total();

                # get all state
                $states = ShipState::orderBy("name", "asc")->get();

                # view checkout page 
                return view("frontend.checkout.view", compact("carts", "cartQty", "cartTotal", "states"));
            } else {
                # notification
                $notification  = ['message' => 'First add product cart', 'alert-type' => 'info'];

                # return to home page
                return redirect()->route("index")->with($notification);
            }
        } else {
            # notification
            $notification  = ['message' => 'You need to Login first', 'alert-type' => 'error'];

            # return to login page
            return redirect()->route("login")->with($notification);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderRequest $request)
    {
        # get form data
        $data = $request->validated();

        # get cart Total 
        $cartTotal = Cart::total();


        # check payment method
        switch ($data['payment_method']) {
            case 'stripe':
                # return to stripe payment method
                return view("frontend.payment.stripe", compact("data", "cartTotal"));
                break;

            case "card":
                return "card";
                break;

            case "cash":
                return view("frontend.payment.cash", compact("data", "cartTotal"));
                break;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(OrderRequest $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Get all district data according to state id
     */
    public function getDistrict($id)
    {
        # get district
        $districts = ShipDistrict::where('state_id', $id)->orderBy("name", "asc")->get();

        # return json data
        return response()->json($districts);
    }
}
