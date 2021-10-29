@extends('admin.admin_master')
@section('title', 'All Categories')

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

                <!-- ------------ VIEW ALL CATEGORIES ------------------------ -->
                <div class="col-8">

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">All Categories</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="viewAllBrands" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Icon</th>
                                            <th>Category English</th>
                                            <th>Category Hindi</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categories as $item)
                                            <tr>
                                                <td><span><i class="{{ $item->icon }}"></i></span></td>
                                                <td>{{ $item->name_en }}</td>
                                                <td>{{ $item->name_hin }}</td>
                                                <td>
                                                    <a href="{{ route('category.edit', $item->id) }}" title="Edit Data"
                                                        class="btn btn-info"> <i class="fa fa-pencil"></i> </a>
                                                    <a href="{{ route('category.delete', $item->id) }}"
                                                        title="Delete Data" class="btn btn-danger ml-2" id="delete"> <i
                                                            class="fa fa-trash"></i>
                                                    </a>
                                                    <form id="deleteForm"
                                                        action="{{ route('category.delete', $item->id) }}" method="post"
                                                        style="display: none;">
                                                        @method("DELETE")
                                                        @csrf
                                                    </form>
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


                <!-- ------------ ADD CATEGORIES ------------------------ -->
                <div class="col-4">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Add Category</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table class="table-responsive">

                                <form action="{{ route('category.store') }}" method="post">
                                    @csrf
                                    <!-- Categoryd Name English-->
                                    <div class="form-group">
                                        <h5>Category Name English <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="name_en" class="form-control">
                                            @error('name_en')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Category Name Hindi-->
                                    <div class="form-group">
                                        <h5>Category Name Hindi <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="name_hin" class="form-control">
                                            @error('name_hin')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Category Image -->
                                    <div class="form-group">
                                        <h5>Icon <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="icon" class="form-control">
                                            @error('icon')
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
