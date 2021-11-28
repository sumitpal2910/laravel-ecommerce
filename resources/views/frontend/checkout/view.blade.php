@extends('frontend.main_master')

@section('title', 'Checkout')

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
                    <form action="{{ route('checkout.store') }}" method="POST">
                        @csrf

                        <div class="col-md-8">
                            <div class="panel-group checkout-steps" id="accordion">
                                <!-- checkout-step-01  -->
                                <div class="panel panel-default checkout-step-01">

                                    <div style="height:auto;" id="collapseOne" class="panel-collapse collapse in">

                                        <!-- panel-body  -->
                                        <!-- Shipping address -->
                                        <div class="panel-body">
                                            <h4 class="checkout-subtitle"><b>Shipping Address</b></h4>

                                            <div class="row">

                                                <!-- Name -->
                                                <div class="col-md-6 col-sm-6">
                                                    <div class="form-group">
                                                        <label class="info-title"
                                                            for="checkoutName">Name<span>*</span></label>
                                                        <input type="text"
                                                            class="form-control unicase-form-control text-input"
                                                            id="checkoutName" placeholder="Enter your full name"
                                                            value="{{ Auth::user()->name }}" name="name">
                                                        <x-error name="name" />
                                                    </div>
                                                </div>

                                                <!-- Email -->
                                                <div class="col-md-6 col-sm-6">
                                                    <div class="form-group">
                                                        <label class="info-title" for="checkoutEmail">Email
                                                            <span>*</span></label>
                                                        <input type="email"
                                                            class="form-control unicase-form-control text-input"
                                                            id="checkoutEmail" placeholder="Email Id"
                                                            value="{{ Auth::user()->email }}" name="email">
                                                        <x-error name="email" />
                                                    </div>
                                                </div>

                                                <!-- Phone -->
                                                <div class="col-md-6 col-sm-6">
                                                    <div class="form-group">
                                                        <label class="info-title"
                                                            for="checkoutPhone">Phone<span>*</span></label>
                                                        <input type="text"
                                                            class="form-control unicase-form-control text-input"
                                                            id="checkoutPhone" placeholder="Phone" name="phone"
                                                            value="{{ Auth::user()->phone }}">
                                                        <x-error name="phone" />
                                                    </div>
                                                </div>

                                                <!-- Pincode -->
                                                <div class="col-md-6 col-sm-6">
                                                    <div class="form-group">
                                                        <label class="info-title"
                                                            for="checkoutPinCode">Pincode<span>*</span></label>
                                                        <input type="text"
                                                            class="form-control unicase-form-control text-input"
                                                            id="checkoutPinCode" placeholder="Pincode" name="pincode">
                                                        <x-error name="pincode" />
                                                    </div>
                                                </div>

                                                <!-- Address -->
                                                <div class="col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label class="info-title"
                                                            for="checkoutAddress">Address<span>*</span></label>
                                                        <textarea rows="4"
                                                            class="form-control unicase-form-control text-input"
                                                            id="checkoutAddress" placeholder="Address (Area and Street)"
                                                            name="address"></textarea>
                                                        <x-error name="address" />
                                                    </div>
                                                </div>

                                                <!-- State -->
                                                <div class="col-md-6 col-sm-6">
                                                    <div class="form-group">
                                                        <label class="info-title"
                                                            for="checkoutState">State<span>*</span></label>
                                                        <select class="form-control unicase-form-control text-input"
                                                            id="checkoutState" name="state_id">
                                                            <option value="" disabled selected>--Select State--</option>
                                                            @foreach ($states as $state)
                                                                <option value="{{ $state->id }}">{{ $state->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <x-error name="state_id" />
                                                    </div>
                                                </div>

                                                <!-- District -->
                                                <div class="col-md-6 col-sm-6">
                                                    <div class="form-group">
                                                        <label class="info-title"
                                                            for="checkoutDistrict">District<span>*</span></label>
                                                        <select class="form-control unicase-form-control text-input"
                                                            id="checkoutDistrict" name="district_id">
                                                            <option value="" disabled selected>--Select District--</option>
                                                        </select>
                                                        <x-error name="district_id" />
                                                    </div>
                                                </div>

                                                <!-- City -->
                                                <div class="col-md-6 col-sm-6 ">
                                                    <div class="form-group">
                                                        <label class="info-title"
                                                            for="checkoutCity">City<span>*</span></label>
                                                        <input type="text"
                                                            class="form-control unicase-form-control text-input"
                                                            id="checkoutCity" placeholder="City/Town" name="city">
                                                        <x-error name="city" />
                                                    </div>
                                                </div>

                                                <!-- Alt Phone -->
                                                <div class="col-md-6 col-sm-6 ">
                                                    <div class="form-group">
                                                        <label class="info-title" for="checkoutAltPhone">Alternate
                                                            Phone</label>
                                                        <input type="text"
                                                            class="form-control unicase-form-control text-input"
                                                            id="checkoutAltPhone" placeholder="Alt Phone (Optional)"
                                                            name="alt_phone">
                                                        <x-error name="alt_phone" />
                                                    </div>
                                                </div>

                                                <!-- Landmark -->
                                                <div class="col-md-12 col-sm-12 ">
                                                    <div class="form-group">
                                                        <label class="info-title"
                                                            for="checkoutLandmark">Landmark</label>
                                                        <input type="text"
                                                            class="form-control unicase-form-control text-input"
                                                            id="checkoutLandmark" placeholder="Landmark (Optional)"
                                                            name="landmark">
                                                        <x-error name="landmark" />
                                                    </div>
                                                </div>
                                                <!-- Notes -->
                                                <div class="col-md-12 col-sm-12 ">
                                                    <div class="form-group">
                                                        <label class="info-title" for="checkoutNotes">Notes</label>
                                                        <textarea rows="3"
                                                            class="form-control unicase-form-control text-input"
                                                            id="checkoutNotes" placeholder="Any Instruction (Optional)"
                                                            name="notes"></textarea>
                                                        <x-error name="notes" />
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                    <!-- Shipping address -->

                                </div>
                            </div>
                            <!-- panel-body  -->

                        </div><!-- row -->
                        <!-- checkout-step-01  -->
                        <div class="col-md-4">
                            <!-- checkout-progress-sidebar -->
                            <div class="checkout-progress-sidebar ">
                                <div class="panel-group">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="unicase-checkout-title">Products</h4>
                                        </div>
                                        <div class="">
                                            <ul class="nav nav-checkout-progress list-unstyled">
                                                @foreach ($carts as $item)
                                                    <li>
                                                        <div class="row">
                                                            <div class="col-md-2">
                                                                <img src="{{ $item->options->image }}" width="50px"
                                                                    alt="">
                                                            </div>
                                                            <div class="col-md-10">
                                                                {{ $item->name }} <br>
                                                                <ul class="list-unstyled list-inline">
                                                                    <li>
                                                                        <span> Qty:
                                                                            <strong>({{ $item->qty }})</strong></span>
                                                                    </li>
                                                                    @if ($item->options->color)
                                                                        <li>Color:<strong class="text-success">
                                                                                {{ $item->options->color }}</strong>
                                                                        </li>



                                                                    @endif
                                                                    @if ($item->options->size)
                                                                        <li>
                                                                            <span>
                                                                                Size:<strong>{{ $item->options->size }}</strong>
                                                                            </span>
                                                                        </li>

                                                                    @endif
                                                                </ul>
                                                                <ul class="list-unstyled list-inline">
                                                                    <li>
                                                                        <span>Price:
                                                                            <strong
                                                                                class="text-success">{{ $item->price }}</strong>
                                                                        </span>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <br>
                                                @endforeach
                                                <hr>
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
                            <!-- checkout-progress-sidebar -->
                            <!-- checkout-progress-sidebar -->
                            <div class="checkout-progress-sidebar ">
                                <div class="panel-group">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="unicase-checkout-title">Payment</h4>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <input type="radio" name="payment_method" value="stripe"
                                                    id="payment_method1">
                                                <label for="payment_method1">Stripe</label>
                                                <img src="{{ asset('frontend/assets/images/payments/3.png') }}" alt="">
                                            </div>
                                            <div class="col-md-4">
                                                <input type="radio" name="payment_method" value="card" id="payment_method2">
                                                <label for="payment_method2">Card</label>
                                                <img src="{{ asset('frontend/assets/images/payments/4.png') }}" alt="">
                                            </div>
                                            <div class="col-md-4">
                                                <input type="radio" name="payment_method" value="cash" id="payment_method3">
                                                <label for="payment_method3">Cash</label>
                                                <img src="{{ asset('frontend/assets/images/payments/6.png') }}" alt="">
                                            </div>

                                        </div>
                                        <x-error name="payment_method" />
                                        <hr>
                                        <button type="submit"
                                            class="btn btn-upper btn-primary checkout-page-button">Payment Step</button>
                                    </div>
                                </div>
                            </div>
                            <!-- checkout-progress-sidebar -->
                        </div>
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
