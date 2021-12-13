@extends('frontend.main_master')

@section('title', 'Return Orders')

@section('content')

    <div class="body-content">
        <div class="container">
            <div class="row">

                <!-- User Dashboard Menu-->
                <x-user-menu />

                <div class="col-md-10">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr style="background: #e2e2e2;">
                                    <th width="20%">Date</th>
                                    <th>Total</th>
                                    <th>Payment</th>
                                    <th>Invoice</th>
                                    <th>Reason</th>
                                    <th>Order</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td style="padding-left:10px;" width="20%">
                                            <strong>{{ \Carbon\Carbon::parse($order->order_date)->format('d M Y') }}</strong>
                                        </td>
                                        <td style="padding-left:10px;"><strong>{{ $order->amount }}</strong></td>
                                        <td style="padding-left:10px;"><strong>{{ $order->payment_type }}</strong></td>
                                        <td style="padding-left:10px;"><strong>{{ $order->invoice_no }}</strong></td>
                                        <td style="padding-left:10px;"><strong>{{ $order->return_reason }}</strong></td>
                                        <td style="padding-left:10px;">
                                            @if ($order->return_date)
                                                <x-f-badge class="primary" message="pending" />
                                                <br>
                                                <span class="badge badge-pill-warning">Return requested</span>
                                            @else
                                                <x-f-badge class="primary" :message="$order->status" />
                                            @endif
                                        </td>
                                        <td style="padding-left:10px;">
                                            <a href="{{ route('user.order.show', ['id' => $order->id]) }}" title="View"
                                                class="btn btn-primary btn-sm"><i class="fa fa-eye"></i>
                                            </a>
                                            <a target="_blank"
                                                href="{{ route('user.order.invoice', ['id' => $order->id]) }}"
                                                title="Invoice" class="btn btn-info btn-sm"><i class="fa fa-download"></i>
                                            </a>
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
