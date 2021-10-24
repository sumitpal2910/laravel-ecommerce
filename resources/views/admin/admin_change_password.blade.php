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
                    <h4 class="box-title">Admin Change Password</h4>

                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col">
                            <form action="{{ route('update.change.password') }}" method="POST">
                                @csrf

                                <div class="row">
                                    <div class="col-6">

                                        <div class="form-group">
                                            <h5>Current Password <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="password" name="oldpassword" id="current_password"
                                                    class="form-control" required="">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <h5>New Password <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="password" name="password" id="password" class="form-control"
                                                    required="">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <h5>Confirm New Password <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="password" name="password_confirmation"
                                                    id="password_confirmation" class="form-control" required="">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-6"></div>
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

@endsection
