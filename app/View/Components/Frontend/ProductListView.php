<?php

namespace App\View\Components\Frontend;

use Illuminate\View\Component;

class ProductListView extends Component
{
    /**
     * set property
     */
    public $product;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($product)
    {
        $this->product = $product;
    }


    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.frontend.product-list-view');
    }
}
