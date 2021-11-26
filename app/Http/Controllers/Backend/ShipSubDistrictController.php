<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\Backend\ShipSubDistrictRequest;
use App\Models\ShipDistrict;
use App\Models\ShipSubDistrict;
use App\Models\ShipState;

class ShipSubDistrictController extends Controller
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
        $subDistricts = ShipSubDistrict::with('state')->latest()->get();

        # get all state
        $states = ShipState::orderBy('name', 'asc')->get();

        # show view page
        return view('backend.ship.sub-dist.view', compact('subDistricts', 'states'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ShipSubDistrictRequest $request)
    {
        # get validate data
        $data = $request->validated();

        # insert data
        ShipSubDistrict::create($data);

        # notification
        $notification = ['message' => 'Shipping Sub District add Successfully', 'alert-type' => 'success'];

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
        $subDistrict = ShipSubDistrict::with('state', 'district')->findOrFail($id);

        # get all state
        $states = ShipState::orderBy('name', 'asc')->get();

        # get district
        $districts = ShipDistrict::where('state_id', $subDistrict->state_id)->get();

        # show view page
        return view('backend.ship.sub-dist.edit', compact('subDistrict', 'states', 'districts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ShipSubDistrictRequest $request, $id)
    {
        # get validate data
        $data = $request->validated();

        # get all district
        $district = ShipSubDistrict::findOrFail($id);

        # update
        $district->update($data);

        # notification
        $notification = ['message' => 'Shipping Sub District Update Successfully', 'alert-type' => 'info'];

        # return back with notification
        return redirect()->route('ship.subdist.index')->with($notification);
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
        $district = ShipSubDistrict::findOrFail($id);

        # delete
        $district->delete();

        # notification
        $notification = ['message' => 'Shipping Sub District deleted Successfully', 'alert-type' => 'success'];

        # return back with notification
        return  redirect()->back()->with($notification);
    }

    /**
     * Get all sub district data according to state id
     */
    public function getSubDistrict($id)
    {
        # get district
        $subDistricts = ShipSubDistrict::where('district_id', $id)->get();

        # return json data
        return response()->json($subDistricts);
    }
}
