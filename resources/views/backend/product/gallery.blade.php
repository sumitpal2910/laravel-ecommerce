@extends('admin.admin_master')


@section('title', $product->name_en)

@section('content')

<div class="container-full">
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box bt-3 border-info">
                    <div class="box-header">
                        <h4 class="box-title">Image <strong> "{{$product->name_en}}" </strong></h4>
                        <x-gallery-link id="{{$product->id}}" />
                    </div>
                    <form id="formImgFileAdd" action="">
                        <input type="hidden" name="product_id" id="product_id" value="{{$product->id}}">
                        <div class="pdropzone">
                            <input type="file" name="file" id="file" multiple>
                        </div>

                    </form>


                </div>

                <!--Images Box-->
                <div class="box border-info">
                    <div class="box-header row">
                        <div class="col-4">
                            <h3>Images</h3>
                        </div>
                        <div class="col-8">
                            <button target="#images" onclick="selectAll(event)" class="btn btn-success mr-3 ">
                                Select All</button>
                            <button target="#images" product-id="{{$product->id}}" onclick="deleteAll(event)"
                                class="btn btn-danger ml-3 "> Delete</button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="row images" id="images"></div>
                    </div>
                </div>

                <!--Videos Box-->
                <div class="box border-info">
                    <div class="box-header row">
                        <div class="col-4">
                            <h3>Videos</h3>
                        </div>
                        <div class="col-md-8">
                            <button target="#videos" onclick="selectAll(event)" class="btn btn-success mr-3 "> Select
                                All</button>
                            <button target="#videos" product-id="{{$product->id}}" onclick="deleteAll(event)"
                                class="btn btn-danger ml-3 "> Delete</button>
                        </div>

                    </div>
                    <div class="box-body">
                        <div class="row videos" id="videos"></div>
                    </div>
                </div>
            </div>

            <!-- /.row -->

    </section>
    <!-- /.content -->
</div>

<x-gallery-modal id="{{$product->id}}" />

@endsection
