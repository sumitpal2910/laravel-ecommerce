@extends('frontend.main_master')

@section('title', 'Forget Password')

@section('content')
    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                    <li><a href="home.html">Home</a></li>
                    <li class='active'>Forget Password</li>
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
                        <h4 class="">Forget Password</h4>
                        <p class="">Forget Your Password? No Problem</p>

                        <form method="POST" action="{{ route('password.email') }}" class="register-form outer-top-xs">
                            @csrf
                            <div class="form-group">
                                <label class="info-title" for="email">Email Address <span>*</span></label>
                                <input type="email" class="form-control unicase-form-control text-input" id="email"
                                    name="email" required autofocus>
                            </div>
                            <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Email Password
                                Reset Link</button>
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
