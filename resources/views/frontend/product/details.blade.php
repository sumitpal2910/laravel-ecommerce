@extends('frontend.main_master')

@section('title', $product->name_en)


@section('content')
    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                    <li><a href="{{ route('index') }}">Home</a></li>
                    <li><a href="#">Clothing</a></li>
                    <li class='active'>{{ $product->name_en }}</li>
                </ul>
            </div><!-- /.breadcrumb-inner -->
        </div><!-- /.container -->
    </div><!-- /.breadcrumb -->
    <div class="body-content outer-top-xs">
        <div class='container'>
            <div class='row single-product'>
                <div class='col-md-3 sidebar'>
                    <div class="sidebar-module-container">
                        <div class="home-banner outer-top-n">
                            <img src="{{ asset('frontend/assets/images/banners/LHS-banner.jpg') }}" alt="Image">
                        </div>



                        <!-- ============================================== HOT DEALS ============================================== -->

                        <x-hot-deals class="outer-top-vs" />
                        <!-- ============================================== HOT DEALS: END ============================================== -->

                        <!-- ============================================== NEWSLETTER ============================================== -->
                        <div class="sidebar-widget newsletter wow fadeInUp outer-bottom-small outer-top-vs">
                            <h3 class="section-title">Newsletters</h3>
                            <div class="sidebar-widget-body outer-top-xs">
                                <p>Sign Up for Our Newsletter!</p>
                                <form>
                                    <div class="form-group">
                                        <label class="sr-only" for="exampleInputEmail1">Email address</label>
                                        <input type="email" class="form-control" id="exampleInputEmail1"
                                            placeholder="Subscribe to our newsletter">
                                    </div>
                                    <button class="btn btn-primary">Subscribe</button>
                                </form>
                            </div><!-- /.sidebar-widget-body -->
                        </div><!-- /.sidebar-widget -->
                        <!-- ============================================== NEWSLETTER: END ============================================== -->

                        <!-- ============================================== Testimonials============================================== -->
                        <x-sidebar-testimonial />

                        <!-- ============================================== Testimonials: END ============================================== -->



                    </div>
                </div><!-- /.sidebar -->
                <div class='col-md-9'>
                    <div class="detail-block">
                        <div class="row  wow fadeInUp">

                            <div class="col-xs-12 col-sm-6 col-md-5 gallery-holder">
                                <div class="product-item-holder size-big single-product-gallery small-gallery">

                                    <div id="owl-single-product">
                                        <div class="single-product-gallery-item" id="slide-{{ $product->id }}">
                                            <a data-lightbox="image-1" data-title="Gallery"
                                                href="{{ url($product->thumbnail) }}">
                                                <img class="img-responsive" alt="" src="{{ url($product->thumbnail) }}"
                                                    data-echo="{{ url($product->thumbnail) }}" />
                                            </a>
                                        </div><!-- /.single-product-gallery-item -->
                                        @foreach ($product->multiImg as $img)
                                            <div class="single-product-gallery-item" id="slide-{{ $img->id }}">
                                                <a data-lightbox="image-1" data-title="Gallery"
                                                    href="{{ url($img->photo_name) }}">
                                                    <img class="img-responsive" alt="" src="{{ url($img->photo_name) }}"
                                                        data-echo="{{ url($img->photo_name) }}" />
                                                </a>
                                            </div><!-- /.single-product-gallery-item -->
                                        @endforeach


                                    </div><!-- /.single-product-slider -->


                                    <div class="single-product-gallery-thumbs gallery-thumbs">

                                        <div id="owl-single-product-thumbnails">
                                            <div class="item">
                                                <a class="horizontal-thumb active" data-target="#owl-single-product"
                                                    data-slide="1" href="#slide-{{ $product->id }}">
                                                    <img class="img-responsive" width="85" alt=""
                                                        src="{{ url($product->thumbnail) }}"
                                                        data-echo="{{ url($product->thumbnail) }}" />
                                                </a>
                                            </div>
                                            @foreach ($product->multiImg as $img)
                                                <div class="item">
                                                    <a class="horizontal-thumb " data-target="#owl-single-product"
                                                        data-slide="1" href="#slide-{{ $img->id }}">
                                                        <img class="img-responsive" width="85" alt=""
                                                            src="{{ url($img->photo_name) }}"
                                                            data-echo="{{ url($img->photo_name) }}" />
                                                    </a>
                                                </div>
                                            @endforeach

                                        </div><!-- /#owl-single-product-thumbnails -->



                                    </div><!-- /.gallery-thumbs -->

                                </div><!-- /.single-product-gallery -->
                            </div><!-- /.gallery-holder -->
                            <div class='col-sm-6 col-md-7 product-info-block'>
                                <div class="product-info">
                                    <h1 class="name">
                                        <span id="pName">
                                            @if (session()->get('language') === 'hindi')
                                                {{ $product->name_hin }}
                                            @else
                                                {{ $product->name_en }}
                                            @endif
                                        </span>
                                    </h1>
                                    <div class="row">Code:
                                        <span id="pCode" class="text-muted">{{ $product->code }}</span>
                                    </div>
                                    <div class="rating-reviews m-t-20">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <div class="rating rateit-small"></div>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="reviews">
                                                    <a href="#" class="lnk">(13 Reviews)</a>
                                                </div>
                                            </div>
                                        </div><!-- /.row -->
                                    </div><!-- /.rating-reviews -->

                                    <div class="stock-container info-container m-t-10">
                                        <div class="row">
                                            <div class="col-sm-2">
                                                <div class="stock-box">
                                                    <span class="label">Availability :</span>
                                                </div>
                                            </div>
                                            <div class="col-sm-9">
                                                <div class="stock-box">
                                                    <span class="value">
                                                        @if ($product->qty > 0)
                                                            In Stock
                                                        @else
                                                            Out of Stock
                                                        @endif
                                                    </span>
                                                </div>
                                            </div>
                                        </div><!-- /.row -->
                                    </div><!-- /.stock-container -->

                                    <div class="description-container m-t-20">
                                        @if (session()->get('language') === 'hindi')
                                            {{ $product->short_descp_hin }}
                                        @else
                                            {{ $product->short_descp_en }}
                                        @endif
                                    </div><!-- /.description-container -->

                                    <div class="price-container info-container m-t-20">
                                        <div class="row">


                                            <div class="col-sm-6">
                                                <div class="price-box">
                                                    @if ($product->discount_price == 0 || !$product->discount_price)
                                                        <span
                                                            class="price">${{ $product->selling_price }}</span>
                                                    @else
                                                        <span
                                                            class="price">${{ $product->discount_price }}</span>
                                                        <span
                                                            class="price-strike">${{ $product->selling_price }}</span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="favorite-button m-t-10">
                                                    <a class="btn btn-primary" data-toggle="tooltip" data-placement="right"
                                                        title="Wishlist" href="#">
                                                        <i class="fa fa-heart"></i>
                                                    </a>
                                                    <a class="btn btn-primary" data-toggle="tooltip" data-placement="right"
                                                        title="Add to Compare" href="#">
                                                        <i class="fa fa-signal"></i>
                                                    </a>
                                                    <a class="btn btn-primary" data-toggle="tooltip" data-placement="right"
                                                        title="E-mail" href="#">
                                                        <i class="fa fa-envelope"></i>
                                                    </a>
                                                </div>
                                            </div>

                                        </div><!-- /.row -->
                                    </div><!-- /.price-container -->

                                    <!-- Product Size and Color -->
                                    <div class="row">

                                        <!-- Product Size -->
                                        <div class="col-sm-6">
                                            @if ($product->size_en && $product->size_hin)
                                                @php
                                                    $sizes = explode(',', $product->size_en);
                                                    if (session()->get('language') === 'hindi') {
                                                        $sizes = explode(',', $product->size_hin);
                                                    }
                                                @endphp
                                                <div class="form-group">
                                                    <label class="info-title control-label">Size </label>
                                                    <select class="form-control unicase-form-control selectpicker"
                                                        id="pSize">
                                                        <option selected disabled>--Select Size--</option>
                                                        @foreach ($sizes as $size)
                                                            <option value="{{ $size }}">{{ ucwords($size) }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            @endif
                                        </div>

                                        <div class="col-sm-6">
                                            @if ($product->color_en && $product->color_hin)
                                                @php
                                                    $colors = explode(',', $product->color_en);
                                                    if (session()->get('language') === 'hindi') {
                                                        $colors = explode(',', $product->color_hin);
                                                    }
                                                @endphp
                                                <div class="form-group">
                                                    <label class="info-title control-label">Color</label>
                                                    <select class="form-control unicase-form-control selectpicker"
                                                        id="pColor">
                                                        <option selected disabled>--Select Color--</option>
                                                        @foreach ($colors as $color)
                                                            <option value="{{ $color }}">{{ ucwords($color) }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            @endif
                                        </div>

                                    </div>
                                    <!-- Product Size and Color : End -->

                                    <div class="quantity-container info-container">
                                        <div class="row">

                                            <div class="col-sm-2">
                                                <span class="label">Qty :</span>
                                            </div>

                                            <div class="col-sm-2">
                                                <div class="cart-quantity">
                                                    <div class="quant-input">
                                                        {{-- <div class="arrows">
                                                            <div class="arrow plus gradient"><span class="ir"><i
                                                                        class="icon fa fa-sort-asc"></i></span></div>
                                                            <div class="arrow minus gradient"><span
                                                                    class="ir"><i
                                                                        class="icon fa fa-sort-desc"></i></span></div>
                                                        </div> --}}
                                                        <input type="number" id="pQty" min="1" value="1">
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="hidden" id="productId" value="{{ $product->id }}">
                                            <div class="col-sm-7">
                                                <button type="button" onclick="addToCart()" class="btn btn-primary"><i
                                                        class="fa fa-shopping-cart inner-right-vs"></i> ADD TO CART</button>
                                            </div>


                                        </div><!-- /.row -->
                                    </div><!-- /.quantity-container -->






                                </div><!-- /.product-info -->
                            </div><!-- /.col-sm-7 -->
                        </div><!-- /.row -->
                    </div>

                    <div class="product-tabs inner-bottom-xs  wow fadeInUp">
                        <div class="row">
                            <div class="col-sm-3">
                                <ul id="product-tabs" class="nav nav-tabs nav-tab-cell">
                                    <li class="active"><a data-toggle="tab" href="#description">DESCRIPTION</a>
                                    </li>
                                    <li><a data-toggle="tab" href="#review">REVIEW</a></li>
                                    <li><a data-toggle="tab" href="#tags">TAGS</a></li>
                                </ul><!-- /.nav-tabs #product-tabs -->
                            </div>
                            <div class="col-sm-9">

                                <div class="tab-content">

                                    <div id="description" class="tab-pane in active">
                                        <div class="product-tab">
                                            <p class="text">
                                                @if (session()->get('language') === 'hindi')
                                                    {!! $product->long_descp_hin !!}
                                                @else
                                                    {!! $product->long_descp_en !!}
                                                @endif
                                            </p>
                                        </div>
                                    </div><!-- /.tab-pane -->

                                    <div id="review" class="tab-pane">
                                        <div class="product-tab">

                                            <div class="product-reviews">
                                                <h4 class="title">Customer Reviews</h4>

                                                <div class="reviews">
                                                    @foreach ($product->review as $review)
                                                        <div class="review">
                                                            <div class="review-title">
                                                                <span
                                                                    class="summary">{{ $review->summary }}</span>
                                                                <br>
                                                                <span class="date">
                                                                    {{ $review->created_at->diffForHumans() }} by,
                                                                    <i><b>{{ $review->user->name }}</b></i>
                                                                </span>
                                                            </div>
                                                            <div class="text">"{{ $review->comment }}"</div>
                                                        </div>
                                                    @endforeach

                                                </div><!-- /.reviews -->
                                            </div><!-- /.product-reviews -->


                                            @auth
                                                <div class="product-add-review">
                                                    <h4 class="title">Write your own review</h4>
                                                    <div class="review-table">
                                                        <div class="table-responsive">
                                                            {{-- <table class="table">
                                                                <thead>
                                                                    <tr>
                                                                        <th class="cell-label">&nbsp;</th>
                                                                        <th>1 star</th>
                                                                        <th>2 stars</th>
                                                                        <th>3 stars</th>
                                                                        <th>4 stars</th>
                                                                        <th>5 stars</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td class="cell-label">Quality</td>
                                                                        <td>
                                                                            <input type="radio" name="quality"
                                                                                class="radio" value="1">
                                                                        </td>
                                                                        <td>
                                                                            <input type="radio" name="quality"
                                                                                class="radio" value="2">
                                                                        </td>
                                                                        <td>
                                                                            <input type="radio" name="quality"
                                                                                class="radio" value="3">
                                                                        </td>
                                                                        <td>
                                                                            <input type="radio" name="quality"
                                                                                class="radio" value="4">
                                                                        </td>
                                                                        <td>
                                                                            <input type="radio" name="quality"
                                                                                class="radio" value="5">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="cell-label">Price</td>
                                                                        <td>
                                                                            <input type="radio" name="price"
                                                                                class="radio" value="1">
                                                                        </td>
                                                                        <td>
                                                                            <input type="radio" name="price"
                                                                                class="radio" value="2">
                                                                        </td>
                                                                        <td>
                                                                            <input type="radio" name="price"
                                                                                class="radio" value="3">
                                                                        </td>
                                                                        <td>
                                                                            <input type="radio" name="price"
                                                                                class="radio" value="4">
                                                                        </td>
                                                                        <td>
                                                                            <input type="radio" name="price"
                                                                                class="radio" value="5">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="cell-label">Value</td>
                                                                        <td>
                                                                            <input type="radio" name="value"
                                                                                class="radio" value="1">
                                                                        </td>
                                                                        <td>
                                                                            <input type="radio" name="value"
                                                                                class="radio" value="2">
                                                                        </td>
                                                                        <td>
                                                                            <input type="radio" name="value"
                                                                                class="radio" value="3">
                                                                        </td>
                                                                        <td>
                                                                            <input type="radio" name="value"
                                                                                class="radio" value="4">
                                                                        </td>
                                                                        <td>
                                                                            <input type="radio" name="value"
                                                                                class="radio" value="5">
                                                                        </td>
                                                                    </tr>

                                                                </tbody>
                                                            </table><!-- /.table .table-bordered --> --}}
                                                        </div><!-- /.table-responsive -->
                                                    </div><!-- /.review-table -->

                                                    <div class="review-form">
                                                        <div class="form-container">
                                                            <form action="{{ route('review.store') }}" method="POST"
                                                                class="cnt-form">
                                                                @csrf
                                                                <input type="hidden" name="product_id"
                                                                    value="{{ $product->id }}">
                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label for="summary">Summary <span
                                                                                    class="astk">*</span></label>
                                                                            <input type="text" class="form-control txt"
                                                                                name="summary" id="summary"
                                                                                placeholder="Review Title" required>
                                                                        </div><!-- /.form-group -->
                                                                    </div>

                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="comment">Review <span
                                                                                    class="astk">*</span></label>
                                                                            <textarea class="form-control txt txt-review"
                                                                                name="comment" id="comment" rows="4"
                                                                                placeholder="Write your review"
                                                                                required></textarea>
                                                                        </div><!-- /.form-group -->
                                                                    </div>
                                                                </div><!-- /.row -->

                                                                <div class="action text-right">
                                                                    <button type="submit"
                                                                        class="btn btn-primary btn-upper">SUBMIT
                                                                        REVIEW</button>
                                                                </div><!-- /.action -->

                                                            </form><!-- /.cnt-form -->
                                                        </div><!-- /.form-container -->
                                                    </div><!-- /.review-form -->

                                                </div><!-- /.product-add-review -->
                                            @endauth
                                        </div><!-- /.product-tab -->
                                    </div><!-- /.tab-pane -->

                                    <div id="tags" class="tab-pane">
                                        <div class="product-tag">

                                            <h4 class="title">Product Tags</h4>
                                            <form role="form" class="form-inline form-cnt">
                                                <div class="form-container">

                                                    <div class="form-group">
                                                        <label for="exampleInputTag">Add Your Tags: </label>
                                                        <input type="email" id="exampleInputTag" class="form-control txt">


                                                    </div>

                                                    <button class="btn btn-upper btn-primary" type="submit">ADD
                                                        TAGS</button>
                                                </div><!-- /.form-container -->
                                            </form><!-- /.form-cnt -->

                                            <form role="form" class="form-inline form-cnt">
                                                <div class="form-group">
                                                    <label>&nbsp;</label>
                                                    <span class="text col-md-offset-3">Use spaces to separate tags. Use
                                                        single quotes (') for phrases.</span>
                                                </div>
                                            </form><!-- /.form-cnt -->

                                        </div><!-- /.product-tab -->
                                    </div><!-- /.tab-pane -->

                                </div><!-- /.tab-content -->
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.product-tabs -->

                    <!-- ============================================== RELATED PRODUCTS ============================================== -->
                    @if (count($relatedProducts) > 0)

                        <section class="section featured-product wow fadeInUp">
                            <h3 class="section-title">related products</h3>
                            <div
                                class="owl-carousel home-owl-carousel upsell-product custom-carousel owl-theme outer-top-xs">

                                <!-- Product Grid View Compnent -->
                                <x-product-grid-view :products="$relatedProducts" />


                            </div><!-- /.home-owl-carousel -->
                        </section><!-- /.section -->
                    @endif

                    <!-- ============================================== RELATED PRODUCTS : END ============================================== -->

                </div><!-- /.col -->
                <div class="clearfix"></div>
            </div><!-- /.row -->



            <!-- ==== ================== BRANDS CAROUSEL ============================================== -->
            @include('frontend.body.brands')


        </div><!-- /.container -->
    </div><!-- /.body-content -->

@endsection
