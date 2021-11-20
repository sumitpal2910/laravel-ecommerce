<?php

namespace App\View\Components\Frontend;

use Illuminate\View\Component;

class ProductTab extends Component
{
    /**
     * set property
     */
    public $products;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($products)
    {
        $this->products = $products;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.frontend.product-tab');
    }
}
