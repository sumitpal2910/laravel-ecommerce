@extends('admin.admin_master')
@section('title', 'Edit Slider')

@section('content')
    <div class="container-full">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="page-title">Data Tables</h3>
                    <div class="d-inline-block align-items-center">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                                <li class="breadcrumb-item" aria-current="page">Tables</li>
                                <li class="breadcrumb-item active" aria-current="page">Data Tables</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <section class="content">
            <div class="row">

                <!-- ------------ EDIT SLIDER ------------------------ -->
                <div class="col-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Edit Slider</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">

                                <form action="{{ route('slider.update', $slider->id) }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <!-- ID-->
                                    <input type="hidden" name="id" value="{{ $slider->id }}">

                                    <!-- Old Image-->
                                    <input type="hidden" name="oldImg" value="{{ $slider->image }}">

                                    <!-- Slider Title-->
                                    <div class="form-group">
                                        <h5>Title</h5>
                                        <div class="controls">
                                            <input type="text" name="title" class="form-control"
                                                value="{{ $slider->title }}">
                                        </div>
                                    </div>

                                    <!-- Slider Description-->
                                    <div class="form-group">
                                        <h5>Description </h5>
                                        <div class="controls">
                                            <input type="text" name="description" class="form-control"
                                                value="{{ $slider->description }}">
                                        </div>
                                    </div>

                                    <!-- Slider Image -->
                                    <div class="form-group">
                                        <h5>Image </h5>
                                        <div class="controls">
                                            <input type="file" name="image" class="form-control-file">
                                            @error('image')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Submit Button -->
                                    <div class="form-group">
                                        <input type="submit" value="Update" class="btn btn-primary">
                                    </div>
                                </form>
                        </div>
                    </div>
                    <!-- /.col-8 -->
                </div>
                <!-- /.row -->
        </section>
        <!-- /.content -->

    </div>
@endsection
