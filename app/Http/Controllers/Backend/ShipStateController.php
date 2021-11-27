<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\ShipStateRequest;
use App\Models\ShipDistrict;
use App\Models\ShipState;
use Illuminate\Http\Request;

class ShipStateController extends Controller
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
        # get all division
        $states = ShipState::orderBy('name', 'asc')->get();

        # show view page
        return view('backend.ship.state.view', compact('states'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ShipStateRequest $request)
    {
        # get validate data
        $data = $request->validated();

        # insert data
        ShipState::create($data);

        # notification
        $notification = ['message' => 'Shipping State add Successfully', 'alert-type' => 'success'];

        # return back with notification
        return  redirect()->back()->with($notification);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        # get all division
        $state = ShipState::findOrFail($id);

        # show view page
        return view('backend.ship.state.edit', compact('state'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ShipStateRequest $request, $id)
    {
        # get validate data
        $data = $request->validated();

        # get ship division data
        $state = ShipState::findOrFail($id);

        # update
        $state->update($data);

        # notification
        $notification = ['message' => 'Shipping State update Successfully', 'alert-type' => 'info'];

        # return back with notification
        return  redirect()->route('ship.state.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        # get ship division data
        $state = ShipState::findOrFail($id);

        # delete
        $state->delete();

        # notification
        $notification = ['message' => 'Shipping State deleted Successfully', 'alert-type' => 'success'];

        # return back with notification
        return  redirect()->back()->with($notification);
    }

 
}
