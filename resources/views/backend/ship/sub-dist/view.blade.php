@extends('admin.admin_master')
@section('title', 'Ship Sub Districts')

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

                <!-- ------------ VIEW ALL Sub Division ------------------------ -->
                <div class="col-8">

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">All Sub Division</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="shipSubDistrictTable" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>District</th>
                                            <th>State</th>
                                            <th width="20%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($subDistricts as $item)
                                            <tr>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->district->name }}</td>
                                                <td>{{ $item->state->name }}</td>
                                                <td>
                                                    <a href="{{ route('ship.subdist.edit', ['id' => $item->id]) }}"
                                                        title="Edit Data" class="btn btn-info"> <i
                                                            class="fa fa-pencil"></i> </a>
                                                    <a href="{{ route('ship.subdist.delete', ['id' => $item->id]) }}"
                                                        title="Delete Data" class="btn btn-danger ml-2" id="delete"> <i
                                                            class="fa fa-trash"></i>
                                                    </a>
                                                    <form id="deleteForm"
                                                        action="{{ route('ship.subdist.delete', ['id' => $item->id]) }}"
                                                        method="post" style="display: none;">
                                                        @method("DELETE")
                                                        @csrf
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->

                </div>
                <!-- /.col-8 -->


                <!-- ------------ ADD Sub Division ------------------------ -->
                <div class="col-4">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Add Sub District</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table class="table-responsive">

                                <form action="{{ route('ship.subdist.store') }}" method="post">
                                    @csrf

                                    <!-- State -->
                                    <div class="form-group">
                                        <h5>State <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <select name="state_id" id="subDistState" class="form-control">
                                                <option value="" disabled selected>--Select State--</option>
                                                @foreach ($states as $state)
                                                    <option value="{{ $state->id }}">{{ $state->name }}</option>
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
                                                <option value="" disabled selected>--Select District--</option>
                                            </select>
                                            <x-error name="district_id" />
                                        </div>
                                    </div>

                                    <!-- Name-->
                                    <div class="form-group">
                                        <h5>Name <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="name" class="form-control">
                                            <x-error name="name" />
                                        </div>
                                    </div>


                                    <!-- Submit Button -->
                                    <div class="form-group">
                                        <input type="submit" value="Add New" class="btn btn-primary">
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
