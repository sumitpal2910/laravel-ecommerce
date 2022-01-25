@extends('admin.admin_master')
@section('title', 'view Order')

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
                <div class="col-md-6 col-12">
                    <div class="box box-bordered border-primary">
                        <div class="box-header with-border">
                            <h4 class="box-title"><strong>Shipping Details</strong> </h4>
                        </div>
                        <div class="box-body">
                            <table class="table">
                                <tr>
                                    <th>Name</th>
                                    <th>{{ $order->name }}</th>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <th>{{ $order->email }}</th>
                                </tr>
                                <tr>
                                    <th>Phone</th>
                                    <th>{{ $order->phone }}</th>
                                </tr>
                                <tr>
                                    <th>District</th>
                                    <th>{{ $order->district->name }}</th>
                                </tr>
                                <tr>
                                    <th>State</th>
                                    <th>{{ $order->state->name }}</th>
                                </tr>
                                <tr>
                                    <th>Pincode</th>
                                    <th>{{ $order->pincode }}</th>
                                </tr>
                                <tr>
                                    <th>Order Date</th>
                                    <th>{{ \Carbon\Carbon::parse($order->order_date)->format('D, d M Y') }}</th>
                                </tr>

                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-12">
                    <div class="box box-bordered border-primary">
                        <div class="box-header with-border">
                            <h4 class="box-title"><strong>Order Details &nbsp;&nbsp;
                                    <small class="text-primary"> Invoice: {{ $order->invoice_no }}</small></strong>
                            </h4>
                        </div>
                        <div class="box-body">
                            <table class="table">
                                <tr>
                                    <th>Name</th>
                                    <th>{{ $order->user->name }}</th>
                                </tr>
                                <tr>
                                    <th>Phone</th>
                                    <th>{{ $order->user->phone }}</th>
                                </tr>
                                <tr>
                                    <th>Payment Method</th>
                                    <th>{{ $order->payment_type }}</th>
                                </tr>
                                <tr>
                                    <th>Tranx ID</th>
                                    <th>{{ $order->transaction_id ?? '...' }}</th>
                                </tr>
                                <tr>
                                    <th>Invoice</th>
                                    <th class="text-primary">{{ $order->invoice_no }}</th>
                                </tr>
                                <tr>
                                    <th>Total</th>
                                    <th>${{ $order->amount }}</th>
                                </tr>
                                <tr>
                                    <th>Order</th>
                                    <th>
                                        <x-badge class="primary" :message="$order->status" />
                                    </th>
                                </tr>


                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 col-12">
                    <div class="box box-bordered border-primary">
                        <div class="box-header with-border">
                            <h4 class="box-title"><strong>Product</strong></h4>
                        </div>
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr style="background: #e2e2e2;">
                                            <th>Image</th>
                                            <th width="30%">Name</th>
                                            <th width="20%">Code</th>
                                            <th>Color</th>
                                            <th>Size</th>
                                            <th>Quantity</th>
                                            <th width="15%">Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($order->orderItem as $item)
                                            @php
                                                $product = $item->product;
                                            @endphp
                                            <tr>
                                                <td><img width="50px" src="{{ url($product->thumbnail) }}" alt=""></td>
                                                <td style="padding-left:10px;"><strong>{{ $product->name_en }}</strong>
                                                </td>
                                                <td><strong>{{ $product->code }}</strong></td>
                                                <td>
                                                    <strong>{{ $item->color ?? '...' }}</strong>
                                                </td>
                                                <td>
                                                    <strong>{{ $item->size ?? '...' }}</strong>
                                                </td>
                                                <td><strong>{{ $item->qty }}</strong></td>
                                                <td><strong>${{ $item->price }}
                                                        (${{ $item->price * $item->qty }})</strong>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>



        </section>
        <!-- /.content -->

    </div>
@endsection
