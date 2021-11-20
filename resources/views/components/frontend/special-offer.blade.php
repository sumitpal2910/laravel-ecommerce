    <div class="sidebar-widget outer-bottom-small wow fadeInUp">
        <h3 class="section-title">{{ $title }}</h3>
        <div class="sidebar-widget-body outer-top-xs">
            <div class="owl-carousel sidebar-carousel special-offer custom-carousel owl-theme outer-top-xs">
                @php
                    $count = 0;
                    $len = count($products) / 3;
                @endphp

                @for ($i = 0; $i < $len; $i++)
                    <div class="item">
                        <div class="products special-product">

                            @for ($j = 0; $j < 3; $j++)
                                @php
                                    # break the loop
                                    if (count($products) <= $count) {
                                        break;
                                    }
                                    
                                    $product = $products[$count];
                                @endphp
                                <div class="product">
                                    <div class="product-micro">
                                        <div class="row product-micro-row">
                                            <div class="col-5 col-xs-5">
                                                <div class="product-image">
                                                    <div class="image"> <a
                                                            href="{{ route('product.details', ['id' => $product->id, 'slug' => $product->slug_en]) }}">
                                                            <img src="{{ url($product->thumbnail) }}" alt="">
                                                        </a> </div>
                                                    <!-- /.image -->

                                                </div>
                                                <!-- /.product-image -->
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-7 col-xs-7">
                                                <div class="product-info">
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
                                                        <span class="price">${{ $product->selling_price }}
                                                        </span>
                                                    </div>
                                                    <!-- /.product-price -->

                                                </div>
                                            </div>
                                            <!-- /.col -->
                                        </div>
                                        <!-- /.product-micro-row -->
                                    </div>
                                    <!-- /.product-micro -->

                                </div>
                                @php
                                    $count++;
                                @endphp
                            @endfor
                        </div>
                    </div>
                @endfor


            </div>
        </div>
        <!-- /.sidebar-widget-body -->
    </div>
