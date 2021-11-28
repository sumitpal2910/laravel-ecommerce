@extends('frontend.main_master')

@section('title', 'Dashboard')

@section('content')

    <div class="body-content">
        <div class="container">
            <div class="row">
               
                    <!-- User Dashboard Menu-->
                    <x-user-menu />


                <div class="col-md-2">

                </div> <!-- // End col-md-2 -->

                <div class="col-md-6">
                    <div class="card">
                        <h3 class="text-center">
                            <span class="text-danger">Hi..</span>
                            <strong>{{ Auth::user()->name }}</strong>
                            Welcome to Laravel Ecommerce
                        </h3>
                    </div>
                </div> <!-- // End col-md-8 -->
                <div class="col-md-2"></div>

            </div>
        </div>
    </div>

@endsection
