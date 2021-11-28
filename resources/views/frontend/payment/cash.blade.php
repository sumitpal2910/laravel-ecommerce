@extends('frontend.main_master')

@section('title', 'Cash On Dalivery')

@section('content')
    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                    <li><a href="">Home</a></li>
                    <li class='active'>Checkout</li>
                </ul>
            </div><!-- /.breadcrumb-inner -->
        </div><!-- /.container -->
    </div><!-- /.breadcrumb -->

    <div class="body-content">
        <div class="container">
            <div class="checkout-box ">
                <div class="row">


                    <!-- checkout-step-01  -->
                    <div class="col-md-6">
                        <!-- checkout-progress-sidebar -->
                        <div class="checkout-progress-sidebar ">
                            <div class="panel-group">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="unicase-checkout-title">Amount</h4>
                                    </div>
                                    <div class="">
                                        <ul class="nav nav-checkout-progress list-unstyled">
                                            @if (session()->has('coupon'))
                                                @php
                                                    $coupon = Session::get('coupon');
                                                @endphp

                                                <li>
                                                    <div class="row">
                                                        <div class="col-md-6"> <strong> Coupon</strong></div>
                                                        <div class="col-md-6">
                                                            <strong>{{ $coupon['coupon_name'] }}
                                                                ({{ $coupon['discount'] }}%)</strong>
                                                        </div>
                                                    </div>
                                                </li>
                                                <hr>
                                                <li>
                                                    <div class="row">
                                                        <div class="col-md-6"> <strong> Sub Total</strong></div>
                                                        <div class="col-md-6">
                                                            <strong>&dollar;{{ $cartTotal }}</strong>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="row">
                                                        <div class="col-md-6"> <strong> Discount</strong>
                                                            <span class="pull-right">&minus;</span>
                                                        </div>
                                                        <div class="col-md-6"> <strong>
                                                                &dollar;{{ $coupon['discount_amount'] }}</strong>
                                                        </div>
                                                    </div>
                                                </li>
                                                <hr>
                                                <li>
                                                    <div class="row text-success">
                                                        <div class="col-md-6"> <strong> Grand Total</strong></div>
                                                        <div class="col-md-6">
                                                            <strong>&dollar;{{ $coupon['total'] }}</strong>
                                                        </div>
                                                    </div>
                                                </li>
                                            @else
                                                <li>
                                                    <div class="row">
                                                        <div class="col-md-6"> <strong> Sub Total</strong></div>
                                                        <div class="col-md-6">
                                                            <strong>{{ $cartTotal }}</strong>
                                                        </div>
                                                    </div>
                                                </li>
                                                <br>
                                                <li>
                                                    <div class="row text-success">
                                                        <div class="col-md-6"> <strong> Grand Total</strong></div>
                                                        <div class="col-md-6">
                                                            <strong>{{ $cartTotal }}</strong>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endif

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end col-md-6 / -->
                    </div>
                    <div class="col-md-6">
                        <!-- checkout-progress-sidebar -->
                        <div class="checkout-progress-sidebar ">
                            <div class="panel-group">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="unicase-checkout-title">Payment</h4>
                                    </div>
                                    <img src="{{asset("frontend/assets/images/payments/cash.png")}}" alt="">
                                    <form action="{{ route('payment.cash') }}" method="post">
                                        @csrf
                                        <!-- user data -->
                                        <input type="hidden" name="name" value="{{ $data['name'] }}">
                                        <input type="hidden" name="email" value="{{ $data['email'] }}">
                                        <input type="hidden" name="phone" value="{{ $data['phone'] }}">
                                        <input type="hidden" name="alt_phone" value="{{ $data['alt_phone'] }}">
                                        <input type="hidden" name="address" value="{{ $data['address'] }}">
                                        <input type="hidden" name="city" value="{{ $data['city'] }}">
                                        <input type="hidden" name="landmark" value="{{ $data['landmark'] }}">
                                        <input type="hidden" name="pincode" value="{{ $data['pincode'] }}">
                                        <input type="hidden" name="notes" value="{{ $data['notes'] }}">
                                        <input type="hidden" name="state_id" value="{{ $data['state_id'] }}">
                                        <input type="hidden" name="district_id" value="{{ $data['district_id'] }}">

                                        <br>
                                        <button class="btn btn-primary">Submit Payment</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- checkout-progress-sidebar -->
                    </div>
                    <!-- end col-md-6 /-->
                    </form>
                </div><!-- /.checkout-steps -->
            </div>

        </div><!-- /.row -->
    </div><!-- /.checkout-box -->
    <!-- ============================================== BRANDS CAROUSEL ============================================== -->

    @include('frontend.body.brands')
    <!-- ============================================== BRANDS CAROUSEL : END ============================================== -->
    </div><!-- /.container -->
    </div><!-- /.body-content -->

@endsection
