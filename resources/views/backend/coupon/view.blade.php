@extends('admin.admin_master')
@section('title', 'Coupons')

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

                <!-- ------------ VIEW ALL couponS ------------------------ -->
                <div class="col-8">

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title"> Coupons
                                <x-badge :message="count($coupons)" />
                            </h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="couponTable" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Discount</th>
                                            <th>Validity</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($coupons as $coupon)
                                            <tr>
                                                <td>{{ $coupon->name }}</td>
                                                <td>{{ $coupon->discount }}%</td>
                                                <td>
                                                    {{ Carbon\Carbon::parse($coupon->validity)->format('D, d F Y') }}
                                                </td>
                                                <td>
                                                    @if ($coupon->validity < now())
                                                        <x-badge class="danger" message="In Valid" />
                                                    @else
                                                        <x-badge message="Valid" />
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('coupon.edit', ['id' => $coupon->id]) }}"
                                                        title="Edit Data" class="btn btn-info"> <i
                                                            class="fa fa-pencil"></i> </a>
                                                    <a href="{{ route('coupon.delete', ['id' => $coupon->id]) }}"
                                                        title="Delete Data" class="btn btn-danger ml-2" id="delete"> <i
                                                            class="fa fa-trash"></i>
                                                    </a>
                                                    <form id="deleteForm"
                                                        action="{{ route('coupon.delete', ['id' => $coupon->id]) }}"
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


                <!-- ------------ ADD COUPONS ------------------------ -->
                <div class="col-4">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Add Coupon</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table class="table-responsive">

                                <form action="{{ route('coupon.store') }}" method="post">
                                    @csrf
                                    <!-- coupon Name-->
                                    <div class="form-group">
                                        <h5>Name <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="name" class="form-control">
                                            <x-error name="name" />
                                        </div>
                                    </div>

                                    <!-- Discount -->
                                    <div class="form-group">
                                        <h5>Discount(%) <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="number" name="discount" class="form-control">
                                            <x-error name="discount" />
                                        </div>
                                    </div>

                                    <!-- Validity -->
                                    <div class="form-group">
                                        <h5>Validity Date <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="date" name="validity" class="form-control"
                                                min="{{ date('Y-m-d') }}">
                                            <x-error name="validity" />
                                        </div>
                                    </div>

                                    <!-- Submit Button -->
                                    <div class="form-group">
                                        <input type="submit" value="Add New" class="btn btn-primary">
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
