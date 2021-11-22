@php
# get all category, sub category, sub sub category and products
$categories = App\Models\Category::with(['subCategory', 'subCategory.subSubCategory'])
    ->orderBy('name_en', 'asc')
    ->get();
@endphp

<div class="side-menu animate-dropdown outer-bottom-xs">
    <div class="head"><i class="icon fa fa-align-justify fa-fw"></i> Categories</div>
    <nav class="yamm megamenu-horizontal">
        <ul class="nav">

            <!-- Categories-->
            @foreach ($categories as $category)
                <li class="dropdown menu-item"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
                            class="icon {{ $category->icon }}" aria-hidden="true"></i>
                        @if (session()->get('language') === 'hindi')
                            {{ $category->name_hin }}
                        @else
                            {{ $category->name_en }}
                        @endif
                    </a>
                    <ul class="dropdown-menu mega-menu">
                        <li class="yamm-content">
                            <div class="row">
                                @foreach ($category->subCategory as $subCategory)

                                    <div class="col-sm-12 col-md-3">
                                        <a
                                            href="{{ route('product.subCategory', ['subcat' => $subCategory->id, 'slug' => $subCategory->slug_en]) }}">
                                            <h2 class="title">
                                                @if (session()->get('language') === 'hindi') {{ $subCategory->name_hin }}@else {{ $subCategory->name_en }}@endif
                                            </h2>
                                        </a>
                                        <ul class="links list-unstyled">
                                            @foreach ($subCategory->subSubCategory as $subSub)
                                                <li>
                                                    <a
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

                            </div>
                            <!-- /.row -->
                        </li>
                        <!-- /.yamm-content -->
                    </ul>
                    <!-- /.dropdown-menu -->
                </li>
                <!-- /.menu-item -->
            @endforeach

            <li class="dropdown menu-item"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
                        class="icon fa fa-envira"></i>Home and Garden</a>
                <!-- /.dropdown-menu -->
            </li>
            <!-- /.menu-item -->

        </ul>
        <!-- /.nav -->
    </nav>
    <!-- /.megamenu-horizontal -->
</div>
