<header class="header-style-1">


    <!-- ============================================== TOP MENU ============================================== -->
    <div class="top-bar animate-dropdown">
        <div class="container">
            <div class="header-top-inner">
                <div class="cnt-account">
                    <ul class="list-unstyled">
                        <li>
                            <a href="#"><i class="icon fa fa-user"></i>
                                @if (session()->get('language') === 'hindi') मेरी प्रोफाइल @else My Account @endif
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('wishlist.index') }}"><i class="icon fa fa-heart"></i>
                                @if (session()->get('language') === 'hindi') इच्छा-सूची @else Wishlist @endif
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('cart.index') }}"><i class="icon fa fa-shopping-cart"></i>
                                @if (session()->get('language') === 'hindi') मेरी गाड़ी @else My Cart @endif
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('checkout.index') }}"><i class="icon fa fa-check"></i>
                                @if (session()->get('language') === 'hindi') चेक आउट @else Checkout @endif
                            </a>
                        </li>
                        @guest
                            <li>
                                <a href="{{ route('login') }}"><i class="icon fa fa-lock"></i>
                                    @if (session()->get('language') === 'hindi') लॉग इन/रजिस्टर @else  Login/Register @endif
                                </a>
                            </li>
                        @else
                            <li>
                                <a href="{{ route('dashboard') }}"><i class="icon fa fa-user"></i>
                                    {{ Auth::user()->name }}
                                </a>
                            </li>
                        @endguest
                    </ul>
                </div>
                <!-- /.cnt-account -->

                <div class="cnt-block">
                    <ul class="list-unstyled list-inline">
                        <li class="dropdown dropdown-small"> <a href="#" class="dropdown-toggle" data-hover="dropdown"
                                data-toggle="dropdown"><span class="value">USD
                                </span><b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">USD</a></li>
                                <li><a href="#">INR</a></li>
                                <li><a href="#">GBP</a></li>
                            </ul>
                        </li>
                        <li class="dropdown dropdown-small"> <a href="#" class="dropdown-toggle" data-hover="dropdown"
                                data-toggle="dropdown"><span class="value">
                                    @if (session()->get('language') === 'hindi') भाषा: हिंदी @else Language @endif
                                </span><b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                @if (session()->get('language') === 'hindi')
                                    <li><a href="{{ route('language.english') }}">English</a></li>
                                @else
                                    <li><a href="{{ route('language.hindi') }}">हिंदी</a> </li>
                                @endif
                            </ul>
                        </li>
                    </ul>
                    <!-- /.list-unstyled -->
                </div>
                <!-- /.cnt-cart -->
                <div class="clearfix"></div>
            </div>
            <!-- /.header-top-inner -->
        </div>
        <!-- /.container -->
    </div>
    <!-- /.header-top -->
    <!-- ============================================== TOP MENU : END ============================================== -->
    @php
        $setting = App\Models\SiteSetting::find(1);
    @endphp
    <div class="main-header">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-3 logo-holder">
                    <!-- ============================================================= LOGO ============================================================= -->
                    <div class="logo"> <a href="{{ route('index') }}">
                            <img src="{{ asset($setting->logo) }}" alt="logo">
                        </a> </div>
                    <!-- /.logo -->
                    <!-- ============================================================= LOGO : END ============================================================= -->
                </div>
                <!-- /.logo-holder -->

                <div class="col-xs-12 col-sm-12 col-md-7 top-search-holder">
                    <!-- /.contact-row -->
                    <!-- ============================================================= SEARCH AREA ============================================================= -->
                    <div class="search-area">
                        <form>
                            <div class="control-group">
                                <ul class="categories-filter animate-dropdown">
                                    <li class="dropdown"> <a class="dropdown-toggle" data-toggle="dropdown"
                                            href="category.html">Categories <b class="caret"></b></a>
                                        <ul class="dropdown-menu" role="menu">
                                            <li class="menu-header">Computer</li>
                                            <li role="presentation"><a role="menuitem" tabindex="-1"
                                                    href="category.html">- Clothing</a></li>
                                            <li role="presentation"><a role="menuitem" tabindex="-1"
                                                    href="category.html">- Electronics</a></li>
                                            <li role="presentation"><a role="menuitem" tabindex="-1"
                                                    href="category.html">- Shoes</a></li>
                                            <li role="presentation"><a role="menuitem" tabindex="-1"
                                                    href="category.html">- Watches</a></li>
                                        </ul>
                                    </li>
                                </ul>
                                <input class="search-field" placeholder="Search here..." />
                                <a class="search-button" href="#"></a>
                            </div>
                        </form>
                    </div>
                    <!-- /.search-area -->
                    <!-- ============================================================= SEARCH AREA : END ============================================================= -->
                </div>
                <!-- /.top-search-holder -->

                <div class="col-xs-12 col-sm-12 col-md-2 animate-dropdown top-cart-row">
                    <!-- ============================================================= SHOPPING CART DROPDOWN ============================================================= -->

                    <div class="dropdown dropdown-cart"> <a href="#" class="dropdown-toggle lnk-cart"
                            data-toggle="dropdown">
                            <div class="items-cart-inner">
                                <div class="basket"> <i class="glyphicon glyphicon-shopping-cart"></i>
                                </div>
                                <div class="basket-item-count">
                                    <span class="count" id="miniCartQty">0</span>
                                </div>
                                <div class="total-price-basket">
                                    <span class="lbl">cart -</span>
                                    <span class="total-price">
                                        <span class="sign">$</span><span class="value"
                                            id="miniCartTotal">0</span>
                                    </span>
                                </div>
                            </div>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <div id="miniCart"></div>

                                <hr>
                                <div class="clearfix cart-total">
                                    <div class="pull-right"> <span class="text">Sub Total
                                            :</span><span class='price'>$ <span id="miniCartSubTotal">00.00</span>
                                        </span> </div>
                                    <div class="clearfix"></div>
                                    <a href="{{ route('checkout.index') }}"
                                        class="btn btn-upper btn-primary btn-block m-t-20">Checkout</a>
                                </div>
                                <!-- /.cart-total-->

                            </li>
                        </ul>
                        <!-- /.dropdown-menu-->
                    </div>
                    <!-- /.dropdown-cart -->

                    <!-- ============================================================= SHOPPING CART DROPDOWN : END============================================================= -->
                </div>
                <!-- /.top-cart-row -->
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container -->

    </div>
    <!-- /.main-header -->

    <!-- ============================================== NAVBAR ============================================== -->
    <div class="header-nav animate-dropdown">
        <div class="container">
            <div class="yamm navbar navbar-default" role="navigation">
                <div class="navbar-header">
                    <button data-target="#mc-horizontal-menu-collapse" data-toggle="collapse"
                        class="navbar-toggle collapsed" type="button">
                        <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span>
                        <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                </div>

                <!-- Get all category, sub category and sub sub category-->
                @php
                    $categories = App\Models\Category::with(['subCategory', 'subCategory.subSubCategory'])
                        ->orderBy('name_en', 'asc')
                        ->get();
                @endphp

                <div class="nav-bg-class">
                    <div class="navbar-collapse collapse" id="mc-horizontal-menu-collapse">
                        <div class="nav-outer">
                            <ul class="nav navbar-nav">
                                <li class="active dropdown yamm-fw"> <a href="{{ route('index') }}"
                                        data-hover="dropdown" class="dropdown-toggle" data-toggle="dropdown">
                                        @if (session()->get('language') === 'hindi')घर @else Home @endif
                                    </a>
                                </li>

                                <!-- Categories-->
                                @foreach ($categories as $category)

                                    <li class="dropdown yamm mega-menu"> <a href="{{ route('index') }}"
                                            data-hover="dropdown" class="dropdown-toggle" data-toggle="dropdown">
                                            @if (session()->get('language') === 'hindi')
                                                {{ $category->name_hin }}
                                            @else
                                                {{ $category->name_en }}
                                            @endif
                                        </a>
                                        <ul class="dropdown-menu container">
                                            <li>
                                                <div class="yamm-content ">
                                                    <div class="row">

                                                        <!-- Sub Categories-->
                                                        @foreach ($category->subCategory as $subCategory)

                                                            <div class="col-xs-12 col-sm-6 col-md-2 col-menu">
                                                                <h2 class="title">
                                                                    <a
                                                                        href="{{ route('product.subCategory', ['subcat' => $subCategory->id, 'slug' => $subCategory->slug_en]) }}">
                                                                        @if (session()->get('language') === 'hindi')
                                                                            {{ $subCategory->name_hin }}
                                                                        @else
                                                                            {{ $subCategory->name_en }}
                                                                        @endif
                                                                    </a>
                                                                </h2>
                                                                <ul class="links">

                                                                    <!-- Sub Sub Categories-->
                                                                    @foreach ($subCategory->subSubCategory as $subSub)

                                                                        <li> <a
                                                                                href="{{ route('product.subSubCategory', ['sub_subcat' => $subSub->id, 'slug' => $subSub->slug_en]) }}">
                                                                                @if (session()->get('language') === 'hindi')
                                                                                    {{ $subSub->name_hin }}
                                                                                @else
                                                                                    {{ $subSub->name_en }}
                                                                                @endif
                                                                            </a>
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                            <!-- /.col -->
                                                        @endforeach

                                                        <div class="col-xs-12 col-sm-6 col-md-4 col-menu banner-image">
                                                            <img class="img-responsive"
                                                                src="{{ asset('frontend/assets/images/banners/top-menu-banner.jpg') }}"
                                                                alt="">
                                                        </div>
                                                        <!-- /.yamm-content -->
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                @endforeach


                                <li class="dropdown  navbar-right special-menu"> <a href="#">Todays offer</a> </li>
                                <li class="dropdown  navbar-right special-menu"> <a
                                        href="{{ route('blog.index') }}">Blog</a> </li>
                            </ul>
                            <!-- /.navbar-nav -->
                            <div class="clearfix"></div>
                        </div>
                        <!-- /.nav-outer -->
                    </div>
                    <!-- /.navbar-collapse -->

                </div>
                <!-- /.nav-bg-class -->
            </div>
            <!-- /.navbar-default -->
        </div>
        <!-- /.container-class -->

    </div>
    <!-- /.header-nav -->
    <!-- ============================================== NAVBAR : END ============================================== -->

</header>
