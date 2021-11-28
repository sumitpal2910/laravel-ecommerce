@extends('frontend.main_master')

@section('title', 'Change Password ')

@section('content')

    <div class="body-content">
        <div class="container">
            <div class="row">


                <!-- User Dashboard Menu-->
                <x-user-menu />



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
