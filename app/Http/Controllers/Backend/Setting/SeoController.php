<?php

namespace App\Http\Controllers\Backend\Setting;

use App\Http\Controllers\Controller;
use App\Models\Seo;
use Illuminate\Http\Request;

class SeoController extends Controller
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
        # get or create data
        $seo = Seo::find(1) ?? Seo::factory()->create();

        # show edit page
        return view('backend.setting.seo.edit', compact('seo'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        # get seo
        $seo = Seo::findOrFail($id);

        # get form data
        $data = $request->input();

        # set data
        $seo->title = $data['title'] ?? $seo->title;
        $seo->author = $data['author'] ?? $seo->author;
        $seo->keyword = $data['keyword'] ?? $seo->keyword;
        $seo->description = $data['description'] ?? $seo->description;
        $seo->google_analytics = $data['google_analytics'] ?? $seo->google_analytics;

        # update data
        $seo->update();

        # Notification
        $notification = [
            'message' => 'Seo Update successfully',
            'alert-type' => 'success'
        ];

        # Redirect
        return redirect()->back()->with($notification);
    }
}
