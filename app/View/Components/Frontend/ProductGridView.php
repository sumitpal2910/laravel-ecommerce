<?php

namespace App\View\Components\Frontend;

use Illuminate\View\Component;

class ProductGridView extends Component
{
    /**
     * set property
     */
    public $products;
    public $class;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($products, $class = "")
    {
        $this->products = $products;
        $this->class = $class;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.frontend.product-grid-view');
    }
}
