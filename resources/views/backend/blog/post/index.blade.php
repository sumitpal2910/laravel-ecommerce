@extends('admin.admin_master')
@section('title', 'Blog Posts')

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
                <div class="col-12">

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Blog Post
                                <x-badge :message="count($blogPosts)" />
                            </h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="blogPostCategoryTable" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>Title English</th>
                                            <th>Title Hindi</th>
                                            <th>Category</th>
                                            <th width="15%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($blogPosts as $item)
                                            <tr>
                                                <td><img src="{{ url($item->image) }}" width="50px" alt=""></td>
                                                <td>{{ $item->title_en }}</td>
                                                <td>{{ $item->title_hin }}</td>
                                                <td>{{ $item->category->name_en }}</td>
                                                <td>
                                                    <a href="{{ route('admin.blog.edit', ['id' => $item->id]) }}"
                                                        title="Edit Data" class="btn btn-info"> <i
                                                            class="fa fa-pencil"></i> </a>
                                                    <a href="{{ route('admin.blog.delete', ['id' => $item->id]) }}"
                                                        title="Delete Data" class="btn btn-danger ml-2" id="delete"> <i
                                                            class="fa fa-trash"></i>
                                                    </a>
                                                    <form id="deleteForm"
                                                        action="{{ route('admin.blog.delete', ['id' => $item->id]) }}"
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

        </section>
        <!-- /.content -->

    </div>
@endsection
