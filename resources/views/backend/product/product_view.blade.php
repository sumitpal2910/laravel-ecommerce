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
                        <h3 class="box-title"> Products
                            <x-badge :message="count($products)" />
                        </h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="productTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Discount</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="product-table">
                                    @foreach ($products as $item)
                                    <tr class="product-table-item">
                                        <input type="hidden" class="product-id" id="product-{{$item->id}}"
                                            value="{{$item->id}}">
                                        <td><img src="{{ url($item->thumbnail) }}" alt="" style="width: 40px;">
                                        </td>
                                        <td>{{ substr($item->name_en, 0, 30) }}..</td>
                                        @php
                                        $stockQty =0;
                                        @endphp

                                        @foreach ($item->stocks as $stock)
                                        @if ($stock->type == 1)
                                        @php
                                        $stockQty += $stock->qty;
                                        @endphp
                                        @else
                                        @php
                                        $stockQty -= $stock->qty;
                                        @endphp

                                        @endif
                                        @endforeach
                                        <td>{{$stockQty < 0 ? 0 : $stockQty}} pices</td>
                                        <td>&#36;{{ $item->selling_price }}</td>
                                        <!-- Discount Price -->
                                        <td>
                                            @if ($item->discount_price)
                                            @php
                                            $sellPrice = $item->selling_price;
                                            $amt = $sellPrice - $item->discount_price;
                                            $percent = round(($amt / $sellPrice) * 100) . '%';
                                            $amt = '$' . $amt;
                                            @endphp
                                            <x-badge class="info" :message="$percent" />
                                            <x-badge class="primary" :message="$amt" />
                                            @else
                                            <x-badge class="danger" message="No Discount" />
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->status)
                                            <x-badge message="Active" />
                                            @else
                                            <x-badge message="Inactive" class="danger" />
                                            @endif
                                        </td>
                                        <td>
                                            <div class="dropdown float-right">
                                                <a style="border-radius: 50%"
                                                    class="btn btn-sm btn-outline-secondary dropdown-toggle"
                                                    type="button" id="dropdownMenuButton" data-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">
                                                    <i class="fa fa-ellipsis-v"> </i>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <!--Edit-->
                                                    <a href="{{ route('product.edit', $item->id) }}" title="Edit Data"
                                                        class="btn btn-sm btn-info dropdown-item"> <i
                                                            class="fa fa-pencil"></i>
                                                        Edit
                                                    </a>

                                                    <!--Manage Stock-->
                                                    <a pname="{{$item->name_en}}" pid="{{$item->id}}"
                                                        data-toggle="modal" data-target="#manageStock" type="button"
                                                        class="btn btn-sm btn-primary ml-2 manageStock dropdown-item"><i
                                                            class="fa fa-cart-plus"></i> Manage Stock
                                                    </a>

                                                    <!--Gallery-->
                                                    <a href="{{ route('product.gallery.index', $item->id) }}"
                                                        title="Gallery"
                                                        class="btn btn-sm btn-success ml-2 dropdown-item">
                                                        <i class="fa fa-file-image-o"></i> Gallery
                                                    </a>

                                                    <!--delete-->
                                                    <a href="{{ route('product.delete', $item->id) }}"
                                                        title="Delete Data"
                                                        class="btn btn-sm btn-danger ml-2 dropdown-item" id="delete"> <i
                                                            class="fa fa-trash"></i> Delete
                                                    </a>
                                                    <form id="deleteForm"
                                                        action="{{ route('product.delete', $item->id) }}" method="post"
                                                        style="display: none;">
                                                        @method("DELETE")
                                                        @csrf
                                                    </form>

                                                    @if ($item->status)
                                                    <a href="{{ route('product.updateStatus', $item->id) }}"
                                                        title=" Inactive"
                                                        class="btn btn-sm btn-warning ml-2 dropdown-item" id="">
                                                        <i class="fa fa-arrow-down"></i> Change Status
                                                    </a>
                                                    @else
                                                    <a href="{{ route('product.updateStatus', $item->id) }}"
                                                        title="Active Data"
                                                        class="btn btn-sm btn-success ml-2 dropdown-item">
                                                        <i class="fa fa-arrow-up"></i> Change Status
                                                    </a>
                                                    @endif
                                                </div>
                                            </div>


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


<!--Modal Add Stock-->
<div class="modal fade" id="manageStock" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel"> Manage Stock "<span id="productName"></span>"</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form action="{{route('admin.stock.store')}}" method="post">
                @csrf
                <input type="hidden" name="product_id" id="product_id">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Quantity</label>
                                <input required type="number" min="0" name="qty" class="form-control">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Type</label>
                                <select required class="form-control" name="type" id="">
                                    <option selected disabled>--Select Type--</option>
                                    <option value="1">In</option>
                                    <option value="0">Out</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary float-right" type="submit">Submit</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!--Modal Add Stock: End-->
@endsection
