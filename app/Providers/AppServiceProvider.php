<?php

namespace App\Providers;

use App\View\Components\Frontend\Sidebar\HotDeals;
use App\View\Components\Frontend\ProductGridView;
use App\View\Components\Frontend\ProductListView;
use App\View\Components\Frontend\Sidebar\ProductTags;
use App\View\Components\Frontend\Sidebar\Category;
use App\View\Components\Frontend\Sidebar\SpecialOffer;
use App\View\Components\Frontend\Sidebar\Testimonial;
use App\View\Components\Frontend\Sidebar\VerticalMenu;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /**
         * ====================================
         *      FRONTEND
         * ====================================
         */
        # product grid view
        Blade::component('product-grid-view', ProductGridView::class);

        # product list view
        Blade::component('product-list-view', ProductListView::class);





        // ========= SIDEBAR ===========
        # shop by category
        Blade::component('sidebar-category', Category::class);

        # vertical sidebar menu
        Blade::component('vertical-menu', VerticalMenu::class);

        # hot deals
        Blade::component('hot-deals', HotDeals::class);

        # special offer
        Blade::component('special-offer', SpecialOffer::class);

        # product tag
        Blade::component('sidebar-product-tags', ProductTags::class);

        # testimoinal
        Blade::component('sidebar-testimonial', Testimonial::class);
    }
}
