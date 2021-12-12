@extends('admin.admin_master')
@section('title', 'Add Product')

@section('content')

    <div class="container-full">

        <!-- Main content -->
        <section class="content">

            <!-- Basic Forms -->
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">Edit Blog Post</h4>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col">
                            <form action="{{ route('admin.blog.update', ['id' => $blogPost->id]) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method("PUT")
                                <div class="row">
                                    <div class="col-12">

                                        <!-- first row -->
                                        <div class="row mb-5 mt-3">
                                            <!-- Title English -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5>Title English <span class="text-danger">*</span>
                                                    </h5>
                                                    <div class="controls">
                                                        <input type="text" name="title_en" id="title_en"
                                                            class="form-control" value="{{ $blogPost->title_en }}">
                                                        <x-error name="title_en" />
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Title Hindi -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5>Title Hindi <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="title_hin" id="title_hin"
                                                            class="form-control" value="{{ $blogPost->title_hin }}">
                                                        <x-error name="title_hin" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- first row end -->

                                        <!-- Second row  -->
                                        <div class="row mb-5 mt-3">
                                            <!-- category -->
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <h5> Select Post Category <span class="text-danger">*</span> </h5>
                                                    <div class="controls">
                                                        <select name="blog_post_category_id" class="form-control"
                                                            id="blog_post_category_id">
                                                            </option>
                                                            @foreach ($categories as $category)
                                                                @if ($blogPost->blog_post_category_id === $category->id)
                                                                    <option value="{{ $category->id }}" selected>
                                                                        {{ $category->name_en }} </option>
                                                                @else
                                                                    <option value="{{ $category->id }}">
                                                                        {{ $category->name_en }} </option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                        <x-error name="blog_post_category_id" />
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Image -->
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <h5> Image </h5>
                                                    <div class="controls">
                                                        <input type="hidden" name="oldImage"
                                                            value="{{ $blogPost->image }}">
                                                        <input class="form-control" type="file" name="image" id="image" />
                                                        <x-error name="image" />
                                                    </div>
                                                </div>
                                                <img id="mainThumbnail" src="{{ url($blogPost->image) ?? '' }}"
                                                    width="{{ $blogPost->image ? '100px' : '' }}">
                                            </div>

                                        </div>
                                        <!-- Second row end -->

                                        <!-- Third row  -->
                                        <div class="row mb-5 mt-3">
                                            <!-- Content English  -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5>Content English <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <textarea id="editor1" name="content_en" rows="10"
                                                            cols="80">{{ $blogPost->content_en }}</textarea>
                                                        <x-error name="content_en" />
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Content Hindi  -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5>Content Hindi <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <textarea id="editor2" name="content_hin" rows="10"
                                                            cols="80">{{ $blogPost->content_hin }}</textarea>
                                                        <x-error name="content_hin" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Third row end -->
                                    </div>
                                </div>

                                <hr>

                                <!-- Submit Button-->
                                <div class="text-xs-right">
                                    <input type="submit" class="btn btn-rounded btn-info" value="Update Blog Post">
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
             * Show Thumbnail Image Preview
             */
            $('#image').on('change', function() {
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
