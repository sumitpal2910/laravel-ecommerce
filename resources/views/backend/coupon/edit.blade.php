@extends('admin.admin_master')
@section('title', 'Edit Coupons')

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


                <!-- ------------ EDIT COUPONS ------------------------ -->
                <div class="col-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Edit Coupon</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table class="table-responsive">

                                <form action="{{ route('coupon.update', ['id' => $coupon->id]) }}" method="post">
                                    @csrf

                                    <!-- coupon Name-->
                                    <div class="form-group">
                                        <h5>Name <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="name" class="form-control"
                                                value="{{ $coupon->name }}">
                                            <x-error name="name" />
                                        </div>
                                    </div>

                                    <!-- Discount -->
                                    <div class="form-group">
                                        <h5>Discount(%) <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="number" name="discount" class="form-control"
                                                value="{{ $coupon->discount }}">
                                            <x-error name="discount" />
                                        </div>
                                    </div>

                                    <!-- Validity -->
                                    <div class="form-group">
                                        <h5>Validity Date <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="date" name="validity" class="form-control"
                                                min="{{ date('Y-m-d') }}" value="{{ $coupon->validity }}">
                                            <x-error name="validity" />
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
