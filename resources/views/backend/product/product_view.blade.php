@extends('admin.admin_master')
@section('title', 'All Products')

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

                <!-- ------------ VIEW ALL PRODUCTS ------------------------ -->
                <div class="col-12">

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">All Products</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="viewAllBrands" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>Product English</th>
                                            <th>Product Hindi</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Discount</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $item)
                                            <tr>
                                                <td><img src="{{ url($item->thumbnail) }}" alt="" style="width: 40px;">
                                                </td>
                                                <td>{{ $item->name_en }}</td>
                                                <td>{{ $item->name_hin }}</td>
                                                <td>{{ $item->qty }} pics</td>
                                                <td>&#36;{{ $item->selling_price }}</td>
                                                <!-- Discount Price -->
                                                <td>
                                                    @if ($item->discount_price)
                                                        @php
                                                            $sellPrice = $item->selling_price;
                                                            $amt = $sellPrice - $item->discount_price;
                                                            $precent = round(($amt / $sellPrice) * 100);
                                                        @endphp
                                                        <span
                                                            class="badge badge-pill badge-info">{{ $precent }}%</span>
                                                        <br>
                                                        <span
                                                            class='badge badge-pill badge-primary badge-sm'>&#36;{{ $amt }}</span>
                                                    @else
                                                        <span class="badge badge-pill badge-danger">No Discount</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($item->status)
                                                        <span class="badge badge-pill badge-success">Active</span>
                                                    @else
                                                        <span class="badge badge-pill badge-danger">Inactive</span>
                                                    @endif
                                                </td>
                                                <td width="20%">
                                                    <a href="{{ route('product.edit', $item->id) }}" title="Edit Data"
                                                        class="btn btn-info"> <i class="fa fa-pencil"></i> </a>
                                                    <a href="{{ route('product.delete', $item->id) }}" title="Delete Data"
                                                        class="btn btn-danger ml-2" id="delete"> <i
                                                            class="fa fa-trash"></i>
                                                    </a>
                                                    <form id="deleteForm"
                                                        action="{{ route('product.delete', $item->id) }}" method="post"
                                                        style="display: none;">
                                                        @method("DELETE")
                                                        @csrf
                                                    </form>

                                                    @if ($item->status)
                                                        <a href="{{ route('product.updateStatus', $item->id) }}"
                                                            title=" Inactive" class="btn btn-warning ml-2" id="">
                                                            <i class="fa fa-arrow-down"></i>
                                                        </a>
                                                    @else
                                                        <a href="{{ route('product.updateStatus', $item->id) }}"
                                                            title="Active Data" class="btn btn-success ml-2">
                                                            <i class="fa fa-arrow-up"></i>
                                                        </a>
                                                    @endif
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



        </section>
        <!-- /.content -->

    </div>
@endsection
