@extends('admin.admin_master')
@section('title', 'Edit Category')

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

                <!-- ------------ EDIT CATEGORIES ------------------------ -->
                <div class="col-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Edit Blog Category</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table class="table-responsive">

                                <form action="{{ route('admin.blog.cat.update', $category->id) }}" method="post">
                                    @csrf
                                    @method("PUT")


                                    <!-- Categoryd Name English-->
                                    <div class="form-group">
                                        <h5>Category Name English <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="name_en" class="form-control"
                                                value="{{ $category->name_en }}">
                                            <x-error name="name_en" />
                                        </div>
                                    </div>

                                    <!-- Category Name Hindi-->
                                    <div class="form-group">
                                        <h5>Category Name Hindi <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="name_hin" class="form-control"
                                                value="{{ $category->name_hin }}">
                                            <x-error name="name_hin" />
                                        </div>
                                    </div>

                                    <!-- Submit Button -->
                                    <div class="form-group">
                                        <input type="submit" value="Update" class="btn btn-primary">
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
