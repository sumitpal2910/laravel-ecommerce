@extends('admin.admin_master')
@section('title', 'Add Product')

@section('content')

    <div class="container-full">

        <!-- Main content -->
        <section class="content">

            <!-- Basic Forms -->
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">Add Product</h4>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col">
                            <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-12">

                                        <!-- first row -->
                                        <div class="row mb-5">

                                            <!-- Brand -->
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <h5>Brand Select <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <select name="brand_id" id="brand_id" class="form-control">
                                                            <option selected disabled value="">-- Select Brand --
                                                            </option>
                                                            @foreach ($brands as $brand)
                                                                <option value="{{ $brand->id }}">
                                                                    {{ $brand->name_en }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('brand_id')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Category -->
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <h5>Category Select <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <select name="category_id" id="category_id" class="form-control"
                                                            aria-invalid="false">
                                                            <option selected disabled value="">-- Select Category --
                                                            </option>
                                                            @foreach ($categories as $category)
                                                                <option value="{{ $category->id }}">
                                                                    {{ $category->name_en }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('category_id')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Sub Category -->
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <h5>Sub Category Select <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <select name="subcategory_id" id="subcategory_id"
                                                            class="form-control" aria-invalid="false" req>
                                                            <option selected disabled value="">-- Select Sub Category --
                                                            </option>
                                                        </select>
                                                        @error('subcategory_id')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- first row end -->

                                        <!-- second row -->
                                        <div class="row mb-5 mt-3">

                                            <!-- sub sub category -->
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <h5>Sub-Sub Category Select <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <select name="sub_subcategory_id" id="sub_subcategory_id"
                                                            class="form-control" aria-invalid="false">
                                                            <option selected disabled value="">-- Select Sub-Sub Category --
                                                            </option>
                                                        </select>
                                                        @error('sub_subcategory_id')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Product Name English -->
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <h5>Product Name English <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="name_en" class="form-control">
                                                        @error('name_en')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Product Name Hindi -->
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <h5>Product Name Hindi <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="name_hin" class="form-control">
                                                        @error('name_hin')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- second row end -->

                                        <!-- Third row -->
                                        <div class="row mb-5 mt-3">
                                            <!-- Product Quantity -->
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <h5> Quantity <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="number" name="qty" id="" class="form-control">
                                                        @error('qty')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Product Tags English -->
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <h5>Tags English <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input class="form-control" type="text" value="" name="tags_en"
                                                            data-role="tagsinput" placeholder="add tags">
                                                        @error('tags_en')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Product Tags Hindi -->
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <h5> Tags Hindi <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input class="form-control" type="text" value="" name="tags_hin"
                                                            data-role="tagsinput" placeholder="add tags " />
                                                        @error('tags_hin')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Third row end -->

                                        <!-- Forth row -->
                                        <div class="row mb-5 mt-3">
                                            <!-- Product Size -->
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <h5> Size English </h5>
                                                    <div class="controls">
                                                        <input class="form-control" type="text" value="small,medium,large"
                                                            name="size_en" data-role="tagsinput" placeholder="add size" />
                                                        @error('size_en')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Product Size Hindi -->
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <h5> Size Hindi </h5>
                                                    <div class="controls">
                                                        <input class="form-control" type="text" value="small,medium,large"
                                                            name="size_hin" data-role="tagsinput" placeholder="add size" />
                                                        @error('size_hin')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Product Color English -->
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <h5> Color English </h5>
                                                    <div class="controls">
                                                        <input class="form-control" type="text" value="red,blue,black"
                                                            name="color_en" data-role="tagsinput" placeholder="add tags " />
                                                        @error('color_en')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Fourth row end -->

                                        <!-- Fifth row -->
                                        <div class="row mb-5">
                                            <!-- Product Color Hindi -->
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <h5> Color Hindi </h5>
                                                    <div class="controls">
                                                        <input class="form-control" type="text" value="red,blue,black"
                                                            name="color_hin" data-role="tagsinput"
                                                            placeholder="add tags " />
                                                        @error('color_hin')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Product Selling Price -->
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <h5>Selling Price <span class="text-danger">*</span></h5>
                                                    <div class="input-group"> <span class="input-group-addon">$</span>
                                                        <input type="number" name="selling_price" class="form-control">
                                                    </div>
                                                    @error('selling_price')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <!-- Product Discount Price -->
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <h5>Discount Price <span class="text-danger">*</span></h5>
                                                    <div class="input-group"> <span class="input-group-addon">$</span>
                                                        <input type="number" name="discount_price" class="form-control">
                                                    </div>
                                                    @error('discount_price')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Fifth row end -->

                                        <!-- Sixth row Thumbnail, Multi Image -->
                                        <div class="row mb-5 mt-3">
                                            <!-- Product Thumbnail -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5> Thumbnail <span class="text-danger">*</span> </h5>
                                                    <div class="controls">
                                                        <input class="form-control" type="file" name="thumbnail"
                                                            id="thumbnail" />
                                                        @error('thumbnail')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <img id="mainThumbnail" src="">
                                            </div>

                                            <!-- Product Multipal Image -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5>Multipal Images </h5>
                                                    <div class="controls">
                                                        <input class="form-control" type="file" id="multiImg"
                                                            name="multiImg[]" multiple />
                                                        @error('multi_img')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div id="multiImgPreview" class="row"></div>
                                            </div>

                                        </div>
                                        <!-- Sixth row end -->

                                        <!-- Seventh row  -->
                                        <div class="row mb-5 mt-3">
                                            <!-- Product Short Description English -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5>Short Description English <span class="text-danger">*</span>
                                                    </h5>
                                                    <div class="controls">
                                                        <textarea name="short_descp_en" id="short_descp_en" rows="5"
                                                            class="form-control"></textarea>

                                                        @error('short_descp_en')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Product Short Description Hindi -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5>Short Description Hindi <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <textarea name="short_descp_hin" id="short_descp_hin" rows="5"
                                                            class="form-control"></textarea>

                                                        @error('short_descp_hin')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Seventh row end -->

                                        <!-- Eight row  -->
                                        <div class="row mb-5 mt-3">
                                            <!-- Product Long Description English  -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5>Long Description English <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <textarea id="editor1" name="long_descp_en" rows="10"
                                                            cols="80"></textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Product Long Description Hindi  -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5>Long Description Hindi <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <textarea id="editor2" name="long_descp_hin" rows="10"
                                                            cols="80"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Eight row end -->
                                    </div>
                                </div>

                                <hr>

                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="controls">
                                                <fieldset>
                                                    <input type="checkbox" id="hot_deals" name="hot_deals" value="1">
                                                    <label for="hot_deals">Hot Deals</label>
                                                </fieldset>
                                                <fieldset>
                                                    <input type="checkbox" id="featured" name="featured" value="1">
                                                    <label for="featured">Featured</label>
                                                </fieldset>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="controls">
                                                <fieldset>
                                                    <input type="checkbox" id="special_offer" name="special_offer"
                                                        value="1">
                                                    <label for="special_offer">Special Offer</label>
                                                </fieldset>
                                                <fieldset>
                                                    <input type="checkbox" id="special_deals" name="special_deals"
                                                        value="1">
                                                    <label for="special_deals">Special Deals</label>
                                                </fieldset>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Submit Button-->
                                <div class="text-xs-right">
                                    <input type="submit" class="btn btn-rounded btn-info" value="Add Product">
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
        <!-- /.content -->
    </div>

    <script>
        $(document).ready(function() {
            /**
             * Get Sub Category Select
             */
            $('select[name="category_id"]').on('change', function() {
                let category_id = $(this).val();
                $("select[name='sub_subcategory_id']").html(
                    `<option selected value="" disabled>-- Select -- </option>`);

                $.ajax({
                    url: "{{ url('/category/sub/ajax') }}/" + category_id,
                    type: "GET",
                    dataType: 'json',
                    success: function(data) {
                        let select = $("select[name='subcategory_id']").empty();
                        select.append(
                            `<option selected value="" disabled>-- Select -- </option>`);

                        if (data) {
                            $(data).each(function(key, value) {
                                select.append(
                                    `<option value="${value.id}">${value.name_en}</option>`
                                );
                            });
                        }
                    }
                });
            });

            /**
             * Get Sub-Sub Category Select
             */
            $('select[name="subcategory_id"]').on('change', function() {
                let subcategory_id = $(this).val();

                $.ajax({
                    url: "{{ url('/category/sub/sub/ajax') }}/" + subcategory_id,
                    type: "GET",
                    dataType: 'json',
                    success: function(data) {
                        let select = $("select[name='sub_subcategory_id']").empty();
                        select.append(
                            `<option selected value="" disabled>-- Select -- </option>`);

                        if (data) {
                            $(data).each(function(key, value) {
                                select.append(
                                    `<option value="${value.id}">${value.name_en}</option>`
                                );
                            });
                        }
                    }
                });
            });

            /**
             *  Show Multipal Image 
             */
            $('#multiImg').on('change', function() {
                //check File API supported browser
                if (window.File && window.FileReader && window.FileList && window.Blob) {
                    var data = $(this)[0].files;

                    $(data).each(function(index, file) {
                        //check supported file type
                        if (/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)) {

                            let fRead = new FileReader();
                            fRead.onload = function(e) {

                                let img = $('<img>').addClass('img-thumbnail')
                                    .attr('src', e.target.result)
                                    .width("80px").height("80px");

                                $('#multiImgPreview').append(img);

                            };
                            //URL representing the file's data.
                            fRead.readAsDataURL(file);
                        }
                    });

                } else {
                    //if File API is absent
                    alert("Your browser doesn't support File API!");
                }
            });

            /**
             * Show Thumbnail Image Preview
             */
            $('#thumbnail').on('change', function() {
                let data = this.files;
                if (data && data[0]) {
                    let reader = new FileReader();
                    reader.onload = function(el) {
                        $("#mainThumbnail").attr('src', el.target.result).height("80px")
                            .width("80px").addClass('img-thumbnail');
                    }
                    reader.readAsDataURL(data[0]);
                }
            })

        });
    </script>

@endsection
