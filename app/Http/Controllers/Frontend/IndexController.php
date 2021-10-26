<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class IndexController extends Controller
{
    /**
     * Display index page
     */
    public function index()
    {
        return view('frontend.index');
    }

    /**
     * User logout
     */
    public function userLogout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    /**
     * Show user profile
     */
    public function userProfile()
    {
        $id = Auth::id();
        $user = User::findOrFail($id);
        return view('frontend.profile.user_profile', compact('user'));
    }



    /**
     * Update user profile
     */
    public function userProfileStore(Request $request)
    {
        // Find the data from database
        $user = User::findOrFail(Auth::id());

        // Change email and name
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;

        if ($request->file('profile_photo_path')) {
            // // Remove Old Image
            if ($user->profile_photo_path) {
                unlink("upload/user_images/" . $user->profile_photo_path);
            }

            // Store New Image
            $file = $request->file('profile_photo_path');
            $fileName = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/user_images/'), $fileName);
            $user->profile_photo_path = $fileName;
        }
        // Save changes
        $user->save();

        // Toastr notification
        $notification = ['message' => 'Profile has been updated', 'alert-type' => 'success'];

        // return to user profile page with message
        return redirect()->route('dashboard')->with($notification);
    }

    /**
     * Change user password
     */
    public function userChangePassword()
    {
        $user = Auth::user();
        return view('frontend.profile.change_password', compact('user'));
    }

    /**
     * Update user password
     */
    public function userPasswordUpdate(Request $request)
    {
        $request->validate([
            'oldpassword' => 'required',
            'password' => 'required|confirmed'
        ]);


        $hashedPassword = Auth::user()->password;

        if (Hash::check($request->oldpassword, $hashedPassword)) {
            $user = User::find(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();
            return redirect()->route('user.logout');
        } else {
            return redirect()->back();
        }
    }
}
