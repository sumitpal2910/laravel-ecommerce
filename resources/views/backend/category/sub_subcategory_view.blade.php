@extends('admin.admin_master')
@section('title', 'All Sub-Sub Categories')

@section('content')
    <!-- Jquery -->
    <script src="{{ asset('../assets/vendor_components/jquery-3.3.1/jquery-3.3.1.min.js') }}"></script>

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

                <!-- ------------ VIEW ALL SUB -> SUB CATEGORIES ------------------------ -->
                <div class="col-8">

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title"> Sub Sub Categories   <x-badge :message="count($subSubCategories)" /></h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="subSubCategoryTable" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Category </th>
                                            <th>Sub Category </th>
                                            <th>Sub Sub Category</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($subSubCategories as $item)
                                            <tr>
                                                <td>{{ $item->category->name_en }}</td>
                                                <td>{{ $item->subCategory->name_en }}</td>
                                                <td>{{ $item->name_en }} </td>
                                                <td width="30%">
                                                    <a href="{{ route('subSubCategory.edit', $item->id) }}"
                                                        title="Edit Data" class="btn btn-info"> <i
                                                            class="fa fa-pencil"></i> </a>
                                                    <a href="{{ route('subSubCategory.delete', $item->id) }}"
                                                        title="Delete Data" class="btn btn-danger ml-2" id="delete"> <i
                                                            class="fa fa-trash"></i> </a>
                                                    <form id="deleteForm"
                                                        action="{{ route('subSubCategory.delete', $item->id) }}"
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


                <!-- ------------ ADD SUB SUB CATEGORIES ------------------------ -->
                <div class="col-4">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Add Sub Sub Category</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">

                            <form action="{{ route('subSubCategory.store') }}" method="post">
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
                                        @error('category_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Sub Category -->
                                <div class="form-group">
                                    <h5>Sub Category <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="subcategory_id" id="subcategory_id" class="form-control"
                                            aria-invalid="false">
                                            <option selected disabled value="">-- Select Sub Category --</option>
                                        </select>
                                        @error('subcategory_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Sub Sub Category Name English-->
                                <div class="form-group">
                                    <h5>Sub Sub Category Name English <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="name_en" class="form-control">
                                        @error('name_en')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Sub Sub Category Name Hindi-->
                                <div class="form-group">
                                    <h5>Sub Sub Category Name Hindi <span class="text-danger">*</span></h5>
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

    <script>
        $(document).ready(function() {
            $('select[name="category_id"]').on('change', function() {
                let category_id = $(this).val();

                $.ajax({
                    url: "{{ url('/category/sub/ajax') }}/" + category_id,
                    type: "GET",
                    dataType: 'json',
                    success: function(data) {
                        if (data) {
                            let select = $("select[name='subcategory_id']").empty();
                            $(data).each(function(key, value) {
                                select.append(
                                    `<option value="${value.id}">${value.name_en}</option>`
                                );
                            });
                        } else {
                            select.append(
                                `<option value="">No Sub Category Available </option>`);
                        }
                    }
                });
            });
        });
    </script>
@endsection
