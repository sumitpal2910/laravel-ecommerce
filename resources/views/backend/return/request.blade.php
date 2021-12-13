@extends('admin.admin_master')
@section('title', 'Return Orders')

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
                            <h3 class="box-title"> Return Orders
                                <x-badge :message="count($orders)" />
                            </h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="pendingOrderTable" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Order Date</th>
                                            <th>Return Date</th>
                                            <th>Invoice</th>
                                            <th>Amount</th>
                                            <th>Reason</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $order)
                                            <tr>
                                                <td>{{ Carbon\Carbon::parse($order->order_date)->format('D, d F Y') }}
                                                </td>
                                                <td>{{ Carbon\Carbon::parse($order->return_date)->format('D, d F Y') }}
                                                </td>
                                                <td>{{ $order->invoice_no }}</td>
                                                <td>${{ $order->amount }}</td>
                                                <td>{{ $order->return_reason }}</td>
                                                <td>
                                                    @if ($order->return_order)
                                                        <x-badge class="success" message="success" />
                                                    @else
                                                        <x-badge class="primary" message="pending" />
                                                    @endif
                                                </td>
                                                <td>
                                                    <a onclick="event.preventDefault();document.getElementById('returnApprove{{ $order->id }}').submit();"
                                                        href="{{ route('admin.return.approve', ['id' => $order->id]) }}"
                                                        class="btn btn-primary"><i class="fa fa-check"></i>Approve</a>
                                                    <form id='returnApprove{{ $order->id }}'
                                                        action="{{ route('admin.return.approve', ['id' => $order->id]) }}"
                                                        method="post" style="display: none;">
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
