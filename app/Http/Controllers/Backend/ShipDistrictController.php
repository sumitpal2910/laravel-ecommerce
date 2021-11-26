<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\ShipDistrictRequest;
use App\Models\ShipDistrict;
use App\Models\ShipState;
use Illuminate\Http\Request;

class ShipDistrictController extends Controller
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
        $districts = ShipDistrict::with('state')->latest()->get();

        # get all state
        $states = ShipState::orderBy('name', 'asc')->get();

        # show view page
        return view('backend.ship.district.view', compact('districts', 'states'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ShipDistrictRequest $request)
    {
        # get validate data
        $data = $request->validated();

        # insert data
        ShipDistrict::create($data);

        # notification
        $notification = ['message' => 'Shipping District add Successfully', 'alert-type' => 'success'];

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
        # get all district
        $district = ShipDistrict::with('state')->findOrFail($id);

        # get all state
        $states = ShipState::orderBy('name', 'asc')->get();

        # show view page
        return view('backend.ship.district.edit', compact('district', 'states'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ShipDistrictRequest $request, $id)
    {
        # get validate data
        $data = $request->validated();

        # get all district
        $district = ShipDistrict::findOrFail($id);

        # update
        $district->update($data);

        # notification
        $notification = ['message' => 'Shipping District Update Successfully', 'alert-type' => 'info'];

        # return back with notification
        return redirect()->route('ship.dist.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        # get all district
        $district = ShipDistrict::findOrFail($id);

        # delete
        $district->delete();

        # notification
        $notification = ['message' => 'Shipping District deleted Successfully', 'alert-type' => 'success'];

        # return back with notification
        return  redirect()->back()->with($notification);
    }

    /**
     * Get all district data according to state id
     */
    public function getDistrict($id)
    {
        # get district
        $districts = ShipDistrict::where('state_id', $id)->get();

        # return json data
        return response()->json($districts);
    }
}
