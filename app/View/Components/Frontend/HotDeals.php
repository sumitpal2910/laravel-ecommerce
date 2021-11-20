<?php

namespace App\View\Components\Frontend;

use Illuminate\View\Component;

class HotDeals extends Component
{
    /**
     * set property
     */
    public $class;
    public $products;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($class="", $products)
    {
        $this->class = $class;
        $this->products = $products;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.frontend.hot-deals');
    }
}
