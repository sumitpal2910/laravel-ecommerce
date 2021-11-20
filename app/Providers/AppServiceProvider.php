<?php

namespace App\Providers;

use App\View\Components\Frontend\HotDeals;
use App\View\Components\Frontend\ProductTab;
use App\View\Components\Frontend\SpecialOffer;
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
         * ===== FRONTEND ======
         */
        # frontend product tab
        Blade::component('product-tab', ProductTab::class);
        
        # frontend hot deals
        Blade::component('hot-deals', HotDeals::class);

        # frontend special offer
        Blade::component('special-offer', SpecialOffer::class);
    }
}
