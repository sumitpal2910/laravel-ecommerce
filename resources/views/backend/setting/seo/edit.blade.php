@extends('admin.admin_master')

@section('title', 'Seo Setting')

@section('content')

    <div class="container-full">
        <section class="content">

            <!-- Basic Forms -->
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">Change Seo Setting</h4>

                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col">
                            <form action="{{ route('setting.seo.update', ['id' => $seo->id]) }}" method="POST">
                                @csrf
                                @method("PUT")
                                <div class="row">
                                    <div class="col-6">

                                        <!--  Title -->
                                        <div class="form-group">
                                            <h5>Title</h5>
                                            <div class="controls">
                                                <input type="text" name="title" class="form-control"
                                                    value="{{ $seo->title }}">
                                            </div>
                                        </div>

                                        <!-- Author -->
                                        <div class="form-group">
                                            <h5>Author</h5>
                                            <div class="controls">
                                                <input type="text" name="author" class="form-control"
                                                    value="{{ $seo->author }}">
                                            </div>
                                        </div>

                                        <!-- Keyword -->
                                        <div class="form-group">
                                            <h5>Keyword</h5>
                                            <div class="controls">
                                                <input type="text" name="keyword" class="form-control"
                                                    value="{{ $seo->keyword }}">
                                            </div>
                                        </div>


                                        <!-- Description -->
                                        <div class="form-group">
                                            <h5>Description</h5>
                                            <div class="controls">
                                                <textarea name="description" rows="5"
                                                    class="form-control">{{ $seo->description }}</textarea>
                                            </div>
                                        </div>

                                        <!-- Google Analytics -->
                                        <div class="form-group">
                                            <h5>Google Analytics</h5>
                                            <div class="controls">
                                                <textarea name="google_analytics" rows="5"
                                                    class="form-control">{{ $seo->google_analytics }}</textarea>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-6"></div>
                                </div>
                                <div class="text-xs-right">
                                    <button type="submit" class="btn btn-rounded btn-primary">Update</button>
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
    </div>

@endsection
