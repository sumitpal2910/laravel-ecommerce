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

                <!-- ------------ EDIT SUB CATEGORY ------------------------ -->
                <div class="col-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Edit Sub Category</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">

                            <form action="{{ route('subcategory.update', $subCategory->id) }}" method="post">
                                @csrf

                                <!-- Category -->
                                <input type="hidden" name="id" value="{{ $subCategory->id }}">

                                <!-- Category -->
                                <div class="form-group">
                                    <h5>Category <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="category_id" id="category_id" class="form-control"
                                            aria-invalid="false">
                                            <option selected disabled value="">-- Select Category --</option>
                                            @foreach ($categories as $category)
                                                @if ($category->id === $subCategory->category_id)
                                                    <option selected value="{{ $category->id }}">
                                                        {{ $category->name_en }}
                                                    </option>
                                                @else
                                                    <option value="{{ $category->id }}">{{ $category->name_en }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <!-- Sub Category Name English-->
                                <div class="form-group">
                                    <h5>Sub Category Name English <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="name_en" class="form-control"
                                            value="{{ $subCategory->name_en }}">
                                        @error('name_en')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Sub Category Name Hindi-->
                                <div class="form-group">
                                    <h5>Sub Category Name Hindi <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="name_hin" class="form-control"
                                            value="{{ $subCategory->name_hin }}">
                                        @error('name_hin')
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
