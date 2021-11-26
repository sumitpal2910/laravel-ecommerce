<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\ShipBlockRequest;
use App\Models\ShipBlock;
use App\Models\ShipDistrict;
use App\Models\ShipState;
use App\Models\ShipSubDistrict;
use Illuminate\Http\Request;

class ShipBlockController extends Controller
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
        # get all blocks
        $blocks = ShipBlock::with(['state', 'district', 'subDistrict'])->latest()->get();

        # get all state
        $states = ShipState::orderBy('name', 'asc')->get();


        # show view page
        return view('backend.ship.block.view', compact('blocks', 'states'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ShipBlockRequest $request)
    {
        # get validate data
        $data = $request->validated();

        # insert data
        ShipBlock::create($data);

        # notification
        $notification = ['message' => 'Shipping Block add Successfully', 'alert-type' => 'success'];

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
        # get all blocks
        $block = ShipBlock::with(['state', 'district', 'subDistrict'])->findOrFail($id);

        # get all state
        $states = ShipState::orderBy('name', 'asc')->get();

        # get all districts of state
        $districts = ShipDistrict::where('state_id', $block->state_id)->orderBy('name', 'asc')->get();

        # get all sub district of district
        $subDistricts = ShipSubDistrict::where('district_id', $block->district_id)->orderBy('name', 'asc')->get();

        # show view page
        return view('backend.ship.block.edit', compact('block', 'states', 'districts', 'subDistricts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ShipBlockRequest $request, $id)
    {
        # get validate data
        $data = $request->validated();

        # get data
        $block = ShipBlock::findOrFail($id);

        # update data
        $block->update($data);

        # notification
        $notification = ['message' => 'Shipping Block Update Successfully', 'alert-type' => 'success'];

        # return back with notification
        return  redirect()->route('ship.block.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        # get data
        $block = ShipBlock::findOrFail($id);

        # update data
        $block->delete();

        # notification
        $notification = ['message' => 'Shipping Block Deleted Successfully', 'alert-type' => 'success'];

        # return back with notification
        return  redirect()->back()->with($notification);
    }
}
