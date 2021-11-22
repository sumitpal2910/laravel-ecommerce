@php
$products = App\Models\Product::where('status', 1)
    ->where('hot_deals', 1)
    ->orderBy('id', 'desc')
    ->limit(3)
    ->get();

@endphp
    <div class="sidebar-widget hot-deals wow fadeInUp {{ $class ? $class : 'outer-bottom-xs' }}">
        <h3 class="section-title">hot deals</h3>
        <div class="owl-carousel sidebar-carousel custom-carousel owl-theme outer-top-ss">
            @foreach ($products as $product)


                <div class="item">
                    <div class="products">
                        <div class="hot-deal-wrapper">
                            <div class="image"> <a
                                    href="{{ route('product.details', ['id' => $product->id, 'slug' => $product->slug_en]) }}">
                                    <img src="{{ url($product->thumbnail) }}" alt="">
                                </a>
                            </div>
                            @php
                                $amt = $product->selling_price - $product->discount_price;
                                $discount = round(($amt / $product->selling_price) * 100);
                            @endphp
                            @if ($product->discount_price > 0)
                                <div class="sale-offer-tag">
                                    <span>{{ $discount }}%<br> off </span>
                                </div>
                            @endif
                            <div class="timing-wrapper">
                                <div class="box-wrapper">
                                    <div class="date box"> <span class="key">120</span>
                                        <span class="value">DAYS</span>
                                    </div>
                                </div>
                                <div class="box-wrapper">
                                    <div class="hour box"> <span class="key">20</span>
                                        <span class="value">HRS</span>
                                    </div>
                                </div>
                                <div class="box-wrapper">
                                    <div class="minutes box"> <span class="key">36</span>
                                        <span class="value">MINS</span>
                                    </div>
                                </div>
                                <div class="box-wrapper hidden-md">
                                    <div class="seconds box"> <span class="key">60</span>
                                        <span class="value">SEC</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.hot-deal-wrapper -->

                        <div class="product-info text-left m-t-20">
                            <h3 class="name"><a
                                    href="{{ route('product.details', ['id' => $product->id, 'slug' => $product->slug_en]) }}">
                                    @if (session()->get('language') === 'hindi')
                                        {{ $product->name_hin }}
                                    @else
                                        {{ $product->name_en }}
                                    @endif
                                </a></h3>
                            <div class="rating rateit-small"></div>
                            <div class="product-price">
                                @if ($product->discount_price)
                                    <span class="price">
                                        ${{ $product->discount_price }} </span>
                                    <span class="price-before-discount">
                                        ${{ $product->selling_price }}</span>
                                @else
                                    <span class="price">
                                        ${{ $product->selling_price }} </span>
                                @endif
                            </div>
                            <!-- /.product-price -->

                        </div>
                        <!-- /.product-info -->

                        <div class="cart clearfix animate-effect">
                            <div class="action">
                                <div class="add-cart-button btn-group">
                                    {{-- <button class="btn btn-primary icon" type="button">
                                    <i class="fa fa-shopping-cart"></i>
                                </button> --}}
                                    <button class="btn btn-primary cart-btn" type="button">
                                        <i class="fa fa-shopping-cart"></i> &nbsp;
                                        Add to cart</button>
                                </div>
                            </div>
                            <!-- /.action -->
                        </div>
                        <!-- /.cart -->
                    </div>
                </div>
            @endforeach
        </div>
        <!-- /.sidebar-widget -->
    </div>
