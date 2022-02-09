<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Folder;
use GrahamCampbell\ResultType\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FolderController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $userId = Auth::guard('admin')->id();

        # get folders
        $folders = Folder::where('user_id', $userId)->get();

        $result = [];
        foreach ($folders as $key => $folder) {
            $arr = ['id' => $folder->id, 'parent' => $folder->parent_id == 0 ? '#' : $folder->parent_id, 'text' => $folder->name,];
            array_push($result, $arr);
        }


        return response()->json($result);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        # validate
        $request->validate(['name' => 'required']);

        # get data
        $data = $request->all();
        $data['user_id'] = Auth::guard('admin')->id();

        # check if same folder is exists or not
        $exists = Folder::where('user_id', $data['user_id'])->where('parent_id', $data['parent_id'])->where('name', $data['name'])->count();

        if ($exists != 0) {
            $res = ['status' => 0, 'message' => 'Folder already exists'];
        } else {
            # create folder
            Folder::create($data);
            $res = ['status' => 1, 'message' => 'Folder created'];
        }

        # return resposne
        return response()->json($res);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Folder  $folder
     * @return \Illuminate\Http\Response
     */
    public function show(Folder $folder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Folder  $folder
     * @return \Illuminate\Http\Response
     */
    public function edit(Folder $folder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Folder  $folder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Folder $folder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Folder  $folder
     * @return \Illuminate\Http\Response
     */
    public function destroy(Folder $folder)
    {
        //
    }
}
