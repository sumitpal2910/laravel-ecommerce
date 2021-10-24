@extends('admin.admin_master')

@section('title', 'Profile')

@section('content')
    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js"
        integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>

    <div class="container-full">
        <section class="content">

            <!-- Basic Forms -->
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">Admin Profile Edit</h4>

                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col">
                            <form action="{{ route('admin.profile.update') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">

                                            <!-- Name Input-->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5>Name <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="name" class="form-control" required=""
                                                            value="{{ old('name', $admin->name) }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end col md 6 -->

                                            <!-- Email Id Input-->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5>Email ID <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="email" name="email" class="form-control" required=""
                                                            data-validation-required-message="This field is required"
                                                            value="{{ old('name', $admin->email) }}">
                                                        <div class="help-block"></div>
                                                    </div>
                                                </div>
                                                <!-- /. end col-md-6 -->
                                            </div>
                                            <!-- /. end row -->
                                        </div>

                                        <div class="row">
                                            <!-- Profile Photo Input-->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5>Profile Image</h5>
                                                    <div class="controls">
                                                        <input type="file" id="image" name="profile_photo_path"
                                                            class="form-control">
                                                    </div>
                                                </div>
                                                <!-- /. end col-md-6 -->
                                            </div>

                                            <!-- Show Profile Photo -->
                                            <div class="col-md-6">
                                                <img id="showImage" class="rounded-circle"
                                                    src="{{ !empty($admin->profile_photo_path) ? url('upload/admin_images/' . $admin->profile_photo_path) : url('upload/no_image.jpg') }}"
                                                    alt="Admin Image" style="width:100px; height:100px;">
                                            </div>
                                            <!-- end row -->
                                        </div>


                                    </div>
                                </div>
                                <div class="text-xs-right">
                                    <button type="submit" class="btn btn-rounded btn-primary">Update</button>
                                </div>
                            </form>

                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

        </section>
    </div>
    <script>
        $(document).ready(function() {
            $("#image").change(function(event) {

                let reader = new FileReader();
                reader.onload = function(event) {
                    $("#showImage").attr('src', event.target.result);
                }
                reader.readAsDataURL(event.target.files[0]);
            });
        });
    </script>
@endsection
