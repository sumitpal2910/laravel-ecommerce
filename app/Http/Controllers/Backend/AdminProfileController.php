<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminProfileController extends Controller
{
    /**
     * Display Profile
     */
    public function adminProfile()
    {
        $admin = Admin::findOrFail(1);
        return view('admin.admin_profile_view', compact('admin'));
    }

    /**
     * Display Edit Profile
     */
    public function adminProfileEdit()
    {
        $admin = Admin::findOrFail(1);
        return view('admin.admin_profile_edit', compact('admin'));
    }

    /**
     * Update the Profile
     */
    public function adminProfileUpdate(Request $request)
    {
        // Find the data from database
        $admin = Admin::findOrFail(1);

        // Change email and name
        $admin->name = $request->name;
        $admin->email = $request->email;

        if ($request->file('profile_photo_path')) {
            // Remove Old Image
            if ($admin->profile_photo_path) {
                unlink("upload/admin_images/" . $admin->profile_photo_path);
            }

            // Store New Image
            $file = $request->file('profile_photo_path');
            $fileName = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'), $fileName);
            $admin->profile_photo_path = $fileName;
        }
        // Save changes
        $admin->save();

        // Toastr notification
        $notification = ['message' => 'Profile has been updated', 'alert-type' => 'success'];

        // return to admin profile page
        return redirect()->route('admin.profile')->with($notification);
    }

    /**
     * Display Change password page
     */
    public function adminChangePassword()
    {
        return view('admin.admin_change_password');
    }

    /**
     * Update Change password 
     */
    public function adminUpdateChangePassword(Request $request)
    {
        $validate = $request->validate([
            'oldpassword' => 'required',
            'password' => 'required|confirmed'
        ]);


        $hashedPassword = Admin::findOrFail(1)->password;

        if (Hash::check($request->oldpassword, $hashedPassword)) {
            $admin = Admin::findOrfail(1);
            $admin->password = Hash::make($request->password);
            $admin->save();
            Auth::logout();
            return redirect()->route('admin.logout');
        } else {
            return redirect()->back();
        }
    }
}
