<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class SliderController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum,admin', 'auth:admin']);
    }

    /**
     * view all Sliders 
     */
    public function viewSlider()
    {
        // get all slider from database
        $sliders = Slider::latest()->get();

        // show slider page
        return view('backend.slider.slider_view', compact('sliders'));
    }

    /**
     * store slider
     */
    public function storeSlider(Request $request)
    {
        // validate
        $request->validate(
            ['image' => "required"],
            ['image.required' => 'Please Select a Slider Image']
        );

        // save image
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $nameGen = hexdec(uniqid()) . "." . $image->getClientOriginalExtension();
            $fileUrl = "upload/slider/" . $nameGen;
            Image::make($image)->resize(870, 370)->save($fileUrl);
        }

        // store in database
        Slider::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'image' => $fileUrl
        ]);

        // notification
        $notification = [
            'message' => 'Slider Insert Successfully',
            'alert-type' => 'success'
        ];

        // redirect back
        return redirect()->back()->with($notification);
    }

    /**
     * show edit page
     */
    public function editSlider($id)
    {
        // get slider
        $slider = Slider::findOrFail($id);

        // view edit page
        return view('backend.slider.slider_edit', compact('slider'));
    }

    /**
     * update slider
     */
    public function updateSlider(Request $request, $id)
    {
        // get slider from database
        $slider = Slider::findOrFail($id);

        // store image
        if ($request->hasFile('image')) {
            // unlink image
            if ($slider->image) unlink($slider->image);

            // save image
            $image = $request->file('image');
            $nameGen = hexdec(uniqid()) . "." . $image->getClientOriginalExtension();
            $fileUrl = "upload/slider/" . $nameGen;
            Image::make($image)->resize(870, 370)->save($fileUrl);

            // update slider
            $slider->image = $fileUrl;
        }

        // change data
        $slider->title = $request->input('title');
        $slider->description = $request->input('description');

        // save 
        $slider->save();

        // notification
        $notification = [
            'message' => 'Slider Updated Successfully',
            'alert-type' => 'success'
        ];

        // redirect back
        return redirect()->route('all.slider')->with($notification);
    }

    /**
     * delete slider
     */
    public function deleteSlider($id)
    {
        // get the slider
        $slider = Slider::findOrFail($id);

        // unlink image
        if ($slider->image) unlink($slider->image);

        // delete
        $slider->delete();

        // notification
        $notification = [
            'message' => 'Slider Updated Successfully',
            'alert-type' => 'success'
        ];

        // redirect back
        return redirect()->back()->with($notification);
    }

    /**
     * update status
     */
    public function updateSliderStatus($id)
    {
        // Notification
        $notification = [
            'message' => 'Slider Active',
            'alert-type' => 'success'
        ];

        // get slider
        $slider = Slider::findOrFail($id);

        // check and set status
        if ($slider->status) {
            $slider->update(['status' => 0]);
            $notification = ['message' => 'Slider Inactivce', 'alert-type' => 'info'];
        } else {
            $slider->update(['status' => 1]);
        }

        // redirect to back
        return redirect()->back()->with($notification);
    }
}
