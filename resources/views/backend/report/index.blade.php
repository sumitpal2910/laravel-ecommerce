@extends('admin.admin_master')
@section('title', 'All Brands')

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



                <!-- ------------ ADD SEARCH PAGE ------------------------ -->
                <!-- Date -->
                <div class="col-3">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Search by Date</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table class="table-responsive">
                                <form action="{{ route('report.date') }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <h5>Select Date </h5>
                                        <div class="controls">
                                            <input type="date" name="date" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-block">Search</button>
                                    </div>
                                </form>
                            </table>
                        </div>
                    </div>
                    <!-- /.col-8 -->
                </div>
                <!-- /.row -->

                <!-- Month-->
                <div class="col-6">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Search by Month</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table class="table-responsive">
                                <form action="{{ route('report.month') }}" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <h5>Select Date </h5>
                                                <div class="controls">
                                                    <select name="month" id="" class="form-control">
                                                        <option value="">Select Month</option>
                                                        @php
                                                            $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
                                                        @endphp
                                                        @foreach ($months as $key => $month)
                                                            <option value="{{ $key }}">{{ $month }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <h5>Select Year </h5>
                                                <div class="controls">
                                                    <select name="year" id="" class="form-control">
                                                        <option value="">Select Year</option>
                                                        @php
                                                            $current = date('Y');
                                                            $back = 5;
                                                        @endphp
                                                        @for ($i = 0; $i <= $back; $i++)
                                                            @if ($current - $i === $current)
                                                                <option selected value="{{ $current - $i }}">
                                                                    {{ $current - $i }}
                                                                </option>
                                                            @else
                                                                <option value="{{ $current - $i }}">{{ $current - $i }}
                                                            @endif
                                                        @endfor
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-block">Search</button>
                                    </div>
                                </form>
                            </table>
                        </div>
                    </div>
                    <!-- /.col-8 -->
                </div>

                <!-- Year-->
                <div class="col-3">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Search by Year</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table class="table-responsive">
                                <form action="{{ route('report.year') }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <h5>Select Year </h5>
                                        <div class="controls">
                                            <select name="year" id="" class="form-control">
                                                <option value="">Select Year</option>
                                                @php
                                                    $current = date('Y');
                                                    $back = 5;
                                                @endphp
                                                @for ($i = 0; $i <= $back; $i++)
                                                    @if ($current - $i === $current)
                                                        <option selected value="{{ $current - $i }}">
                                                            {{ $current - $i }}
                                                        </option>
                                                    @else
                                                        <option value="{{ $current - $i }}">{{ $current - $i }}
                                                    @endif
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-block">Search</button>
                                    </div>
                                </form>
                            </table>
                        </div>
                    </div>
                    <!-- /.col-8 -->
                </div>
                <!-- /.row -->

        </section>
        <!-- /.content -->

    </div>
@endsection
