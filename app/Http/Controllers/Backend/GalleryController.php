<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum,admin', 'auth:admin']);
    }


    /**
     * Show Product Image
     */
    public function index($productId)
    {
        # get product
        $product = Product::findOrFail($productId);


        # show gallery
        return view('backend.product.gallery', compact('product'));
    }

    /**
     * show all images in json
     */
    public function showImage($productId)
    {
        # get images
        $images = Gallery::where('product_id', $productId)->where('type', 1)->orderBy('ordering', 'asc')->get();

        return response()->json(['status' => 1, 'message' => 'success', 'data' =>  $images]);
    }

    /**
     * show all videos in json
     */
    public function showVideo($productId)
    {
        # get videos
        $videos = Gallery::where('product_id', $productId)->where('type', 2)->orderBy('ordering', 'asc')->get();

        return response()->json(['status' => 1, 'message' => 'success', 'data' =>  $videos]);
    }

    /**
     * Store Image
     */
    public function storeImage(Request $request, $productId)
    {
        # get data
        $data = $request->all();
        $data['user_id'] = Auth::guard('admin')->id();
        unset($data['images']);

        # create dir
        $path = "products/{$productId}/";
        if (Storage::missing($path)) Storage::makeDirectory($path);

        if ($request->path_type == 1 && $request->hasFile('images')) {
            # get files
            $files = $request->file('images');

            # loop over files and save
            foreach ($files as $key => $file) {
                $url = $path . hexdec(uniqid()) . "." . $file->getClientOriginalExtension();
                $image = Image::make($file)->resize(512, null, function ($const) {
                    $const->aspectRatio();
                });
                Storage::put($url, (string) $image->encode());

                # save
                Gallery::create([
                    'user_id' => Auth::guard('admin')->id(),
                    'product_id' => $productId,
                    'path' => $url,
                    'path_type' => 1,
                    'name' => $file->getClientOriginalName(),
                    'folder_id' => $request->input('folder_id'),
                ]);
            }
        } else if ($request->path_type == 2) {
            # get data
            $data = $request->all();

            # insert data
            Gallery::create($data);
        }

        return response()->json(['status' => 1, 'message' => 'Image Upload']);
    }

    /**
     * Store Video
     */
    public function storeVideo(Request $request, $productId)
    {
        # get data
        $data = $request->all();
        $data['user_id'] = Auth::guard('admin')->id();
        unset($data['video']);

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


    /**
     * Delete Image
     */
    public function destroy($id)
    {
        # get data
        $data =  Gallery::findOrFail($id);

        # unlink image
        if ($data->path) Storage::delete($data->path);

        # delete data
        $data->delete();

        return response()->json(['status' => 1, 'message' => 'Image has been deleted', 'data' => $data]);
    }

    /**
     * Delete Multiple
     */
    public function deleteMultiple(Request $request, $productId)
    {
        # get ids
        $ids = $request->all();


        # get images
        $images = Gallery::where('product_id', $productId)->whereIn('id', $ids);

        # unlink image
        foreach ($images as $key => $image) {
            Storage::delete($image->path);
            Storage::delete($image->cover_image);
        }

        $images->delete();

        # return response
        return response()->json(['status' => 1, 'message' => 'Image delete successfull']);
    }

    /**
     * Re Order Image
     */
    public function reOrder(Request $request, $productId)
    {
        # get id
        $imageId = $request->input('imageId');

        # get all data
        $images = Gallery::where('product_id', $productId)->whereIn('id', $imageId)->get();

        # loop over ids
        if ($imageId) {
            foreach ($imageId as $key => $id) {
                # find image
                $image = $images->find($id)->update(['ordering' => $key + 1]);
            }
        }

        # return reposne
        return response()->json(['status' => 1, 'message' => 'Image re order successfully']);
    }

    /**
     * Update Description
     */
    public function description(Request $request, $imageId)
    {

        # get id
        $id = $request->input('id');

        # get image
        $image = Gallery::findOrFail($id)->update(['description' => $request->input('description')]);

        # return resposne
        return response()->json(['status' => 1, 'message' => 'description updated']);
    }


    /**
     * Change Favorite
     */
    public function favorite(Request $request, $id)
    {
        # get data
        $image = Gallery::findOrFail($id);

        if ($image->favorite == 1) {
            $fav = 0;
            $msg = 'Mark as unfavorite';
        } else {
            $fav = 1;
            $msg = 'Mark as favorite';
        }

        # update
        $image->favorite = $fav;
        $image->save();

        # return response
        return response()->json(['status' => 1, 'message' => $msg]);
    }

    /**
     * Store Link
     */
    public function link(Request $request, $productId)
    {
        # get data
        $data = $request->all();
        $data['user_id'] = Auth::guard('admin')->id();
        $data['type'] = 2;

        # insert data
        $gallery = Gallery::create($data);

        return response()->json(['status' => 1, 'message' => 'Link Add Successfully', 'data' => $gallery]);
    }

    /**
     * Update Status
     */
    public function updateStatus(Request $request, $id)
    {
        # get data
        $image = Gallery::findOrFail($id);

        if ($image->status == 0) {
            $image->status = 1;
            $msg = 'Image Show in Gallery';
        } else {
            $image->status = 0;
            $msg = 'Image hide from Gallery';
        }

        $image->save();

        return response()->json(['status' => 1, 'message' => $msg]);
    }
}
