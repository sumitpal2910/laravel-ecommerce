@extends('admin.admin_master')
@section('title', 'All Slider')

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

                <!-- ------------ VIEW ALL SLIDER ------------------------ -->
                <div class="col-8">

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title"> Sliders
                                <x-badge :message="count($sliders)" />
                            </h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="sliderTable" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($sliders as $slider)
                                            <tr>
                                                <td><img src="{{ url($slider->image) }}" class="img-thumbnail"
                                                        alt="slider image" width="80px">
                                                </td>
                                                <td>
                                                    @if ($slider->title)
                                                        {{ $slider->title }}
                                                    @else
                                                        <span class="badge badge-pill badge-danger">No Title</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($slider->description)
                                                        {{ $slider->description }}
                                                    @else
                                                        <span class="badge badge-pill badge-danger">No Description</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($slider->status)
                                                        <span class="badge badge-pill badge-success">Active</span>
                                                    @else
                                                        <span class="badge badge-pill badge-danger">Inactive</span>
                                                    @endif
                                                </td>
                                                <td width="30%">
                                                    <a href="{{ route('slider.edit', $slider->id) }}" title="Edit Data"
                                                        class="btn btn-info btn-sm"> <i class="fa fa-pencil"></i> </a>
                                                    <a href="{{ route('slider.delete', $slider->id) }}"
                                                        title="Delete Data" class="btn btn-danger btn-sm ml-2" id="delete">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                    <form id="deleteForm"
                                                        action="{{ route('slider.delete', ['id' => $slider->id]) }}"
                                                        method="post" style="display: none;">
                                                        @method("DELETE")
                                                        @csrf
                                                    </form>
                                                    @if ($slider->status)
                                                        <a href="{{ route('slider.updateStatus', $slider->id) }}"
                                                            title=" Inactive" class="btn btn-warning btn-sm ml-2" id="">
                                                            <i class="fa fa-arrow-down"></i>
                                                        </a>
                                                    @else
                                                        <a href="{{ route('slider.updateStatus', $slider->id) }}"
                                                            title="Active Data" class="btn btn-success btn-sm ml-2">
                                                            <i class="fa fa-arrow-up"></i>
                                                        </a>
                                                    @endif
                                                </td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->

                </div>
                <!-- /.col-8 -->


                <!-- ------------ ADD SLIDERS ------------------------ -->
                <div class="col-4">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Add Slider</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table class="table-responsive">

                                <form action="{{ route('slider.store') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <!-- Slider Title-->
                                    <div class="form-group">
                                        <h5>Title</h5>
                                        <div class="controls">
                                            <input type="text" name="title" class="form-control">
                                        </div>
                                    </div>

                                    <!-- Slider Description-->
                                    <div class="form-group">
                                        <h5>Description </h5>
                                        <div class="controls">
                                            <input type="text" name="description" class="form-control">
                                        </div>
                                    </div>

                                    <!-- Slider Image -->
                                    <div class="form-group">
                                        <h5>Image <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="file" name="image" class="form-control-file">
                                            @error('image')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Submit Button -->
                                    <div class="form-group">
                                        <input type="submit" value="Add New" class="btn btn-primary">
                                    </div>
                                </form>
                            </table>
                        </div>
                    </div>
                    <!-- /.col-8 -->
                </div>
                <!-- /.row -->
        </section>
        <!-- /.content -->

    </div>
@endsection
