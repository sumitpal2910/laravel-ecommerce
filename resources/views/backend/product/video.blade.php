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
                    <form action="">
                        <input type="hidden" name="product_id" id="product_id" value="{{$product->id}}">
                        <div class="pdropzone">
                            <input type="file" name="file" id="file" multiple>
                        </div>

                    </form>


                    <div class="row m-0 border-top border-bottom border-secondary bg-white">
                        <div class="col-md-9"></div>
                        <div class="col-md-3 mt-3 mb-3">
                            <button onclick="selectAll()" class="btn btn-success mr-3 "> Select All</button>
                            <button onclick="deleteAll({{$product->id}})" class="btn btn-danger ml-3 "> Delete</button>
                        </div>
                    </div>

                    <div id="gallery" class="row ml-0 mr-0 pt-5 gallery">
                        <!--for html check loadHtml() function in gallery.js-->
                    </div>
                </div>
            </div>

            <!-- /.row -->

    </section>
    <!-- /.content -->
</div>

<x-gallery-modal id="{{$product->id}}" />

@endsection
