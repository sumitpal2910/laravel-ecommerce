@extends('frontend.main_master')

@section('title', 'My Order')

@section('content')

    <div class="body-content">
        <div class="container">
            <div class="row">

                <!-- User Dashboard Menu-->
                <x-user-menu />

                <!-- Shipping Details -->
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header">
                            <h4>Shipping Details</h4>
                        </div>
                        <hr>
                        <div class="card-body" style="background: #E9EBEC;">
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
                <!-- Shipping Details : End -->

                <!-- Order Details -->
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header">
                            <h4>Order Details &nbsp;&nbsp;
                                <small class="text-primary"> Invoice: {{ $order->invoice_no }}</small>
                            </h4>
                        </div>
                        <hr>
                        <div class="card-body" style="background: #E9EBEC;">
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
                                    <th>{{ $order->transaction_id }}</th>
                                </tr>
                                <tr>
                                    <th>Invoice</th>
                                    <th class="text-primary">{{ $order->invoice_no }}</th>
                                </tr>
                                <tr>
                                    <th>Total</th>
                                    <th>{{ $order->amount }}</th>
                                </tr>
                                <tr>
                                    <th>Order</th>
                                    <th>
                                        @if ($order->status === 'pending')
                                            <x-f-badge class="danger" message="Pending" />
                                        @endif
                                    </th>
                                </tr>


                            </table>
                        </div>
                    </div>
                </div>
                <!-- Order Details : End -->

            </div>
            <div class="row">
                <div class="col-md-12">
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
                                        <td style="padding-left:10px;"><img width="50px" src="{{ url($product->thumbnail) }}" alt=""></td>
                                        <td style="padding-left:10px;"><strong>{{ $product->name_en }}</strong></td>
                                        <td style="padding-left:10px;"><strong>{{ $product->code }}</strong></td>
                                        <td style="padding-left:10px;"><strong>{{ $item->color ?? '...' }}</strong></td>
                                        <td style="padding-left:10px;"><strong>{{ $item->size ?? '...' }}</strong></td>
                                        <td style="padding-left:10px;"><strong>{{ $item->qty }}</strong></td>
                                        <td style="padding-left:10px;"><strong>${{ $item->price }} (${{ $item->price * $item->qty }})</strong>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
