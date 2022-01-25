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
                                    <th>${{ $order->amount }}</th>
                                </tr>
                                <tr>
                                    <th>Order</th>
                                    <th>
                                        @if ($order->return_order)
                                            <x-f-badge class="primary" :message="$order->status" />
                                            <br>
                                            <span class="badge badge-pill-warning">Return requested</span>
                                        @else
                                            <x-f-badge class="primary" :message="$order->status" />
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
                                        <td style="padding-left:10px;"><img width="50px"
                                                src="{{ url($product->thumbnail) }}" alt=""></td>
                                        <td style="padding-left:10px;"><strong>{{ $product->name_en }}</strong></td>
                                        <td style="padding-left:10px;"><strong>{{ $product->code }}</strong></td>
                                        <td style="padding-left:10px;"><strong>{{ $item->color ?? '...' }}</strong></td>
                                        <td style="padding-left:10px;"><strong>{{ $item->size ?? '...' }}</strong></td>
                                        <td style="padding-left:10px;"><strong>{{ $item->qty }}</strong></td>
                                        <td style="padding-left:10px;"><strong>${{ $item->price }}
                                                (${{ $item->price * $item->qty }})</strong>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

<<<<<<< HEAD
            @if ($order->status === "delivered")
                
            <div class="form-group">
                <textarea name="return_reason" id="" cols="30" rows="5" class="form-control" placeholder="Return reason"
                required></textarea>
            </div>
=======
            @if ($order->status === 'delivered' && !$order->return_reason)
                <form action="{{ route('user.order.return', ['id' => $order->id]) }}" method="post">
                    @csrf
                    <div class="form-group">
                        <textarea name="return_reason" id="" cols="30" rows="5" class="form-control"
                            placeholder="Return reason" required></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Return</button>
                    </div>
                </form>
>>>>>>> 554f03b3f5d3736d4c17543c52f74ceb4331dd3d
            @endif
        </div>
    </div>

@endsection
