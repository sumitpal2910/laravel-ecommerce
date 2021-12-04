@extends('admin.admin_master')
@section('title', 'Confirmed Orders')

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

                <!-- ------------ VIEW ALL PENDING ORDERS ------------------------ -->
                <div class="col-12">

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">All Confirmed Orders</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="pendingOrderTable" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Invoice</th>
                                            <th>Amount</th>
                                            <th>Payment</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $order)
                                            <tr>
                                                <td>{{ Carbon\Carbon::parse($order->order_date)->format('D, d F Y') }}
                                                </td>
                                                <td>{{ $order->invoice_no }}</td>
                                                <td>${{ $order->amount }}</td>
                                                <td>{{ $order->payment_type }}</td>
                                                <td>
                                                    <x-badge class="primary" :message="$order->status" />
                                                </td>
                                                <td>
                                                    <a href="{{ route('order.show', ['id' => $order->id]) }}"
                                                        title="Show " class="btn btn-info"> <i class="fa fa-eye"></i>
                                                    </a>
                                                    <a target="_blank" href="{{ route('order.invoice', ['id' => $order->id]) }}"
                                                        title="Invoice Download" class="btn btn-primary"> <i
                                                            class="fa fa-download"></i>
                                                    </a>
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
