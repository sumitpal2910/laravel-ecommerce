@extends('frontend.main_master')

@section('title', 'Reset Password')

@section('content')
    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                    <li><a href="home.html">Home</a></li>
                    <li class='active'>Reset Password</li>
                </ul>
            </div><!-- /.breadcrumb-inner -->
        </div><!-- /.container -->
    </div><!-- /.breadcrumb -->

    <div class="body-content">
        <div class="container">
            <div class="sign-in-page">
                <div class="row">

                    <!-- forget-password -->
                    <div class="col-md-6 col-sm-6 sign-in">
                        <h4 class="">Reset Password</h4>
                        <p class="">Reset Your Password </p>

                        <form method="POST" action="{{ route('password.update') }}" class="register-form outer-top-xs">
                            @csrf
                            <input type="hidden" name="token" value="{{ $request->route('token') }}">

                            <div class="form-group">
                                <label class="info-title" for="email">Email Address <span>*</span></label>
                                <input type="email" class="form-control unicase-form-control text-input" id="email"
                                    name="email" required value="{{ old('email', $request->email) }}">
                            </div>
                            <div class="form-group">
                                <label class="info-title" for="password">Password <span>*</span></label>
                                <input type="password" class="form-control unicase-form-control text-input" id="password"
                                    name="password" required autofocus>
                            </div>
                            <div class="form-group">
                                <label class="info-title" for="password_confirmation">Confirm Password
                                    <span>*</span></label>
                                <input type="password" class="form-control unicase-form-control text-input"
                                    id="password_confirmation" name="password_confirmation" required>
                            </div>
                            <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Reset
                                Password</button>
                        </form>
                    </div>
                    <!-- forget-password -->

                </div><!-- /.row -->
            </div><!-- /.forget-password-->
            <!-- ============================================== BRANDS CAROUSEL ============================================== -->
            @include('frontend.body.brands')
            <!-- ============================================== BRANDS CAROUSEL : END ============================================== -->
        </div><!-- /.container -->
    </div>
@endsection
