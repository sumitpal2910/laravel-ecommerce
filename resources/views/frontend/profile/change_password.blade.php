@extends('frontend.main_master')

@section('title', 'Change Password ')

@section('content')

    <div class="body-content">
        <div class="container">
            <div class="row">
                <div class="col-md-2">
                    <br>
                    <img class="card-img-top" style="border-radius:50%;"
                        src="{{ !empty($user->profile_photo_path) ? url('upload/user_images/' . $user->profile_photo_path) : url('upload/no_image.jpg') }}"
                        alt="image" height="100%" width="100%">
                    <br> <br>
                    <ul class="list-group list-group-flush">
                        <a href="{{ route('dashboard') }}" class="btn btn-primary btn-sm btn-block">Home</a>
                        <a href="{{ route('user.profile') }}" class="btn btn-primary btn-sm btn-block">Profile Update</a>
                        <a href="{{ route('change.password') }}" class="btn btn-primary btn-sm btn-block">Change Password</a>
                        <a href="{{ route('user.logout') }}" class="btn btn-danger btn-sm btn-block ">Logout</a>

                        <!-- Logout form-->


                    </ul>
                </div> <!-- // End col-md-2 -->

                <div class="col-md-2">

                </div> <!-- // End col-md-2 -->

                <div class="col-md-6">
                    <div class="card">
                        <h3 class="text-center">
                            Change Password
                        </h3>

                        <div class="card-body">
                            <form action="{{ route('user.password.update') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label class="info-title" for="current_password">Current Password
                                        <span>*</span></label>
                                    <input type="password" id="current_password" class="form-control " name="oldpassword"
                                        required autofocus>
                                </div>
                                <div class="form-group">
                                    <label class="info-title" for="password">New Password <span>*</span></label>
                                    <input type="password" id="password" class="form-control " name="password" required>
                                </div>
                                <div class="form-group">
                                    <label class="info-title" for="password_confirmation">
                                        Confirm Password <span>*</span></label>
                                    <input type="password" id="password_confirmation" class="form-control "
                                        name="password_confirmation" required>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-success">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div> <!-- // End col-md-8 -->
                <div class="col-md-2"></div>

            </div>
        </div>
    </div>

@endsection
