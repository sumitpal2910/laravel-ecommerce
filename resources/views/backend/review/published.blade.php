@extends('admin.admin_master')
@section('title', 'Published Reviews')

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

                <!-- ------------ VIEW ALL PENDING reviewS ------------------------ -->
                <div class="col-12">

                    <div class="box">
                        <div class="box-header with-breview">
                            <h3 class="box-title"> Published Reviews
                                <x-badge :message="count($reviews)" />
                            </h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="reviewTable" class="table table-breviewed table-striped">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>User</th>
                                            <th>Summary</th>
                                            <th>Comment</th>
                                            <th>Status</th>
                                            <th width="15%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($reviews as $review)
                                            <tr>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-3">
                                                            <img src="{{ url($review->product->thumbnail) }}"
                                                                class="img-thumbnail" width="50px" alt="">
                                                        </div>
                                                        <div class="col-9">
                                                            {{ substr($review->product->name_en, 0, 100) }}...</div>
                                                    </div>
                                                </td>
                                                <td>{{ $review->user->name }}</td>
                                                <td>{{ $review->summary }}</td>
                                                <td>{{ substr($review->comment, 0, 100) }}...</td>
                                                <td>
                                                    @if (!$review->status)
                                                        <x-badge class="primary" message="pending" />
                                                    @else
                                                        <x-badge class="success" message="publish" />
                                                    @endif
                                                </td>
                                                <td>
                                                    <a onclick="event.preventDefault();this.parentElement.children[1].submit()"
                                                        href="{{ route('admin.review.update', ['id' => $review->id]) }}"
                                                        class="btn btn-danger"><i class="fa fa-times"></i>Unapprove
                                                    </a>
                                                    <form class="adminUpdateReview"
                                                        action="{{ route('admin.review.update', ['id' => $review->id]) }}"
                                                        method="post" style="display: none;">@csrf </form>
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
