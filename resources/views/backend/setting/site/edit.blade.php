@extends('admin.admin_master')

@section('title', 'Site Setting')

@section('content')

    <div class="container-full">
        <section class="content">

            <!-- Basic Forms -->
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">Change Site Setting</h4>

                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col">
                            <form action="{{ route('setting.site.update', ['id' => $setting->id]) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method("PUT")

                                <div class="row">
                                    <div class="col-6">

                                        <!--  Phone -->
                                        <div class="form-group">
                                            <h5>Phone</h5>
                                            <div class="controls">
                                                <input type="text" name="phone" class="form-control"
                                                    value="{{ $setting->phone }}">
                                            </div>
                                        </div>

                                        <!-- Alternate Phone -->
                                        <div class="form-group">
                                            <h5>Alternate Phone</h5>
                                            <div class="controls">
                                                <input type="text" name="alt_phone" class="form-control"
                                                    value="{{ $setting->alt_phone }}">
                                            </div>
                                        </div>

                                        <!-- Email -->
                                        <div class="form-group">
                                            <h5>Email</h5>
                                            <div class="controls">
                                                <input type="email" name="email" class="form-control"
                                                    value="{{ $setting->email }}">
                                            </div>
                                        </div>

                                        <!-- Cpmpany name -->
                                        <div class="form-group">
                                            <h5>Company Name</h5>
                                            <div class="controls">
                                                <input type="text" name="company_name" class="form-control"
                                                    value="{{ $setting->company_name }}">
                                            </div>
                                        </div>

                                        <!-- Cpmpany Address -->
                                        <div class="form-group">
                                            <h5>Company Address</h5>
                                            <div class="controls">
                                                <input type="text" name="company_address" class="form-control"
                                                    value="{{ $setting->company_address }}">
                                            </div>
                                        </div>


                                    </div>
                                    <div class="col-6">
                                        <!--  Logo -->
                                        <div class="form-group">
                                            <h5>Logo </h5>
                                            <div class="controls">
                                                <input type="file" name="logo" class="form-control">
                                                @if ($setting->logo)
                                                    <img width="100px" src="{{ url($setting->logo) }}" alt="">
                                                @endif
                                            </div>
                                        </div>

                                        <!--  Facebook  -->
                                        <div class="form-group">
                                            <h5>Facebook </h5>
                                            <div class="controls">
                                                <input type="text" name="facebook" class="form-control"
                                                    value="{{ $setting->facebook }}">
                                            </div>
                                        </div>

                                        <!--  Twitter -->
                                        <div class="form-group">
                                            <h5>Twitter </h5>
                                            <div class="controls">
                                                <input type="text" name="twitter" class="form-control"
                                                    value="{{ $setting->twitter }}">
                                            </div>
                                        </div>

                                        <!--  Linkedin -->
                                        <div class="form-group">
                                            <h5>Linkedin </h5>
                                            <div class="controls">
                                                <input type="text" name="linkedin" class="form-control"
                                                    value="{{ $setting->linkedin }}">
                                            </div>
                                        </div>

                                        <!--  Youtube -->
                                        <div class="form-group">
                                            <h5>Youtube </h5>
                                            <div class="controls">
                                                <input type="text" name="youtube" class="form-control"
                                                    value="{{ $setting->youtube }}">
                                            </div>
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

@endsection
