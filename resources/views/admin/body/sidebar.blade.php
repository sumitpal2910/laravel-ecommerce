@php
$prefix = Request::route()->getPrefix();
$route = Route::current()->getName();
@endphp

<aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar">

        <div class="user-profile">
            <div class="ulogo">
                <a href="{{ route('admin.dashboard') }}">
                    <!-- logo for regular state and mobile devices -->
                    <div class="d-flex align-items-center justify-content-center">
                        <img src="{{ asset('backend/images/logo-dark.png') }}" alt="">
                        <h3><b>Laravel</b> Ecommerce</h3>
                    </div>
                </a>
            </div>
        </div>

        <!-- sidebar menu-->
        <ul class="sidebar-menu" data-widget="tree" id="sidebar-menu">


            <!-- dashboard -->
            <li class="{{ $route === 'admin.dashboard' ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard') }}">
                    <i data-feather="pie-chart"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <!-- brands -->
            <li class="treeview {{ $prefix === '/brand' ? 'active' : '' }}">
                <a href="#">
                    <i class="fa fa-tags"></i>
                    <span>Brand</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $route === 'all.brand' ? 'active' : '' }}"><a href="{{ route('all.brand') }}"><i
                                class="ti-more"></i>All Brands</a></li>
                </ul>
            </li>

            <!-- Category -->
            <li class="treeview {{ $prefix === '/category' ? 'active' : '' }}">
                <a href="#">
                    <i class="fa fa-th"></i>
                    <span>Category</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $route === 'all.category' ? 'active' : '' }}">
                        <a href="{{ route('all.category') }}"><i class="ti-more"></i>All Categories</a>
                    </li>
                    <li class="{{ $route === 'all.subcategory' ? 'active' : '' }}">
                        <a href="{{ route('all.subcategory') }}">
                            <i class="ti-more"></i>All Sub Categories</a>
                    </li>
                    <li class="{{ $route === 'all.subSubCategory' ? 'active' : '' }}">
                        <a href="{{ route('all.subSubCategory') }}">
                            <i class="ti-more"></i>All Sub->Sub Categories</a>
                    </li>
                </ul>
            </li>

            <!-- Products -->
            <li class="treeview {{ $prefix === '/product' ? 'active' : '' }}">
                <a href="#">
                    <i class="fa fa-dropbox"></i>
                    <span>Product</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $route === 'product.add' ? 'active' : '' }}">
                        <a href="{{ route('product.add') }}">
                            <i class="ti-more"></i>Add Product</a>
                    </li>
                    <li class="{{ $route === 'all.product' ? 'active' : '' }}">
                        <a href="{{ route('all.product') }}"><i class="ti-more"></i>Manage Product</a>
                    </li>
                </ul>
            </li>

            <!-- Slider -->
            <li class="treeview {{ $prefix === '/slider' ? 'active' : '' }}">
                <a href="#">
                    <i class="fa fa-sliders"></i>
                    <span>Slider</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $route === 'all.slider' ? 'active' : '' }}">
                        <a href="{{ route('all.slider') }}"><i class="ti-more"></i>Manage Slider</a>
                    </li>

                </ul>
            </li>

            <!-- Coupon -->
            <li class="treeview {{ $prefix === '/coupon' ? 'active' : '' }}">
                <a href="#">
                    <i class="fa fa-tag"></i>
                    <span>Coupon</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $route === 'coupon.index' ? 'active' : '' }}">
                        <a href="{{ route('coupon.index') }}"><i class="ti-more"></i>Manage Coupon</a>
                    </li>

                </ul>
            </li>

            <!-- Shipping Area -->
            <li class="treeview {{ $prefix === '/shipping' ? 'active' : '' }}">
                <a href="#">
                    <i class="fa fa-tag"></i>
                    <span>Shipping Area</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $route === 'ship.state.index' ? 'active' : '' }}">
                        <a href="{{ route('ship.state.index') }}"><i class="ti-more"></i>Ship State</a>
                    </li>

                    <li class="{{ $route === 'ship.dist.index' ? 'active' : '' }}">
                        <a href="{{ route('ship.dist.index') }}"><i class="ti-more"></i>Ship District</a>
                    </li>
                </ul>
            </li>

<<<<<<< HEAD
            <!-- Shipping Area -->
            <li class="treeview {{ $prefix === '/order' ? 'active' : '' }}">
                <a href="#">
                    <i class="fa fa-tag"></i>
                    <span>Orders</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $route === 'order.pending' ? 'active' : '' }}">
                        <a href="{{ route('order.pending') }}"><i class="ti-more"></i>Pending Order</a>
                    </li>
                    <li class="{{ $route === 'order.confirmed' ? 'active' : '' }}">
                        <a href="{{ route('order.confirmed') }}"><i class="ti-more"></i>Confirmed Order</a>
                    </li>
                    <li class="{{ $route === 'order.processing' ? 'active' : '' }}">
                        <a href="{{ route('order.processing') }}"><i class="ti-more"></i>Processing Order</a>
                    </li>
                    <li class="{{ $route === 'order.picked' ? 'active' : '' }}">
                        <a href="{{ route('order.picked') }}"><i class="ti-more"></i>Picked Order</a>
                    </li>

                </ul>
            </li>


            <li class="header nav-small-cap">User Interface</li>

            <li class="treeview">
=======
            <!-- Orders -->
            <li class="treeview {{ $prefix === '/order' ? 'active' : '' }}">
>>>>>>> 554f03b3f5d3736d4c17543c52f74ceb4331dd3d
                <a href="#">
                    <i class="fa fa-tag"></i>
                    <span>Orders</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $route === 'order.pending' ? 'active' : '' }}">
                        <a href="{{ route('order.pending') }}"><i class="ti-more"></i>Pending Order</a>
                    </li>
                    <li class="{{ $route === 'order.confirmed' ? 'active' : '' }}">
                        <a href="{{ route('order.confirmed') }}"><i class="ti-more"></i>Confirmed Order</a>
                    </li>
                    <li class="{{ $route === 'order.processing' ? 'active' : '' }}">
                        <a href="{{ route('order.processing') }}"><i class="ti-more"></i>Processing Order</a>
                    </li>
                    <li class="{{ $route === 'order.picked' ? 'active' : '' }}">
                        <a href="{{ route('order.picked') }}"><i class="ti-more"></i>Picked Order</a>
                    </li>
                    <li class="{{ $route === 'order.shipped' ? 'active' : '' }}">
                        <a href="{{ route('order.shipped') }}"><i class="ti-more"></i>Shipped Order</a>
                    </li>
                    <li class="{{ $route === 'order.delivered' ? 'active' : '' }}">
                        <a href="{{ route('order.delivered') }}"><i class="ti-more"></i>Delivered Order</a>
                    </li>
                    <li class="{{ $route === 'order.cancel' ? 'active' : '' }}">
                        <a href="{{ route('order.cancel') }}"><i class="ti-more"></i>Cancel Order</a>
                    </li>

                </ul>
            </li>

            <!-- Orders -->
            <li class="treeview {{ $prefix === '/admin/return' ? 'active' : '' }}">
                <a href="#">
                    <i class="fa fa-tag"></i>
                    <span>Return</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $route === 'admin.return.request' ? 'active' : '' }}">
                        <a href="{{ route('admin.return.request') }}"><i class="ti-more"></i>Return
                            Request</a>
                    </li>
                    <li class="{{ $route === 'admin.return.index' ? 'active' : '' }}">
                        <a href="{{ route('admin.return.index') }}"><i class="ti-more"></i>All Request</a>
                    </li>
                </ul>
            </li>

            <!-- Reports -->
            <li class="treeview {{ $prefix === '/report' ? 'active' : '' }}">
                <a href="#">
                    <i class="fa fa-tag"></i>
                    <span>Reports</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $route === 'report.index' ? 'active' : '' }}">
                        <a href="{{ route('report.index') }}"><i class="ti-more"></i>All Report</a>
                    </li>
                </ul>
            </li>

            <!-- Users -->
            <li class="treeview {{ $prefix === '/admin/users' ? 'active' : '' }}">
                <a href="#">
                    <i class="fa fa-tag"></i>
                    <span>All Users</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $route === 'admin.users' ? 'active' : '' }}">
                        <a href="{{ route('admin.users') }}"><i class="ti-more"></i>Users</a>
                    </li>
                </ul>
            </li>

            <!-- Blog Post -->
            <li class="treeview {{ $prefix === '/admin/blog' ? 'active' : '' }}">
                <a href="#">
                    <i class="fa fa-tag"></i>
                    <span>Blog Post</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $route === 'admin.blog.cat.index' ? 'active' : '' }}">
                        <a href="{{ route('admin.blog.cat.index') }}"><i class="ti-more"></i>
                            Blog Category</a>
                    </li>
                    <li class="{{ $route === 'admin.blog.create' ? 'active' : '' }}">
                        <a href="{{ route('admin.blog.create') }}"><i class="ti-more"></i>Add Post</a>
                    </li>
                    <li class="{{ $route === 'admin.blog.index' ? 'active' : '' }}">
                        <a href="{{ route('admin.blog.index') }}"><i class="ti-more"></i>Manage Post</a>
                    </li>
                </ul>
            </li>

            <!-- Review -->
            <li class="treeview {{ $prefix === '/admin/review' ? 'active' : '' }}">
                <a href="#">
                    <i class="fa fa-tag"></i>
                    <span>Review</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $route === 'admin.review.pending' ? 'active' : '' }}">
                        <a href="{{ route('admin.review.pending') }}"><i class="ti-more"></i> Pending
                            Review</a>
                    </li>
                    <li class="{{ $route === 'admin.review.published' ? 'active' : '' }}">
                        <a href="{{ route('admin.review.published') }}"><i class="ti-more"></i> Published
                            Review</a>
                    </li>

                </ul>
            </li>

            <!-- Setting -->
            <li class="treeview {{ $prefix === '/setting' ? 'active' : '' }}">
                <a href="#">
                    <i class="fa fa-tag"></i>
                    <span> Setting</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $route === 'setting.site.index' ? 'active' : '' }}">
                        <a href="{{ route('setting.site.index') }}"><i class="ti-more"></i>Site Setting</a>
                    </li>
                    <li class="{{ $route === 'setting.seo.index' ? 'active' : '' }}">
                        <a href="{{ route('setting.seo.index') }}"><i class="ti-more"></i>Seo Setting</a>
                    </li>
                </ul>
            </li>

        </ul>
    </section>

    <div class="sidebar-footer">
        <!-- item-->
        <a href="javascript:void(0)" class="link" data-toggle="tooltip" title=""
            data-original-title="Settings" aria-describedby="tooltip92529"><i class="ti-settings"></i></a>
        <!-- item-->
        <a href="mailbox_inbox.html" class="link" data-toggle="tooltip" title=""
            data-original-title="Email"><i class="ti-email"></i></a>
        <!-- item-->
        <a href="javascript:void(0)" class="link" data-toggle="tooltip" title=""
            data-original-title="Logout"><i class="ti-lock"></i></a>
    </div>
</aside>
