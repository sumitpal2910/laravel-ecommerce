@forelse ($products as $product)

    <div class="{{ $class ?? 'item item-carousel' }}">
        <div class="products">
            <div class="product">
                <div class="product-image">
                    <div class="image"> <a
                            href="{{ route('product.details', ['id' => $product->id, 'slug' => $product->slug_en]) }}"><img
                                src="{{ url($product->thumbnail) }}" alt=""></a> </div>
                    <!-- /.image -->

                    @php
                        $amt = $product->selling_price - $product->discount_price;
                        $discount = round(($amt / $product->selling_price) * 100);
                    @endphp

                    @if ($product->discount_price == 0 || !$product->discount_price)
                        <div class="tag new"><span>new</span></div>
                    @else
                        <div class="tag hot">
                            <span>{{ $discount }}%</span>
                        </div>
                    @endif
                </div>
                <!-- /.product-image -->

                <div class="product-info text-left">
                    <h3 class="name"><a
                            href="{{ route('product.details', ['id' => $product->id, 'slug' => $product->slug_en]) }}">
                            @if (session()->get('language') === 'hindi')
                                {{ $product->name_hin }}
                            @else
                                {{ $product->name_en }}
                            @endif
                        </a></h3>
                    <div class="rating rateit-small"></div>
                    <div class="description"></div>
                    <div class="product-price">
                        @if ($product->discount_price > 0 )
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
                        <ul class="list-unstyled">
                            <li class="add-cart-button btn-group">
                                <button class="btn btn-primary icon" title="Add to Cart" data-toggle="modal"
                                    data-target="#modalViewProduct" id="{{ $product->id }}"
                                    onclick="viewProduct(this.id)" type="button">
                                    <i class="fa fa-shopping-cart"></i>
                                </button>
                                <button class="btn btn-primary cart-btn" type="button">Add to
                                    cart</button>
                            </li>
                            <li class="wishlist add-cart-button">
                                <button class="btn btn-primary" id="{{ $product->id }}"
                                    onclick="addToWishList(this.id)" title="Wishlist">
                                    <i class="icon fa fa-heart"></i>
                                </button>
                            </li>

                            <li class="lnk"> <a class="add-to-cart" href="detail.html" title="Compare"> <i
                                        class="fa fa-signal" aria-hidden="true"></i> </a>
                            </li>
                        </ul>
                    </div>
                    <!-- /.action -->
                </div>
                <!-- /.cart -->
            </div>
            <!-- /.product -->

        </div>
        <!-- /.products -->
    </div>
    <!-- /.item -->
@empty
    <h5 class="text-danger">No Product Found</h5>
@endforelse
