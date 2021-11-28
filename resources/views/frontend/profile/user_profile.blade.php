@extends('frontend.main_master')

@section('title', 'Update Profile ')

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
                            <span class="text-danger">Hi..</span>
                            <strong>{{ Auth::user()->name }}</strong>
                            Update Your Profile
                        </h3>

                        <div class="card-body">
                            <form action="{{ route('user.profile.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label class="info-title" for="name">Name</label>
                                    <input type="text" class="form-control " id="name" name="name"
                                        value="{{ $user->name }}">
                                </div>
                                <div class="form-group">
                                    <label class="info-title" for="email">Email Address</label>
                                    <input type="email" class="form-control " id="email" name="email"
                                        value="{{ $user->email }}">
                                </div>
                                <div class="form-group">
                                    <label class="info-title" for="phone">Phone</label>
                                    <input type="text" class="form-control " id="phone" name="phone"
                                        value="{{ $user->phone }}">
                                </div>
                                <div class="form-group">
                                    <label class="info-title" for="profile_photo_path">Profile Picture</label>
                                    <input type="file" class="form-control " id="profile_photo_path"
                                        name="profile_photo_path">
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
