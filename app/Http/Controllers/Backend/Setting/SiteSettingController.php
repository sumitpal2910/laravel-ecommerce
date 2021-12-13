<?php

namespace App\Http\Controllers\Backend\Setting;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class SiteSettingController extends Controller
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
        # get setting
        $setting = SiteSetting::find(1) ?? SiteSetting::factory()->create();

        # show update page
        return view('backend.setting.site.edit', compact('setting'));
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
        # get setting
        $setting = SiteSetting::findOrFail($id);



        # get form data
        $data = $request->input();

        # change data
        $setting->phone = $data['phone'] ?? $setting->phone;
        $setting->alt_phone = $data['alt_phone'] ?? $setting->alt_phone;
        $setting->email = $data['email'] ?? $setting->alt_phone;
        $setting->company_name = $data['company_name'] ?? $setting->company_name;
        $setting->company_address = $data['company_address'] ?? $setting->company_address;
        $setting->facebook = $data['facebook'] ?? $setting->facebook;
        $setting->twitter = $data['twitter'] ?? $setting->twitter;
        $setting->linkedin = $data['linkedin'] ?? $setting->linkedin;
        $setting->youtube = $data['youtube'] ?? $setting->youtube;

        if ($request->hasFile('logo')) {
            # unlink logo
            if ($setting->logo) unlink(public_path($setting->logo));

            # resize and store image
            $image = $request->file('logo');
            $nameGen = hexdec(uniqid()) . "." . $image->getClientOriginalExtension();
            $fileUrl = 'upload/logo/' . $nameGen;
            Image::make($image)->resize(139, 36)->save($fileUrl);

            # update logo
            $setting->logo = $fileUrl;
        }

        # update
        $setting->update();

        // Notification
        $notification = [
            'message' => 'Setting Update successfully',
            'alert-type' => 'success'
        ];

        // Redirect
        return redirect()->back()->with($notification);
    }
}
