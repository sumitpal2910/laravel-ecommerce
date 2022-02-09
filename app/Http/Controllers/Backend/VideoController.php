<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum,admin', 'auth:admin']);
    }


    /**
     * Show Product Image
     */
    public function show($productId)
    {
        # get product
        $product = Product::with('videos')->findOrFail($productId);


        # show gallery
        return view('backend.product.video', compact('product'));
    }


    /**
     * Store Video
     */
    public function store(Request $request, $productId)
    {
        # get data
        $data = $request->all();
        $data['user_id'] = Auth::guard('admin')->id();

        # make dir
        $path = "products/{$productId}";
        if (Storage::missing($path)) Storage::makeDirectory($path);

        # save video
        if ($data['path_type'] == 1 && $request->hasFile('video')) {
            $video = $request->file('video');
            $tempName = hexdec(uniqid()) . "." . $video->getClientOriginalExtension();
            $url = Storage::putFileAs($path, $video, $tempName);
            $data['path'] = $url;
            $data['name'] = $video->getClientOriginalName();
        }
        unset($data['video']);

        # save cover image
        if (($data['path_type'] == 1) && ($request->hasFile('cover_image'))) {
            $img = $request->file('cover_image');
            $tempName =  time() . "." . $img->getClientOriginalExtension();
            $data['cover_image'] =  Storage::putFileAs($path, $img, $tempName);
        }

        # save to database
        Gallery::create($data);

        return response()->json(['status' => 1, 'message' => 'Video uploaded']);
    }
}
