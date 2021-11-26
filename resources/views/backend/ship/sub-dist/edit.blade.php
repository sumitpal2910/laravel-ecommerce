@extends('admin.admin_master')
@section('title', 'Ship Sub Divisions')

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



                <!-- ------------ Edit Sub Division ------------------------ -->
                <div class="col-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Edit Sub District</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table class="table-responsive">

                                <form action="{{ route('ship.subdist.update', ['id' => $subDistrict->id]) }}"
                                    method="post">
                                    @csrf

                                    <!-- State -->
                                    <div class="form-group">
                                        <h5>State <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <select name="state_id" id="subDistSate" class="form-control">
                                                @foreach ($states as $state)
                                                    @if ($state->id === $subDistrict->state_id)
                                                        <option selected value="{{ $state->id }}">{{ $state->name }}
                                                        </option>
                                                    @else
                                                        <option value="{{ $state->id }}">{{ $state->name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            <x-error name="state_id" />
                                        </div>
                                    </div>

                                    <!-- District -->
                                    <div class="form-group">
                                        <h5>District <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <select name="district_id" id="subDistDistrict" class="form-control">
                                                @foreach ($districts as $dist)
                                                    @if ($dist->id === $subDistrict->district_id)
                                                        <option selected value="{{ $dist->id }}">{{ $dist->name }}
                                                        </option>
                                                    @else
                                                        <option value="{{ $dist->id }}">{{ $dist->name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            <x-error name="district_id" />
                                        </div>
                                    </div>

                                    <!-- Name-->
                                    <div class="form-group">
                                        <h5>Name <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="name" class="form-control"
                                                value="{{ $subDistrict->name }}">
                                            <x-error name="name" />
                                        </div>
                                    </div>


                                    <!-- Submit Button -->
                                    <div class="form-group">
                                        <input type="submit" value="Update" class="btn btn-primary">
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
