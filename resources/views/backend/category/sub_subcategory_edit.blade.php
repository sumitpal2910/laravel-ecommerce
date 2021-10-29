@extends('admin.admin_master')
@section('title', 'All Sub->Sub Categories')

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

                <!-- ------------ EDIT SUB SUB CATEGORIES ------------------------ -->
                <div class="col-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Edit Sub Sub Category</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">

                            <form action="{{ route('subSubCategory.update', $subSubCategory->id) }}" method="post">
                                @csrf
                                <!-- ID -->
                                <input type="hidden" name="id" value="{{ $subSubCategory->id }}">

                                <!-- Category -->
                                <div class="form-group">
                                    <h5>Category <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="category_id" id="category_id" class="form-control"
                                            aria-invalid="false">
                                            @foreach ($categories as $category)
                                                @if ($category->id === $subSubCategory->category_id)
                                                    <option selected value="{{ $category->id }}">
                                                        {{ $category->name_en }}
                                                    </option>
                                                @else
                                                    <option value="{{ $category->id }}">{{ $category->name_en }}
                                                    </option>
                                                @endif

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
                                            @foreach ($subCategories as $subCategory)
                                                @if ($subCategory->id === $subSubCategory->subcategory_id)
                                                    <option selected value="{{ $subCategory->id }}">
                                                        {{ $subCategory->name_en }}
                                                    </option>
                                                @else
                                                    <option value="{{ $subCategory->id }}">{{ $subCategory->name_en }}
                                                    </option>
                                                @endif
                                            @endforeach
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
                                        <input type="text" name="name_en" class="form-control"
                                            value="{{ $subSubCategory->name_en }}">
                                        @error('name_en')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Sub Sub Category Name Hindi-->
                                <div class="form-group">
                                    <h5>Sub Sub Category Name Hindi <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="name_hin" class="form-control"
                                            value="{{ $subSubCategory->name_hin }}">
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
