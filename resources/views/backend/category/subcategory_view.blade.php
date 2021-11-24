@extends('admin.admin_master')
@section('title', 'All Sub Categories')

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
                            <h3 class="box-title">All Sub Categories</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="subCategoryTable" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Category </th>
                                            <th>Sub Category English</th>
                                            <th>Sub Category Hindi</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($subCategories as $item)
                                            <tr>
                                                <td>{{ $item->category->name_en }}</td>
                                                <td>{{ $item->name_en }}</td>
                                                <td>{{ $item->name_hin }}</td>
                                                <td width="30%">
                                                    <a href="{{ route('subcategory.edit', $item->id) }}" title="Edit Data"
                                                        class="btn btn-info"> <i class="fa fa-pencil"></i> </a>
                                                    <a href="{{ route('subcategory.delete', $item->id) }}"
                                                        title="Delete Data" class="btn btn-danger ml-2" id="delete"> <i
                                                            class="fa fa-trash"></i>
                                                    </a>
                                                    <form id="deleteForm"
                                                        action="{{ route('subcategory.delete', $item->id) }}"
                                                        method="post" style="display: none;">
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


                <!-- ------------ ADD SUB CATEGORIES ------------------------ -->
                <div class="col-4">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Add Sub Category</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">

                            <form action="{{ route('subcategory.store') }}" method="post">
                                @csrf
                                <!-- Category -->
                                <div class="form-group">
                                    <h5>Category <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="category_id" id="category_id" class="form-control"
                                            aria-invalid="false">
                                            <option selected disabled value="">-- Select Category --</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name_en }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <!-- Sub Category Name English-->
                                <div class="form-group">
                                    <h5>Sub Category Name English <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="name_en" class="form-control">
                                        @error('name_en')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Sub Category Name Hindi-->
                                <div class="form-group">
                                    <h5>Sub Category Name Hindi <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="name_hin" class="form-control">
                                        @error('name_hin')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <div class="form-group">
                                    <input type="submit" value="Add New" class="btn btn-primary">
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
