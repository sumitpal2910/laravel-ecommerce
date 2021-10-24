@extends('admin.admin_master')

@section('title', 'Profile')

@section('content')
    <div class="container-full">

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="box box-widget widget-user">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header bg-black">
                        <h3 class="widget-user-username">{{ $admin->name }}</h3>
                        <a href="{{ route('admin.profile.edit') }}"
                            class="btn btn-rounded btn-success float-right mb-5">Edit
                            Profile</a>
                        <h6 class="widget-user-desc">{{ $admin->email }}</h6>
                    </div>
                    <div class="widget-user-image">
                        <img class="rounded-circle"
                            src="{{ !empty($admin->profile_photo_path) ? url('upload/admin_images/' . $admin->profile_photo_path) : url('upload/no_image.jpg') }}"
                            alt="Admin Image">
                    </div>
                    <div class="box-footer">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="description-block">
                                    <h5 class="description-header">12K</h5>
                                    <span class="description-text">FOLLOWERS</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 br-1 bl-1">
                                <div class="description-block">
                                    <h5 class="description-header">550</h5>
                                    <span class="description-text">FOLLOWERS</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4">
                                <div class="description-block">
                                    <h5 class="description-header">158</h5>
                                    <span class="description-text">TWEETS</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
